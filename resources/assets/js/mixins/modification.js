import highlight from "./highlight";
import UserInfo from "../components/UserInfo";
import Vote from "../components/Vote";
import MEditor from "../components/MEditor";
import destroy from "./destroy";

export default {
    data(){
        return {
            editing:false
        }
    },
    components:{UserInfo,Vote,MEditor},
    mixins:[highlight, destroy],
    methods:{
        edit(){
            this.setEditCache()
            this.editing = true
        },
        cancel(){
            this.restoreFromCache()
            this.editing = false
        },
        payload(){},
        update(){
            axios.put(this.endpoint,this.payload())
                .then(({data})=>{
                    this.bodyHtml = data.body_html
                    this.$toast.success(data.message,'Success',{timeout:3000})
                    this.editing = false
                })
                .then(()=>this.highlight())
                .catch(({response})=>{
                    this.$toast.error(response.data.message,'Error',{timeout:3000})
                })
        },
        setEditCache(){},
        restoreFromCache(){},
    }
}
