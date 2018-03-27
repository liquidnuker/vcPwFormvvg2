// import Vue from "vue";
// import VueRouter from "vue-router";

import vcRouterView from "../vue-components/RouterView.vue";

Vue.use(VueRouter);

const vcHome = () => import('../vue-components/Home.vue');
const vcLogin = () => import('../vue-components/Login.vue');
const vcMembers = () => import('../vue-components/Members.vue');
const vc404 = () => import('../vue-components/global404.vue');
// const vcHome = require('../vue-components/Home.vue').default

const routes = [
  {
    path: "/",
    component: vcHome
  },
  {
    path: "/login",
    component: vcLogin
  },
  {
    path: "/members",
    component: vcMembers
  },
  {
    path: "*",
    component: vc404
  }
];

const router = new VueRouter({
  routes
});

new Vue({
  el: "#app",
  router,
  render: h => h(vcRouterView)
});

export {router};