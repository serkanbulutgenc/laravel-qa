<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form class="card-body" v-show="authorize('modify',question) && editing" @submit.prevent="update">
                    <div class="card-title">
                        <input type="text" class="form-control form-control-lg" v-model="title"/>
                    </div>
                    <hr>
                    <div class="media">
                        <div class="media-body">
                            <div class="form-group">
                                <m-editor :body="body" :name="uniqueName">
                                    <textarea class="form-control" required rows="10" v-model="body"></textarea>
                                </m-editor>
                            </div>
                            <button :disabled="isInvalid" class="btn btn-primary">Update</button>
                            <button @click="cancel" class="btn btn-outline-secondary" type="button">Cancel</button>
                        </div>
                    </div>

                </form>

                <div class="card-body" v-show="!editing">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h1>{{title}}</h1>
                            <div class="ml-auto">
                                <a class="btn btn-outline-secondary" href="/questions">Back to all
                                    Question</a>
                            </div>
                        </div>

                    </div>
                    <hr>

                    <div class="media">
                        <vote :model="question" name="question"></vote>
                        <div class="media-body">

                            <div v-html="bodyHtml" ref="bodyHtml"></div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="ml-auto">
                                        <a @click.prevent="edit"
                                           class="btn btn-sm btn-outline-info"
                                           v-if="authorize('modify',question)">
                                            Edit
                                        </a>
                                        <button @click="destroy"
                                                class="btn btn-sm btn-outline-danger"
                                                v-if="authorize('deleteQuestion',question)"
                                                type="button">Delete
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <user-info :model=" question" label="Asked"></user-info>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import modification from "../mixins/modification";

    export default {
        name: "Question",
        props: ['question'],
        mixins:[modification],
        data() {
            return {
                title: this.question.title,
                body: this.question.body,
                bodyHtml: this.question.body_html,
                id:this.question.id,
                beforeEditCache:{}
            }
        },
        computed:{
            uniqueName(){
                return  `answer-${this.id}`
            },
            isInvalid(){
                return this.body.length < 10 || this.title.length < 10
            },
            endpoint(){
                return `/questions/${this.id}`
            }
        },
        methods:{
            setEditCache(){
                this.beforeEditCache = {
                    body:this.body,
                    title:this.title
                }
            },
            restoreFromCache(){
                this.body = this.beforeEditCache.body
                this.title = this.beforeEditCache.title
                const element = this.$refs.htmlBody
                if (element) Prism.highlightAllUnder(element)

            },
            payload(){
                return {
                    body:this.body,
                    title:this.title
                }
            },
            delete(){
                axios.delete(this.endpoint)
                    .then(({data}) => {
                        this.$toast.success(data.message,'Success',{timeout:2000})
                    })
                setTimeout(()=>{
                    window.location.href = "/questions"
                },3000)
            }
        }
    }
</script>

<style>

</style>
