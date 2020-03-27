<template>
<div class="row align-items-center">
    <div class="col">
        <button @click="prev" class="btn btn-outline-secondary" :disabled="isFirst">Newer</button>
    </div>
    <div class="col text-center">{{ pagesInfo }}</div>
    <div class="col text-right">
        <button @click="next" class="btn btn-outline-secondary" :disabled="isLast">Older</button>
    </div>
</div>
</template>

<script>
    export default {
        name: "Pagination",
        props:['meta','link'],
        methods:{
            switchPage(){
                this.$router.push({
                    name:'questions',
                    query:{
                        page:this.meta.current_page
                    }
                })
            },
            prev(){
                if( ! this.isFirst ){
                    this.meta.current_page--
                }
                this.switchPage()
            },
            next(){
                if( ! this.isLast ){
                    this.meta.current_page++
                }
                this.switchPage()
            }

        },
        computed:{
            pagesInfo(){
                return `Page ${this.meta.current_page} of ${this.meta.last_page}`
            },
            isFirst(){
                return this.meta.current_page === 1
            },
            isLast(){
                return this.meta.current_page === this.meta.last_page
            }
        }
    }
</script>

<style scoped>

</style>
