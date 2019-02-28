<comment :attributes="{{ $comment }}" inline-template v-cloak>
    <div id="{{ $id }}" class="bg-white m-2 p-4 flex flex-col justify-between leading-normal shadow">
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
                    <button class="bg-green-lightest text-green w-1/4 p-2 rounded-full" @click="update">
                        <i class="fal fa-check"></i>
                    </button>
                    <button class="bg-red-lightest text-red w-1/4 p-2 rounded-full" @click="editing = false">
                        <i class="fal fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="text-grey text-base font-serif overflow-auto" v-else v-html="body">
                {!! $body !!}
            </div>
            <p class="text-time text-right my-2">
                {{ $date }}
            </p>
        </div>
        <div class="flex justify-end">
            @can('update', $comment)
                <div class="p-1">
                    <button class="text-blue hover:text-blue-lighter hover:shadow-xl" @click="editing = true">
                        <i class="fal fa-edit"></i>
                    </button>
                </div>
            @endcan
            @can('delete', $comment)
                <div class="p-1">
                    <button class="text-red hover:text-red-lighter hover:shadow-xl" @click="destroy">
                        <i class="fal fa-trash-alt"></i>
                    </button>
                </div>
            @endcan
        </div>
    </div>
</comment>
