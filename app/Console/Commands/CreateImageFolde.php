<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateImageFolde extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:image-folder';

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
        File::exists(storage_path('app/public/img')) or File::makeDirectory(storage_path('app/public/img'), 0777, true);

        File::copy(public_path('img/temp-img-profile.png'), storage_path('app/public/img/temp-img-profile.png'));

        File::copy(public_path('img/temp-img-profile.jpg'), storage_path('app/public/img/temp-img-profile.jpg'));
    }
}
