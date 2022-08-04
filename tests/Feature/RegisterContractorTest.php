<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class RegisterContractorTest extends TestCase
{
    use RefreshDatabase;

    public function test_contractor_successfully_registered_without_profile_image(): void
    {
        $data = [
            'name' => 'John Doe',
            'username' => 'johndoe',
            'email' => fake('id-ID')->email,
            'password' => 'secret',
            'password_confirmation' => 'secret',
            'role' => 'contractor',
        ];
        $response = $this->postJson('/api/contractor/auth/register', $data);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'username',
                'email',
                'role',
                'profile_url',
            ],
        ]);

        $user = User::where('email', $data['email'])->first();
        $this->assertNotNull($user);
        $this->assertEquals($data['name'], $user->name);
        $this->assertEquals($data['username'], $user->username);
        $this->assertEquals($data['email'], $user->email);
        $this->assertTrue(Hash::check($data['password'], $user->password));
    }
}
