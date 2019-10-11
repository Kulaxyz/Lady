<template>
    <div class="tape-activity tape-activity-publication">
        <div class="tape-activity-el comment-activity">
            <div class="tape-activity__icon like" v-if="!hasLiked" @click="like"></div>
            <div class="tape-activity__icon like active" v-if="hasLiked" @click="dislike"></div>
            <span class="tape-activity-el-count">{{comment.likers_count}}</span>
        </div>
        <div class="tape-activity-el comment-activity">
            <div class="tape-activity__icon dislike" v-if="!hasDisliked" @click="upVote"></div>
            <div class="tape-activity__icon dislike active" v-if="hasDisliked" @click="downVote"></div>
            <span class="tape-activity-el-count">{{comment.bookmarkers_count}}</span>
        </div>
    </div>
</template>

<script>
    export default {
        name: "comment-activities",
        props: ['comment', 'liked', 'disliked'],

        data() {
            return {
                hasLiked: false,
                hasDisliked: false,
            }
        },
        created() {
            this.hasLiked = this.liked;
            this.hasDisliked = this.disliked;
        },

        methods: {
            like() {
                axios.post('/comment/like', {comment_id: this.comment.id}).then(response => {
                    this.hasLiked =  true;
                    this.comment.likers_count++;
                    if (this.hasDisliked) {
                        this.downVote();
                    }
                })
            },
            dislike() {
                axios.post('/comment/dislike', {comment_id: this.comment.id}).then(response => {
                    this.hasLiked =  false;
                    this.comment.likers_count--;
                })
            },
            upVote() {
                axios.post('/comment/upvote', {comment_id: this.comment.id}).then(response => {
                    this.hasDisliked =  true;
                    this.comment.bookmarkers_count++;
                    if (this.hasLiked) {
                        this.dislike();
                    }
                })
            },
            downVote() {
                axios.post('/comment/downvote', {comment_id: this.comment.id}).then(response => {
                    this.hasDisliked = false;
                    this.comment.bookmarkers_count--;
                })
            },
        }
    }
</script>

<style scoped>

</style>
