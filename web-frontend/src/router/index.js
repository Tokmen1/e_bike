import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const EmployeeEbike = () => import('@/views/EmployeeEbike/EmployeeEbike.vue');
const EmployeeEbikeForm = () => import('@/views/EmployeeEbike/EmployeeEbikeForm.vue');

const routes = [
  {
    path: '/',
    name: null,
    meta: { label: 'route.employee_ebike_list_title' },
    redirect: { name: 'EmployeeEbike', params: { page: 1 } },

    component: {
      render(c) { return c('router-view'); }
    },

    children: [
      {
        path: 'list/:page',
        name: 'EmployeeEbike',
        meta: { label: 'route.employee_ebike_list' },
        props: true,
        component: EmployeeEbike,
      },
      {
        path: 'create',
        name: 'EmployeeEbikeCreate',
        meta: { label: 'route.employee_ebike_create_title' },
        component: EmployeeEbikeForm
      },
      {
        path: 'update/:id',
        name: 'EmployeeEbikeUpdate',
        meta: { label: 'route.employee_ebike_update_title' },
        props: (route) => {
          return {
            id: Number(route.params.id)
          };
        },
        component: EmployeeEbikeForm
      },
    ]
  },
]

const router = new VueRouter({
  routes
})

export default router
