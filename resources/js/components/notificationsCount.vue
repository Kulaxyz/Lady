<template>
    <div v-if="notifications !== 0" class="count_activity">
        <span>{{ notifications }}</span>
    </div>
</template>

<script>
    export default {
        props:['user'],
        name: "notificationsCount",

        data() {
            return {
                notifications: 0,
            }
        },

        methods: {
          countNotifications() {
              axios.get('/countNotifications').then(response => {
                  this.notifications = response.data;
              });

          }
        },

        created() {
            this.countNotifications();
            Echo.private('users.'+ this.user.id)
                .listen('CommentCreated',(e)=>{
                    console.log('new comment')
                    this.countNotifications();
                })
        }
    }

</script>

<style scoped>

</style>
