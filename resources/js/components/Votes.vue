<template>
    <div :class='"wrap-quiz " + this.hasVoted'>
        <div class="wrap-quiz-content" v-for="(option, index) in options" :id="option.id" @click="vote" >
            <div class="quiz-content-el" :id="option.id">
                <div :id="option.id" class="quiz-content-el-procent_bg" :style='"width: " + option.percent + "%"' ></div>
                <div :id="option.id" class="quiz-content-el-info">
                    <div class="quiz-content-el-info-left">
                        <p :id="option.id" class="quiz-content-el-info-name">
                            {{option.name}}
                        </p>
                        <p class="quiz-content-el-info-count">
                            {{option.votesCount}}
                        </p>
                    </div>
                    <div class="quiz-content-el-info-right">
<!--                        <div class="quiz-content-el-info-checked" style="background-image: url(/img/quiz_checked.png);"></div>-->
                        <p class="quiz-content-el-info-procent">
                            {{option.percent}}%
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrap-quiz-voted">
            <div class="quiz-voted-count">
                <p>Проголосовали <span>{{this.all}}</span> человек</p>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props: ['voted', 'post'],
        name: "Votes",
        data() {
            return {
                options:[],
                all:0,
                hasVoted:'',
            }
        },
        methods: {
            fetchOptions() {
                axios.get('/options/'+this.post).then(response => {
                    this.options = response.data;
                        this.countVotes();
                });
            },
            countVotes() {
              for(let option of this.options) {
                  this.all+=option.votesCount;
              }
            },

            vote: function(el) {
                if (this.hasVoted != 'voted') {

                    axios.post('/posts/vote', {option_id: el.target.id, post_id: this.post}).then(response => {
                        this.options = response.data;
                        this.countVotes();
                        this.hasVoted = 'voted';
                    });
                }
            }
        },

        created() {
            this.fetchOptions();
            this.hasVoted = this.voted;
        },
    }

</script>

<style scoped>

</style>
