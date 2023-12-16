import { createRouter, createWebHistory } from 'vue-router'
import Feedback from '../Pages/Admin/Feedback.vue';
import FeedbackUser from '../Pages/User/Feedback.vue';
import Login from '../Pages/Auth/Login.vue';
import Register from '../Pages/Auth/Registration.vue';
import Swagger from '../Pages/Swagger/Swagger.vue';
import SuccessFeedback from '../components/SuccessFeedback.vue';
import process from 'process'

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes: [
    {
          path: '/',
          name: 'main',
          component:Feedback
    },
    {
          path: '/login',
          name: 'login.index',
          component:Login
    },
    {
          path: '/user',
          name: 'user.index',
          component:FeedbackUser
    },
    {
           path: '/registration',
           name: 'registration.index',
           component: Register
    },
    {
          path: '/notification',
          name: 'notification.index',
          component:SuccessFeedback
    },
    {
          path: '/swagger',
          name: 'swagger.index',
          component:Swagger
    },
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
