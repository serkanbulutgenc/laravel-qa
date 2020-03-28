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
                let currentPage = this.meta.current_page || 1
                let lastPage = this.meta.last_page || 1
                return `Page ${currentPage} of ${lastPage}`
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
