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
                            class="btn btn-fancy"
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
                <p class="text-grey text-center text-base font-serif"> Please <a class="btn btn-link" href="/login">sign in</a> to comment on this post.</p>
            </div>
        </div>
    </div>
</template>

<script>
    import 'jquery.caret';
    import 'at.js';

    export default {
        data() {
            return {
                body: ''
            };
        },

        mounted() {
            $('#body').atwho({
                at: "@",
                delay: 750,
                callbacks: {
                    remoteFilter: function(query, callback) {
                        $.getJSON("/api/users", {name: query}, function(usernames) {
                            callback(usernames)
                        });
                    }
                }
            })
        },

        methods: {
            addComment() {
                axios.post(location.pathname + '/comment', { body: this.body })
                    .catch(error => {
                        flash(error.response.data, 'danger');
                    })
                    .then(({data}) => {
                        this.body = '';

                        flash('Your comment has been posted.', 'success');

                        this.$emit('created', data);
                    });
            }
        }
    }
</script>
