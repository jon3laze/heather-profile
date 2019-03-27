<article class="{{ $class }}" v-cloak>
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
        <div class="text-2xl mb-2 font-sans" v-if="editing">
            <input id="title"
                type="text"
                class="form-control form-input"
                name="title"
                v-model="form.title"
                required
                autofocus>
        </div>
        <div class="text-2xl mb-2 font-sans" v-else>
            <a href="{{ $path }}" class="no-underline text-blue" v-text="title"></a>
        </div>
    </div>
    <div class="mb-8">
        <div class="post-body" v-if="editing">
            <textarea id="body"
                class="form-control form-input"
                name="body"
                rows="10"
                v-model="form.body"
                required></textarea>
            <div class="my-3 flex justify-around">
                <button class="btn btn-success w-1/4 rounded-full"
                    @click="update"
                    type="button">
                    <font-awesome-icon :icon="['fal', 'check']"></font-awesome-icon>
                </button>
                <button class="btn btn-danger w-1/4 rounded-full"
                    @click="resetForm"
                    type="button">
                    <font-awesome-icon :icon="['fal', 'times']"></font-awesome-icon>
                </button>
            </div>
        </div>
        <div class="post-body" v-else>
            <div v-html="body">
                {!! $body !!}
            </div>
        </div>
    </div>
    {{ $link }}
</article>
