<template>
    <modal v-if="shouldBeOpen">
        <h2>Add a new Client</h2>
        <form @keydown="form.errors.clear($event.target.name)">
            <div class="field">
                <label class="label">Client Name</label>
                <div class="control flex">
                    <input class="input" type="text" name="name" placeholder="Client" v-model="form.name">
                    <span class="help is-error" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></span>
                </div>
            </div>
            <div class="field">
                <label class="label">Client Email</label>
                <div class="control">
                    <input class="input" type="text" name="email" placeholder="Email" v-model="form.email">
                    <span class="help is-error" v-if="form.errors.has('email')" v-text="form.errors.get('email')"></span>
                </div>
            </div>
            <div class="field">
                <label class="label">Client Phone</label>
                <div class="control">
                    <input class="input" type="text" name="phone" placeholder="Phone" v-model="form.phone">
                    <span class="help is-error" v-if="form.errors.has('phone')" v-text="form.errors.get('phone')"></span>
                </div>
            </div>
            <div class="control">
                <button class="button is-link" @click.prevent="submit" :disabled="form.errors.any()">Submit</button>
            </div>
        </form>
    </modal>
</template>

<script>
import store from '../store';
import Modal from './Modal';
import Form from '../classes/Form';

export default {
    name: `AddClientModal`,

    data() {
        return {
            form: new Form({
                name: '',
                phone: '',
                email: ''
            })
        }
    },

    components: {
        Modal
    },

    methods: {
        submit() {
            this.form.submit('post', '/api/client')
                .then(response => {
                    store.commit('hideModal');
                    store.state.clients.push(response.client)
                })
        }
    },

    computed: {
        shouldBeOpen() {
            return this.$options.name === store.state.modal.component
        }
    },
}
</script>
