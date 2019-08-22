<template>
    <li class="todo">
        <input type="checkbox" :checked="todo.done" @change="toggleTodo(todo)">
        <label v-text="todo.body"></label>
        <button class="button is-danger" @click="deleteTodo(todo)">&times;</button>
    </li>
</template>

<script>
import {mapActions} from 'vuex';
export default {

    props: ['todo'],

    methods: mapActions(['toggleTodo', 'deleteTodo']),
}
</script>
