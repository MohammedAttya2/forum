@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Create new thread
                    </div>

                    <div class="panel-body">
                        <form action="/threads" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="channel_id">Choose a Channel:</label>
                                <select name="channel_id" id="channel_id" class="form-control" required>
                                    <option value="">Choose one ....</option>
                                    @foreach ($channels as $channel)
                                        <option value="{{$channel->id}}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>{{ $channel->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                Title: <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                            </div>
                            <div class="form-group">
                                Thread: <textarea name="body" id="body" cols="30" rows="10" class="form-control" placeholder="Add your Thoughts" required>{{ old('body') }}</textarea>
                            </div>
                            <div class="form-group">

                                <button type="submit" class="btn btn-primary">
                                    Publish
                                </button>

                            </div>

                            <div class="form-group">

                                @if (count($errors))
                                    <ul class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
