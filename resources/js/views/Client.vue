<template>
    <div v-if="client">
        <div class="level">
            <h1 class="is-size-2">Client: {{client.name}}</h1>
            <div class="button is-danger" @click="destroy"><i class="fa fa-trash"></i></div>
        </div>
        <div class="level">
            <small>Phone: {{client.phone}} | Email: {{client.email}} | Balance: ${{balance | price}}</small>
            <!-- <button class="button is-info" ><i class="fa fa-plus"></i></button> -->
            <v-button text="Add Project" component="AddProjectModal"></v-button>
        </div>
        <hr>
        <client-projects></client-projects>
    </div>
</template>

<script>
import store from '../store';
import ClientProjects from './ClientProjects'; // Nested Router Views????
import VButton from '../components/Button';

export default {
    components: {
        ClientProjects,
        VButton
    },

    methods: {
        destroy() {
            let choice = confirm('Are you sure?');
            if (choice) {
                store.dispatch('destroyClient', this.client.id)
            }
        }
    },

    computed: {
        client() {
            return store.getters.client
        },
        balance() {
            return store.getters.client_balance
        }
    },
}
</script>
