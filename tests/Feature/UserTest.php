<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Drop the 'users' and 'farms' collection before each test
        DB::connection('mongodb')->getCollection('users')->drop();
        DB::connection('mongodb')->getCollection('farms')->drop();
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

    public function test_can_add_farm()
    {
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'johndoe@gmail.com',
            'role' => 'manager'
        ]);

        Auth::user($user);

        $attributes = [
            'name' => 'Farm Fresh',
            'location' => 'Kajang'
        ];

        $response = $this->actingAs($user)->post(route('farm.add'), $attributes);

        $response->assertStatus(201);
        $this->assertDatabaseHas('farms', $attributes, 'mongodb');
    }
}
