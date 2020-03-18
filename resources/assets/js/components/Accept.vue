<template>
    <div>
        <a :class="classes" @click.prevent="create"
           title="Mark this answer as best answer"
           v-if="canAccept">
            <i class="fas fa-check fa-2x"></i>
            <span class="favorites-count">123 </span>
        </a>
        <a :class="classes"
           title="The question answer accepted this answer as best answer"
           v-if="accepted"
        >
            <i class="fas fa-check fa-2x"></i>
            <span class="favorites-count"> </span>
        </a>
    </div>
</template>

<script>
    export default {
        props: ['answer'],
        name: "Accept",
        data() {
            return {
                id:this.answer.id,
                isBest: this.answer.is_best
            }
        },
        methods:{
            create(){
                axios.post(`/answer/${this.id}/accept`)
                .then(res=>{
                    this.$toast.success(res.data.message,'Success',{
                        timeout:3000,
                        position:'bottomLeft'
                    });
                    this.isBest = true
                })
            }
        },
        computed: {
            canAccept() {
                return this.authorize('accept',this.answer);
            },
            accepted() {
                return !this.canAccept && this.isBest;
            },
            classes() {
                return [
                    'mt-2',
                    this.isBest ? 'vote-accepted' : ''
                ]
            }
        }
    }
</script>

<style scoped>

</style>
