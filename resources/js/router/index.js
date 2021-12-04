import {createWebHistory, createRouter} from "vue-router";

import Home from '../pages/Home';
import About from '../pages/About';
import Register from '../pages/Register';
import Login from '../pages/Login';
import Dashboard from '../pages/Dashboard';

import items from '../components/Items';
import AddItem from '../components/AddItem';
import EditItem from '../components/EditItem';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'about',
        path: '/about',
        component: About
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: Dashboard
    },
    {
        name: 'items',
        path: '/items',
        component: items
    },
    {
        name: 'additem',
        path: '/item/add',
        component: AddItem
    },
    {
        name: 'edititem',
        path: '/item/edit/:id',
        component: EditItem
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
