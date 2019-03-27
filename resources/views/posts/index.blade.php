@extends('layouts.app')

@section('content')
<div class="flex mx-6 justify-center">
    <div class="w-1/2 flex-col">
        @if(count($trending))
            <div class="flex flex-col fixed pin-l">
                <div class="bg-white mb-2 p-2 justify-between leading-normal text-grey font-sans font-bold text-xl">
                    Trending Posts
                </div>
                @foreach($trending as $post)
                        <div class="justify-between leading-normal">
                            <a href="{{ $post->path }}" class="bg-white no-underline text-blue font-sans shadow hover:shadow-xl mb-2 p-2 block flex justify-between">
                                {{ $post->title }}
                            </a>
                        </div>
                @endforeach
            </div>
        @endif
        @foreach($posts as $post)
            @component('components.post-stub')
                @slot('class', 'post post-stub')
                @slot('name')
                    {{ $post->owner->name }}
                @endslot
                @slot('slug')
                    {{ $post->category->slug }}
                @endslot
                @slot('category')
                    {!! $post->category->name !!}
                @endslot
                @slot('date')
                    {{ $post->created_at->toFormattedDateString() }}
                @endslot
                @slot('path')
                    {{ $post->path() }}
                @endslot
                @slot('title')
                    @if(auth()->check() && $post->hasUpdatesFor(auth()->user()))
                        <strong>
                            {{ $post->title }}
                        </strong>
                    @else
                        {{ $post->title }}
                    @endif
                @endslot
                @slot('body')
                    {!! str_limit($post->body, 200, '...') !!}
                @endslot
                @slot('link')
                    <a href="{{ $post->path() }}" class="post-stub-link">Full Article</a>
                @endslot
            @endcomponent
            <div class="flex justify-end mb-4 -mt-1 mx-2">
                <div class="text-blue px-1 py-2 text-xs flex content-center">
                    <span class="font-sans font-bold">
                        <font-awesome-icon :icon="['far', 'eye']" class="mr-1"></font-awesome-icon>{{ $post->visits()->count() }}
                    </span>
                </div>
                <div class="text-blue px-1 py-2 text-xs flex content-center">
                    <span class="font-sans font-bold">
                        <font-awesome-icon :icon="['far', 'comment-alt']" class="mr-1" flip="horizontal"></font-awesome-icon>{{ $post->comments_count }}
                    </span>
                </div>
            </div>
        @endforeach

        {{ $posts->links() }}
    </div>
</div>
@endsection
