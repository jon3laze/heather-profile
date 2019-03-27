<comment :attributes="{{ $comment }}" inline-template v-cloak>
    <div id="{{ $id }}" class="comment">
        <div class="mx-4">
            <div class="text-blue text-left font-bold text-xl mb-2 font-sans">
                {{ $name }} <span class="text-sm text-grey">said...</span>
            </div>
            <div class="text-grey text-base font-serif" v-if="editing">
                <textarea id="body"
                        class="form-control form-input"
                        name="body"
                        rows="5"
                        required
                        v-model="body"
                        ></textarea>
                <div class="my-3 flex justify-around">
                    <button class="btn btn-success w-1/4 rounded-full" @click="update">
                        <font-awesome-icon icon="['fal', 'check']"></font-awesome-icon>
                    </button>
                    <button class="btn btn-danger w-1/4 rounded-full" @click="editing = false">
                        <font-awesome-icon icon="['fal', 'times']"></font-awesome-icon>
                    </button>
                </div>
            </div>
            <div class="comment-body" v-else v-html="body">
                {!! $body !!}
            </div>
            <p class="text-time text-right my-2">
                {{ $date }}
            </p>
        </div>
        <div class="flex justify-end">
            @can('update', $comment)
                <div class="p-1">
                    <button class="btn btn-info" @click="editing = true">
                        <font-awesome-icon icon="['far', 'edit']"></font-awesome-icon>
                    </button>
                </div>
            @endcan
            @can('delete', $comment)
                <div class="p-1">
                    <button class="btn btn-danger" @click="destroy">
                        <font-awesome-icon icon="['far', 'trash-alt']"></font-awesome-icon>
                    </button>
                </div>
            @endcan
        </div>
    </div>
</comment>
