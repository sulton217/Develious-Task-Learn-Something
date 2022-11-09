<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use app\Models\StokBarang;
use App\Models\User;

class StokBarangTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */


    public function testIndex()
    {
        $this->json('GET','/stokbarang', ['Accept' => 'application/json'])->assertStatus(200);
    }

    public function testStore()
    {
        $data = StokBarang::factory()->create(); 
        $this->withoutExceptionHandling();
        $this->json('POST', '/stokbarang', $data->toArray(), ['Accept' => 'application/json'])
            ->assertStatus(302)
            ->assertRedirect(route('stokbarang.index'));
    }

    public function testUpdate()
    {
    $data = StokBarang::factory()->create();
    $this->withoutExceptionHandling();
    $this->json('PUT', 'stokbarang/'.$data->id, $data->toArray(), ['Accept' => 'application/json'])
        ->assertStatus(302)
        ->assertRedirect(route('stokbarang.index'));
    }

    public function testDelete()
    {
    $data = StokBarang::factory()->create();
    $this->withoutExceptionHandling();
    $this->json('DELETE', 'stokbarang/'.$data->id, ['Accept' => 'application/json'])
        ->assertStatus(302)
        ->assertRedirect(route('stokbarang.index'));
    }
}
