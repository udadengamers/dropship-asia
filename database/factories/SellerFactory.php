<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SellerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => preg_replace('/@example\..*/', '@domain.com', $this->faker->unique()->safeEmail),
            'phone_number' => $this->faker->unique()->e164PhoneNumber(),
            'otp' => Str::random(10),
            'otp_expired_date' => now()->addDays(1),
            'otp_verify_date' => now(),
            'email_verify_date' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
}
