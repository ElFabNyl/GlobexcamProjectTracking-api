<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * @return void
     * @test
     */
    public function requires_email_and_password()
    {
        $this->json('POST', 'api/user/login')
            ->assertStatus(422)
            ->assertJson([
                'status' => false,
                "error" => [
                    "email" => [
                        "The email field is required."
                    ],
                    "password" => [
                        "The password field is required."
                    ]
                ]
            ]);
    }

    /** @test */
    public function require_email()
    {
        $this->json('POST', 'api/user/login')
            ->assertStatus(422)
            ->assertJson([
                'status' => false,
                "error" => [
                    "email" => [
                        "The email field is required."
                    ]
                ]
            ]);
    }

    /** @test */
    public function require_password()
    {
        $this->json('POST', 'api/user/login')
            ->assertStatus(422)
            ->assertJson([
                'status' => false,
                "error" => [
                    "password" => [
                        "The password field is required."
                    ]
                ]
            ]);
    }

//    /** @test */
//    public function user_login_successfully()
//    {
//        $user = User::factory()->create([
//            'email' => 'stevymarlino@user.com',
//            'password' => bcrypt('password'),
//        ]);
//
//        $payload = ['email' => 'stevymarlino@user.com', 'password' => 'password'];
//
//        $this->json('POST', 'api/user/login', $payload)
//            ->assertStatus(200)
//            ->assertJsonStructure([
//                'message',
//                'data' => [
//                    'token',
//                    'user' => [
//                        'id',
//                        'name',
//                        'last_name',
//                        'phone',
//                        'role',
//                        'email',
//                        'email_verified_at',
//                        'created_at',
//                        'updated_at',
//                    ]
//                ],
//            ]);
//    }

}
