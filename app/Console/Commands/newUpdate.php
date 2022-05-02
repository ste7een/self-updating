<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Artisan;


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
        // Artisan::call('migrate');
        // $this->info('Migrated.');
        // Artisan::call('git merge main');
        // //artisan to merge the main branch
        // $this->info('Merged.');
        // return 0;
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://api.github.com/repos/ste7een/self-updating/releases/latest');
        $latest = json_decode($res->getBody()->getContents());

        // get current release from config
        $current = config('app.version');

        if ($latest->tag_name > $current) {
            Artisan::call('down');
            Artisan::call('up');
            $this->info('New update available. Please restart your application.');
        } else {
            $this->info('No new updates available.');
        }
    }
}
