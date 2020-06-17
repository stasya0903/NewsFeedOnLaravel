<template>
    <div>
        <ckeditor
            :editor="editor"
            v-model="editorData"
            :config="editorConfig"
            tag-name="textarea"
            name="text"
        >
        </ckeditor>



    </div>

</template>

<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    export default {
        props:[
            'userData'
        ],

        data() {
            return {
                editor: ClassicEditor,
                editorConfig: {

                },


            }
        },

        computed:{
            editorData (){
                return this.userData;
            }
        }

    }
</script>

<style scoped>

</style>
