<template>
    <div class="bg-gradient bg-gray-800 py-5">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card todo-main">
                    <div class="card-header flex justify-between">
                        <span>Your To-Do List</span>
                        <span class="btn btn-dark btn-sm">
                            <router-link :to="'/todo/new'">
                                Add New Task
                            </router-link>
                        </span>
                    </div>
                    <div class="card-body">
                        <TodoItem v-for="item in items" :key="item.id" :item="item"></TodoItem>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import TodoItem from './TodoItem.vue';
    export default {
        data(){
            return {
                items: []
            }
        },
        mounted() {
            console.log('[[[[[this.items]]]]]');
            console.log(this.items);
            axios.get('/todo').then(res => {
                this.items = res.data;
            }).catch( er => console.error(er));
        },
        components: {
            TodoItem
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
