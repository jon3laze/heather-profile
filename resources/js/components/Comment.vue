<template>
    <div :id="id" :class="isBest ? 'comment-success' : 'comment-default'" class="comment">
        <div class="flex flex-col justify-around">
            <div class="flex justify-between">
                <div class="text-blue text-left font-bold text-xl mb-2 font-sans">
                    <a :href="path">
                        <img :src="image" class="comment-avatar">
                        <span v-text="comment.owner.name"></span>
                        <span class="text-sm text-grey ml-1">said...</span>
                    </a>
                </div>
                <div v-if="authorize('owns', comment.post)">
                    <button @click="saveBestComment">
                        <font-awesome-icon icon="star" size="lg" class="text-yellow" v-show="isBest" />
                        <font-awesome-icon :icon="['fal', 'star']" class="text-grey" v-show="! isBest" />
                    </button>
                </div>
            </div>
            <div class="text-grey text-base font-serif" v-if="editing">
                <form @submit="update">
                    <textarea id="body"
                            class="form-control form-input"
                            name="body"
                            rows="5"
                            required
                            v-model="body"
                            ></textarea>
                    <div class="my-3 flex justify-around">
                        <button class="btn btn-success w-1/4 rounded-full">
                            <font-awesome-icon :icon="['fal', 'check']"></font-awesome-icon>
                        </button>
                        <button class="btn btn-danger w-1/4 rounded-full"
                            @click="editing = false"
                            type="button">
                            <font-awesome-icon :icon="['fal', 'times']"></font-awesome-icon>
                        </button>
                    </div>
                </form>
            </div>
            <div class="comment-body" v-else v-html="body"></div>
        </div>
        <div class="text-time text-right my-2">
            <span v-text="ago"></span>
        </div>
        <div class="flex justify-between" v-if="authorize('owns', comment)">
            <div class="flex self-end justify-end w-full">
                <div class="p-1">
                    <button class="btn text-blue" @click="editing = true">
                        <font-awesome-icon :icon="['far', 'edit']"></font-awesome-icon>
                    </button>
                </div>

                <div class="p-1">
                    <button class="btn text-red" @click="destroy">
                        <font-awesome-icon :icon="['far', 'trash-alt']"></font-awesome-icon>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import moment from 'moment';

    export default {
        props: ['comment'],

        data() {
            return {
                editing: false,
                id: this.comment.id,
                body: this.comment.body,
                isBest: this.comment.isBest
            };
        },

        computed: {
            ago() {
                return moment(this.comment.created_at).fromNow();
            },

            image() {
                return this.comment.owner.avatar_path;
            },

            path() {
                return '/profiles/' + this.comment.owner.name;
            }
        },

        created() {
            window.events.$on('best-comment-selected', id => {
                this.isBest = (id === this.id);
            });
        },

        methods: {
            update() {
                axios.patch('/comments/' + this.id, {
                    body: this.body
                })
                .catch(error => {
                    flash(error.response.data, 'danger');
                });
                this.editing = false;
                flash('Your comment has been updated.', 'success')
            },

            destroy() {
                axios.delete('/comments/' + this.id);

                this.$emit('destroyed', this.id);
            },

            saveBestComment() {

                axios.post('/comments/' + this.id + '/best');

                this.isBest = true;

                window.events.$emit('best-comment-selected', this.id);
            }
        }
    };
</script>
