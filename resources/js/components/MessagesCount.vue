<template>
    <div v-if="messages != 0" class="count_activity">
        <span>{{messages}}</span>
    </div>
</template>

<script>
    export default {
        props:['user'],
        name: "MessagesCount",
        data() {
            return {
                messages: 0,
            }
        },
        methods:{
            fetchMessagesCount() {
                axios.get('/messages-count').then(response => {
                   if(Number.isInteger(response.data)) {
                       this.messages = response.data;
                   }
                });
            },
        },
        created() {
            this.fetchMessagesCount();

            Echo.private('privatechat.'+this.user.id).listen('PrivateMessageSent', (e)=>{
                this.fetchMessagesCount();
            });
        }
    }
</script>

<style scoped>

</style>
