//DASHBOARD
import DashboardIndex from './components/dashboard/DashboardIndex.vue';
import UserIndex from './components/user/UserIndex.vue';
import UserCreate from './components/user/UserCreate.vue';
import UserEdit from './components/user/UserEdit.vue';
 const routes = [
     {
        path: '/',
        component: DashboardIndex,
        name : 'IndexDashboard'
     },
     { path: '/user', component: UserIndex,name: 'IndexUser' },
     { path: '/user/create', component: UserCreate,name: 'CreateUser' },
     { path: '/user/edit/:id', component: UserEdit,name: 'EditUser' }
 ];

 export default routes;
