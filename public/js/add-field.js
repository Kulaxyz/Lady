new Vue({
    el: '.sample',
    data: {
        guests: []
    },
    methods: {
        addGuest(){
            this.guests.push('');
        },
        deleteGuest(index){
            this.guests.splice(index, 1);
        }
    }
});
