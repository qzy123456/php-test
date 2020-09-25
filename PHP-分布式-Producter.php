<?php
/*
 * 作者：zhengzizhi@126.com
 * 日期：二O一七年 七夕节
 */
namespace app\index\controller;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use think\Request;
use think\Db;
use PDO;


class Producer
{
    private $connection;
    private $channel;
    private $callback1_queue;
    private $callback2_queue;
    private $pass_msg1 = true;
    private $pass_msg2 = true;
    /**
     * @var string
     */
    private $response;

    private $waiting1;
    private $waiting2;

    /**
     * @var string
     */
    private $corr_id;

    private $suffix1 = ['01','02','03','04','05','06','07','08','09'];
    private $suffix2 = ['10','20','30','40','50','60','70','80','90'];


    public function __construct() {
        $this->connection = new AMQPStreamConnection('192.168.10.105', 5672, 'guest', 'guest');
        $this->channel = $this->connection->channel();
    }

    /**
     * @return string
     *
     * [root@contoso ~]# chown -R apache:apache /home/myth/www/think/apps/bank-data/data.csv && ll /home/myth/www/think/apps
     * [root@contoso ~]# chmod -R 0755 /home/myth/www/think/apps/bank-data && ll /home/myth/www/think/apps/bank-data
     * [root@contoso ~]# cat /home/myth/www/think/apps/bank-data/data.csv
     * [root@contoso ~]# cat /dev/null > /home/myth/www/think/apps/bank-data/data.csv
     *
     * [root@mariadbxxx ~]# cat /dev/null > /var/log/mariadb/queries.log && cat /dev/null > /var/log/mariadb/mariadb-slow.log && cat /dev/null > /var/log/mariadb/mariadb-error.log
     * [root@mariadbxxx ~]# mysql -uroot -p123456 -h127.0.0.1 -e "reset master"
     *
     * GET http://contoso.org/index/producer/transfer?account[user_from]=1&account[amount]=1024&account[status]=0&account[user_to]=2
     *
     * [root@rabbitmq1 ~]# rabbitmqadmin list bindings
     * [root@rabbitmq1 ~]# rabbitmqadmin list queues
     * [root@rabbitmq1 ~]# rabbitmqadmin get queue=bank.transfers1 requeue=true count=30
     * [root@rabbitmq1 ~]# rabbitmqadmin get queue=bank.transfers2 requeue=true count=10
     *
     * [myth@contoso ~]$ ab -r -t 7200 -s 7200 -k -n 100000 -c 500 "http://contoso.org/index/producer/transfer?account[user_from]=1&account[amount]=1024&account[status]=0&account[user_to]=2"
     */
    public function transfer(Request $request)
    {
        $this->response = null;
        $msg_id = session_create_id();//uniqid();
        //$index = random_int(1,9);
        /*
         * $this->corr_id has a value like 53e26b393313a
         */
        $this->corr_id = $msg_id;
        $user_from = $request->param('account.user_from');
        $amount = $request->param('account.amount');
        $status = $request->param('account.status');
        $user_to = $request->param('account.user_to');

        $account = [
            'msg_id' => $msg_id,
            'user_from' => $user_from,
            'amount' => $amount,
            'status' => $status,
            'user_to' => $user_to,
        ];

        $this->channel->exchange_declare(
            "corp1.fanout",
            'fanout',
            false,
            true,
            false
        );

        list($this->callback1_queue,, ) = $this->channel->queue_declare(
            '', 	#queue $msg_id.$this->suffix1[$index]
            false, 	#passive
            true, 	#durable
            true, 	#exclusive
            false	#auto delete
        );

        $this->channel->queue_declare(
            "bank.transfers1",  #queue
            false,             #passive
            true,              #durable
            false,             #exclusive
            false              #auto delete
        );

        $this->channel->queue_bind('', "corp1.fanout");

        $this->channel->queue_bind("bank.transfers1", "corp1.fanout");

        /*
         * create a message with two properties: reply_to, which is set to the
         * callback queue and correlation_id, which is set to a unique value for
         * every request
         */
        $msg1 = new AMQPMessage(
            json_encode($account), 															#body
            [
                'correlation_id' => $this->corr_id,
                'reply_to' => $this->callback1_queue,
                'delivery_mode' => 2,
            ]	#properties
        );

        /**
         * Publishes a message
         *
         * @param AMQPMessage $msg
         * @param string $exchange
         * @param string $routing_key
         * @param bool $mandatory
         * @param bool $immediate
         * @param int $ticket
         */
        $this->channel->basic_publish(
            $msg1,                  #message
            "corp1.fanout",         #exchange
            "bank.transfers1",      #routing key
            true,                   #mandatory
            false
        );

        $this->channel->basic_consume(
            $this->callback1_queue, 	#queue
            '', 			#consumer_tag = amq.ctag-bzBXVZr5iF7R16bq1NYgYw
            false, 			#no local
            false, 			#no ack
            false, 			#exclusive
            false, 			#no wait
            [$this, 'onCallback1']	#callback
        );

        $this->waiting1 = false;
        while(!$this->waiting1) {
            $this->channel->wait();
        }

        if($this->pass_msg1 == false){
            $this->channel->close();
            $this->connection->close();
            return $this->response;
        }

        $this->channel->exchange_declare(
            "cor2.fanout",
            'fanout',
            false,
            true,
            false
        );

        list($this->callback2_queue,, ) = $this->channel->queue_declare(
            '', 	#queue $msg_id.$this->suffix2[$index]
            false, 	#passive
            true, 	#durable
            true, 	#exclusive
            false	#auto delete
        );

        $this->channel->queue_declare(
            "bank.transfers2",   #queue
            false,               #passive
            true,                #durable
            false,               #exclusive
            false                #auto delete
        );

        $this->channel->queue_bind('', "corp2.fanout");

        $this->channel->queue_bind("bank.transfers2", "corp2.fanout");

        $account['status'] = 1;
        $msg2 = new AMQPMessage(
            json_encode($account), 															#body
            [
                'correlation_id' => $this->corr_id,
                'reply_to' => $this->callback2_queue,
                'delivery_mode' => 2,
            ]	#properties
        );

        $this->channel->basic_publish(
            $msg2,                  #message
            "corp2.fanout",         #exchange
            "bank.transfers2",      #routing key
            true,                   #mandatory
            false
        );

        $this->channel->basic_consume(
            $this->callback2_queue, 	#queue
            '', 			#consumer_tag = amq.ctag-bzBXVZr5iF7R16bq1NYgYw
            false, 			#no local
            false, 			#no ack
            false, 			#exclusive
            false, 			#no wait
            [$this, 'onCallback2']	#callback
        );

        $this->waiting2 = false;
        while(!$this->waiting2) {
            $this->channel->wait();
        }

        $this->channel->close();
        $this->connection->close();

        return $this->response;
    }

