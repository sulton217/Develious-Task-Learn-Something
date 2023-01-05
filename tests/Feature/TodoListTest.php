<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\TodoList;
class TodoListTest extends TestCase
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

    public function test_single_todo_list(){
        
        $list =  TodoList::factory()->create();

        $response=$this->getJson(route('todo-list.show',$list->id))
                        ->assertStatus(200);
        $this->assertEquals($response->json()['name'] ,$list->name);
    }

}
