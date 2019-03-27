<template>
    <div>
        <div v-for="(comment, index) in items" :key="comment.id">
            <comment :comment="comment" @destroyed="remove(index)"></comment>
        </div>

        <paginator :dataSet="dataSet" @changed="fetch"></paginator>

        <div class="comment comment-disabled" v-if="$parent.locked">
            <span class="text-grey">
                <font-awesome-icon :icon="['fas', 'lock-alt']" class="mr-1"></font-awesome-icon> This post has been locked. No more comments are allowed.
            </span>
        </div>
        <new-comment @created="add" v-else></new-comment>
    </div>
</template>

<script>
    import Comment from './Comment.vue';
    import NewComment from './NewComment.vue';
    import collection from '../mixins/collection';

    export default {
        components: { Comment, NewComment },

        mixins: [collection],

        data() {
            return { dataSet: false }
        },

        created() {
            this.fetch();
        },

        methods: {
            fetch(page) {
                axios.get(this.url(page))
                    .then(this.refresh);
            },

            url(page) {
                if(! page) {
                    let query = location.search.match(/page=(\d+)/);

                    page = query ? query[1] : 1;
                }

                return `${location.pathname}/comment?page=${page}`;
            },

            refresh({data}) {
                this.dataSet = data;
                this.items = data.data;

                window.scrollTo(0,0);
            }
        }
    }
</script>
