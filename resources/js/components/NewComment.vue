<template>
    <div v-if="signedIn">
        <div class="bg-white m-2 p-4 flex flex-col justify-between leading-normal">
            <div class="mx-4">
                    <div class="text-blue text-left font-bold text-xl mb-2 font-serif">
                        <span class="text-sm text-grey">What are your thoughts on it?</span>
                    </div>
                    <div class="mb-2">
                        <textarea id="body"
                            class="form-control form-input"
                            name="body"
                            rows="5"
                            required
                            v-model="body"
                            ></textarea>
                    </div>
                    <div class="mb-3 flex justify-end">
                        <button type="submit"
                            class="button"
                            @click="addComment">
                            Comment
                        </button>
                    </div>
            </div>
        </div>
    </div>

    <div v-else>
        <div class="bg-white m-2 p-4 flex flex-col justify-between leading-normal">
            <div class="mx-4">
                <p class="text-grey text-center text-base font-serif"> Please <a class="naked-link" href="/login">sign in</a> to comment on this post.</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                body: ''
            };
        },

        computed: {
            signedIn() {
                return window.App.signedIn;
            }
        },

        methods: {
            addComment() {
                axios.post(location.pathname + '/comment', { body: this.body })
                    .then(({data}) => {
                        this.body = '';

                        flash('Your comment has been posted.');

                        this.$emit('created', data);
                    });
            }
        }
    }
</script>
