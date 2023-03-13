<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 m-auto pt-4">
                    <div class="card">
                        <div class="card-header">
                            <h3>Todo List</h3>
                        </div>

                        <div class="card-body">
                            <form @submit.prevent="addTodo">
                                <div class="form-group">
                                    <label>Task</label>
                                    <input type="text" class="form-control" v-model="newTodoTitle" />
                                </div>

                                <button type="submit" class="btn btn-primary mt-3 ">Add task</button>
                            </form>

                            <ul class="list-group mt-3">
                                <li class="list-group-item" v-for="(todo, index) in todos" :key="todo.title">
                                    {{todo.title}}

                                    <i @click="removeTodo(todo, index)" class="float-right text-danger btn-delete">X</i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import axios from "axios";

export default {
    data() {
        return {
            newTodoTitle: "",
            todos: []
        };
    },
    methods: {
        addTodo() {
            const newTodoTitle = this.newTodoTitle.trim();
            if (newTodoTitle) {
                const data = {
                    title: newTodoTitle,
                    description: '',
                }
                axios.post('/todos', data).then((res) => {

                    this.todos.push(res.data);
                    this.newTodoTitle = "";
                 
                }).catch( () => {
                    alert('Failed to store')
                });
            }
        },
        removeTodo(todo, index) {
            console.log(todo)
            axios.delete('todos/' + todo.id ).then(res =>  {
                this.todos.splice(index, 1);
            }).catch( () => {
                alert('Failed to delete')
            });
        }
    },
    mounted() {
        axios.get('todos').then(res =>  {
            this.todos = res.data;
        });
    }
};
</script>
