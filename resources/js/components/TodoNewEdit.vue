<template>
    <div class="container">
        <form class="row justify-content-center py-5">
            <div class="card p-5 col-6">
                <div class="sm:grid-cols-12">
                    <div class="sm:col-span-6">
                        <label for="task-name" class="block text-sm font-medium leading-6 text-gray-900">Task Name</label>
                        <div class="mt-2">
                            <input type="text" name="task-name" id="task-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500" v-model="task.name">
                        </div>
                    </div>
                    
                    <div class="sm:col-span-6">
                        <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                        <div class="mt-2">
                            <input type="text" name="description" id="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500" v-model="task.description">
                        </div>
                    </div>
            
                    <div class="sm:col-span-3">
                        <label for="due_date" class="block text-sm font-medium leading-6 text-gray-900">Due Date</label>
                        <input name="due_date" id="due_date" type="datetime-local" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500" placeholder="Select date" v-model="task.due_date">
                        <!-- <div class="relative max-w-sm">
                            <input type="datetime-local" v-model="task.due_date">
                        </div> -->
                    </div>
                </div>
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" @click="updateTask">Save</button>
                </div>
            </div>
            
        </form>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        props: ['item'],
        data(){
            return {
                task: {}
            }
        },
        mounted() {
            axios.get(`/todo/${this.item}`).then(res => {
                this.task = res.data;
            }).catch( er => console.error(er));
        },
        methods: {
            updateTask(event) {
                event.preventDefault();
                let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                let url = this.item ? `/todo/${this.task.id}/update`: '/todo/new';
                
                axios.post(url, this.task, {
                    headers: {
                        'X-CSRF-TOKEN' : token,
                        'Content-Type': 'application/json'
                    }
                }).then(res => {
                    this.$router.push('/');
                }).catch( er => console.error(er));
            }
        }
    }
</script>
