<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportSql extends Command
{
    /**
     * The name anad signature of the console command.
     * php artisan import:sql database/sql/dropship.sql
     *
     * @var string
     */
    protected $signature = 'import:sql {path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import SQL file into the database';

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
     * @return int
     */
    public function handle()
    {
        $sqlPath = $this->argument('path');

        if (!file_exists($sqlPath)) {
            $this->error('SQL file not found.');
            return;
        }

        try {
          
            $db = [
                'username' => env('DB_USERNAME'),
                'password' => env('DB_PASSWORD'),
                'host' => env('DB_HOST'),
                'database' => env('DB_DATABASE')
            ];
    
            exec("mysql --user={$db['username']} --password={$db['password']} --host={$db['host']} --database {$db['database']} < $sqlPath");

            $this->info('SQL file imported successfully.');
        } catch (\Exception $e) {
            $this->error('Error importing SQL file: ' . $e->getMessage());
        }
    }
}
