
import Home from './components/Home.vue';
import Register from './components/Register.vue';
import Login from './components/Login.vue';
import EditItem from './components/EditItem';
import ItemAdd from './components/ItemAdd';

export const routes = [
    {
        path: '/',
            name: 'home',
            component: Home
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
    },
    {
        path: '/Additem',
        name: 'additem',
        component: ItemAdd,
        meta: {
            requiresAuth: true
        }
        
    },
    {
        path: '/edititem/:id',
        component: EditItem,
        name: 'edititem',
        meta: { 
            requiresAuth: true
         }
    },
]