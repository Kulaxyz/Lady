<template>
    <div class="search">
        <input type="text" placeholder="Поиск по сайту.." v-model="query" @keyup="this.fetchResults">
<!--        <div class="search-btn" style="background-image: url('/img/search.png');"></div>-->
    </div>

</template>

<script>
    export default {
        name: "Searchbar",
        data() {
            return {
                query: null,
                results: null,
            }
        },
        methods:{
            fetchResults() {
                setTimeout(() => {
                    console.log(this.query);
                    axios.get('/search/?query='+this.query).then(response => {
                        this.results = response.data;
                        console.log(this.results)
                    });
                }, 20);
            }
        }

    }
</script>

<style scoped>

</style>
