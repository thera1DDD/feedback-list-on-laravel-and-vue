<template>
    <div class="container">
        <div class="postman-run-button"
             data-postman-action="collection/fork"
             data-postman-visibility="public"
             data-postman-var-1="24820863-9921304d-44d2-4acf-a9a1-54b7702d83f7"
             data-postman-collection-url="entityId=24820863-9921304d-44d2-4acf-a9a1-54b7702d83f7&entityType=collection&workspaceId=da427c9e-fdf9-4c50-803b-4fadab5097ec"></div>
    </div>
</template>
<script>
(function (p,o,s,t,m,a,n) {
    !p[s] && (p[s] = function () { (p[t] || (p[t] = [])).push(arguments); });
    !o.getElementById(s+t) && o.getElementsByTagName("head")[0].appendChild((
        (n = o.createElement("script")),
            (n.id = s+t), (n.async = 1), (n.src = m), n
    ));
}(window, document, "_pm", "PostmanRunObject", "https://run.pstmn.io/button.js"));
import axios from "axios";
export default {
    name: "Seeds.vue",
    data() {
        return {
            API_URL: import.meta.env.VITE_BASE_API_URL,
            feedback:{
                id: '',
                name: '',
                email: '',
                status: 0,
                message: '',
                comment: '',
            },
            error: '',
        };
    },


    mounted() {
       this.test();
    },

    methods:{
        test(){
            console.log(this.API_URL);
        },

        clearFields(){
            this.feedback.name = ''
            this.feedback.email = ''
            this.feedback.message = ''
            this.id = ''
        },

        async postFeedback()
        {
            await this.axios.post(this.API_URL +'/feedback/post' , {
                name: this.feedback.name,
                email:this.feedback.email,
                message:this.feedback.message,
               })
                .then(
                    ({})=>{
                        this.clearFields()
                        this.$router.push('/notification');
                    }
                )
        },


    }
};
</script>

<style>
router-link{
    font-weight: bold;
}
</style>
