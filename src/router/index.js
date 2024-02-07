import { createRouter, createWebHistory } from 'vue-router'
import Home from "../views/Home.vue"
import Following from "../views/Following.vue"
import Create from "../views/Create.vue"
import Auth from "../views/Auth.vue"

const routes = [
  {
    path:"/",
    name:"Home",
    component:Home
  },
  {
    path:"/following",
    name:"Following",
    component:Following  
  },
  {
    path:"/create",
    name:"Create",
    component:Create
  },
  {
    path:"/auth",
    name:"Auth",
    component:Auth
  }
  
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
