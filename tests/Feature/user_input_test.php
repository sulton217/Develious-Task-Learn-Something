<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class user_input_test extends TestCase
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

    public function user_input_test()
    {
        $this->visit('/post/create');

     
        $this->submitForm('Save', [
            'title' => 'Test User input DB ',
            'description' => 'Lorem Ipsum  '
        ]);

        $this->seeInDatabase('posts', [
            'title' => 'Test User input DB ',
            'description' => 'Lorem Ipsum  '
        ]);

        $this->seePageIs('/post');

        $this->see('Test User input DB'); 
        $this->see('Lorem Ipsum'); 
        
    }
}
