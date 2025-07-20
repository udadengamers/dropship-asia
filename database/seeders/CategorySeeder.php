<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = Category::count();
        
        if ($count == 0) {
            $lists = [
                [
                    'name' => 'electronic',
                    'slug' => 'electronic',
                    'state' => 'active'
                ],
                [
                    'name' => 'shirt',
                    'slug' => 'shirt',
                    'state' => 'active'
                ],
                [
                    'name' => 'shoes',
                    'slug' => 'shoes',
                    'state' => 'active'
                ],
                [
                    'name' => 'bags',
                    'slug' => 'bags',
                    'state' => 'active'
                ],
                [
                    'name' => 'watch',
                    'slug' => 'watch',
                    'state' => 'active'
                ],
                [
                    'name' => 'cosmetic',
                    'slug' => 'cosmetic',
                    'state' => 'active'
                ],
                [
                    'name' => 'pants',
                    'slug' => 'pants',
                    'state' => 'active'
                ],
                [
                    'name' => 'jacket',
                    'slug' => 'jacket',
                    'state' => 'active'
                ],
            ];

            foreach ($lists as $key => $list) {
                Category::create([
                    'name' => $list['name'],
                    'slug' => $list['slug'],
                    'state' => $list['state'],
                ]);
            }
        }
    }
}
