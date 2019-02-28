@extends('layouts.app')

@section('content')
    <div class="max-w-md w-full lg:flex mx-auto">
        @foreach($posts as $post)
            @component('components.post')
                @slot('class', 'post post-snub')
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
                    {!! str_limit($post->body, 200, '...') !!}
                @endslot
                @slot('link')
                    <a href="{{ $post->path() }}" class="post-snub-link">Full Article</a>
                @endslot
            @endcomponent

        @endforeach

        {{ $posts->links() }}
    </div>
@endsection
