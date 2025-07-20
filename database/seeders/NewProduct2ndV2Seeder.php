<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Exception;
use Illuminate\Support\Facades\Log;

class NewProduct2ndV2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $skip = 10;

    public function run()
    {
        DB::beginTransaction();

        $data = $this->data($this->skip);
        
        $this->create($data);

        DB::commit();
    }

    public function data($skip)
    {
        $client = new Client();

        // $api_response = $client->get('https://www.shopeexiv.com/main/goods/getRandList?limit=100');

        // $api_response = $client->get('https://fakestoreapi.com/products');

        // $api_response = $client->get('https://www.shopeexiv.com/main/goods/getInfo?id=100');

        $api_response = $client->get('https://dummyjson.com/products?skip=75&limit=25');
        
        $responses = json_decode($api_response->getBody());
        
        foreach ($responses as $key => $response) {

            if (is_array($response)) {

                foreach ($response as $key_product => $product) {
    
                    $raw_category = Str::slug($product->category);
    
                    $category = Category::where('slug', $raw_category)->first();
    
                    if ($category) {
                        $merge['category_id'] = $category->id;
                    } else {

                        if (in_array($product->category, ['skincare'])) {
                            $new_category = Category::where('slug', 'cosmetic')->first();
                        } else {    
                            $new_category = Category::create([
                                'name' => $product->category,
                                'slug' => $raw_category,
                                'state' => 'active',
                            ]);
                        }
        
                        $merge['category_id'] = $new_category->id;
                    }


                    if (str_contains_all($product->title, ['shirt', 'dress'])) {
                        $merge = [
                            'stock' => [
                                [
                                    'name' => 'S',
                                    'quantity' => 10000,
                                    'price' => $product->price,
                                    'state' => 'active',
                                ],
                                [
                                    'name' => 'M',
                                    'quantity' => 10000,
                                    'price' => $product->price + 10,
                                    'state' => 'active',
                                ],
                                [
                                    'name' => 'L',
                                    'quantity' => 10000,
                                    'price' => $product->price + 20,
                                    'state' => 'active',
                                ],
                            ]
                        ];
                    } else if (str_contains_all($product->description, ['pants'])) {
                        $merge = [
                            'stock' => [
                                [
                                    'name' => '30',
                                    'quantity' => 10000,
                                    'price' => $product->price,
                                    'state' => 'active',
                                ],
                                [
                                    'name' => '31',
                                    'quantity' => 10000,
                                    'price' => $product->price,
                                    'state' => 'active',
                                ],
                                [
                                    'name' => '32',
                                    'quantity' => 10000,
                                    'price' => $product->price + 10,
                                    'state' => 'active',
                                ],
                                [
                                    'name' => '33',
                                    'quantity' => 10000,
                                    'price' => $product->price + 20,
                                    'state' => 'active',
                                ],
                            ]
                        ];
                    } else if (str_contains_all($product->title, ['shoes'])) {
                        $merge = [
                            'stock' => [
                                [
                                    'name' => '41',
                                    'quantity' => 10000,
                                    'price' => $product->price,
                                    'state' => 'active',
                                ],
                                [
                                    'name' => '42',
                                    'quantity' => 10000,
                                    'price' => $product->price,
                                    'state' => 'active',
                                ],
                                [
                                    'name' => '43',
                                    'quantity' => 10000,
                                    'price' => $product->price + 10,
                                    'state' => 'active',
                                ],
                                [
                                    'name' => '44',
                                    'quantity' => 10000,
                                    'price' => $product->price + 20,
                                    'state' => 'active',
                                ],
                            ]
                        ];
                    } else {
                        $merge['price'] = $product->price;
                        $merge['quantity'] = 10000;
                    }
                    
                    $data[$key_product] = array_merge($merge, [
                        'name' => $product->title,
                        'sku' => Str::slug($product->title),
                        'description' => $product->description,
                        'images' => $product->images
                    ]);

                    $merge = null;
                }
            }
        }
        return $data;
    }

    public function create($results)
    {
        $options = array(
            "ssl" => array (
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
            'http' => array( 
                'header' => 'User-agent: Mozilla/5.0 (Linux; Android 4.4.4; HM NOTE 1LTEW Build/KTU84P) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/33.0.0.0 Mobile Safari/537.36 MicroMessenger/6.0.0.54_r849063.501 NetType/WIFI', 
            )
        );

        $this->command->getOutput()->progressStart(count($results));

        foreach ($results as $key => $data) {
            
            $this->command->getOutput()->progressAdvance();
            try {

                $product = Product::create([
                    "name" => $data['name'],
                    "sku" => $data['sku'],
                    "category_id" => isset($data['category_id']) ? $data['category_id'] : 2,
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
        
        // if ($this->skip != 100) {
        //     sleep(10);
        //     $this->skip += 10;
        //     $this->data($this->skip);
        // }

        $this->command->getOutput()->progressFinish();
    }
}
