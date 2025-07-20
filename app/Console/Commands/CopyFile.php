<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CopyFile extends Command
{
    /**
     * php artisan copy:file
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'copy:file';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        if ($this->confirm('Are you sure you want to execute this command? This will delete the following folders: img, media, payment-buyer, product, shop, top-up, withdraw.')) {
            $directoriesToDelete = [
                'img',
                'media',
                'payment-buyer',
                'product',
                'shop',
                'top-up',
                'withdraw',
                'withdrawal'
                // Add more folder names here as needed
            ];
            
            foreach ($directoriesToDelete as $directory) {
    
                $directoryPath = storage_path('app/public/' . $directory);
            
                if (File::exists($directoryPath)) {
                    File::deleteDirectory($directoryPath);
                }
            }
    
            $sourceDirectory = public_path('public'); // Path to the source directory
    
            $destinationDirectory = storage_path('app/public'); // Path to the destination directory
    
            File::copyDirectory($sourceDirectory, $destinationDirectory);

            $this->info('Command executed successfully.');
        } else {
            $this->info('Command execution canceled.');
        }
    }
}
