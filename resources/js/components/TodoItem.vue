<template>
    <div class="py-3">
        <div class="card">
            <div class="card-header flex justify-between">
                <p>{{ this.item.name }}</p>
                <span v-if="!this.item.completed_date" class="btn btn-sm btn-success" @click="completeTask">Done</span>
                <span v-else class="" >Task Completed</span>
            </div>
            
            <div class="card-body flex flex-column p-1">
                <i class="due-date">Due Date: {{ this.item.due_date }}</i>
                <p class="px-2 py-3">{{this.item.description}}</p>
            </div>
            <div class="card-footer flex justify-between">
                <span class="btn btn-dark btn-sm">
                    <router-link :to="`/todo/${this.item.id}`">
                        Edit Task
                    </router-link>
                </span>
                <span class="btn btn-danger btn-sm" @click="deleteTask">
                    Delete Task
                </span>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        props: ['item'],
        mounted() {
            // console.log('Component mounted.')
            // console.log('[[[[[[[item]]]]]]]');
            // console.log(this.item);
        },
        methods: {
            deleteTask(event) {
                axios.delete(`/todo/${this.item.id}`).then(res => {
                    console.log('[[[[[[[[[res]]]]]]]]]');
                    console.log(res);
                    this.$router.push('/');
                }).catch( er => console.error(er));
            },
            completeTask(event) {
                axios.put(`/todo/${this.item.id}`).then(res => {
                    console.log('[[[[[[[[[res]]]]]]]]]');
                    console.log(res);
                    this.$router.push('/');
                }).catch( er => console.error(er));
            }
        }
    }
</script>
<style media="screen">
    .due-date {
        font-size: 10px;
        align-self: end;
    }
</style>
