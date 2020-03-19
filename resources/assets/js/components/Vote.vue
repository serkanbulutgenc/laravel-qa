<template>
    <div class="d-flex flex-column votes-controls">
        <a :title="title('up')"
           @click.prevent="voteUp"
           class="vote-up" :class="classes"
        >
            <i class="fas fa-caret-up fa-3x"></i>
        </a>

        <span class="votes-count">{{ count }}</span>

        <a :title="title('down')"
           @click.prevent="voteDown"
           class="votes-down" :class="classes"
        >
            <i class="fas fa-caret-down fa-3x"></i>
        </a>

         <favorite v-if="name === 'question'" :question="model"></favorite>
        <accept v-else :answer="model"></accept>
    </div>
</template>

<script>
    import Favorite from "./Favorite";
    import Accept from "./Accept";

    export default {
        name: "Vote",
        props:['name','model'],
        components:{
            Favorite,
            Accept
        },
        data(){
            return {
                count:this.model.votes_count || 0,
                id:this.model.id
            }
        },
        computed:{
            endpoint() {
                return `/${this.name}s/${this.id}/vote`
            },
            classes(){
                return this.signedIn ? '' : 'off'
            }
        },
        methods:{
            title(voteType){
                let titles ={
                    up:`This ${this.name} is useful`,
                    down:`This ${this.name} is useful`
                }

                return titles[voteType]
            },

            voteUp(){this._vote(1)},
            voteDown(){this._vote(-1)},

            _vote(vote){
                if(!this.signedIn){
                    this.$toast.warning(`Please login to vote ${this.name}`,'Warning',{
                        timeout:3000,
                        position:'bottomLeft'
                    });
                    return;
                }
                axios.post(this.endpoint,{
                    vote
                })
                .then(res=>{
                    this.$toast.success(res.data.message,'Success',{
                        timeout:3000,
                        position:'bottomLeft'
                    })
                    this.count = res.data.votesCount;
                })
            }
        }
    }
</script>

<style scoped>

</style>
