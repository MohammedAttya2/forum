@if (auth()->check())
    <form method="POST" action="{{ $thread->path() . '/replies' }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">

            <textarea id="body" class="form-control" name="body" rows="5"
                      placeholder="Have a reply?">{{ old('body') }}</textarea>

            @if ($errors->has('body'))
                <span class="help-block">
                            <strong>{{ $errors->first('body') }}</strong>
                        </span>
            @endif

        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                Reply
            </button>
        </div>

    </form>

@else
    <p class='text-center'>Please <a href="{{ route('login') }}">login</a> to participate.</p>
@endif