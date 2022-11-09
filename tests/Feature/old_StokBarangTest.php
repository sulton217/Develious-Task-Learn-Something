<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class old_StokBarangTest extends TestCase
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

    public function it_stores_data()
    {
        $response =  StokBarang::factory()->create()
        //Hit post ke method store, fungsinya ya akan lari ke fungsi store.
        ->post(route('stokbarang.store'), [
            //isi parameter sesuai kebutuhan request
            'nama' => $this->faker->name(),
            'jumlah' => $this->faker->numberBetween(1, 50),
            'kodebarang' => $this->faker->numberBetween(1, 100),
        ]);
    
        //Tuntutan status 302, yang berarti redirect status code.
        $response->assertStatus(302);
    
        //Tuntutan bahwa abis melakukan POST URL akan dialihkan ke URL product atau routenya adalah product.index
        $response->assertRedirect(route('stokbarang.index'));
    }

}
