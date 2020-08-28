<?php
use Swoole\Process;

for ($n = 1; $n <= 3; $n++) {
    $process = new Process(function () use ($n) {
        echo 'Child #' . getmypid() . " start and sleep {$n}s" . PHP_EOL;
        sleep($n);
        echo 'Child #' . getmypid() . ' exit' . PHP_EOL;
    });
    $process->start();
}
for ($n = 3; $n--;) {
    $status = Process::wait(true);
    echo "Recycled #{$status['pid']}, code={$status['code']}, signal={$status['signal']}" . PHP_EOL;
}
echo 'Parent #' . getmypid() . ' exit' . PHP_EOL;
//PS ：每次的进程Id 不一致，由linux分配生成的
//Child #21177 start and sleep 1s
//Child #21178 start and sleep 2s
//Child #21179 start and sleep 3s
//Child #21177 exit
//Recycled #21177, code=0, signal=0
//Child #21178 exit
//Recycled #21178, code=0, signal=0
//Child #21179 exit
//Recycled #21179, code=0, signal=0
//Parent #21175 exit
$redis = new Redis;
$redis->connect('127.0.0.1', 6379);

function callback_function() {
    swoole_timer_after(1000, function () {
        echo "hello world\n";
    });
    global $redis;//同一个连接
};
//1. 子进程启动后会自动清除父进程中 Swoole\Timer::tick 创建的定时器、Process::signal 监听的信号
//和 swoole_event_add 添加的事件监听；
//2. 子进程会继承父进程创建的 $redis 连接对象，父子进程使用的连接是同一个。
swoole_timer_tick(1000, function () {
    echo "parent timer\n";
});//不会继承

Swoole\Process::signal(SIGCHLD, function ($sig) {
    while ($ret = Swoole\Process::wait(false)) {
        // create a new child process
        $p = new Swoole\Process('callback_function');
        $p->start();
    }
});

// create a new child process
$p = new Swoole\Process('callback_function');

$p->start();

//hello world
//parent timer
//parent timer
//parent timer
//parent timer
//parent timer
//parent timer
//parent timer
//parent timer
//........