<?php

use Illuminate\Database\Seeder;
use App\User;
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
            'name' => 'TiventAdmin',
            'email' => 'tivent@gmail.com',
            'role' => 'admin',
            'nomor_rekening' => 9172465719,
            'password' => Hash::make('admintivent')
        ]);
    }
}
