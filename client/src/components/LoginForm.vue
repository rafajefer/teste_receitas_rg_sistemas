<template>
  <div>
    <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
    <form @submit.prevent="login">
      <div class="mb-4">
        <label class="block text-gray-700 mb-2 text-red" for="login">Login</label>
        <input v-model="loginField" id="login" type="text" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" required />
      </div>
      <div class="mb-6">
        <label class="block text-gray-700 mb-2" for="password">Senha</label>
        <input v-model="password" id="password" type="password" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" required />
      </div>
      <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">Entrar</button>
    </form>
    <div v-if="error" class="mt-4 text-red-600 text-center">{{ error }}</div>
  </div>
</template>

<script>
export default {
  name: 'LoginForm',
  data() {
    return {
      loginField: '',
      password: '',
      error: ''
    }
  },
  methods: {
    async login() {
      this.error = ''
      try {
        await this.$store.dispatch('auth/login', { login: this.loginField, password: this.password })
        this.$router?.replace?.({ name: 'Home' })
      } catch (e) {
        console.log('Login error:', e)
        this.error = e.response?.data?.message || 'Erro ao autenticar.'
      }
    }
  }
}
</script>
