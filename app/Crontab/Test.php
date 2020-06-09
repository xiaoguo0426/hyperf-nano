<?php


namespace App\Crontab;


class Test
{

    public function __invoke()
    {
        // TODO: Implement __invoke() method.
        $this->execute();
    }

    public function aaa()
    {
        echo '我是1秒触发一次';
    }
    public function bbb()
    {
        echo '我是2秒触发一次';
    }

    public function ccc()
    {
        echo '我是5秒触发一次';
    }
}