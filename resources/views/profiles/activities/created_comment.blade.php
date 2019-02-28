<a href="{{ $activity->subject->path() }}" class="text-blue no-underline">
    <div class="flex w-full justify-between items-center shadow p-4">
        <i class="fal fa-fw fa-comment-alt-plus text-indigo-dark" data-fa-transform="flip-h"></i>
        <span class="text-grey font-sans">Commented on an article</span>
        <span class="text-time">{{ $activity->subject->created_at->toDayDateTimeString() }}</span>
    </div>
</a>
