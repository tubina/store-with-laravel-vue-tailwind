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
        $user = User::factory(2)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => '12345678'
        ]);
        $felipe = User::factory()->create([
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

        $product = Product::factory(10)->create();

        foreach($product as $product)
        {
            DB::table('cart')->insert([
                'user_id' => 4,
                'product_id' => $product->id
            ]);
        }

        $pro = Product::all();
        for($x=0;$x<=10;$x++){
            $pro2 = $pro->random()->id;
            DB::table('favorites')->insert([
                'user_id' => $felipe->id,
                'product_id' => $pro2
            ]);
        }

    }
}
