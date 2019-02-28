<template>
    <button :class="classes"
        @click="subscribe"
        v-text="state"></button>
</template>

<script>
    export default {
        props: ['active'],

        computed: {
            classes() {
                return ['button', this.active ? 'disabled' : ''];
            },
            state() {
                return this.active ? 'Subscribed' : 'Subscribe';
            }
        },

        methods: {
            subscribe() {
                axios[(this.active ? 'delete' : 'post')](location.pathname + '/subscriptions')
                    .catch(function(error) {
                        flash(error);
                    })
                    .then(response => {
                        this.active = ! this.active;
                    });
            }
        }
    }
</script>
