<div class="flex flex-col justify-around">
    <div class="fa-lg">
        <span class="fa-layers fa-fw">
            <i class="fal fa-comment-alt text-grey-light" data-fa-transform="flip-h"></i>
            <span class="fa-layers-text font-black font-mono text-grey text-xs" data-fa-transform="up-3">
                {{ $post->comments_count }}
            </span>
        </span>
    </div>
    @can('delete', $post)
        <div class="text-center">
            <a class="no-underline"
                href="#"
                onclick="event.preventDefault();
                document.getElementById('delete-{{ $post->id }}').submit();">
                <i class="fal fa-trash-alt text-red-light hover:text-red-dark hover:shadow-xl"></i>
            </a>

            <form id="delete-{{ $post->id }}" action="{{ $post->path() }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
            </form>
        </div>
    @endcan
</div>
