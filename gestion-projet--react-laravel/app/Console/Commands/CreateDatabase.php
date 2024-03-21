<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


class CreateDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
    }

    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the database'],
        ];
    }

    public function fire()
    {
        DB::getConnection()->statement('CREATE DATABASE :schema', ['schema' => $this->argument('name')]);
    } 
}
