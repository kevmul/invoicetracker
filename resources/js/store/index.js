import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        clients: [],
        modal: {
            visible: false,
            component: null
        },
    },

    mutations: {
        setClients (state, clients) {
            state.clients = clients;
        },
        removeClient (state, client) {
            let index = state.clients.map( x => x.id).indexOf(client)
            state.clients.splice(index, 1);
        },
        showModal(state, componentName) {
            state.modal.visible = true;
            state.modal.component = componentName;
        },
        hideModal(state) {
            state.modal.visible = false;
            state.modal.component = null;
        },
    },

    setters: {},

    getters: {
        client (state) {
            return state.clients.filter(x => x.id === parseInt(state.route.params.client))[0]
        },
        client_balance (state, getters) {
            if (getters.projects) {
                return getters.projects.reduce((a, b) => a + (parseInt(b.amount) || 0),0);
            }
            return 0;
        },
        projects (state, getters) {
            if (getters.client) {
                return getters.client.projects
            }
            return []
        }
    },

    actions: {
        fetchClients: async (context) => {
            let {data} = await axios.get('/api/clients');
            context.commit('setClients', data.clients);
        },
        destroyClient: async (context, payload) => {
            await axios.delete('/api/client/' + payload);
            context.commit('removeClient', payload);
        }

        // fetchProjects: async (context, payload) => {
        //     let {data} = await axios.get(`/api/client/${payload.client_id}`);
        //     context.commit('setProjects', data);
        // },
        // fetchPayments: async (context, payload) => {
        //     let {data} = await axios.get(`/api/client/${payload.client_id}/project/${payload.project_id}`);
        //     context.commit('setPayments', data);
        // }
    }
});
