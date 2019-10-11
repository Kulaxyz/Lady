<template>
    <div class="tape-activity tape-activity-publication">
        <div class="tape-activity-el">
            <div class="tape-activity__icon like" v-if="!hasLiked" @click="like"></div>
            <div class="tape-activity__icon like active" v-if="hasLiked" @click="dislike"></div>
<!--                <img v-if="!hasLiked" @click="like" src="/img/tape/like.png" alt="">-->
<!--                <img v-if="hasLiked" @click="dislike" src="/img/tape/liked.png" alt="">-->
            <span class="tape-activity-el-count">{{Post.likers_count}}</span>
        </div>
        <div class="tape-activity-el">
            <div class="tape-activity__icon dislike" v-if="!hasDisliked" @click="upVote"></div>
            <div class="tape-activity__icon dislike active" v-if="hasDisliked" @click="downVote"></div>
<!--                <img v-if="!hasLiked" @click="like" src="/img/tape/like.png" alt="">-->
<!--                <img v-if="hasLiked" @click="dislike" src="/img/tape/liked.png" alt="">-->
            <span class="tape-activity-el-count">{{Post.bookmarkers_count}}</span>
        </div>
        <div class="tape-activity-el">
            <div class="tape-activity__icon bookmark" v-if="!hasFavorited" @click="favotire"></div>
            <div class="tape-activity__icon bookmark active" v-if="hasFavorited" @click="unfavotire"></div>
<!--                <img v-if="!hasLiked" @click="like" src="/img/tape/like.png" alt="">-->
<!--                <img v-if="hasLiked" @click="dislike" src="/img/tape/liked.png" alt="">-->
            <span class="tape-activity-el-count">{{Post.favoriters_count}}</span>
        </div>

<!--        <div class="activity-el">-->
<!--            <div class="activity-el_img">-->
<!--                <img v-if="!hasDisliked" @click="upVote" src="/img/tape/dislike.png" alt="">-->
<!--                <img v-if="hasDisliked" @click="downVote" src="/img/tape/disliked.png" alt="">-->
<!--            </div>-->
<!--            <div class="activity-el_count">-->
<!--                <span>{{Post.bookmarkers_count}}</span>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="activity-el">-->
<!--            <div class="activity-el_img">-->
<!--                <img v-if="!hasFavorited" @click="favotire" src="/img/tape/bookmark.png" alt="">-->
<!--                <img v-if="hasFavorited" @click="unfavotire" src="/img/tape/bookmarked.png" alt="">-->
<!--            </div>-->
<!--            <div class="activity-el_count">-->
<!--                <span>{{Post.favoriters_count}}</span>-->
<!--            </div>-->
<!--        </div>-->
        <div class="tape-activity-el">
            <div class="tape-activity__icon comments"></div>
            <span class="tape-activity-el-count">{{Post.comments_count}}</span>
        </div>
<!--        <div class="activity-el">-->
<!--            <div class="activity-el_img">-->
<!--                <img src="/img/tape/comment.png" alt="">-->
<!--            </div>-->
<!--            <div class="activity-el_count">-->
<!--                <span>{{Post.comments_count}}</span>-->
<!--            </div>-->
<!--        </div>-->
    </div>

</template>

<script>
    export default {
        props:['Post', 'liked', 'disliked', 'favorited'],
        name: "Activities",
        data() {
          return {
              hasLiked: false,
              hasDisliked: false,
              hasFavorited: false,
          }
        },
        created() {
            this.hasDisliked = this.disliked;
            this.hasLiked = this.liked;
            this.hasFavorited = this.favorited;
        },
        methods: {
            like() {
                axios.post('/posts/like', {post_id: this.Post.id}).then(response => {
                    this.hasLiked =  true;
                    this.Post.likers_count++;
                    if (this.hasDisliked) {
                        this.downVote();
                    }
                })
            },
            dislike() {
                axios.post('/posts/dislike', {post_id: this.Post.id}).then(response => {
                    this.hasLiked =  false;
                    this.Post.likers_count--;
                })
            },
            upVote() {
                axios.post('/posts/upvote', {post_id: this.Post.id}).then(response => {
                    this.hasDisliked =  true;
                    this.Post.bookmarkers_count++;
                    if (this.hasLiked) {
                        this.dislike();
                    }
                })
            },
            downVote() {
                axios.post('/posts/downvote', {post_id: this.Post.id}).then(response => {
                    this.hasDisliked = false;
                    this.Post.bookmarkers_count--;
                })
            },
            favotire() {
                axios.post('/posts/favorite', {post_id: this.Post.id}).then(response => {
                    this.hasFavorited = true;
                    this.Post.favoriters_count++;
                })
            },
            unfavotire() {
                axios.post('/posts/unfavorite', {post_id: this.Post.id}).then(response => {
                    this.hasFavorited = false;
                    this.Post.favoriters_count--;
                })
            }
        }
    }
</script>

<style scoped>

</style>
