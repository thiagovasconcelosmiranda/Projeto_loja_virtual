<?php

namespace Database\Seeders;

use App\Models\Seller;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Seller::create([
            'name_seller' => 'Luiz Pais'
        ]);
        Seller::create([
            'name_seller' => 'Rosana Oliveira'
        ]);
        Seller::create([
            'name_seller' => 'Nicole Nascimento'
        ]);
    }
}
