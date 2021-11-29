import Vue from 'vue'
import VueRouter from 'vue-router'
import Frontend from '../views/Frontend.vue'
import Backend from '../views/Backend.vue'

Vue.use(VueRouter)

const routes = [
  {path: '/', name: 'Backend', component: Backend},
  {path: '/frontend', name: 'Frontend', component: Frontend},
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
