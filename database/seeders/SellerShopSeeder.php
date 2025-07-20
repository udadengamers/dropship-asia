<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class SellerShopSeeder extends Seeder
{
    protected $shops = [
        [
            'name' => 'Fashion Paradise',
            'description' => 'Trendy fashion for men and women',
            'supplier_name' => 'ABC Fashion Suppliers',
            'invitation_code' => 'FASHION2023',
            'phone_number' => '555-1234',
            'contact_person' => 'John Doe',
            'id_card' => '12345',
            'address' => '123 Main Street, Anytown USA',
            'payment_method_id' => 1,
            'profile_picture' => 'https://example.com/fashion-paradise.png',
            'business_license' => 'https://example.com/fashion-paradise-license.pdf',
            'type' => 'clothing',
            'state' => 'active'
        ],
        [
            'name' => 'Healthy Habits',
            'description' => 'Natural supplements and organic food',
            'supplier_name' => 'Green Health Supplies',
            'invitation_code' => 'HEALTHY2023',
            'phone_number' => '555-5678',
            'contact_person' => 'Jane Smith',
            'id_card' => '67890',
            'address' => '456 Elm Street, Anytown USA',
            'payment_method_id' => 2,
            'profile_picture' => 'https://example.com/healthy-habits.png',
            'business_license' => 'https://example.com/healthy-habits-license.pdf',
            'type' => 'health',
            'state' => 'active'
        ],
        [
            'name' => 'Tech Solutions',
            'description' => 'Cutting-edge technology and gadgets',
            'supplier_name' => 'Innovative Tech Suppliers',
            'invitation_code' => 'TECH2023',
            'phone_number' => '555-9012',
            'contact_person' => 'Mark Johnson',
            'id_card' => '34567',
            'address' => '789 Oak Street, Anytown USA',
            'payment_method_id' => 3,
            'profile_picture' => 'https://example.com/tech-solutions.png',
            'business_license' => 'https://example.com/tech-solutions-license.pdf',
            'type' => 'electronics',
            'state' => 'active'
        ],
        [
            'name' => 'Gourmet Delights',
            'description' => 'Delicious gourmet food and artisanal treats',
            'supplier_name' => 'Gourmet Food Co.',
            'invitation_code' => 'DELIGHTS2023',
            'phone_number' => '555-4567',
            'contact_person' => 'Maria Rodriguez',
            'id_card' => '23456',
            'address' => '321 Pine Street, Anytown USA',
            'payment_method_id' => 2,
            'profile_picture' => 'https://example.com/gourmet-delights.png',
            'business_license' => 'https://example.com/gourmet-delights-license.pdf',
            'type' => 'food',
            'state' => 'active'
        ],
        [
            'name' => 'Fitness Focus',
            'description' => 'Fitness equipment and supplements for health enthusiasts',
            'supplier_name' => 'FitCo',
            'invitation_code' => 'FITNESS2023',
            'phone_number' => '555-7890',
            'contact_person' => 'Michael Davis',
            'id_card' => '45678',
            'address' => '567 Maple Avenue, Anytown USA',
            'payment_method_id' => 1,
            'profile_picture' => 'https://example.com/fitness-focus.png',
            'business_license' => 'https://example.com/fitness-focus-license.pdf',
            'type' => 'fitness',
            'state' => 'active'
        ],
        [
            'name' => 'Home Decor Haven',
            'description' => 'Stylish and modern home decor and furniture',
            'supplier_name' => 'DecorCo',
            'invitation_code' => 'DECOR2023',
            'phone_number' => '555-1234',
            'contact_person' => 'Emily Brown',
            'id_card' => '34567',
            'address' => '789 Oak Street, Anytown USA',
            'payment_method_id' => 3,
            'profile_picture' => 'https://example.com/home-decor-haven.png',
            'business_license' => 'https://example.com/home-decor-haven-license.pdf',
            'type' => 'home',
            'state' => 'active'
        ],
        [        
            'name' => 'Fashion Frenzy',        
            'description' => 'Trendy clothing and accessories for fashion-forward individuals',        
            'supplier_name' => 'FashionCo',        
            'invitation_code' => 'FASHION2023',        
            'phone_number' => '555-2345',        
            'contact_person' => 'Sarah Lee',        
            'id_card' => '45678',        
            'address' => '567 Maple Avenue, Anytown USA',        
            'payment_method_id' => 1,        
            'profile_picture' => 'https://example.com/fashion-frenzy.png',        
            'business_license' => 'https://example.com/fashion-frenzy-license.pdf',        
            'type' => 'fashion',        
            'state' => 'active'    
        ],
        [        
            'name' => 'Pet Paradise',        
            'description' => 'High-quality pet food and supplies for animal lovers',        
            'supplier_name' => 'PetCo',        
            'invitation_code' => 'PET2023',        
            'phone_number' => '555-3456',        
            'contact_person' => 'John Smith',        
            'id_card' => '56789',        
            'address' => '123 Elm Street, Anytown USA',        
            'payment_method_id' => 2,        
            'profile_picture' => 'https://example.com/pet-paradise.png',        
            'business_license' => 'https://example.com/pet-paradise-license.pdf',        
            'type' => 'pets',        
            'state' => 'active'    
        ],
        [        
            'name' => 'Toy Time',       
            'description' => 'Fun and educational toys for children of all ages',        
            'supplier_name' => 'ToyCo',        
            'invitation_code' => 'TOYS2023',        
            'phone_number' => '555-5678',        
            'contact_person' => 'Amy Johnson',        
            'id_card' => '67890',        
            'address' => '456 Main Street, Anytown USA',        
            'payment_method_id' => 3,        
            'profile_picture' => 'https://example.com/toy-time.png',        
            'business_license' => 'https://example.com/toy-time-license.pdf',        
            'type' => 'toys',        
            'state' => 'active'    
        ],
        [    
            'name' => 'Fashionista',           
            'description' => 'Trendy and stylish clothing and accessories for men and women',            
            'supplier_name' => 'Fashion Co.',            
            'invitation_code' => 'FASHION2023',            
            'phone_number' => '555-1234',           
            'contact_person' => 'John Smith',            
            'id_card' => '12345',            
            'address' => '789 Main Street, Anytown USA',            
            'payment_method_id' => 2,            
            'profile_picture' => 'https://example.com/fashionista.png',            
            'business_license' => 'https://example.com/fashionista-license.pdf',            
            'type' => 'clothing',            
            'state' => 'active'    
        ],
        [    
            'name' => 'Fresh Market',    
            'description' => 'Fresh produce and meats from local farms and ranches',    
            'supplier_name' => 'FreshCo',    
            'invitation_code' => 'FRESH2023',    
            'phone_number' => '555-1234',    
            'contact_person' => 'John Smith',    
            'id_card' => '12345',    
            'address' => '789 Farm Road, Smalltown USA',    
            'payment_method_id' => 2,    
            'profile_picture' => 'https://example.com/fresh-market.png',    
            'business_license' => 'https://example.com/fresh-market-license.pdf',    
            'type' => 'groceries',    
            'state' => 'active'  
        ],
    ];
    
    public function run()
    {
        foreach ($this->shops as $key => $shop) {

            $faker = \Faker\Factory::create();

            $seller = User::create([
                'fname' => $faker->firstName(),
                'lname' => $faker->lastName(),
                'email' => $faker->unique()->safeEmail(),
                'email_verified_at' => now(),
                'otp' => Str::random(10),
                'otp_expired_at' => now()->addDays(1),
                'otp_verified_at' => now(),
                'phone' => preg_replace("/[^0-9]/", "", $faker->phoneNumber()),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'type' => 'seller',
                'state' => 'active',
                'wallet_address' => Str::random(60, 'alnum'),
            ]);

            if ($seller) {
                $seller->shop()->create([
                    'name' => $shop['name'],
                    'slug' => Str::slug($shop['name']),
                    'description' => $shop['description'],
                    'supplier_name' => $shop['supplier_name'],
                    'invitation_code' => $shop['invitation_code'],
                    'phone_number' => $shop['phone_number'],
                    'contact_person' => $shop['contact_person'],
                    'id_card' => $shop['id_card'],
                    'address' => $shop['address'],
                    'payment_method_id' => $shop['payment_method_id'],
                    'profile_picture' => null, // temporary
                    'business_license' => null,  // temporary
                    'state' => 'active',
                ]);
            }
        }
    }
}
