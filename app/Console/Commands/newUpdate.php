<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Artisan;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
//use git command in terminal


class newUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newUpdate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'New update installed';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //on click of button run command line
        Artisan::call('migrate');
        $this->info('Migrated.');
        // Process('git merge main');
        $process = new Process(["git","pull"]);
        $process->setWorkingDirectory(base_path());
        $process->run(function ($type, $buffer) {
            if (Process::ERR === $type) {
                echo 'ERR > '.$buffer;
            } else {
                echo 'OUT > '.$buffer;
            }
        });
        $this->info('Merged.');
        return 0;
    }
}
