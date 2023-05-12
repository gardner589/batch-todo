<template>
    <div class="bg-gradient bg-gray-800 py-5">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card todo-main">
                    <div class="card-header flex justify-between">
                        <span>Login</span>
                        <span class="btn btn-info btn-sm">
                            <router-link :to="'/todo/new'">
                                Register
                            </router-link>
                        </span>
                    </div>
                    <div class="card-body flex flex-column py-5">
                        <div class="sm:col-span-6">
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                            <div class="mt-2">
                                <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block p-2.5 w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500" v-model="email">
                            </div>
                        </div>
                        
                        <div class="sm:col-span-6">
                            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                            <div class="mt-2">
                                <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block p-2.5 w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500" v-model="password">
                            </div>
                        </div>
                        
                        <div class="flex justify-center p-3">
                            <button class="col-8 btn btn-primary" @click="login">
                                Login
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    // import TodoItem from './TodoItem.vue';
    export default {
        data(){
            return {
                email: '',
                password: ''
            }
        },
        mounted() {
            console.log('[[[[[this.items]]]]]');
            console.log(this.items);
            axios.get('/api/user').then(res => {
                console.log('[[[[[[[res]]]]]]]');
                console.log(res);
            }).catch( er => console.error(er));
        },
        methods: {
            login(){
                let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                axios.post('/login', {email: this.email, password: this.password}, {
                    headers: {
                        'X-CSRF-TOKEN' : token,
                        'Content-Type': 'application/json'
                    }
                }).then(res => {
                    console.log('[[[[[[[res]]]]]]]');
                    console.log(res);
                    // this.$router.push('/home');
                }).catch( er => console.error(er));
            }
        },
        components: {
            // TodoItem
        }
    }
</script>
<style media="screen">
    .card.todo-main {
        height: 85vh;
    }
    .card.todo-main > .card-body {
        overflow: scroll;
    }
</style>
