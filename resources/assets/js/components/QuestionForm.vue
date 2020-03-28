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
            <button class="btn btn-outline-primary btn-lg" type="submit">
                <spinner :small="true" v-if="$root.loading"></spinner>
                <span v-else>{{ buttonText }}</span>
            </button>
        </div>
    </form>
</template>

<script>
    import EventBus from '../EventBus'
    import MEditor from "./MEditor";

    export default {
        name: "QuestionForm",
        components: {MEditor},
        props: {
            isEdit: {
                type: Boolean,
                default: false
            }
        },
        data() {
            return {
                title: '',
                body: '',
                errors: {
                    title: [],
                    body: []
                }
            }
        },
        methods: {
            handleSubmit() {
                this.$emit('submitted', {
                    title: this.title,
                    body: this.body,
                })
            },
            errorClass(column) {
                return [
                    'form-control',
                    this.errors[column] && this.errors[column][0] ? 'is-invalid' : ''
                ]
            },
            fetchQuestion() {
                axios.get(`/questions/${this.$route.params.id}`)
                    .then(({data}) => {
                        this.title = data.title,
                            this.body = data.body
                    })
                    .catch(error => {
                        console.log(error)
                    })
            }
        },
        computed: {
            buttonText() {
                return this.isEdit ? 'Update Question' : 'Ask Question'
            }
        },
        mounted() {
            EventBus.$on('error', errors => this.errors = errors)

            if (this.isEdit) this.fetchQuestion()
        }
    }
</script>

<style scoped>

</style>
