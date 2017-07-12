@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form action="/threads" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        Title: <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        Thread: <textarea name="body" id="body" cols="30" rows="10" class="form-control" placeholder="Add your Thoughts">{{ old('body') }}</textarea>
                    </div>
                    <div class="form-group">

                        <button type="submit" class="btn btn-primary">
                            Add Thread
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
