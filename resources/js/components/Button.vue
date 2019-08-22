<template>
    <button class="button is-primary" @click="openModal">{{text}}</button>
</template>

<script>
import store from '../store';

export default {
    props: ['text', 'component'],

    methods: {
        openModal() {
            store.commit('showModal', this.component);
        }
    },
}
</script>
