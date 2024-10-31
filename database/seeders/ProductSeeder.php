<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create(
            [
                'image' => 'product1.jpg',
                'name_product' => 'Console PlayStantion 5',
                'description' => 'PlayStation 5 Console [videogame]',
                'qtd' => 100,
                'price' => 3500.00,
                'created_at'=> '2024-10-26 10:12:30',
                'updated_at' => '2024-10-26 10:12:30'

            ],    
        );

        Product::create(
            [
                'image' => 'product2.jpg',
                'name_product' => 'Console Xbox serie S',
                'description' => 'Xbox Series S 550GB acompanha cabos e controle cor branco',
                'qtd' => 100,
                'price' => 4500.00,
                'created_at'=> '2024-10-26 10:12:30',
                'updated_at' => '2024-10-26 10:12:30'

            ],
        );

        Product::create(
            [
                'image' => 'product3.jpg',
                'name_product' => 'Console Nintendo Switch OLED',
                'description' => 'Console Nintendo Switch OLED - Azul e Vermelho Neon',
                'qtd' => 300,
                'price' => 2460.00,
                'created_at'=> '2024-10-26 10:12:30',
                'updated_at' => '2024-10-26 10:12:30'

            ],
        );

        Product::create(
            [
                'image' => 'product4.jpg',
                'name_product' => 'Jogo PlayStation 5 Sniper Elite 5',
                'description' => 'Cd Jogo PlayStation 5 Sniper Elite 5, acompanha manual.',
                'qtd' => 300,
                'price' => 2460.00,
                'created_at'=> '2024-10-26 10:12:30',
                'updated_at' => '2024-10-26 10:12:30'

            ],
        );

        Product::create(
            [
                'image' => 'product5.jpg',
                'name_product' => 'Jogo Mortal Combate 11',
                'description' => 'Cd Jogo Mortal Combate 11 acompanha manual',
                'qtd' => 300,
                'price' => 250.00,
                'created_at'=> '2024-10-26 10:12:30',
                'updated_at' => '2024-10-26 10:12:30'

            ],
        );

        
    }
}
