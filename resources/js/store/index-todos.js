import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        todos: [
            {body: 'Go to the store', done: false},
            {body: 'Buy groceries', done: true},
            {body: 'Finish Homework', done: false},
        ]
    },

    mutations: {
        toggleCompleted(state, todo) {
            console.log(todo);
            todo.done = !todo.done;
        },
        completeAll(state) {
            state.todos.forEach(todo => todo.done = true);
        },
        deleteTodo(state, todo) {
            state.todos.splice(state.todos.indexOf(todo), 1);
        }
    },

    actions: {
        toggleTodo(context, todo) {
            context.commit('toggleCompleted', todo);
        },

        completeAll(context) {
            context.commit('completeAll');
        },

        deleteTodo(context, todo) {
            context.commit('deleteTodo', todo);
        }
    }
});
