<template>
    <div class="container">
        <div class="col-sm-auto-15">
            <div>
                <div>
                    <h3>Обратная связь</h3>
                    <hr/>
                </div>
                <div class="alert alert-danger" v-if="error">
                    {{ error }}
                </div>
                <form>
                    <div class="form-floating">
                        <textarea  style="height: 35px;" class="form-control" v-model="feedback.name" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                        <label for="floatingTextarea">Имя</label>
                    </div>
                    <br>
                    <div class="form-floating">
                        <textarea type="email" style="height: 35px;" class="form-control" v-model="feedback.email" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                        <label for="floatingTextarea">Email</label>
                    </div>
                    <br>
                    <div class="form-floating">
                        <textarea  style="height: 100px;" class="form-control" v-model="feedback.message" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                        <label for="floatingTextarea">Сообщение</label>
                    </div>
                    <br>
                    <button @click.prevent="postFeedback()"  type="submit" class="btn btn-outline-success">Отправить</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
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
