@if (auth()->check())
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
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
        </div>
    </div>
@else
    <p class='text-center'>Please <a href="{{ route('login') }}">login</a> to participate.</p>
@endif