<template>
    <div class="project">
        <div class="columns m-b-5">
            <div class="column is-four-fifths">
                <div class="level">
                    <div class="level-left"><h2>{{project.title}}</h2></div>
                    <div class="level-right"><span class="is-strong">${{project.amount | price}}</span></div>
                </div>
            </div>
        </div>
        <div class="payments">
            <payments v-for="(payment, index) in project.payments" :key="index" :payment="payment"></payments>
        </div>
        <div class="columns">
            <div class="column is-four-fifths">
                <div class="remainder">
                    <h2 class="is-size-3 align-right">Balance Remaining : ${{balance | price}}</h2>
                </div>
            </div>
            <div class="column is-one-fifth">
                <v-button text="Add Payment" component="AddPaymentModal"></v-button>
            </div>
        </div>
        <hr>
    </div>
</template>

<script>
import store from '../store';
import Payments from './Payments';
import Form from '../classes/Form';
import VButton from './Button';

export default {
    props: ['project'],

    components: {
        Payments,
        VButton
    },

    data() {
        return {
            form: new Form({
                amount: '',
                paid_on: new Date
            })
        }
    },

    methods: {
        submit() {
            this.form.post(`/api/client/${store.state.route.params.client}/project/${this.project.id}/payment`)
        }
    },



    computed: {
        balance () {
            let payments = this.project.payments.reduce((a,b) => a + (b.amount || 0), 0);
            return this.project.amount - payments;
        }
    },
}
</script>
