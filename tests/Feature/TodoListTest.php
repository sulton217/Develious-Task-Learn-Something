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

    use RefreshDatabase;
    private $list;
//run setup  before unist test running 
    public function setUp(): void
    {
        parent::setUp();
        $this->list = TodoList::factory()->create(['name'=>'my list','detail'=>'Dummy Unit Test']);
                // TodoList::where('name',$list->name)->delete();
    }

    public function test_show_single_todo_list(){
        $response=$this->getJson(route('todo-list.show',$this->list->id))
                        ->assertStatus(200);
        $this->assertEquals($response->json()['name'] ,$this->list->name);
    }

    public function test_store_new_todo_list(){
        $response = $this->postJson(route('todo-list.store'),['name'=>$this->list->name,'detail'=>$this->list->detail])
        ->assertCreated()->json();

        $this->assertEquals($this->list->name,$response['name']);
        $this->assertDatabaseHas('todolist',['name'=>$this->list->name]);
    }
    
    public function test_delete_todo_list(){
        $this->deleteJson(route('todo-list.destroy',$this->list->id))
        ->assertNoContent();

        $this->assertDatabaseMissing('todolist',['name' => $this->list->name]);
    }

    public function test_update_todo_list(){
    $this->patchJson(route('todo-list.update',$this->list->id),['name'=>'update name'])
    ->assertOk();

    $this->assertDatabaseHas('todolist',['id' => $this->list->id,'name'=>'update name']);
    }
    
}
