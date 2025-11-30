<template>
  <div class="min-h-screen flex flex-col bg-gray-100">
    <!-- Header -->
    <header class="bg-blue-700 text-white py-4 px-6 flex items-center justify-between shadow">
      <h1 class="text-2xl font-bold">Painel Admin</h1>
      <button @click="handleLogout" class="bg-red-600 px-4 py-2 rounded hover:bg-red-700 transition">Sair</button>
    </header>

    <!-- Main Layout -->
    <div class="flex flex-1">
      <!-- Sidebar Menu -->
      <aside class="w-64 bg-white shadow-md p-6 flex flex-col">
        <nav>
          <ul class="space-y-4">
            <li>
              <router-link to="/admin" class="block py-2 px-4 rounded hover:bg-blue-100">Ínicio</router-link>
            </li>
            <li>
              <router-link to="/admin/users" class="block py-2 px-4 rounded hover:bg-blue-100">Usuários</router-link>
            </li>
            <li>
              <router-link to="/admin/recipes" class="block py-2 px-4 rounded hover:bg-blue-100">Receitas</router-link>
            </li>
            <li>
              <router-link to="/admin/settings" class="block py-2 px-4 rounded hover:bg-blue-100">Configurações</router-link>
            </li>
          </ul>
        </nav>
      </aside>

      <!-- Main Content -->
      <main class="flex-1 p-8">
        <slot />
      </main>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AdminLayout',
  methods: {
    async handleLogout() {
      await this.$store.dispatch('auth/logout')
      this.$router.push({ name: 'Login' })
    }
  }
}
</script>

<style scoped>
/* Adicione estilos personalizados se necessário */
</style>
