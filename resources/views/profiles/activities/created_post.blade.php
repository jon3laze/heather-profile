<a href="{{ $activity->subject->path() }}" class="text-blue no-underline">
    <div class="flex w-full justify-between items-center shadow p-4">
        <i class="fal fa-fw fa-file-plus text-green-light"></i>
        <span class="text-grey font-sans">Created an article</span>
        <span class="text-time">{{ $activity->subject->created_at->toDayDateTimeString() }}</span>
    </div>
</a>
<!-- @component('components.post')
    @slot('class', 'post post-snub')
    @slot('name')
        {{ $activity->subject->owner->name }}
    @endslot
    @slot('slug')
        {{ $activity->subject->category->slug }}
    @endslot
    @slot('category')
        {{ $activity->subject->category->name }}
    @endslot
    @slot('date')
        {{ $activity->subject->created_at->toFormattedDateString() }}
    @endslot
    @slot('path')
        {{ $activity->subject->path() }}
    @endslot
    @slot('title')
        {{ $activity->subject->title }}
    @endslot
    @slot('body')
        {!! $activity->subject->body !!}
    @endslot
    @slot('link')
        <a href="{{ $activity->subject->path() }}" class="post-snub-link">Full Article</a>
    @endslot
@endcomponent
 -->
