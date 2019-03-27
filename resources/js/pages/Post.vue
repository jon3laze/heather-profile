<script>
    import Comments from '../components/Comments.vue';
    import SubscribeButton from '../components/SubscribeButton.vue';

    export default {
        props: ['post'],

        components: { Comments, SubscribeButton },

        data() {
            return {
                locked: this.post.locked,
                title: this.post.title,
                body: this.post.body,
                form: {},
                editing: false
            }
        },

        created() {
            this.resetForm();
        },

        methods: {
            toggleLock() {
                let uri  =`/locked-post/${this.post.slug}`;

                axios[this.locked ? 'delete' : 'post'](uri);

                this.locked = ! this.locked;

                if(this.locked) {
                    flash('This post has been locked.', 'danger');
                } else {
                    flash('This post has been unlocked.', 'success');
                }
            },

            update() {
                let uri = `/posts/${this.post.category.slug}/${this.post.slug}`;

                axios.patch(uri, this.form).then(() => {
                    this.editing = false;
                    this.title = this.form.title;
                    this.body = this.form.body;

                    flash('You post has been updated.', 'success');
                });
            },

            destroy() {
                let uri = `/posts/${this.post.category.slug}/${this.post.slug}`;

                axios.delete(uri)
                    .then(function(response) {
                        window.location = '/posts';
                        flash('Your post has been deleted.', 'danger');
                    });
            },

            resetForm() {
                this.form = {
                    title: this.post.title,
                    body: this.post.body
                };

                this.editing = false;
            }
        }
    }
</script>
