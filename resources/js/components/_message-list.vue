<template>
    <div class="messages-content-body" id="privateMessageBox">

        <div class="message-content-el" v-for="(message, index) in allMessages"
             :key="index">
            <div class="message-content-el-icon"
                 :style="'background-image: url(/storage/images/avatars/' + message.user.avatar + ');'"></div>
            <div class="message-content-el-body">
                <div class="message-content-el-body-name">
                    <div class="message-content-el-icon message-content-el-icon-mobile"
                         :style="'background-image: url(/storage/images/avatars/' + message.user.avatar">
                    </div>
                    <div class="message-content-el-body-name-user">
                        <span>{{message.user.name}}</span>
                    </div>
                    <div class="message-content-el-body-name-time">
                        <span> {{$moment(message.created_at).tz('Europe/Moscow').fromNow()}}</span>
                    </div>
                </div>
                <div class="message-content-el-body-text">
                    <p>{{message.message}}</p>
                </div>
                <div class="image-container">
                    <img v-if="message.image" :src="'/storage/images/chat/'+message.image" alt="">

                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props: ['user', 'allMessages'],
    }
</script>

<style scoped>

</style>
