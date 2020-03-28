<template>
    <div class="container" v-if="question.id">
        <question :question="question"></question>
        <answers :question="question"></answers>
    </div>
</template>

<script>
    import Question from "../components/Question";
    import Answers from "../components/Answers";

    export default {
        name: "QuestionPage",
        props:['slug'],
        components:{
            Answers,
            Question
        },
        data(){
            return{
                question:{}
            }
        },
        methods:{
            fetchQuestion(){
                axios.get(`/questions/${this.slug}`)
                .then(({data})=>{
                    this.question = data.data
                })
                .catch(error=>{ console.log(error) })
            }
        },
        mounted() {
            this.fetchQuestion()
        }
    }
</script>

<style scoped>

</style>
