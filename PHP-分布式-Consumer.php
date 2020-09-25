<?php
namespace app\index\controller;
use PDO;
use think\Db;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Consumer
{
    private $connection;
    private $channel;

    public function __construct()
    {

    }



    /**
     * Special remind: before updating consumer code to debug,first,please close consumer listen!
     * Listens for incoming messages
     *
     * [root@rabbitmq1 ~]# rabbitmqctl delete_vhost / && rabbitmqctl add_vhost / && rabbitmqctl set_permissions -p / guest '.*' '.*' '.*'
     * [root@rabbitmq1 ~]# systemctl restart rabbitmq-server && rabbitmqadmin list exchanges
     *
     * [root@contoso ~]# cd /home/myth/www/think && php public/index.php index/Consumer/listen

     */
    public function listen()
    {
        $this-> connection = new AMQPStreamConnection('192.168.10.105', 5672, 'guest', 'guest');
        $this->channel = $this-> connection->channel();

        /**
         * Declares queue, creates if needed
         *
         * @param string $queue
         * @param bool $passive
         * @param bool $durable
         * @param bool $exclusive
         * @param bool $auto_delete
         * @param bool $nowait
         * @param array $arguments
         * @param int $ticket
         * @return mixed|null
         */
        $this->channel->queue_declare(
            'bank.transfers1',#queue - Should be unique in direct exchange
            false,             #passive - false  Don't check if a queue with the same name exists
            true,              #durable - true The queue will survive(exist) server restarts
            false,             #exclusive - false The queue might be accessed by other channels
            false              #auto_delete - false The queue won't be deleted once the channel is closed
        );

        /**
         * Declares exchange
         *
         * @param string $exchange
         * @param string $type
         * @param bool $passive
         * @param bool $durable
         * @param bool $auto_delete
         * @param bool $internal
         * @param bool $nowait
         * @param array $arguments
         * @param int $ticket
         * @return mixed|null
         */
        $this->channel->exchange_declare(
            'corp1.fanout', #exchange - That is the exchange(corp.direct)
            'fanout',      #type - That is the type(direct) of exchange(corp.direct)
            false,         #passive - false Don't check if a exchange with the same name exists
            true,          #durable - true The exchange will survive(exist) server restarts
            false          #auto_delete - false The exchange won't be deleted once the channel is closed
        );

        /**
         * Binds queue to an exchange
         *
         * @param string $queue
         * @param string $exchange
         * @param string $routing_key
         * @param bool $nowait
         * @param array $arguments
         * @param int $ticket
         * @return mixed|null
         */
        $this->channel->queue_bind('bank.transfers1', 'corp1.fanout');


        /**
         * Specifies QoS
         * don't dispatch a new message to a worker until it has processed and
         * acknowledged the previous one. Instead, it will dispatch it to the
         * next worker that is not still busy.
         *
         * @param int $prefetch_size
         * @param int $prefetch_count
         * @param bool $a_global
         * @return mixed
         */
        $this->channel->basic_qos(
            null,   #prefetch size - prefetch window size in octets, null meaning "no specific limit"
            1,      #prefetch count - prefetch window in terms of whole messages
            null    #a_global - null to mean that the QoS settings should apply per-consumer
        #a_global - true to mean that the QoS settings should apply per-channel
        );

        /**
         * Starts a queue consumer
         *
         * @param string $queue
         * @param string $consumer_tag
         * @param bool $no_local
         * @param bool $no_ack
         * @param bool $exclusive
         * @param bool $nowait
         * @param callback|null $callback
         * @param int|null $ticket
         * @param array $arguments
         * @return mixed|string
         */
        $this->channel->basic_consume(
            'bank.transfers1',     #queue - get the messages from the queue(bank.transfers)
            '',                    #consumer_tag - Consumer identifier
            false,                 #no_local - Don't receive messages published by this consumer
            false,                 #no_ack - false acks turned on, - true turned off.  send a proper acknowledgment from the worker, once we're done with a task
            false,                 #exclusive - false The queue(bank.transfers) may be accessed by the all connections
            false,                 #nowait - false Don't wait for a server response
            [$this, 'callback1']   #callback - A PHP callback
        );

        $this->channel->queue_declare(
            'bank.transfers2', #queue - Should be unique in direct exchange
            false,             #passive - false  Don't check if a queue with the same name exists
            true,              #durable - true The queue will survive(exist) server restarts
            false,             #exclusive - false The queue might be accessed by other channels
            false              #auto_delete - false The queue won't be deleted once the channel is closed
        );

        $this->channel->exchange_declare(
            'corp2.fanout', #exchange - That is the exchange(corp.direct)
            'fanout',       #type - That is the type(direct) of exchange(corp.direct)
            false,          #passive - false Don't check if a exchange with the same name exists
            true,           #durable - true The exchange will survive(exist) server restarts
            false           #auto_delete - false The exchange won't be deleted once the channel is closed
        );

        $this->channel->queue_bind('bank.transfers2', 'corp2.fanout');

        $this->channel->basic_consume(
            'bank.transfers2',     #queue - get the messages from the queue(bank.transfers)
            '',                    #consumer_tag - Consumer identifier
            false,                 #no_local - Don't receive messages published by this consumer
            false,                 #no_ack - false acks turned on, - true turned off.  send a proper acknowledgment from the worker, once we're done with a task
            false,                 #exclusive - false The queue(bank.transfers) may be accessed by the all connections
            false,                 #nowait - false Don't wait for a server response
            [$this, 'callback2']   #callback - A PHP callback
        );

        // 'Consuming from queue';
        # Loop as long as the channel has callbacks registered
        # After 10 seconds there will be a timeout exception
        # $channel->wait(null, false, 10)
        while(count($this->channel->callbacks)) {
            // 'Waiting for incoming messages'
            $this->channel->wait();
        }

        $this->channel->close();
        $this->connection->close();
    }

    /**
     * Executes when a message is received.
     *
     * @param AMQPMessage $req
     */
    public function callback1(AMQPMessage $req) {
        $account = json_decode($req->body);
        $msg_id = $req->get('correlation_id');
        $user_from = $account->user_from;
        $amount = $account->amount;
        $status = $account->status;
        $user_to = $account->user_to;
        $_isSuccess = 1;

        if($account->status == 0){
            $status = 1;
            $db2 = Db::connect('db2');
            $db2->startTrans();
            try{
                $cnt = $db2->query(
                    'SELECT COUNT(*) AS cnt FROM think_message_apply a WHERE a.msg_id = ?',
                    [$msg_id]
                );

                if ($cnt[0] == ['cnt'=>0]) {
                    $db2->execute(
                        'INSERT INTO think_message_apply(msg_id,user_from,amount,status,user_to)VALUES(?,?,?,?,?)',
                        [$msg_id,$user_from,$amount,$status,$user_to]
                    );
                }
                $db2->commit();
            } catch (\Exception $e){
                $db2->rollback();
                $_isSuccess = 0;
            }
        }

        if($_isSuccess == 1 && $account->status == 0){
            $status = 1;
            /*
             * Creating a reply message with the same correlation id than the incoming message
             */
            $msg = new AMQPMessage(
                json_encode([
                    'success' => true,
                    'data' => [
                        'msg_id' => $msg_id,
                        'user_from' => $user_from,
                        'amount' => $amount,
                        'status' => $status,
                        'user_to' => $user_to,
                    ],
                ]), #message
                ['correlation_id' => $msg_id]
            );

            /**
             * Publishes a message to the same channel from the incoming message
             *
             * @param AMQPMessage $msg
             * @param string $exchange
             * @param string $routing_key
             * @param bool $mandatory
             * @param bool $immediate
             * @param int $ticket
             */
            $req->delivery_info['channel']->basic_publish(
                $msg,                   #msg
                '',                     #exchange
                $req->get('reply_to')   #routing_key
            );//回复一条入账成功的消息给生产者（消息发送者）

            /**
             * Acknowledges one or more messages to delivery_tag
             * If a consumer dies without sending an acknowledgement the AMQP broker
             * will redeliver it to another consumer or, if none are available at the
             * time, the broker will wait until at least one consumer is registered
             * for the same queue before attempting redelivery
             *
             * @param string $delivery_tag
             * @param bool $multiple
             */
            $req->delivery_info['channel']->basic_ack(
                $req->delivery_info['delivery_tag'] #delivery_tag = '1'
            );//确认一条回复消息已经发送

        } else {
            $status = 0;
            /*
             * Creating a reply message with the same correlation id than the incoming message
             */
            $msg = new AMQPMessage(
                json_encode([
                    'success' => false,
                    'data' => [
                        'msg_id' => $msg_id,
                        'user_from' => $user_from,
                        'amount' => $amount,
                        'status' => $status,
                        'user_to' => $user_to,
                    ],
                ]), #message
                ['correlation_id' => $msg_id]
            );

            /**
             * Publishes a message to the same channel from the incoming message
             *
             * @param AMQPMessage $msg
             * @param string $exchange
             * @param string $routing_key
             * @param bool $mandatory
             * @param bool $immediate
             * @param int $ticket
             */
            $req->delivery_info['channel']->basic_publish(
                $msg,                   #msg
                '',                     #exchange
                $req->get('reply_to')   #routing_key
            );

            /**
             * Acknowledges one or more messages to delivery_tag
             * If a consumer dies without sending an acknowledgement the AMQP broker
             * will redeliver it to another consumer or, if none are available at the
             * time, the broker will wait until at least one consumer is registered
             * for the same queue before attempting redelivery
             *
             * @param string $delivery_tag
             * @param bool $multiple
             */
            $req->delivery_info['channel']->basic_ack(
                $req->delivery_info['delivery_tag'] #delivery_tag = '1'
            );
        }

    }

    /**
     * Executes when a message is received.
     *
     * @param AMQPMessage $req
     */
    public function callback2(AMQPMessage $req) {
        $account = json_decode($req->body);
        $msg_id = $req->get('correlation_id');
        $user_from = $account->user_from;
        $amount = $account->amount;
        $status = $account->status;
        $user_to = $account->user_to;
        $_isSuccess = 1;

        if($account->status == 1){
            $status = 2;
            $db2 = Db::connect('db2');
            $db2->startTrans();
            try{
                $db2->execute(
                    'UPDATE think_account a SET a.amount = a.amount + ? WHERE a.user_id = ?',
                    [$amount,$user_to]
                );
                $db2->execute(
                    'UPDATE think_message_apply b SET b.STATUS = ? WHERE b.msg_id = ?',
                    [$status,$msg_id]
                );
                $db2->commit();
            } catch (\Exception $e){
                $db2->rollback();
                $_isSuccess = 0;
            }
        }

        if($_isSuccess == 1 && $account->status == 1){
            $status = 2;
            /*
             * Creating a reply message with the same correlation id than the incoming message
             */
            $msg = new AMQPMessage(
                json_encode([
                    'success' => true,
                    'data' => [
                        'msg_id' => $msg_id,
                        'user_from' => $user_from,
                        'amount' => $amount,
                        'status' => $status,
                        'user_to' => $user_to,
                    ],
                ]), #message
                ['correlation_id' => $msg_id]
            );

            /**
             * Publishes a message to the same channel from the incoming message
             *
             * @param AMQPMessage $msg
             * @param string $exchange
             * @param string $routing_key
             * @param bool $mandatory
             * @param bool $immediate
             * @param int $ticket
             */
            $req->delivery_info['channel']->basic_publish(
                $msg,                   #msg
                '',                     #exchange
                $req->get('reply_to')   #routing_key
            );//回复一条入账成功的消息给生产者

            /**
             * Acknowledges one or more messages to delivery_tag
             * If a consumer dies without sending an acknowledgement the AMQP broker
             * will redeliver it to another consumer or, if none are available at the
             * time, the broker will wait until at least one consumer is registered
             * for the same queue before attempting redelivery
             *
             * @param string $delivery_tag
             * @param bool $multiple
             */
            $req->delivery_info['channel']->basic_ack(
                $req->delivery_info['delivery_tag'] #delivery_tag = '2'
            );//确认一条回复消息已经发送

        } else {
            $status = 1;
            /*
             * Creating a reply message with the same correlation id than the incoming message
             */
            $msg = new AMQPMessage(
                json_encode([
                    'success' => false,
                    'data' => [
                        'msg_id' => $msg_id,
                        'user_from' => $user_from,
                        'amount' => $amount,
                        'status' => $status,
                        'user_to' => $user_to,
                    ],
                ]), #message
                ['correlation_id' => $msg_id]
            );

            /**
             * Publishes a message to the same channel from the incoming message
             *
             * @param AMQPMessage $msg
             * @param string $exchange
             * @param string $routing_key
             * @param bool $mandatory
             * @param bool $immediate
             * @param int $ticket
             */
            $req->delivery_info['channel']->basic_publish(
                $msg,                   #msg
                '',                     #exchange
                $req->get('reply_to')   #routing_key
            );

            /**
             * Acknowledges one or more messages to delivery_tag
             * If a consumer dies without sending an acknowledgement the AMQP broker
             * will redeliver it to another consumer or, if none are available at the
             * time, the broker will wait until at least one consumer is registered
             * for the same queue before attempting redelivery
             *
             * @param string $delivery_tag
             * @param bool $multiple
             */
            $req->delivery_info['channel']->basic_ack(
                $req->delivery_info['delivery_tag'] #delivery_tag = '2'
            );//确认一条回复消息已经发送
        }

    }

}
