<template>
    <div class="sample" style="display: none">
        <div class="form-group">
            <label>Добавить вариант ответа</label>
            <input type="button"
                   class="btn btn-primary"
                   value="+"
                   @click="addGuest"
            >
        </div>
        <div>
            <div class="form-group" v-for="(guest, index) in guests">
                <label @dblclick="deleteGuest(index)">
                    Вариант {{ index + 1 }}
                </label>
                <input type="text" name="options[]" class="form-control" v-model="guests[index]">
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "AddField",
        data() {
            return {
                guests: []
            }
        },
        methods: {
            addGuest() {
                this.guests.push('');
            },
            deleteGuest(index) {
                this.guests.splice(index, 1);
            }
        }
    }
</script>

<style scoped>

</style>
