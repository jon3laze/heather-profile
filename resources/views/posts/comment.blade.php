@if(auth()->check())
    <div class="bg-white m-2 p-4 flex flex-col justify-between leading-normal">
        <div class="mx-4">
            <form method="POST" action="{{ $post->path() . '/comment' }}">
                @csrf
                <div class="text-blue text-left font-bold text-xl mb-2 font-sans">
                    {{ auth()->user()->name }} <span class="text-sm text-grey">says...</span>
                </div>
                <div class="mb-2">
                    <textarea id="body"
                        class="form-control form-input"
                        name="body"
                        rows="5"
                        required
                        >{{ old('body') }}</textarea>
                </div>
                <div class="mb-3 flex justify-end">
                    <button type="submit" class="btn btn-fancy">
                        {{ __('Comment') }}
                    </button>
                </div>
            </form>
            @include('layouts.error')
        </div>
    </div>
@else
    <div class="bg-white m-2 p-4 flex flex-col justify-between leading-normal">
        <div class="mx-4">
            <p class="text-grey text-center text-base font-serif"> Please <a class="naked-link" href="{{ route('login') }}">sign in</a> to comment on this post.</p>
        </div>
    </div>
@endif
