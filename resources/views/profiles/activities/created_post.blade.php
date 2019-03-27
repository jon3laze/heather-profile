<a href="{{ $activity->subject->path() }}" class="text-blue no-underline">
    <div class="flex w-full justify-between items-center shadow p-4">
        <font-awesome-icon :icon="['far', 'file-plus']" class="text-green"></font-awesome-icon>
        <span class="text-grey font-sans">Created an article</span>
        <span class="text-time">{{ $activity->subject->created_at->toDayDateTimeString() }}</span>
    </div>
</a>
