<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FactoryUnitTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_factory()
    {
        Product::factory()->create(['name' => 'TestFactory']);
        
        // $response = $this->get('/');

        // $response->assertStatus(200);

        Product::where('name','TestFactory')->delete();

    }
}
