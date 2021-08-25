<script>
export default {
    props: ['answer'],
    data(){ 
        return { 
            editing: false,
            body: this.answer.body,
            bodyHtml: this.answer.body_html,
            id: this.answer.id,
            questionId: this.answer.question_id,
            beforeEditCache: null
        }
    },
    computed:{
        isInvalid(){
            return this.body.length < 10;
        }
    },
    methods:{
        edit(){
            this.beforeEditCache = this.body;
            this.editing = true;
        },
        cancel(){
            this.body = this.beforeEditCache;
            this.editing = false;
        },
        update(){ 
            axios.patch(`/questions/${this.questionId}/answers/${this.id}`,{
                body: this.body
            })
            .then(res=>{
                this.bodyHtml = res.data.body_html;
                this.editing = false;
                alert(res.data.message);
            })
            .catch(err=>{
                alert(err.response.data.message);
                console.log('something went wrong')
            })
        }
    }
}
</script>
