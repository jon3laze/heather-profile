<article class="{{ $class }}">
    <div class="flex justify-between my-4">
        <div class="flex flex-col text-sm">
            <div>
                <a class="no-underline text-grey-dark font-bold font-sans text-lg hover:text-blue" href="/profiles/{{ $name }}">{{ $name }}</a>
            </div>

            <div>
                <a href="/posts/{{ $slug }}" class="font-serif font-medium text-grey text-sm no-underline hover:text-blue">
                    {{ $category }}
                </a>
            </div>

            <div class="text-time">
                {{ $date }}
            </div>
        </div>
    </div>
    <div class="flex justify-center my-8">
        <div class="font-bold text-2xl mb-2 font-sans">
            <a href="{{ $path }}" class="no-underline text-blue">{{ $title }}</a>
        </div>
    </div>
    <div class="mb-8">
        <div class="post-body">
            {!! $body !!}
        </div>
    </div>
    {{ $link }}
</article>
