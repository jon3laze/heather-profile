<div class="flex w-full justify-between items-center shadow p-4">
    <i class="fal fa-fw fa-trash-alt text-red-light"></i>
    <span class="text-grey font-sans">Deleted an article</span>
    <span class="text-time">{{ $activity->created_at->toDayDateTimeString() }}
</div>
