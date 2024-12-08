import { createRouter, createWebHistory } from 'vue-router'


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: ()=> import('@v/HomeView.vue'),
    },
    {
      path: '/about',
      name: 'about',
      component: () => import('../views/AboutView.vue'),
    },
    {
      path: '/test',
      name: '/test',
      component: () => import('../views/Testview.vue'),
    },
    {
      path: '/users',
      name: 'users',
      component: () => import('../views/UsersView.vue'),
    },
    {
      path: '/recipes/:id',
      name: 'recipeDetail',
      component: () => import('@/views/DetailView.vue'),      
      props:route => ({ id: Number(route.params.id) })
    },
   
  ],
})

export default router
