<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\assertDatabaseHas;

uses(RefreshDatabase::class);

describe('register', function () {

    test('user can register', function () {

        $response = $this->PostJson('/api/register', [
            'name' => ' test',
            'email' => 'test@test.com',
            'password' => 'test1234',
            'password_confirmation' => 'test1234',
        ]);

        $response->assertStatus(201);
        assertDatabaseHas('users', ['email' => 'test@test.com']);
    });

    test('register fails without email', function () {
        $response = $this->postJson('/api/register', [
            'name' => 'Mohamed',
            'password' => 'password123',
            'password_confirmation' => 'test1234',
        ]);

        $response->assertStatus(422);
    });

    test('password confirmation mismatch', function () {
        $response = $this->postJson('/api/register', [
            'name' => 'Mohamed',
            'email' => 'test@test.com',
            'password' => 'password123',
            'password_confirmation' => 'safidjaisdfj324',
        ]);

        $response->assertStatus(422);
    });

    test('duplicate email', function () {

        User::factory()->create(['email' => 'test@test.com']);

        $response = $this->postJson('/api/register', [
            'name' => 'Mohamed',
            'email' => 'test@test.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertStatus(422);

    });

});

describe('login', function () {

    beforeEach(function () {
        $this->user = User::factory()
            ->create(['email' => 'test@test.com', 'password' => bcrypt('test1234')]);
    });

    test('user can login', function () {

        $response = $this->postJson('/api/login', [
            'email' => 'test@test.com',
            'password' => 'test1234',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['token']);
    });

    test('login with wrong email', function () {

        $response = $this->postJson('/api/login', [
            'email' => 'failed@test.com',
            'password' => 'test1234',
        ]);

        $response->assertStatus(401);
    });

    test('login with wrong password', function () {

        $response = $this->postJson('/api/login', [
            'email' => 'test@test.com',
            'password' => 'hrisoerjsoer23',
        ]);

        $response->assertStatus(401);
    });

    test('password not valid', function () {

        $response = $this->postJson('/api/login', [
            'email' => 'test@test.com',
            'password' => 'failed',
        ]);

        $response->assertStatus(422);
    });

    test('email not valid', function () {

        $response = $this->postJson('/api/login', [
            'email' => 'test.com',
            'password' => 'failed1234',
        ]);

        $response->assertStatus(422);
    });

});

describe('logout', function () {
    test('user can logout', function () {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum')
            ->postJson('/api/logout')
            ->assertStatus(200);
    });
});
