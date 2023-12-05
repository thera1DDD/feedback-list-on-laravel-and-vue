<template>
    <div class="container">
        <div class="col-sm-auto-15">
            <div>
                <div>
                    <h3>Авторизация</h3>
                    <hr/>
                </div>
                <div class="alert alert-danger" v-if="error">
                    {{ error }}
                </div>
                <form>
                    <!-- Email input -->
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" v-model="email" id="floatingInputEmail" placeholder="Email">
                        <label for="floatingInput">Email </label>
                    </div>

                    <!-- Password input -->
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" v-model="password" id="floatingInput" placeholder="Password">
                        <label for="floatingInput">Пароль </label>
                    </div>


                    <!-- Submit button -->
                    <button  @click.prevent="login()" type="button" class="btn btn-primary btn-block mb-4">Войти</button>

                    <!-- Register buttons -->
                    <div class="text-center">
                        <p>Ещё нет аккаунта?  <router-link  :to="{name:'registration.index'}">Регистрация</router-link></p>
                        <button type="button" class="btn btn-link btn-floating mx-1">
                            <i class="fab fa-facebook-f"></i>
                        </button>

                        <button type="button" class="btn btn-link btn-floating mx-1">
                            <i class="fab fa-google"></i>
                        </button>

                        <button type="button" class="btn btn-link btn-floating mx-1">
                            <i class="fab fa-twitter"></i>
                        </button>

                        <button type="button" class="btn btn-link btn-floating mx-1">
                            <i class="fab fa-github"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";
export default {
    name: "Login.vue",
    data() {
        return {
            API_URL:'http://127.0.0.1:8000',
            email: '',
            password: '',
            errors: [],
            error: '',
        };
    },

    methods:{
        login(){
            axios.post(`${this.API_URL}/api/login`,{email:this.email,password:this.password})
                .then(res=>{
                    console.log(res);
                    let user=[
                        {
                            'id':res.data.user.id,
                            'name':res.data.user.name,
                            'email':res.data.user.email,
                            'admin':res.data.user.admin,
                            'x_xsrf_token':res.data,
                        }
                    ]
                    localStorage.setItem ('userData',JSON.stringify(user))
                    window.location.href = '/'
                })
                .catch(err=>{
                    alert('Неправильный логин или пароль')
                })
        },
    }

};
</script>

<style>
router-link{
    font-weight: bold;
}
</style>
