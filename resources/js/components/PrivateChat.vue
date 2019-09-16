<template>
    <section class="messages">
        <div class="wrap-messages">
            <h2>Сообщения</h2>
            <div class="wrap-messages-content">
                <div class="messages-content-top">
                    <div class="messages-content-top-back">
                        <a href="#">
                            <div class="icon_back">
                                <img src="/img/arr_back.png" alt="">
                            </div>
                            <span>Назад</span>
                        </a>
                    </div>
                    <div class="messages-content-top-name">
                        <div class="content-top-name-user">
                            <span>{{friend.name}}</span>
                        </div>
                        <div class="content-top-time">
                            <span>был в сети вчера в 18:58</span>
                        </div>
                    </div>
                    <div class="messages-content-top-user_icon" :style="'background-image: url(/storage/images/avatars/' + friend.avatar + ');'"></div>
                </div>
                    <message-list :user="user" :all-messages="allMessages"></message-list>
                <div class="messages-content-foot"  @keyup.enter="sendMessage">
                    <div class="detail-content-comments-add">
                        <div class="comment-reply-input">
                            <input type="hidden" @input="handleInput($event.target.value)"
                                   class="inp_comment"
                                   placeholder="Напишите сообщение..."
                                   data-emojiable="false">

                            <div class="comment-reply-input-media">
                                <div class="comment-reply-input-media_el">
                                    <div class="load_media">
                                        <file-upload
                                            :post-action="'/private-messages/'+activeFriend"
                                            ref='upload'
                                            v-model="files"
                                            @input-file="$refs.upload.active = true"
                                            :headers="{'X-CSRF-TOKEN': token}"
                                        >
                                            <img src="/img/camera.png" alt="">
                                        </file-upload>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div @click="sendMessage" class="btn-green">
                            <a>Отправить</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




<!--    <v-layout row>-->
<!--        <v-flex id="privateMessageBox" class="messages mb-5" xs9>-->
<!--            <message-list :user="user" :all-messages="allMessages"></message-list>-->

<!--            <div class="floating-div">-->
<!--                <picker v-if="emoStatus" set="emojione" @select="onInput" title="Выберите…" />-->

<!--            </div>-->

<!--            <v-footer-->
<!--                height="auto"-->
<!--                fixed-->
<!--                color="grey"-->
<!--            >-->
<!--                <v-layout row >-->
<!--                    <v-flex class="ml-2 text-right" xs1>-->
<!--                        <v-btn @click="toggleEmo" fab dark small color="pink">-->
<!--                            <v-icon>insert_emoticon </v-icon>-->
<!--                        </v-btn>-->
<!--                    </v-flex>-->

<!--                    <v-flex xs1 class="text-center">-->
<!--                        <file-upload-->
<!--                            :post-action="'/private-messages/'+activeFriend"-->
<!--                            ref='upload'-->
<!--                            v-model="files"-->
<!--                            @input-file="$refs.upload.active = true"-->
<!--                            :headers="{'X-CSRF-TOKEN': token}"-->
<!--                        >-->
<!--                            <v-icon class="mt-3">attach_file</v-icon>-->
<!--                        </file-upload>-->

<!--                    </v-flex>-->
<!--                    <v-flex xs6 >-->
<!--                        <v-text-field-->
<!--                            rows=2-->
<!--                            v-model="message"-->
<!--                            label="Enter Message"-->
<!--                            single-line-->
<!--                            @keyup.enter="sendMessage"-->
<!--                        ></v-text-field>-->
<!--                    </v-flex>-->

<!--                    <v-flex xs4>-->
<!--                        <v-btn-->
<!--                            @click="sendMessage"-->
<!--                            dark class="mt-3 ml-2 white&#45;&#45;text" small color="green">send</v-btn>-->


<!--                    </v-flex>-->

<!--                </v-layout>-->


<!--            </v-footer>-->


<!--        </v-flex>-->

<!--    </v-layout>-->
</template>

<script>
    import MessageList from './_message-list'
    import { Picker } from 'emoji-mart-vue'


    export default {
        props:['user', 'activeFriend', 'friend'],
        components:{
            Picker,
            MessageList
        },

        data () {
            return {
                message:null,
                files:[],
                typingFriend:{},
                allMessages:[],
                typingClock:null,
                emoStatus:false,
                token:document.head.querySelector('meta[name="csrf-token"]').content
            }
        },

        watch:{
            files:{
                deep:true,
                handler(){
                    let success=this.files[0].success;
                    if(success){
                        this.fetchMessages();
                    }
                }
            },
            activeFriend(val){
                this.fetchMessages();
            },
            '$refs.upload'(val){
                console.log(val);
            }
        },

        methods:{
            onTyping(){
                Echo.private('privatechat.'+this.activeFriend).whisper('typing',{
                    user:this.user
                });
            },
            handleInput(value){
                this.message = value;
            },
            sendMessage(){
                // console.log(1);
                //check if there message
                this.message = $('.emojionearea-editor')[0].innerHTML;
                if(!this.message){
                    return alert('Please enter message');
                }
                axios.post('/private-messages/'+this.activeFriend, {message: this.message}).then(response => {
                    this.message=null;
                    $('.emojionearea-editor')[0].innerHTML = '';
                    let  newMsg = response.data.message;
                    newMsg.user = this.user;
                    this.allMessages.push(newMsg);
                    setTimeout(this.scrollToEnd,100);
                });
            },
            fetchMessages() {
                axios.get('/private-messages/'+this.activeFriend).then(response => {
                    this.allMessages = response.data;
                    setTimeout(this.scrollToEnd,100);

                });
            },

            scrollToEnd(){
                document.getElementById('privateMessageBox').scrollTo(0,99999);
            },
            toggleEmo(){
                this.emoStatus= !this.emoStatus;
            },
            onInput(e){
                if(!e){
                    return false;
                }
                if(!this.message){
                    this.message=e.native;
                }else{
                    this.message=this.message + e.native;
                }
                this.emoStatus=false;
            },

            onResponse(e){
                console.log('onrespnse file up',e);
            }


        },

        mounted(){
            console.log(this.activeFriend);

        console.log(this.user);
        },

        created(){
            this.fetchMessages();

            Echo.private('privatechat.'+this.user.id)
                .listen('PrivateMessageSent',(e)=>{
                    console.log('pmessage sent')
                    this.activeFriend=e.message.user_id;
                    this.allMessages.push(e.message)
                    setTimeout(this.scrollToEnd,100);

                })
                .listenForWhisper('typing', (e) => {

                    if(e.user.id==this.activeFriend){

                        this.typingFriend=e.user;

                        if(this.typingClock) clearTimeout();

                        this.typingClock=setTimeout(()=>{
                            this.typingFriend={};
                        },5000);
                    }

                });
        }
    }
</script>

<style scoped>

    .messages{
        /*overflow-y:scroll;*/
        /*height:100vh;*/
    }

</style>
