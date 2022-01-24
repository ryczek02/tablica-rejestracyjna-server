<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\LicensePlate;
use App\Models\User;
use Tests\TestCase;

class CommentsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_comment_be_stored_existing_license_plate()
    {
        //Arrange
        $user = User::factory()->create();

        $licensePlate = LicensePlate::factory([
            'region' => 'OP',
            'unique_plate' => '53835'
        ])->create();

        $comment = Comment::factory([
            'description' => 'A foo bar testing comment'
        ])->create();

        $response = $this->get('/api/comments');
        $response->assertSeeText('A foo bar testing comment');
    }

    public function test_can_comment_be_stored_for_not_existing_license_plate(){
        //Arrange
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/api/comments', ['region' => 'OP', 'unique_plate' => '5ABAB', 'description' => 'An example foo bar testing comment']);
        $response->assertStatus(200);
    }
}
