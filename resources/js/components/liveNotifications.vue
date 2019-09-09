<template>
    <li class="nav-item">
        <a class="nav-link active" href="/my/tags">Моя лента
            <span class="badge" v-if="notifications">{{ notifications }}</span>
        </a>
    </li>

</template>

<script>
    export default {
        name: "liveNotifications",
        props: ['user'],
        data() {
            return {
                notifications: 0,
            }
        },

        methods: {
            countNotifications() {
                axios.get('/countPostNotifications').then(response => {
                    this.notifications = response.data;
                });

            }
        },

        created() {
            this.countNotifications();
            Echo.private('usermy.'+this.user.id)
                .listen('NewPost',(e)=>{
                    console.log('new post')
                    this.countNotifications();
                })
        }
    }
</script>

<style scoped>

</style>
