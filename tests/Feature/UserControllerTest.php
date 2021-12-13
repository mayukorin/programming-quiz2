<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;
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

    public function testStore()
    {
        $response = $this->json('POST', '/api/users/', [
            'name' => 'example',
            'email' => 'll@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(201);
        $new_user = User::where('email', 'll@example.com')->first();
        $response->assertJson([
            'name' => 'example',
            'email' => 'll@example.com',
            'id' => $new_user->id,
        ]);
        $this->assertSame(User::count(), 1);

    }

    public function testStoreWithNameBlank()
    {
        $response = $this->json('POST', '/api/users/',[
            'name' => ' ',
            'email' => 'aaa@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
        $response->assertStatus(400);
        $response->assertJson([
            'message' => array (
                            0 => '名前は必ず指定してください。',
                        ),
        ]);
    }
    public function testStoreWithInvalidEmail()
    {
        $response = $this->json('POST', '/api/users/',[
            'name' => 'example',
            'email' => 'aaa',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
        $response->assertStatus(400);
        $response->assertJson([
            'message' => array (
                            0 => 'メールアドレスには、有効なメールアドレスを指定してください。',
                        ),
        ]);
    }

    public function testStoreWithWrongPasswordConfirmation()
    {
        $response = $this->json('POST', '/api/users/',[
            'name' => 'example',
            'email' => 'aaa@example.com',
            'password' => 'password',
            'password_confirmation' => 'password2',
        ]);
        $response->assertStatus(400);
        $response->assertJson([
            'message' => array (
                            0 => 'パスワードと、確認フィールドとが、一致していません。',
                        ),
        ]);
    }

    public function testStoreWithSameEmail()
    {
        $response = $this->json('POST', '/api/users/',[
            'name' => 'example',
            'email' => 'aaa@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
        $response = $this->json('POST', '/api/users/',[
            'name' => 'example2',
            'email' => 'aaa@example.com',
            'password' => 'password2',
            'password_confirmation' => 'password2',
        ]);
        $response->assertStatus(400);
        $response->assertJson([
            'message' => array (
                            0 => 'メールアドレスの値は既に存在しています。',
                        ),
        ]);
    }
}
