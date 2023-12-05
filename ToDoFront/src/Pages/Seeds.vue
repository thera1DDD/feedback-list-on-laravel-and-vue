<template>
    <div class="container">
        <div class="col-sm-auto-15">
            <div>
                <div>
                    <h3>Seeds</h3>
                    <hr/>
                </div>
                <div class="alert alert-danger" v-if="error">
                    {{ error }}
                </div>
                <form>
                    <button  v-if="isAdmin" @click.prevent="launchSeed()" type="button" class="btn btn-primary btn-block mb-4">Launch</button>
                    <button  v-if="!isAdmin" disabled type="button" class="btn btn-primary btn-block mb-4">Launch</button>
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
            API_URL:'http://127.0.0.1:8000',
            email: '',
            password: '',
            errors: [],
            error: '',
            isAdmin:null,
        };
    },


    mounted() {
      this.checkAdmin();
    },

    methods:{
        checkAdmin(){
            const user =JSON.parse(localStorage.getItem('userData'))
            if(user){
                if(user[0].admin === 1){
                    return this.isAdmin = 1
                }
                else{
                    return this.isAdmin = null
                }
            }
        },

        launchSeed() {
            axios.post(`${this.API_URL}/api/seed/launch`)
                .then(response => {
                    alert('Добавлены новые записи');
                })
                .catch(error => {
                    if (error.response) {
                        // Запрос выполнен, и сервер вернул код состояния, отличный от 2xx.
                        console.error('Ошибка запроса. Код состояния:', error.response.status);
                        console.error('Данные ошибки:', error.response.data);
                    } else if (error.request) {
                        // Запрос выполнен, но не получен ответ от сервера.
                        console.error('Ошибка запроса. Нет ответа от сервера.');
                    } else {
                        // Ошибка настройки запроса.
                        console.error('Ошибка настройки запроса:', error.message);
                    }
                    alert('Произошла ошибка. Подробности смотрите в консоли разработчика.');
                });
        }
    }
};
</script>

<style>
router-link{
    font-weight: bold;
}
</style>
