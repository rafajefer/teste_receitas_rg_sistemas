<template>
  <div>
    <h2 class="text-2xl font-bold mb-6 text-center">Cadastro</h2>
    <form @submit.prevent="register">
      <div class="mb-4">
        <label class="block text-gray-700 mb-2" for="name">Nome</label>
        <input v-model="name" id="name" type="text" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" required />
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 mb-2" for="login">Login</label>
        <input v-model="loginField" id="login" type="text" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" required />
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 mb-2" for="password">Senha</label>
        <input v-model="password" id="password" type="password" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" required />
      </div>
      <div class="mb-6">
        <label class="block text-gray-700 mb-2" for="password_confirmation">Confirme a Senha</label>
        <input v-model="password_confirmation" id="password_confirmation" type="password" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" required />
      </div>
      <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition">Cadastrar</button>
    </form>
    <div v-if="error" class="mt-4 text-red-600 text-center">{{ error }}</div>
    <div v-if="success" class="mt-4 text-green-600 text-center">{{ success }}</div>
  </div>
</template>

<script>
import axios from 'axios'
const apiUrl = process.env.VUE_APP_API_URL || 'http://localhost:8000/api'

export default {
  name: 'RegisterForm',
  data() {
    return {
      name: '',
      loginField: '',
      password: '',
      password_confirmation: '',
      error: '',
      success: ''
    }
  },
  methods: {
    async register() {
      this.error = ''
      this.success = ''
      try {
        await axios.post(`${apiUrl}/auth/register`, {
          name: this.name,
          login: this.loginField,
          password: this.password,
          password_confirmation: this.password_confirmation
        })
        this.success = 'Cadastro realizado com sucesso!'
        // Redirecionar para login se desejar
        // this.$router.push({ name: 'Login' })
      } catch (e) {
        this.error = e.response?.data?.message || 'Erro ao cadastrar.'
      }
    }
  }
}
</script>
