<template>
  <AdminLayout>
    <template #default>
      <div>
        <h2 class="text-2xl font-bold mb-6">Receitas</h2>
        <div class="mb-4 text-right">
          <button @click="goToCreate" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">Adicionar Nova Receita</button>
        </div>
        <table class="min-w-full bg-white rounded shadow">
          <thead>
            <tr>
              <th class="py-2 px-4 border-b">ID</th>
              <th class="py-2 px-4 border-b text-left">Nome</th>
              <th class="py-2 px-4 border-b text-left">Categoria</th>
              <th class="py-2 px-4 border-b text-left">Ações</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="recipe in recipes" :key="recipe.id">
              <td class="py-2 px-4 border-b">{{ recipe.id }}</td>
              <td class="py-2 px-4 border-b">{{ recipe.title }}</td>
              <td class="py-2 px-4 border-b">{{ recipe.categoryName }}</td>
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
  computed: {
    recipes() {
      return this.$store.getters['recipe/recipes']
    },
    loading() {
      return this.$store.getters['recipe/loading']
    },
    error() {
      return this.$store.getters['recipe/error']
    }
  },
  methods: {
    goToCreate() {
      this.$router.push({ name: 'AdminRecipeCreate' })
    }
  },
  mounted() {
    this.$store.dispatch('recipe/fetchRecipes')
  }
}
</script>
