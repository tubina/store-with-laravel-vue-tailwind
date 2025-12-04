<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        // Criar um produto válido vinculado à categoria
        $product = Product::factory()->create([
            'category_id' => $category->id,
        ]);

        // Criar item no carrinho
        Cart::factory()->create([
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);

        // Acessar a rota
        $response = $this->actingAs($user)->get('/cart', [
            'X-Inertia' => 'true'
        ]);

        // Capturar os props do Inertia
        $props = $response->json('props');

        // Testar se existe o cart
        $this->assertArrayHasKey('cart', $props);
    }
}
