import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import Parallax from '../components/parallax'
import Login from '../components/login/Login'
import Logout from '../components/login/Logout'
import Signup from '../components/login/Signup'
import Forum from '../components/forum/Forum'
import Read from '../components/forum/Read'
import Create from '../components/forum/Create'
import createCategory from '../components/category/createCategory'

const routes = [
    { path: '/' , component: Parallax },
    { path: '/login' , component: Login },
    { path: '/logout' , component: Logout },
    { path: '/signup' , component: Signup },
    { path: '/category' , component: createCategory },
    { path: '/forum' , component: Forum , name: "forum"},
    { path: '/ask' , component: Create},
    { path: '/question/:slug' , component: Read , name: "read"}

]

const router = new VueRouter({
    routes,
    hashbang: false,
    mode: 'history'
})

export default router