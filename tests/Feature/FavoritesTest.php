<?php

namespace Tests\Feature;

use Mockery\Exception;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class FavoritesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
        public function guest_cannot_favorite_anything()
        {
            $this->withExceptionHandling()
                ->post("/replies/1/favorites")
                ->assertRedirect('/login');

        }
    
    /** @test */
    public function an_authenticated_user_can_favorite_any_reply()
    {
        $this->signIn();
        $reply = create('App\Reply');
        $this->post("/replies/{$reply->id}/favorites");
        $this->assertCount(1, $reply->favorites);
    }

    /** @test */
        public function authenticated_user_may_only_favorite_reply_once()
        {
            $this->signIn();
            $reply = create('App\Reply');
            try {
                $this->post("/replies/{$reply->id}/favorites");
                $this->post("/replies/{$reply->id}/favorites");
            } catch (\Exception $e) {
                $this->fail('Did not expect to insert the same record twice');
            }
            $this->assertCount(1, $reply->favorites);
        }
}
