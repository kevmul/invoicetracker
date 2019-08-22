<template>
    <transition name="modal-zoom">
    <div class="modal is-active" v-show="isOpen">
        <div class="modal-background" @click="neverMind"></div>
        <div class="modal-content">
            <div class="box">
                <slot></slot>
            </div>
        </div>
        <button class="modal-close is-large" @click="neverMind"></button>
    </div>
    </transition>
</template>

<script>
// import Vue from 'vue';
import store from '../store';

export default {
    name: "Modal",

    data() {
        return {
            component: null
        }
    },
    computed: {
        isOpen () {
            return store.state.modal.visible;
        },
        modalComponent() {
            return store.state.modal.component;
        }
    },

    methods: {
        neverMind() {
            store.commit('hideModal')
        }
    },

    // watch: {
    //     modalComponent(componentName) {
    //         if (!componentName) return;

    //         // Vue.component(componentName, () => import(`./${componentName}`));
    //         Vue.component(componentName, () => import(`./AddClientModal`));

    //         this.component = 'AddClientModal';
    //     }
    // },
}
</script>
