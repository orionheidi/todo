<?php

namespace Tests\Feature;
use App\Models\User;
use Tests\TestCase;

class DailyListTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testStore()
    {
        $user = User::find(33);
        $this->actingAs($user, 'api');

        $user->dailyLists()->create([
            'title' => 'hi',
            'description' => 'hi there',
            'date' => '2022-02-09',
            'user_id' => '33'
        ]);

        $this->assertTrue(true);
    }
}
