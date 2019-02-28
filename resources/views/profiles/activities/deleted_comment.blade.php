<div class="flex w-full justify-between items-center shadow p-4">
    <i class="fal fa-fw fa-trash-alt text-red-light"></i>
    <span class="text-grey font-sans">Deleted a comment</span>
    <span class="text-time">{{ $activity->created_at->toDayDateTimeString() }}
</div>
