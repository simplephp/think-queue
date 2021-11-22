<?php

namespace think\message\queue;

use think\helper\Arr;
use think\helper\Str;
use think\message\Queue;
use think\message\queue\command\FailedTable;
use think\message\queue\command\FlushFailed;
use think\message\queue\command\ForgetFailed;
use think\message\queue\command\Listen;
use think\message\queue\command\ListFailed;
use think\message\queue\command\Restart;
use think\message\queue\command\Retry;
use think\message\queue\command\Table;
use think\message\queue\command\Work;

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
