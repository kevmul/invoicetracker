<template>
    <modal v-if="shouldBeOpen">
        <h2>Add a new Client</h2>
        <form @keydown="form.errors.clear($event.target.name)">

            <div class="field">
                <label class="label">Amount</label>
                <div class="control">
                    <input class="input" type="text" name="amount" placeholder="Dollars" v-modle="form.amount">
                    <span class="help is-error" v-if="form.errors.has('amount')" v-text="form.errors.get('amount')"></span>
                </div>
            </div>

            <div class="field">
                <label class="label">Amount</label>
                <div class="control">
                    <date-picker :value="form.paid_on" name="paid_on" input-class="input"></date-picker>
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
import DatePicker from 'vuejs-datepicker'
import Form from '../classes/Form';

export default {
    name: `AddPaymentModal`,

    data() {
        return {
            form: new Form({
                amount: 0,
                paid_on: new Date()
            })
        }
    },

    components: {
        Modal,
        DatePicker
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
