<?php
interface Logger {
    public function log(string $msg);
}

interface aa extends Logger{
     public function log(string $msg);
}
class Application {
    private $logger;

    public function getLogger(): Logger {
        return $this->logger;
    }

    public function setLogger(Logger $logger) {
        $this->logger = $logger;
    }
}

$app = new Application;
// 使用 new class 创建匿名类
// new class 来实例化一个匿名类，这可以用来替代一些"用后即焚"的完整类定义。
$app->setLogger(new class implements Logger {
    public function log(string $msg) {
        print($msg);
    }
});

$app->getLogger()->log("我的第一条日志");
