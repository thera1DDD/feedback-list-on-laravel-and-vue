<template>
    <div class="container">
        <header>
            <nav class="navbar navbar-expand-md navbar-light bg-light ">
                <button
                    class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarTogglerDemo03"
                    aria-controls="navbarTogglerDemo03"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="/">Главная</a>

                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                    <ul class="navbar-nav mr-auto mt-2 mt-md-0">
                        <li class="nav-item active">
                            <a style="font-weight:bold " class="nav-link" href="user">Feedback</a>
                        </li>
                        <li class="nav-item active">
                            <a style="font-weight:bold " class="nav-link" href="swagger">Postman Swagger</a>
                        </li>
                        <!-- Добавленная категория -->
                    </ul>
                    <router-link  style="text-decoration: underline" class="nav-link" v-if="!token" :to="{name:'login.index'}" >Войти </router-link>
                    <router-link   style="text-decoration: underline" class="nav-link" v-if="!token" :to="{name:'registration.index'}">   /Регистрация</router-link>
                    <!-- Добавленное выпадающее меню пользователя -->
                    <ul class="navbar-nav">
                        <li  v-if="token" class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <i v-if="isAdmin"><img  style="width: 19px"  src="../src/assets/icons/Screenshot_1.jpg" alt="">{{getUserName()}} </i>
                                 <i v-if="!isAdmin"  class="bi bi-person-circle"> {{ getUserName()}}</i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownUser">
                                <!-- Здесь вы можете добавить элементы меню для пользователя -->
                                <a class="dropdown-item" href="#">Profile</a>
                                <div class="dropdown-divider"></div>
                                <a @click.prevent="logout()" class="dropdown-item" href="#">Выйти</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <router-view></router-view>
    </div>
</template>

<script>

export default {
    data(){
        return{
            token:null,
            isAdmin:null,
            user:[],
            username:null
        }
    },

    mounted() {
        this.getToken();
        this.checkAdmin();
    },

    methods:{

        getUserName(){
            const user =JSON.parse(localStorage.getItem('userData'))
            if(user){
                return  ' ' + user[0].name
            }
        },

        getToken(){
            this.token = localStorage.getItem('userData')
        },
        logout(){
            localStorage.removeItem ('userData')
            window.location.href = '/login';
        },
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
    }
}
</script>

<style>
i{
    font-style: normal;
}
</style>
