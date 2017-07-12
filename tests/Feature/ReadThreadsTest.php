<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;


    /**
     * @return mixed
     */
    public function setUp()
    {
        parent::setUp();
        $this->thread = create('App\Thread');
    }

    /** @test */
    public function a_user_can_browse_threads()
    {
        $this->get('/threads')
            ->assertSee($this->thread->title);

    }

    /** @test */
    public function a_user_can_browse_a_single_thread()
    {
        $this->get($this->thread->path())
            ->assertSee($this->thread->title);

    }

    /** @test */
    public function a_user_can_read_replies_associated_with_thread()
    {
        $reply = create('App\Reply', ['thread_id' => $this->thread->id]);
        $this->get($this->thread->path())
            ->assertSee($reply->body);
    }
}
