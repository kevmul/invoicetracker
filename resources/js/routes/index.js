import NotFound from '../views/NotFound';
import Home from '../views/Home';
import Client from '../views/Client';
import ClientProjects from '../views/ClientProjects';

export default {
    mode: 'history',

    routes: [{
        path: '*',
        component: NotFound
    },{
        path: '/',
        component: Home
    },{
        path: '/client/:client',
        component: Client
    },{
        path: '/client/:client/projects',
        component: ClientProjects
    }]
}
