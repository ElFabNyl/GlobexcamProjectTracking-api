<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function setUp() : void {
        parent::setUp();
        Artisan::call("migrate"); // Migration de la base de donnees
    }
    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function LoginWithAdmin()
    {
        $user = User::factory()->create(['role' => "admin"]);
        $token = Auth::attempt([$user->user,bcrypt('password')]);
        $credentials = [
            'email' => $user->email,
            'password' => bcrypt('password'),
            'token' => $token
        ];
        $response = $this->post( "/user/login", $credentials );
        $this->assertAuthenticated();

        $response->assertStatus(200);
    }
}
