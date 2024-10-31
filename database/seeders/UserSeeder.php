<?php

namespace Database\Seeders;

use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      User::create([
         'name'=> 'teste',
         'email' => 'teste@gmail.com',
         'password' => Hash::make('1234'),
      ]);
    }
}
