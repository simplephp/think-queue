<?php

namespace simplephp\queue;

use think\helper\Arr;
use think\helper\Str;
use simplephp\Queue;
use simplephp\queue\command\FailedTable;
use simplephp\queue\command\FlushFailed;
use simplephp\queue\command\ForgetFailed;
use simplephp\queue\command\Listen;
use simplephp\queue\command\ListFailed;
use simplephp\queue\command\Restart;
use simplephp\queue\command\Retry;
use simplephp\queue\command\Table;
use simplephp\queue\command\Work;

class Service extends \think\Service
{
    public function register()
    {
        $this->app->bind('queue', Queue::class);
        $this->app->bind('queue.failer', function () {

            $config = $this->app->config->get('queue.failed', []);

            $type = Arr::pull($config, 'type', 'none');

            $class = false !== strpos($type, '\\') ? $type : '\\think\\queue\\failed\\' . Str::studly($type);

            return $this->app->invokeClass($class, [$config]);
        });
    }

    public function boot()
    {
        $this->commands([
            FailedJob::class,
            Table::class,
            FlushFailed::class,
            ForgetFailed::class,
            ListFailed::class,
            Retry::class,
            Work::class,
            Restart::class,
            Listen::class,
            FailedTable::class,
        ]);
    }
}
