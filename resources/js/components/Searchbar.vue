<template>
    <div class="search">
        <input type="text" @keyup="fetchResults" placeholder="Поиск по сайту.." v-model="query">
        <div class="search-btn" style="background-image: url('/img/search.svg');"></div>
        <ul class="search-results" id="search-res" v-show="query.length > 1">
            <li v-if="tags.length > 0" v-for="(tag) in tags">
                <a :href="'/tag/' + tag.slug">
                    <div class="icon" style="background-image: url(/img/icons_li/topics.svg);"></div>
                    {{tag.name}}</a>
            </li>
            <li v-if="posts.length > 0" v-for="(post) in posts">
                <a :href="'/posts/'+post.slug">
                    <div class="icon" style="background-image: url(/img/icons_li/main.svg);"></div>
                    {{post.title}}</a>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "Searchbar",
        data() {
            return {
                query: '',
                tags: null,
                posts: null,
            }
        },
        methods:{
            fetchResults() {
                console.log(this.query.length);
                setTimeout(() => {
                    if (this.query.length > 1) {
                        console.log(this.query);
                        axios.get('https://lsecrets.ru/public/search?query='+this.query).then(response => {
                            this.tags = response.data[0];
                            this.posts = response.data[1];
                        });
                    }
                }, 600);
            }
        }

    }
</script>

<style scoped>

</style>
