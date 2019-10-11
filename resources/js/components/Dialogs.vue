<template>
    <section class="messages-list">
        <div class="wrap-messages-list">
            <h2>Сообщения</h2>
            <div class="wrap-messages-list-content">
                <div style="z-index: 999999" v-for="(user) in users" :class="'message-list-content ' + active(user)" @click="redirect(user)">
                    <div class="message-list-content_icon" :style="'background-image: url(/storage/images/avatars/' + user.avatar + ');'"></div>
                    <div class="message-list-content-content">
                        <h5>{{user.name}}</h5>
                        <p v-if="user.lastMessage.image">изображение...</p>
                        <p v-else v-html="user.lastMessage.message"></p>
                    </div>
                    <div class="message-list-content-info">
                        <div class="message-list-content-info-time">
                            <span>{{$moment(user.lastMessage.created_at).tz('Europe/Moscow').fromNow()}}</span>
                        </div>
                        <div class="message-list-content-info-count">
                            <span style="display: inline" v-if="user.unreads !== 0">{{user.unreads}}</span>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
                <div @click="loadMore" style="z-index: 9999" class="btn-green tapes-else">
                <a>Смотреть еще <img src="/img/tape/else_icon.svg" alt=""></a>
            </div>
        </div>
    </section>

</template>

<script>
    export default {
        props:['user','dialogers'],
        name: "Dialogs",
        created() {
            this.users = this.dialogers;
            Echo.private('privatechat.'+this.user.id).listen('PrivateMessageSent', (e)=>{
                this.refresh();
            });

        },
        data() {
            return {
                users:[],
                ids:[],
            }
        },
        methods: {
            refresh() {
                axios.post(window.location.pathname, {ids: []}).then(response => {
                    this.users = [];
                    for(let single of response.data) {
                        this.users.push(single);
                    }
                });
            },
            loadMore() {
                for (let user of this.users) {
                    this.ids.push(user.id);
                }
                axios.post(window.location.pathname, {ids: this.ids}).then(response => {
                    for(let single of response.data) {
                        this.users.push(single);
                    }
                });
            },
            active(user) {
                if (user.unreads !== 0) {
                    return 'active';
                }
                return '';
            },
            redirect(user) {
                console.log(1);
                window.location.href = '/chat/' + user.id;
            },
        }

    }
</script>

<style scoped>

</style>
