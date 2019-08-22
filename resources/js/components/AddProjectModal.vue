<template>
    <modal v-if="shouldBeOpen">
        <h2>Add a new Client</h2>
        <form @keydown="form.errors.clear($event.target.name)">
            <div class="field">
            <div class="control flex">
                <label class="label">Project Title</label>
                    <input class="input" type="text" name="title" placeholder="Client" v-model="form.title">
                    <span class="help is-error" v-if="form.errors.has('title')" v-text="form.errors.get('title')"></span>
                </div>
            </div>

            <div class="field">
                <label class="label">Project Amount</label>
                <div class="control">
                    <input class="input" type="text" name="amount" placeholder="Name" v-model="form.amount">
                    <span class="help is-error" v-if="form.errors.has('amount')" v-text="form.errors.get('amount')"></span>
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
    name: `AddProjectModal`,

    data() {
        return {
            form: new Form({
                title: '',
                amount: 0,
            })
        }
    },

    components: {
        Modal
    },

    methods: {
        submit() {
            this.form.submit('post', `/api/client/${this.client.id}/project`)
                .then(response => {
                    store.commit('hideModal');
                    this.client.projects.push(response.project)
                })
        }
    },

    computed: {
        client () {
            return store.getters.client
        },
        shouldBeOpen() {
            return this.$options.name === store.state.modal.component
        }
    },
}
</script>
