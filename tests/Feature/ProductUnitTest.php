<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;


class ProductUnitTest extends TestCase
{
    /**
     * A sbasic feature test example.
     *
     * @return void
     */

    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    // public function testInsert()
    // {
    //     $dummydata = ["name" => "UnitTestSampleName1","detail" => "UnitTestSampleDetail1"];
    //     $response = $this->withHeaders($this->login())->json('POST', '/api/products/store',$dummydata);
    //     $response->assertJsonFragment(["success" => true]);
    // }

    // public function testList()
    // {
    //     $response = $this->withHeaders($this->login())->json('GET', '/api/products/');
    //     $response->assertJsonFragment(["name" => "UnitTestSampleName1"]);
    // }

    // public function testShowByID()
    // {
    //     $lastid=Product::latest('id')->pluck('id')->first();
    //     $response = $this->withHeaders($this->login())->json('GET', '/api/products/show/'.$lastid);
    //     $response->assertJsonFragment(["name" => "UnitTestSampleName1"]);
    // }

    // public function testUpdate()
    // {
    //     $lastid=Product::latest('id')->pluck('id')->first();
    //     $dummydata = ["name" => "UnitTestSampleName2","detail" => "UnitTestSampleDetail2"];
    //     $response = $this->withHeaders($this->login())->json('PUT', '/api/products/update/'.$lastid,$dummydata);
    //     $response->assertJsonFragment(["success" => true]);
    // }

    // public function testDeleteByID()
    // {
    //     $getdummy=Product::where('name','UnitTestSampleName1')->latest('id')->pluck('id')->first();
    //     $response = $this->withHeaders($this->login())->json('delete', '/api/products/delete/'.$getdummy);
    //     $response->assertJsonFragment(["message" => "Product deleted successfully."]);
    //     Product::where('name','UnitTestSampleName1')->delete();
    //     Product::where('name','UnitTestSampleName2')->delete();
    // }

}
