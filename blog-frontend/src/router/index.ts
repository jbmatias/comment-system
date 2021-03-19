import Vue from 'vue'
import VueRouter, { RouteConfig } from 'vue-router'
import Profile from '../views/Profile.vue'
import NewsFeed from '../views/NewsFeed.vue'

Vue.use(VueRouter)

const routes: Array<RouteConfig> = [
  {
    path: '/',
    name: 'profile',
    component: Profile
  },
  {
    path: '/newsfeed',
    name: 'newsfeed',
    component: NewsFeed
  }  
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
