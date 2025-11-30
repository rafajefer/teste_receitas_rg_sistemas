<template>
  <AdminLayout @logout="handleLogout">
    <template #default>
      <div class="text-center">
        <h2 class="text-3xl font-bold mb-4">Bem-vindo ao Painel Admin!</h2>
        <p class="text-lg text-gray-700 mb-6">Esta é a página inicial do painel administrativo.</p>
      </div>
    </template>
  </AdminLayout>
</template>

<script>
import AdminLayout from '@/layouts/AdminLayout.vue'

export default {
  name: 'AdminHome',
  components: { AdminLayout }
}
</script>
