<template>
    <button class="btn btn-bell" @click="subscribe">
            <font-awesome-icon :icon="['fas', 'bell']" v-show="this.subscribed"></font-awesome-icon>
            <font-awesome-icon :icon="['fal', 'bell']" v-show="! this.subscribed"></font-awesome-icon>
        </button>
</template>

<script>
    export default {
        props: ['active'],

        data() {
            return {
                subscribed: this.active
            }
        },

        methods: {
            subscribe() {
                axios[(this.subscribed ? 'delete' : 'post')](location.pathname + '/subscriptions')
                    .catch(function(error) {
                        flash(error);
                    })
                    .then(response => {
                        this.subscribed = ! this.subscribed;
                    });
            }
        }
    }
</script>
