@extends('layouts.app')

@section('content')
<post-view inline-template>
    <div class="max-w-md w-full lg:flex mx-auto">
        @component('components.post')
            @slot('class', 'post')
            @slot('name')
                {{ $post->owner->name }}
            @endslot
            @slot('slug')
                {{ $post->category->slug }}
            @endslot
            @slot('category')
                {{ $post->category->name }}
            @endslot
            @slot('date')
                {{ $post->created_at->toFormattedDateString() }}
            @endslot
            @slot('path')
                {{ $post->path() }}
            @endslot
            @slot('title')
                {{ $post->title }}
            @endslot
            @slot('body')
                {!! $post->body !!}
            @endslot
            @slot('link')
                <subscribe-button :active="{{ json_encode($post->hasSubscription) }}"></subscribe-button>
            @endslot
        @endcomponent

        <div class="flex w-full justify-center mb-4">
            <span class="p-4 text-grey font-sans border-b">Commentary</span>
        </div>

        <comments></comments>
    </div>
</post-view>
@endsection
