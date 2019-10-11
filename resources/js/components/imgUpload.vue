<template>
    <div class="add_media">
        <ul id="list">
            <li v-for="(item, index) in items" v-if="item.image != null">
                <img class="min-upl" :src="item.image" />
            </li>
        </ul>
        <div  v-for="(input, ind) in inputs" v-show="input.seen">
        <label :for="'files' + ind" class="unselectable">

            <div class="add_media-content">
                <div class="add_media-icon">
                    <img src="/img/camera.svg" alt="">
                </div>
                <span>Добавить фото</span>
            </div>
        </label>

        <input @change="onFileChange($event, ind)"
               type="file" :id="'files' + ind" ref="files" multiple
               name="files[]" style="display:none;"/>
        </div>
    </div>
</template>

<script>
    export default {
        name: "imgUpload",
        data() {
            return {
                items: [{image:null}],
                inputs: [{seen:true}]
            }
        },
        methods: {
            onFileChange(e, index) {
                var files = e.target.files || e.dataTransfer.files;
                let i = 0;
                if (!files.length)
                    return;
                if (files.length > 1) {
                    for (let file of files) {
                        let len = this.items.push({image:null});
                        this.createImage(this.items[len-1], files[i]);
                        i++;
                    }
                } else {
                    let len = this.items.push({image: null});
                    this.createImage(this.items[len - 1], files[0]);
                }

                this.inputs[index].seen = false;
                this.inputs.push({seen:true});
            },
            createImage(item, file) {
                var image = new Image();
                var reader = new FileReader();

                reader.onload = (e) => {
                    item.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
        }
    }
</script>

<style scoped>

</style>
