<template>
    <div>
        <div class="wrap-tapes">
            <div class="wrap-tape-column">
                <article class="tape-content" v-for="(post, index) in postsAll" v-if="index % 2 == 0" :data-id="post.id">
                    <div class="tape-content-top">
                        <div class="tape-content-btn">
                            <img src="/img/tape/star.png" alt="">
                        </div>
                        <div class="tape-content-time">
                            <span>{{$moment(post.created_at).tz('Europe/Moscow').fromNow()}}</span>
                        </div>
                    </div>
                    <div class="tape-content-body">
                        <h4><a :href="'/posts/single/'+post.id">{{post.title}}</a></h4>
                        <p>{{Limited(post)}}</p>
                        <div class="img_post" v-if="post.images.length">
                            <img :src="'/storage/images/posts/' + post.images[0].path" alt="">
                        </div>
                    </div>
                    <div class="tape-content-foot">
                        <div class="user-tape" v-if="post.is_anonimous">
                            <img class="user-tape-img" :src="'/storage/images/avatars/default.jpg'"></img>
                            <span><a>Аноним</a></span>
                        </div>
                        <div class="user-tape" v-else>
                            <img class="user-tape-img" :src="'/storage/images/avatars/' + post.user.avatar"></img>
                            <span><a :href='"/user/" + post.user.id'>{{post.user.name}}</a></span>
                        </div>
                        <div class="tape-activity">
                            <div class="tape-activity-el">
                                <img src="/img/tape/like.png" alt="">
                                <span class="tape-activity-el-count">{{post.likers_count}}</span>
                            </div>
                            <div class="tape-activity-el">
                                <img src="/img/tape/bookmark.png" alt="">
                                <span class="tape-activity-el-count">{{post.favoriters_count}}</span>
                            </div>
                            <div class="tape-activity-el">
                                <img src="/img/tape/comment.png" alt="">
                                <span class="tape-activity-el-count">{{post.comments_count}}</span>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
            <div class="wrap-tape-column">
                <article class="tape-content" v-for="(post, index) in postsAll" v-if="index % 2 != 0" :data-id="post.id">
                    <div class="tape-content-top">
                        <div class="tape-content-btn">
                            <img src="/img/tape/star.png" alt="">
                        </div>
                        <div class="tape-content-time">
                            <span>{{$moment(post.created_at).tz('Europe/Moscow').fromNow()}}</span>
                        </div>
                    </div>
                    <div class="tape-content-body">
                        <h4><a :href="'/posts/single/'+post.id">{{post.title}}</a></h4>
                        <p>{{Limited(post)}}</p>
                        <div class="img_post" v-if="post.images.length">
                            <img :src="'/storage/images/posts/' + post.images[0].path" alt="">
                        </div>
                    </div>
                    <div class="tape-content-foot">
                        <div class="user-tape">
                            <img class="user-tape-img" :src="'/storage/images/avatars/' + post.user.avatar"></img>
                            <span><a :href='"/user/" + post.user.id'>{{post.user.name}}</a></span>
                        </div>
                        <div class="tape-activity">
                            <div class="tape-activity-el">
                                <img src="/img/tape/like.png" alt="">
                                <span class="tape-activity-el-count">{{post.likers_count}}</span>
                            </div>
                            <div class="tape-activity-el">
                                <img src="/img/tape/bookmark.png" alt="">
                                <span class="tape-activity-el-count">{{post.favoriters_count}}</span>
                            </div>
                            <div class="tape-activity-el">
                                <img src="/img/tape/comment.png" alt="">
                                <span class="tape-activity-el-count">{{post.comments_count}}</span>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
        <div class="btn-green tapes-else">
            <button @click="loadMore">Смотреть еще <img src="/img/tape/else_icon.png" alt=""></button>
        </div>
    </div>

    <!--    <div class="btn-green tapes-else">-->
    <!--        <a href="#">Смотреть еще <img src="/img/tape/else_icon.png" alt=""></a>-->
    <!--    </div>-->
</template>

<script>
    export default {
        props: ['posts'],
        name: "Posts",
        data() {
            return {
                ids: [],
                postsAll: {},
            }
        },
        methods: {
            Limited(post) {
                console.log(this.posts.length)
                if (post.description.length > 200) {
                    return post.description.substring(0, 200) + '...'
                } else {
                    return post.description
                }
            },

            loadMore() {
                console.log(5);
                let arrPosts = document.getElementsByClassName('tape-content');
                for (let onePost of arrPosts) {
                    this.ids.push(onePost.getAttribute('data-id'));
                }

                axios.post(window.location.pathname, {ids: this.ids}).then(response => {
                    for(let single of response.data) {
                        console.log(single)
                        this.posts.push(single);
                    }
                });
            }

        },
        mounted() {

        },

        created() {
            this.postsAll = this.posts;
            console.log(this.postsAll);
        }
    }
</script>

<style scoped>

</style>
