
import { createRouter, createWebHistory } from 'vue-router'
import store from '../store'

const routes = [
  {
    path: '/admin/recipes/:id/edit',
    name: 'AdminRecipeEdit',
    meta: { requiresAuth: true },
    component: require('@/pages/AdminRecipeEdit.vue').default
  },
  {
    path: '/',
    redirect: '/login'
  },
  {
    path: '/login',
    name: 'Login',
    meta: { public: true },
    component: require('@/pages/Login.vue').default
  },
  {
    path: '/register',
    name: 'Register',
    meta: { public: true },
    component: require('@/components/RegisterForm.vue').default
  },
  {
    path: '/admin',
    name: 'AdminHome',
    meta: { requiresAuth: true },
    component: require('@/pages/AdminHome.vue').default
  },
  {
    path: '/admin/recipes',
    name: 'AdminRecipes',
    meta: { requiresAuth: true },
    component: require('@/pages/AdminRecipes.vue').default
  },
  {
    path: '/admin/recipes/create',
    name: 'AdminRecipeCreate',
    meta: { requiresAuth: true },
    component: require('@/pages/AdminRecipeCreate.vue').default
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

router.beforeEach((to, from, next) => {
  const isAuthenticated = store.getters['auth/isAuthenticated']
  // Se rota requer autenticação e não está autenticado, redireciona para login
  if (to.meta.requiresAuth && !isAuthenticated) {
    next({ name: 'Login' })
  }
  // Se rota é pública e está autenticado, redireciona para Home
  else if (to.meta.public && isAuthenticated) {
    next({ name: 'AdminHome' })
  }
  else {
    next()
  }
})

export default router
