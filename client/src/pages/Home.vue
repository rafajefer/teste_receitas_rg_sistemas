<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-100 px-4">
    <div class="w-full max-w-lg p-8 bg-white rounded shadow text-center">
      <h1 class="text-3xl font-bold mb-4">Bem-vindo ao Sistema de Receitas!</h1>
      <p class="text-lg text-gray-700 mb-6">Login realizado com sucesso.</p>
      <div class="mt-8">
        <router-link to="/recipes" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Ver receitas</router-link>
        <button @click="logout" class="ml-4 bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700 transition">Sair</button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
const apiUrl = process.env.VUE_APP_API_URL || 'http://localhost:8000/api'

export default {
  name: 'HomePage',
  methods: {
    async logout() {
      try {
        await axios.post(`${apiUrl}/auth/logout`)
      } catch (e) {
        // Ignorar erro de logout se não estiver autenticado
      }
      this.$store.dispatch('auth/logout')
      this.$router.push({ name: 'Login' })
    }
  }
}
</script>
