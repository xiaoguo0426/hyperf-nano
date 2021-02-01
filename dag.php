<?php

require_once __DIR__ . '/vendor/autoload.php';
date_default_timezone_set('Asia/Shanghai');

use Hyperf\Dag\Dag;
use Hyperf\Dag\Vertex;

$dag = new Dag();
$a = Vertex::make(function () {
    sleep(1);
    echo date("Y-m-d H:i:s") . "-A\n";
});
$b = Vertex::make(function () {
    sleep(2);
    echo date("Y-m-d H:i:s") . "-B\n";
});
$c = Vertex::make(function () {
    sleep(1);
    echo date("Y-m-d H:i:s") . "-C\n";
});
$d = Vertex::make(function () {
    sleep(1);
    echo date("Y-m-d H:i:s") . "-D\n";
});
$e = Vertex::make(function () {
    sleep(1);
    echo date("Y-m-d H:i:s") . "-E\n";
});
$f = Vertex::make(function () {
    sleep(1);
    echo date("Y-m-d H:i:s") . "-F\n";
});
$g = Vertex::make(function () {
    sleep(1);
    echo date("Y-m-d H:i:s") . "-G\n";
});
$h = Vertex::make(function () {
    sleep(1);
    echo date("Y-m-d H:i:s") . "-H\n";
});
$i = Vertex::make(function () {
    sleep(1);
    echo date("Y-m-d H:i:s") . "-I\n";
});
$dag->addVertex($a)
    ->addVertex($b)
    ->addVertex($c)
    ->addVertex($d)
    ->addVertex($e)
    ->addVertex($f)
    ->addVertex($g)
    ->addVertex($h)
    ->addVertex($i)
    ->addEdge($a, $b)
    ->addEdge($a, $c)
    ->addEdge($a, $d)
    ->addEdge($b, $h)
    ->addEdge($b, $e)
    ->addEdge($b, $f)
    ->addEdge($c, $f)
    ->addEdge($c, $g)
    ->addEdge($d, $g)
    ->addEdge($h, $i)
    ->addEdge($e, $i)
    ->addEdge($f, $i)
    ->addEdge($g, $i);


// 需要在协程环境下执行
\Swoole\Coroutine\run(function () use ($dag) {
    $dag->run();
});

