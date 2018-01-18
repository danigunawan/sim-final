//DASHBOARD
import DashboardIndex from './components/dashboard/DashboardIndex.vue';
import UserIndex from './components/user/UserIndex.vue';
import UserCreate from './components/user/UserCreate.vue';
import UserEdit from './components/user/UserEdit.vue';
import SatuanIndex from './components/satuan/SatuanIndex.vue';
import SatuanCreate from './components/satuan/SatuanCreate.vue';
import SatuanEdit from './components/satuan/SatuanEdit.vue';

 const routes = [
     {
        path: '/',
        component: DashboardIndex,
        name : 'IndexDashboard'
     },
     { path: '/user', component: UserIndex,name: 'IndexUser' },
     { path: '/user/create', component: UserCreate,name: 'CreateUser' },
     { path: '/user/edit/:id', component: UserEdit,name: 'EditUser' },
     { path: '/satuan', component: SatuanIndex,name: 'IndexSatuan' },
     { path: '/satuan/create', component: SatuanCreate,name: 'CreateSatuan' },
     { path: '/satuan/edit/:id', component: SatuanEdit,name: 'EditSatuan' }
 ];

 export default routes;
