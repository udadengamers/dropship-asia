<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ProductImage;

class RemovePercennt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove:percent';

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
        ProductImage::chunk(100, function($images) {
            foreach ($images as $image) {
                $image->update([
                    'path_file' => str_replace('%', '', $image->path_file)
                ]);
            }
        });
    }
}
