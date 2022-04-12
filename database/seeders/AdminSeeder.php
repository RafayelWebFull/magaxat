<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
            'type' => 'admin',
            'country_id' => 2,
            'unique_id' => str_random(60)
        ]);

        User::create([
            'name' => 'adminApp',
            'email' => 'adminApp@example.com',
            'password' => Hash::make('password'),
            'type' => 'admin',
            'country_id' => 2,
            'unique_id' => str_random(60)
        ]);

        User::create([
            'name' => 'Some User',
            'email' => 'uu@uu.u',
            'password' => Hash::make('password'),
            'type' => 'user',
            'country_id' => 2,
            'age' => 25,
            'phone_number' => "+37495632145",
            'gender' => 'male',
            "date_of_birth" => now(),
            "organisation_description" => 'SOme description very long.',
            'unique_id' => str_random(60)
        ]);
    }
}
