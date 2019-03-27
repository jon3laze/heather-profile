<div class="flex w-full justify-between items-center shadow p-4">
    <font-awesome-icon :icon="['far', 'comment-alt-minus']" class="text-red"></font-awesome-icon>
    <span class="text-grey font-sans">Deleted a comment</span>
    <span class="text-time">{{ $activity->created_at->toDayDateTimeString() }}
</div>
