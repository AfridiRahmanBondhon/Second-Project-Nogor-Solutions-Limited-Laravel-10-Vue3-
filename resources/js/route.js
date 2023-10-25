import { createRouter, createWebHistory } from 'vue-router'
import HomeView from './HomeView.vue'
import NogorView from './Nogor/view.vue'
import NogorCreate from './Nogor/create.vue'
import NogorEdit from './Nogor/edit.vue'
import userProfile from './User/User.vue'
import userRegistration from './User/Registration.vue'
import userLogin from './User/Login.vue'
import userEdit from './User/EditUser.vue'
import resetPassword from './User/password/ResetPassword.vue'

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomeView
        },
        {
            path: '/about',
            name: 'about',
            // route level code-splitting
            // this generates a separate chunk (About.[hash].js) for this route
            // which is lazy-loaded when the route is visited.
            component: () => import('./AboutView.vue')
        },
        {
            path: '/nogor',
            name: 'nogorView',
            component: NogorView
        },
        {
            path: '/nogor/create',
            name: 'nogorCreate',
            component: NogorCreate
        },
        {
            path: '/nogor/:id/edit',
            name: 'nogorEdit',
            component: NogorEdit
        },
        {
            path: '/profile',
            name: 'userProfile',
            component: userProfile
        },
        {
            path: '/registration',
            name: 'userRegistration',
            component: userRegistration
        },
        {
            path: '/login',
            name: 'userLogin',
            component: userLogin
        },
        {
            path: '/admin/editUser',
            name: 'userEdit',
            component: userEdit,
            meta:{ requirsAuth:true},
        },
        {
            path: '/admin/resetPassword',
            name: 'resetPassword',
            component: resetPassword
        },
    ]
})

router.beforeEach((to, from, next) => {
    //if(to.matched.some(record=>record.meta.requirsAuth))
    if (to.meta.requirsAuth) {
        if(!localStorage.getItem("lastname")){
            next({
                name:"userLogin",
            })
        }else{
            next();
        }
    }else{
        next();
    }
})

export default router
