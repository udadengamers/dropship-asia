<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seller = User::create([
            'fname' => 'Seller',
            'lname' => 'A',
            'email' => 'seller_a@gmail.com',
            'email_verified_at' => now(),
            'otp' => Str::random(10),
            'otp_expired_at' => now()->addDays(1),
            'otp_verified_at' => now(),
            'phone' => '62895411966110',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'type' => 'seller',
            'state' => 'active',
            'wallet_address' => Str::random(60, 'alnum'),
        ]);

        if ($seller) {
            $seller->shop()->create([    
                'name' => 'Rock Stereo',     
                'slug' => 'rock_stereo',
                'description' => 'Rock Stereo is a absolute music shop.',    
                'supplier_name' => 'Electric Mania',    
                'invitation_code' => 'RS2023',    
                'phone_number' => '1234-1234',    
                'contact_person' => 'Will Smith',    
                'id_card' => '8197238',    
                'address' => '123 Lukaku Road, Small ville Canada',    
                'payment_method_id' => 2,    
                'profile_picture' => null,    
                'business_license' => null,    
                'type' => 'music',    
                'state' => 'active'  
            ]);
        }
    }
}
