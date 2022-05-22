<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function testRegister()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function testUserDuplicate()
    {
        $user1 = User::make([
            'name' => 'Milan Milanovic',
            'email' => 'milanmilanovic@gmail.com'
        ]);

        $user2 = User::make([
            'name' => 'Suzana',
            'email' => 'suzana@gmail.com'
        ]);

        $this->assertTrue($user1->name != $user2->name);
    }

    public function testDeleteUser()
    {
        $user = User::find(52);

        if($user){
            $user->delete();
        }
        $this->assertTrue(true);
    }

}
