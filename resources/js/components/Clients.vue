<template>
    <ul class="menu-list">
        <router-link
            v-for="(client, index) in clients"
            :key="index"
            :to="{ path: '/client/'+ client.id }"
        >{{client.name}}</router-link>
    </ul>
</template>

<script>
import store from '../store'

export default {

    computed: {
        clients() {
            return store.state.clients
        }
    },

    created() {
        store.dispatch('fetchClients');
    }
}
</script>
