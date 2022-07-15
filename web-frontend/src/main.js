import Vue from 'vue'
import './plugins/bootstrap-vue'
import App from './App.vue'
import router from './router';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

Vue.config.productionTip = false

new Vue({
  el: '#app',
  router,
  render: h => h(App),
}).$mount('#app')
