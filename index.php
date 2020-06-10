<?php
require_once __DIR__ . '/vendor/autoload.php';

date_default_timezone_set('Asia/Shanghai');

use Hyperf\Contract\ConfigInterface;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Nano\Factory\AppFactory;

!defined('ROOT_PATH') && define('ROOT_PATH', __DIR__);
!defined('ENV') && define('ENV', 'dev');

$baseUri = ROOT_PATH;

$configDir = $baseUri . '/config';

$app = AppFactory::create();

if (file_exists($configDir . '/' . ENV . '.php')) {
    $config = include $configDir . '/' . ENV . '.php';

    if (isset($config['crontab'])) {
        $crontabList = $config['crontab'];
        foreach ($crontabList as $rule => $crontabItems) {
            foreach ($crontabItems as $crontab) {
                $app->addCrontab($rule, function () use ($crontab) {
                    $crontab();
                });
            }
        }

    }

    if (isset($config['log_level'])) {
        $app->getContainer()->get(ConfigInterface::class)->set(StdoutLoggerInterface::class, ['log_level' => $config['log_level']]);
    }

    if (isset($config['command'])) {
        $commandList = $config['command'];

        foreach ($commandList as $command => $commandItem) {
            $app->addCommand($command, function () use ($commandItem) {
                $commandItem();
            });
        }

    }

    $app->config($config);
}

$app->run();