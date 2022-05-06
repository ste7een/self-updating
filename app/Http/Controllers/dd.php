<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dd extends Controller
{
    public function dd()
    {
        //get latest release from github
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://api.github.com/repos/ste7een/self-updating/releases/latest');
        $latest = json_decode($res->getBody()->getContents());

        // get current release from config
        $current = config('app.version');

        $newUpdate = null;

        if ($latest->tag_name > $current) {
            $newUpdate = $latest->tag_name;
        }
        return view('welcome', [
            'latest' => $latest->tag_name,
            'newUpdate' => $newUpdate,
        ]);
    }

    public function update()
    {
        Artisan::call('migrate');
        $this->info('Migrated.');
        $this->info('Merged.');
        $process = new Process(["git","pull"]);
        $process->setWorkingDirectory(base_path());
        $process->run(function ($type, $buffer) {
            if (Process::ERR === $type) {
                echo 'ERR > '.$buffer;
            } else {
                echo 'OUT > '.$buffer;
            }
        });
        return 0;
    }
}
