import { createRouter, createWebHistory } from 'vue-router'
import ToDo from '../components/ToDo.vue';
import Login from '../Pages/Login.vue';
import Register from '../Pages/Registration.vue';
import Seeds from '../Pages/Seeds.vue';
import process from 'process'

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes: [
    {
          path: '/',
          name: 'main',
          component:ToDo
    },
    {
          path: '/login',
          name: 'login.index',
          component:Login
    },
    {
          path: '/seeds',
          name: 'seeds.index',
          component:Seeds
    },
    {
      path: '/registration',
      name: 'registration.index',
      component: Register
    },
    //
    // {
    //   path: '/login',
    //   name: 'login.index',
    //   component:() =>import('../views/users/Login.vue')
    // },

  ]
})
router.beforeEach((to,from,next)=>{
    const token = localStorage.getItem('userData')

    if(!token){
        if(to.name === 'login.index'|| to.name === 'registration.index'){
            return next()
        } else{
            return next({
                name:'login.index'
            })
        }
    }
    if(to.name === 'login.index'|| to.name === 'registration.index' && token){
        return next({
            name:'main'
        })
    }
    next()
})


export default router