    /**
     * When a message appears, it checks the correlation_id property. If it
     * matches the value from the request it returns the response to the
     * application.
     *
     * @param AMQPMessage $rep
     */
    public function onCallback1(AMQPMessage $rep) {
        if($rep->get('correlation_id') == $this->corr_id) {
            $this->waiting1 = true;
            $body = json_decode($rep->body);
            if($body->success == true){
                $msg_id = $body->data->msg_id;
                $user_from = $body->data->user_from;
                $amount = $body->data->amount;
                $status = $body->data->status;
                $user_to = $body->data->user_to;
                if($status == 1){
                    $db1 = Db::connect('db1');
                    $db1->startTrans();
                    try {
                        $db1->execute(
                            'INSERT  INTO think_message_supply(msg_id,user_from,amount,status,user_to) VALUES (?,?,?,?,?)',
                            [$msg_id,$user_from,$amount,$status,$user_to]
                        );
                        $db1->commit();
                    } catch (\Exception $e){
                        $db1->rollback();
                        $this->response = json(['success'=>0,'msg'=>"First Transaction db1 has failed."]);
                        $this->pass_msg1 = false;
                    }
                }
            } else {
                $this->response =  json(['success'=>0,'msg'=>"First Transaction db2 has failed."]);
                $this->pass_msg1 = false;
            }
        }
    }

    /**
     * When a message appears, it checks the correlation_id property. If it
     * matches the value from the request it returns the response to the
     * application.
     *
     * @param AMQPMessage $rep
     */
    public function onCallback2(AMQPMessage $rep) {
        if($rep->get('correlation_id') == $this->corr_id) {
            $this->waiting2 = true;
            $body = json_decode($rep->body);
            if( $body->success == true){
                $msg_id = $body->data->msg_id;
                $user_id = $body->data->user_from;
                $amount = $body->data->amount;
                $status = $body->data->status;
                if($status == 2){
                    $db1 = Db::connect('db1');
                    $db1->startTrans();
                    try {
                        $db1->execute(
                            'UPDATE think_message_supply a SET a.status = ? WHERE a.msg_id = ?',
                            [$status,$msg_id]
                        );
                        $db1->execute(
                            'UPDATE think_account b SET b.amount = b.amount - ? WHERE b.user_id = ?',
                            [$amount,$user_id]
                        );
                        $db1->commit();
                    } catch (\Exception $e){
                        $db1->rollback();
                        file_put_contents(APP_PATH.'bank-data/data.csv', $rep->body.'  ##  '.date('Y-m-d H:i:s',time()).PHP_EOL, FILE_APPEND);
                        $this->response =  json(['success'=>1,'msg'=>"Avoid to rededuct money,now you must contact our customer."]);
                        $this->pass_msg2 = false;
                    }
                    if($this->pass_msg2 == true){
                        $this->response = json(['success'=>1,'msg'=>'Bank Transaction is successfull.']);
                    }
                }
            } else {
                $this->response =  json(['success'=>0,'msg'=>"Second Transaction db2 has failed."]);
            }
        }
    }

}
