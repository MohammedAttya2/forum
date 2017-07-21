@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="#">{{ $thread->creator->name }}</a>
                        posted:
                        {{ $thread->title }}
                    </div>

                    <div class="panel-body">
                        <article>
                            <div class="body">
                                {{ $thread->body }}
                            </div>
                        </article>
                    </div>
                </div>
                @foreach($replies as $reply)
                    @include('threads.reply')
                @endforeach

                {{ $replies->links() }}

                @include('threads.addReply')
            </div>

            <div class="col-md-4">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Hello
                    </div>

                    <div class="panel-body">
                        This thread created {{ $thread->created_at->diffForHumans() }} by
                        <a href="#">{{ $thread->creator->name }}</a>  and currently has
                        {{ $thread->replies_count }} {{ str_plural('comment', $thread->replies_count) }}.
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
