<template>
    <div class="container">
        <div class="col-sm-auto-15">
            <div>
                <div>
                    <h3>Регистрация</h3>
                    <hr/>
                </div>
                <div class="alert alert-danger" v-if="error">
                    {{ error }}
                </div>
                <form>
                    <div class="form-floating mb-3">
                        <input  class="form-control" v-model="name" id="floatingInputName" placeholder="Имя">
                        <label for="floatingInput">Имя </label>
                    </div>
                    <!-- Email input -->
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" v-model="email" id="floatingInputEmail" placeholder="Email">
                        <label for="floatingInput">Email </label>
                    </div>

                    <!-- Password input -->
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" v-model="password" id="floatingInputPasword" placeholder="Пароль">
                        <label for="floatingInput">Пароль </label>
                    </div>



                    <!-- Submit button -->
                    <button  @click.prevent="register()" type="button" class="btn btn-primary btn-block mb-4">Зарегистрироваться</button>

                    <!-- Register buttons -->
                    <div class="text-center">
                        <p>Уже есть аккаунт?  <router-link  :to="{name:'login.index'}">Авторизация</router-link></p>
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
            name:null,
            email: '',
            password: '',
            errors: [],
            error: '',
        };
    },

    methods:{
        register() {
            axios.post(`${this.API_URL}/api/register`, {
                name: this.name,
                email: this.email,
                password: this.password,
            })
                .then(res => {
                    if (res.status === 200) {
                        // Пользователь успешно создан
                        let user = [
                            {
                                'id': res.data.user.id,
                                'admin': res.data.user.admin,
                                'name': res.data.user.name,
                                'x_xsrf_token': res.data.user.token,
                            }
                        ];
                        localStorage.setItem('userData', JSON.stringify(user));
                        window.location.href = '/'
                    }
                })
                .catch(error => {
                    if (error.response && error.response.status === 500) {
                        // Ошибка на сервере (Internal Server Error)
                        alert('Произошла внутренняя ошибка сервера. Попробуйте позже.');
                    } else if (error.response && error.response.status === 409) {
                        alert('Пользователь с такой почтой уже существует');
                    } else {
                        // Другие ошибки
                        alert('Произошла ошибка. Пожалуйста, попробуйте снова.');
                    }
                });
        }
    }

};
</script>
