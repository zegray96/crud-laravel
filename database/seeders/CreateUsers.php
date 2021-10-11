<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=> 'gabriel',
            'email'=>'gabriel@mail.com',
            'password' => Hash::make("123")
        ]);

        User::create([
            'name'=> 'lucas',
            'email'=>'lucas@mail.com',
            'password' => Hash::make("123")
        ]);
    }
}