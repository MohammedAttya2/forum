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
    
    /** @test */
    public function threads_could_be_filtered_by_channels()
    {
        $channel = create('App\Channel');
        $threadInChannel = create('App\Thread', ['channel_id' => $channel->id]);
        $threadNotInChannel = create('App\Thread');
        $this->get('/threads/' . $channel->slug)
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title);
    }

    /** @test */
    public function a_user_can_filter_threads_by_any_username()
        {
            $this->signIn(create('App\User', ['name' => 'JohnDoe']));
            $threadByJohn = create('App\Thread', ['user_id' => auth()->id()]);
            $threadNotByJohn = create('App\Thread');
            $this->get('/threads?by=JohnDoe')
                ->assertSee($threadByJohn->title)
                ->assertDontSee($threadNotByJohn->title);
        }

    /** @test */
    public function a_user_can_filter_threads_by_popularity()
    {
        $threadWithTwoReplies = create('App\Thread');
        create('App\Reply', ['thread_id' => $threadWithTwoReplies->id], 2);

        $threadWithThreeReplies = create('App\Thread');
        create('App\Reply', ['thread_id' => $threadWithThreeReplies->id], 3);


        $threadWithNoReplies = $this->thread;

        $response = $this->getJson('/threads?popular=1')->json();

        $this->assertEquals([3, 2, 0], array_column($response, 'replies_count'));



    }
    

}
