@extends('layouts.app')

@section('head')
<link href="/css/vendor/jquery.atwho.css" rel="stylesheet">
@endsection

@section('content')
<post-view :post="{{ $post }}" inline-template>
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
                <div class="flex justify-between">
                    <subscribe-button
                        :active="{{ json_encode($post->hasSubscription) }}"
                        v-if="signedIn">
                    </subscribe-button>
                    <div class="flex justify-between self-end" v-if="authorize('owns', post)">
                        <button class="btn text-blue" @click="editing = true">
                            <font-awesome-icon :icon="['far', 'edit']"></font-awesome-icon>
                        </button>
                        <button class="btn text-red" @click="destroy">
                            <font-awesome-icon :icon="['far', 'trash-alt']"></font-awesome-icon>
                        </button>
                        <button
                            class="btn btn-engrave"
                            v-if="authorize('isAdmin')"
                            @click="toggleLock">
                                <font-awesome-icon :icon="['fas', 'unlock-alt']" class="text-grey" v-show="! locked"></font-awesome-icon>
                                <font-awesome-icon :icon="['fas', 'lock-alt']" class="text-grey" v-show="locked"></font-awesome-icon>
                        </button>
                    </div>
                </div>
            @endslot
        @endcomponent

        <div class="flex w-full justify-center mb-4">
            <span class="p-4 text-grey font-sans border-b">Commentary</span>
        </div>

        <comments></comments>
    </div>
</post-view>
@endsection
