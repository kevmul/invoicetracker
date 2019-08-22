require('./bootstrap');

import Vue from 'vue';

import store from './store/index';

import Todo from './components/Todo.vue';

import {mapState, mapActions} from 'vuex';
const app = new Vue({
    el: '#app',

    store,

    components: {Todo},

    computed: {
        ...mapState(['todos']),
        allTodosComplete() {
            return this.todos.every(todo => todo.done);
        }
    },

    methods: mapActions(['completeAll']),
});
