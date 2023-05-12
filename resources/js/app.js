
import { createApp } from 'vue';
import * as VueRouter from 'vue-router';
import '../css/app.css';

import ExampleComponent from './components/ExampleComponent.vue';
import TodoItem from './components/TodoItem.vue';
import TodoList from './components/TodoList.vue';
import TodoNewEdit from './components/TodoNewEdit.vue';
import Auth from './components/Auth.vue';

const routes = [
    { path: '/', component: Auth },
    { path: '/home', component: TodoList },
    { path: '/todo/new', component: TodoNewEdit },
    { path: '/todo/:item', props: true, component: TodoNewEdit },
    { path: '/about', component: TodoItem },
]

const router = VueRouter.createRouter({
    history: VueRouter.createWebHistory(),
    routes,
});


const app = createApp({});
app.use(router);
app.mount('#todo-app');
