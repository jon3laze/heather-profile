<template>
    <li class="notifications" v-if="notifications.length">
        <a href="#" data-toggle="dropdown">
            <i class="fal fa-bell fa-2x"></i>
        </a>

        <ul class="notification-dropdown">
            <li class="notification-item" v-for="notification in notifications">
                <a :href="notification.data.link"
                    v-text="notification.data.message"
                    @click="markAsRead(notification)"></a>
            </li>
        </ul>
    </li>
</template>

<script>
    export default {
        data() {
            return { notifications: false }
        },

        created() {
            axios.get('/profiles/' + window.App.user.name + '/notifications')
                .then(response => this.notifications = response.data);
        },

        methods: {
            markAsRead(notification) {
                axios.delete('/profiles/' + window.App.user.name + '/notifications/' + notification.id)
            }
        }
    }
</script>
