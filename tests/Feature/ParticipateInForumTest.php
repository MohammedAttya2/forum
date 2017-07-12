<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    
    /** @test */
    public function unauthenticated_user_cannot_add_replies()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $this->post('/threads/1/replies', []);
    }
    
    /** @test */
    public function an_authenticated_user_may_participate_in_thread()
    {
        $this->be($user = factory('App\User')->create());

        $thread = factory('App\Thread')->create();
        $reply = factory('App\Reply')->make();

        $this->post('/threads/'.$thread->id.'/replies', $reply->toArray());

        $this->get($thread->path())
            ->assertSee($reply->body);
    }
}
