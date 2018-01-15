<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

//Команда, которая "слушает" папку на предмет изменений
class WatchFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'files:watch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Watches some files';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $listener = app('watcher')->watch('storage/app/metrics');

      $listener->onAnything(function ($event, $resource, $path) {
        $handler = new \App\Events\FilesEvent();
        event($handler);
      });

      app('watcher')->start();
    }
}
