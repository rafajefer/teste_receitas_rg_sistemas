
import { createRouter, createWebHistory } from 'vue-router'
import store from '../store'

const routes = [
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
    path: '/home',
    name: 'Home',
    meta: { requiresAuth: true },
    component: require('@/pages/Home.vue').default
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
    next({ name: 'Home' })
  }
  else {
    next()
  }
})

export default router
