<div class="flex w-full justify-between items-center shadow p-4">
    <font-awesome-icon :icon="['far', 'file-minus']" class="text-red"></font-awesome-icon>
    <span class="text-grey font-sans">Deleted an article</span>
    <span class="text-time">{{ $activity->created_at->toDayDateTimeString() }}
</div>
