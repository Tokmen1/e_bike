import Vue from 'vue'
import VueRouter from 'vue-router'
// import HomeView from '../views/HomeView.vue'

Vue.use(VueRouter)

const EmployeeEbike = () => import('@/views/EmployeeEbike/EmployeeEbike.vue');
// const EmployeeEbikeForm = () => import('@/views/EmployeeEbike/EmployeeEbikeForm.vue');

const routes = [
    {
        path: '/employeeEbike',
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
        //   {
        //     path: 'create',
        //     name: 'FieldCreate',
        //     meta: { label: 'route.employee_ebike_create_title' },
        //     component: EmployeeEbikeForm
        //   },
        //   {
        //     path: 'update/:id',
        //     name: 'FieldUpdate',
        //     meta: { label: 'route.employee_ebike_update_title' },
        //     props: (route) => {
        //       return {
        //         id: Number(route.params.id)
        //       };
        //     },
        //     component: EmployeeEbikeForm
        //   },
        ]
      },



//   {
//     path: '/',
//     name: 'home',
//     component: HomeView
//   },
//   {
//     path: '/about',
//     name: 'about',
//     // route level code-splitting
//     // this generates a separate chunk (about.[hash].js) for this route
//     // which is lazy-loaded when the route is visited.
//     component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
//   }
]

const router = new VueRouter({
  routes
})

export default router
