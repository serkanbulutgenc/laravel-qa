<template>
    <div>

        <div class="card-body">
            <spinner v-if="$root.loading"></spinner>
            <div v-else-if="questions.length">
                <question-excerpt
                        @deleted="remove(index)"
                        v-for="question in questions"
                        :question="question"
                        :key="question.id"></question-excerpt>
            </div>
            <div v-else class="alert alert-warning">
                <strong>Sory !!</strong> There are no questions available
            </div>

        </div>
        <div class="card-footer">
            <pagination :meta="meta" :links="links"></pagination>
        </div>
        <!-- {{ $questions->links( ) }}-->
    </div>
</template>

<script>
    import QuestionExcerpt from "./QuestionExcerpt";
    import Pagination from "./Pagination";

    export default {
        name: "Questions",
        components:{QuestionExcerpt, Pagination},
        data(){
            return {
                questions:[],
                meta:{},
                links:{},
            }
        },
        methods:{
            remove(index){
                this.questions.splice(index,1)
                this.count--
            },
            fetchQuestions(){
                axios.get('/questions',{params:this.$route.query})
                    .then(({data})=>{
                        this.questions = data.data
                        this.meta = data.meta
                        this.links = data.links
                    })
            }
        },
        watch:{
            "$route":'fetchQuestions'
        },
        mounted() {
            this.fetchQuestions()
        }
    }
</script>
<style scoped>

</style>
