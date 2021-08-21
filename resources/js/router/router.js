import Vue from 'vue';
import VueRouter from 'vue-router';
import store from '../store/store';

Vue.use(VueRouter)
import HomeComponent from '../components/HomeComponent';
import AboutComponent from '../components/AboutComponent';
import RegisterComponent from '../components/RegisterComponent';
import DashboardComponent from '../components/DashboardComponent';
import CreateTodolist from '../components/CreateTodolist';


const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomeComponent
        },
        {
            path: '/about',
            name: 'about',
            component: AboutComponent
        },
        {
            path: '/register',
            name: 'register',
            component: RegisterComponent
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: DashboardComponent,
            beforeEnter: (to, from, next) => {
                if(!store.getters['auth/authenticated']) {
                    return next({
                        name: 'home'
                    })
                }

                next()
            }
        },
        {
            path: '/create',
            name: 'create-todolist',
            component: CreateTodolist
        }
    ]
});

export default router;