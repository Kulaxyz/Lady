<template>
    <div class="badge" v-if="notifications">
        {{ notifications }}
    </div>
</template>

<script>
    export default {
        props:['user'],
        name: "notificationsCount",

        data() {
            return {
                notifications: null,
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
            Echo.private('users.'+this.user.id)
                .listen('CommentCreated',(e)=>{
                    console.log('new comment')
                    this.countNotifications();
                })
        }
    }

</script>

<style scoped>

</style>
