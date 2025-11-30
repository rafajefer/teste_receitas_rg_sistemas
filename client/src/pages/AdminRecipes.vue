<template>
  <AdminLayout>
    <template #default>
      <div>
        <h2 class="text-2xl font-bold mb-6">Receitas</h2>
        <table class="min-w-full bg-white rounded shadow">
          <thead>
            <tr>
              <th class="py-2 px-4 border-b">ID</th>
              <th class="py-2 px-4 border-b">Nome</th>
              <th class="py-2 px-4 border-b">Categoria</th>
              <th class="py-2 px-4 border-b">Ações</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="recipe in recipes" :key="recipe.id">
              <td class="py-2 px-4 border-b">{{ recipe.id }}</td>
              <td class="py-2 px-4 border-b">{{ recipe.name }}</td>
              <td class="py-2 px-4 border-b">{{ recipe.category }}</td>
              <td class="py-2 px-4 border-b">
                <button class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition mr-2">Editar</button>
                <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition">Excluir</button>
              </td>
            </tr>
            <tr v-if="recipes.length === 0">
              <td colspan="4" class="py-4 text-center text-gray-500">Nenhuma receita encontrada.</td>
            </tr>
          </tbody>
        </table>
      </div>
    </template>
  </AdminLayout>
</template>

<script>
import AdminLayout from '@/layouts/AdminLayout.vue'

export default {
  name: 'AdminRecipes',
  components: { AdminLayout },
  data() {
    return {
      recipes: [
        { id: 1, name: 'Bolo de Chocolate', category: 'Sobremesa' },
        { id: 2, name: 'Feijoada', category: 'Prato Principal' },
        { id: 3, name: 'Salada Caesar', category: 'Entrada' }
      ]
    }
  }
}
</script>
