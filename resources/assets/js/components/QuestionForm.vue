<template>
    <form @submit.prevent="handleSubmit">
        <div class="form-group">
            <label>Question Title</label>
            <input :class="errorClass('title')" type="text" v-model="title">

            <div class="invalid-feedback" v-if="errors['title'][0]">
                <strong>{{ errors['title'][0] }}</strong>
            </div>


        </div>
        <div class="form-group">
            <label>Question Title</label>
            <m-editor :body="body" name="question-body">
                <textarea :class="errorClass('body')" name="body" rows="10" v-model="body"></textarea>

                <div class="invalid-feedback" v-if="errors['body'][0]">
                    <strong>{{ errors['body'][0] }}</strong>
                </div>
            </m-editor>

        </div>
        <div class="form-group">
            <button class="btn btn-outline-primary btn-lg" type="submit">{{ buttonText }}</button>
        </div>
    </form>
</template>

<script>
    import EventBus from '../EventBus'
    import MEditor from "./MEditor";

    export default {
        name: "QuestionForm",
        components:{MEditor},
        data(){
            return {
                title:'',
                body:'',
                errors:{
                    title:[],
                    body:[]
                }
            }
        },
        methods:{
            handleSubmit() {
                this.$emit('submitted',{
                    title:this.title,
                    body:this.body,
                })
            },
            errorClass(column){
                return [
                    'form-control',
                    this.errors[column] && this.errors[column][0] ? 'is-invalid' :''
                ]
            }
        },
        computed:{
            buttonText(){
                return 'Ask Questions'
            }
        },
        mounted() {
            EventBus.$on('error', errors => this.errors=errors )
        }
    }
</script>

<style scoped>

</style>
