<?php

namespace Tests;
use App\Models\User;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    public $jwtToken = [];
    public function login($user = "admin@gmail.com")
    {
        if (empty($this->jwtToken[$user])) {
            $this->jwtToken[$user] = auth()->login(User::where("email", $user)->first());
        }
        return  ['Authorization' => 'Bearer ' . $this->jwtToken[$user]];
    }


    public function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }
}
