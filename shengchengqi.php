<?php
/**
 * Created by PhpStorm.
 * User: artist
 * Date: 2019-05-22
 * Time: 18:17
 */
function xrange($start, $limit, $step = 1) {
    for ($i = $start; $i < $limit; $i += $step) {
        yield $i + 1 => $i;
    }
}
foreach (xrange(0, 9) as $key => $val) {
    printf("%d %d \n", $key, $val);
    echo "<br>";

}
//yield 除了可以返回值以外，还能接收值，也就是可以在两个层级间实现双向通信。
//Generator 对象除了实现 Iterator 接口中的必要方法以外，还有一个 send 方法，这个方法就是向 yield 语句处传递一个值，
//同时从 yield 语句处继续执行，直至再次遇到 yield 后控制权回到外部。
function printer()
{
    $i = 0;
    while (true) {
        printf("receive: %s\n", (yield ++$i));
    }
}
$printer = printer();
printf("%d\n", $printer->current());
$printer->send('hello');
printf("%d\n", $printer->current());
$printer->send('world');
printf("%d\n", $printer->current());

