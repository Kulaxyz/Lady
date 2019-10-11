<template>
<!--    <div class="sample" style="display: none">-->
<!--        <div class="form-group">-->
<!--            <label>Добавить вариант ответа</label>-->
<!--            <input type="button"-->
<!--                   class="btn btn-primary"-->
<!--                   value="+"-->
<!--                   @click="addGuest"-->
<!--            >-->
<!--        </div>-->
<!--        <div>-->
<!--            <div class="form-group" v-for="(guest, index) in guests">-->
<!--                <label @dblclick="deleteGuest(index)">-->
<!--                    Вариант {{ index + 1 }}-->
<!--                </label>-->
<!--                <input type="text" name="options[]" class="form-control" v-model="guests[index]">-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

<div>
    <div class="publication-content-form-el" @click="showMe = !showMe">

        <h4 v-if="!showMe" class="unselectable">Добавить опрос? <span>(нажмите для создания опроса)</span></h4>
        <h4 v-if="showMe" class="unselectable">Убрать опрос? <span>(нажмите для удаления опроса)</span></h4>
    </div>
    <div id="add"  v-show="showMe" class="publication-content-form-el delete_margin_bottom">
        <h4>Варианты ответов:</h4>
        <div class="inputs">
            <div class="input-el" v-for="(guest, index) in guests" >
                <input v-if="showMe" name="options[]" required class="inp_maxlength" type="text" v-model="guests[index]" minlength="1" maxlength="120">
                <div class="input-el__media">
                    <p>Осталось - <span class="count_limit">{{120 - guests[index].length}}</span></p>
                    <div class="input-el__delete" @click="deleteGuest(index)">
                        <span>удалить</span>
                    </div>
                </div>
            </div>

        </div>
        <div class="add_option">
            <span @click="addGuest" class="unselectable">Добавить еще вариант?</span>
        </div>
    </div>
</div>

</template>

<script>
    export default {
        name: "AddField",
        data() {
            return {
                guests: [''],
                showMe: false,
            }
        },
        methods: {
            addGuest() {
                this.guests.push('');
            },
            deleteGuest(index) {
                this.guests.splice(index, 1);
            }
        },
        computed: {

        },
    }
</script>

<style scoped>

</style>
