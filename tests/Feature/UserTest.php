<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Drop the 'users' collection before each test
        DB::connection('mongodb')->getCollection('users')->drop();
    }

    public function test_can_add_user()
    {

        $attributes = [
            'name' => 'John',
            'email' => 'johndoe@gmail.com',
            'role' => 'manager'
        ];

        $response = $this->post(route('register'), $attributes);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', $attributes, 'mongodb');
    }
}
