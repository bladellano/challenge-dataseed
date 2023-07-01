<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;

class UserControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        config(['database.connections.sqlite_testing' => [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]]);

        $this->app['config']->set('database.default', 'sqlite_testing');
        Artisan::call('migrate');
    }

    protected function getToken()
    {
        $authentication = $this->post('/auth/login', [
            'login' => 'admin',
            'password' => 'password',
        ]);
        return $authentication->json('access_token');
    }

    public function testCreateUserPublic()
    {
        Artisan::call('db:seed');

        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'login' => 'johndoe',
        ]);

        $retrievedUser = User::find($user->id);

        $this->assertEquals('John Doe', $retrievedUser->name);
        $this->assertEquals('john@example.com', $retrievedUser->email);
    }

    public function testCreateUserPrivate()
    {
        Artisan::call('db:seed');

        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'login' => 'johndoe',
        ];

        $response = $this->withHeader('Authorization', "Bearer " . $this->getToken())
        ->post('/api/users/', $data);

        $response->assertStatus(201);
    }

    public function testReadUser()
    {
        Artisan::call('db:seed');

        $user = \App\Models\User::factory()->create();

        $response = $this->withHeader('Authorization', "Bearer " . $this->getToken())
            ->get('/api/users/' . $user->id);

        $response->assertStatus(200);
        $response->assertJson($user->toArray());
    }

    public function testUpdateUser()
    {
        Artisan::call('db:seed');

        $user = \App\Models\User::factory()->create();

        $data = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ];

        $response = $this->withHeader('Authorization', "Bearer " . $this->getToken())
            ->put('/api/users/' . $user->id, $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', ['email' => 'updated@example.com']);
    }

    public function testDeleteUser()
    {
        Artisan::call('db:seed');

        $user = \App\Models\User::factory()->create();

        $response = $this->withHeader('Authorization', "Bearer " . $this->getToken())
        ->delete('/api/users/' . $user->id);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function testUserDataValidation()
    {
        Artisan::call('db:seed');

        $data = [
            'name' => 'John Doe',
            'email' => 'invalid_email',
            'password' => 'pass',
        ];

        $response = $this->withHeader('Authorization', "Bearer " . $this->getToken())
            ->post('/api/users/', $data);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email', 'password']);
    }
}
