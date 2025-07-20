<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Exception;
use Illuminate\Support\Facades\Log;
use Database\Seeders\Data\Data;

class NewProduct4thSeeder extends Seeder
{
    public function run()
    {
        $new = new Data;
        
        $options = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
            'http' => array( 
                'header' => 'User-agent: Mozilla/5.0 (Linux; Android 4.4.4; HM NOTE 1LTEW Build/KTU84P) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/33.0.0.0 Mobile Safari/537.36 MicroMessenger/6.0.0.54_r849063.501 NetType/WIFI', 
            )
        );

        $products = $new->product_v_one;

        $this->command->getOutput()->progressStart(count($products));

        foreach ($products as $key => $data) {
            
            $this->command->getOutput()->progressAdvance();

            try {

                $product = Product::create([
                    "name" => $data['name'],
                    "sku" => $data['sku'],
                    "category_id" => $data['category_id'],
                    "description" => $data['description'],
                    // "price" => "200",
                    "state" => "active",
                ]);

                if ($product) {
                    // stocks
                    if (isset($data['stock'])) {
                        $product->update([
                            'is_variation' => true
                        ]);
                        foreach ($data['stock'] as $key => $stock) {
                            $product->stocks()->create([
                                'name' => $stock['name'],
                                'quantity' => 10000,
                                'price' => $stock['price'],
                                'state' => 'active',
                            ]);
                        }
                    } else {
                        $product->update([
                            'is_variation' => false
                        ]);
                        $product->stocks()->create([
                            'name' => 'default',
                            'quantity' => 10000,
                            'price' => $data['price'],
                            'state' => 'active',
                        ]);
                    }
                    // images
                    if ($data['images']) {
                        foreach ($data['images'] as $key => $image) {
                            $info = pathinfo($image);
                            $contents = file_get_contents($image, false, stream_context_create($options));
                            $file = '/tmp/' . $info['basename'];
                            $path = '/tmp';
                            File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
                            file_put_contents($file, $contents);
                            $uploaded_file = new UploadedFile($file, $info['basename']);
                            upload($product->product_images(), $uploaded_file, $data['name'], 'product');
                        }
                    }
                }
            } catch (Exception $e) {
                Log::info($data);
                
                DB::rollback();

                dd($e);
            }
        }

        $this->command->getOutput()->progressFinish();
    }
}
