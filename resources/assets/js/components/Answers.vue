<template>
    <div>

        <div class="row mt-4" v-cloak v-if="count">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h2>{{title}}</h2>
                        </div>
                        <hr>
                        <answer @deleted="remove(index)" :answer="answer" :key="answer.id" v-for="(answer,index) in answers"></answer>

                        <div class="text-center mt-3" v-if="nextUrl">
                            <button
                                    @click.prevent="fetch(nextUrl)"
                                    class="btn btn-outline-secondary">Load more answers</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <newAnswer @created="add" :question-id="question.id"></newAnswer>
    </div>
</template>

<script>
    import Answer from "./Answer";
    import NewAnswer from "./NewAnswer";
    import highlight from "../mixins/highlight";
    export default {
        name: "Answers",
        mixins:[ highlight ],
        props: ['question'],
        data(){
            return {
                questionId:this.question.id,
                count:this.question.answers_count,
                answers:[],
                nextUrl:null
            }
        },
        components: {Answer, NewAnswer},
        methods:{
            remove(index){
                this.answers.splice(index,1)
                this.count--
            },
            fetch(endpoint){
                axios.get(endpoint)
                .then(({data})=>{
                    this.answers.push(...data.data)
                    this.nextUrl = data.next_page_url
                })
            },
            add(answer){
                this.answers.push(answer)
                this.count++
                this.$nextTick(()=>{
                    this.highlight(`answer-${answer.id}`)
                })
            }
        },
        computed: {
            title() {
                return this.count + " " + (this.count > 1 ? 'Answers' : 'Answer');
            }
        },
        created() {
            this.fetch(`/questions/${this.questionId}/answers`)
        }
    }
</script>

<style scoped>

</style>
