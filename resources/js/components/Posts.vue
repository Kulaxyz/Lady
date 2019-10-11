<template>
    <div>
        <div class="wrap-tapes">
            <div class="wrap-tape-column">
                <article class="tape-content" v-for="(post, index) in postsAll" v-if="index % 2 == 0" :data-id="post.id">
                    <div class="tape-content-top">
                        <div class="tape-content-btn">
                            <a :href="'posts/'+post.slug">
                            <img v-if="post.type == 'post'" src="/img/tape/star.svg" alt="">
                            <img v-if="post.type == 'vote'" src="/img/tape/speaker.svg" alt="">
                            <img v-if="post.type == 'question'" src="/img/tape/ask.svg" alt="">
                            </a>
                        </div>
                        <div class="tape-content-time">
                            <span>{{$moment(post.created_at).tz('Europe/Moscow').fromNow()}}</span>
                        </div>
                    </div>
                    <div class="tape-content-body">
                        <h4><a :href="'/posts/'+post.slug">{{post.title}}</a></h4>
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
                        <div class="tape-activity tape-activity-feed">
                            <div class="tape-activity-el">
<!--                                <img v-if="post.hasLiked" src="/img/tape/liked.png" alt="">-->
<!--                                <img v-else src="/img/tape/like.png" alt="">-->
                                <div v-if="post.hasLiked" class="tape-activity__icon like active"></div>
                                <div v-else class="tape-activity__icon like"></div>

                                <span class="tape-activity-el-count">{{post.likers_count}}</span>
                            </div>
                            <div class="tape-activity-el">
                                <div v-if="post.hasDisliked" class="tape-activity__icon dislike active"></div>
                                <div v-else class="tape-activity__icon dislike"></div>
<!--                                <img v-if="post.hasDisliked" src="/img/tape/disliked.png" alt="">-->
<!--                                <img v-else src="/img/tape/dislike.png" alt="">-->
                                <span class="tape-activity-el-count">{{post.bookmarkers_count}}</span>
                            </div>
                            <div class="tape-activity-el">
<!--                                <img v-if="post.hasFavorited" src="/img/tape/bookmarked.png" alt="">-->
<!--                                <img v-else src="/img/tape/bookmark.png" alt="">-->
                                <div  v-if="post.hasFavorited" class="tape-activity__icon bookmark active"></div>
                                <div  v-else class="tape-activity__icon bookmark"></div>
                                <span class="tape-activity-el-count">{{post.favoriters_count}}</span>
                            </div>
                            <div class="tape-activity-el">
                                <div class="tape-activity__icon comments"></div>
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
                            <a :href="'posts/'+post.slug">
                                <img v-if="post.type == 'post'" src="/img/tape/star.svg" alt="">
                                <img v-if="post.type == 'vote'" src="/img/tape/speaker.svg" alt="">
                                <img v-if="post.type == 'question'" src="/img/tape/ask.svg" alt="">
                            </a>
                        </div>
                        <div class="tape-content-time">
                            <span>{{$moment(post.created_at).tz('Europe/Moscow').fromNow()}}</span>
                        </div>
                    </div>
                    <div class="tape-content-body">
                        <h4><a :href="'/posts/'+post.slug">{{post.title}}</a></h4>
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
                        <div class="tape-activity tape-activity-feed">
                            <div class="tape-activity-el">
                                <!--                                <img v-if="post.hasLiked" src="/img/tape/liked.png" alt="">-->
                                <!--                                <img v-else src="/img/tape/like.png" alt="">-->
                                <div v-if="post.hasLiked" class="tape-activity__icon like active"></div>
                                <div v-else class="tape-activity__icon like"></div>

                                <span class="tape-activity-el-count">{{post.likers_count}}</span>
                            </div>
                            <div class="tape-activity-el">
                                <div v-if="post.hasDisliked" class="tape-activity__icon dislike active"></div>
                                <div v-else class="tape-activity__icon dislike"></div>
                                <!--                                <img v-if="post.hasDisliked" src="/img/tape/disliked.png" alt="">-->
                                <!--                                <img v-else src="/img/tape/dislike.png" alt="">-->
                                <span class="tape-activity-el-count">{{post.bookmarkers_count}}</span>
                            </div>
                            <div class="tape-activity-el">
                                <!--                                <img v-if="post.hasFavorited" src="/img/tape/bookmarked.png" alt="">-->
                                <!--                                <img v-else src="/img/tape/bookmark.png" alt="">-->
                                <div  v-if="post.hasFavorited" class="tape-activity__icon bookmark active"></div>
                                <div  v-else class="tape-activity__icon bookmark"></div>
                                <span class="tape-activity-el-count">{{shorten(post.favoriters_count)}}</span>
                            </div>
                            <div class="tape-activity-el">
                                <div class="tape-activity__icon comments"></div>
                                <span class="tape-activity-el-count">{{shorten(post.comments_count)}}</span>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
        <div class="btn-green tapes-else">
            <a @click="loadMore">Смотреть еще <img src="/img/tape/else_icon.svg" alt=""></a>
        </div>
    </div>

    <!--    <div class="btn-green tapes-else">-->
    <!--        <a href="#">Смотреть еще <img src="/img/tape/else_icon.svg" alt=""></a>-->
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
                likes: {},
            }
        },
        methods: {
            Limited(post) {
                if (post.description.length > 200) {
                    return post.description.substring(0, 200) + '...'
                } else {
                    return post.description
                }
            },

            shorten(number) {
                if (number > 999) {
                    return Math.round(number/100)/10 + 'k';
                } else {
                    return number;
                }
            },

            loadMore() {
                let arrPosts = document.getElementsByClassName('tape-content');
                for (let onePost of arrPosts) {
                    this.ids.push(onePost.getAttribute('data-id'));
                }

                axios.post(window.location.pathname, {ids: this.ids}).then(response => {
                    for(let single of response.data) {
                        this.posts.push(single);
                    }
                });
            },
        },
        mounted() {

        },

        created() {
            this.postsAll = this.posts;
        }
    }
</script>

<style scoped>

</style>
