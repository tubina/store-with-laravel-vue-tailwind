<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(2)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => '12345678'
        ]);
        User::factory()->create([
            'name' => 'felipe',
            'email' => 'felipe@mail.com',
            'password' => '12345678'
        ]);

         DB::table('category')->insert([
            'name' => 'Eletrônicos',
        ]);
         DB::table('category')->insert([
            'name' => 'Roupas',
        ]);
         DB::table('category')->insert([
            'name' => 'Acesórios',
        ]);
         DB::table('category')->insert([
            'name' => 'Portateis',
        ]);

        Product::factory(10)->create();



    }
}
