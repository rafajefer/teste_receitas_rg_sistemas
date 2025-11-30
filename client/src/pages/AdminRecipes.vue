<template>
  <AdminLayout>
    <template #default>
      <div>
        <h2 class="text-2xl font-bold mb-6">Receitas</h2>
        <div class="mb-4 flex justify-between items-center">
          <input
            v-model="search"
            @keyup.enter="searchRecipes"
            type="text"
            placeholder="Buscar por nome..."
            class="px-3 py-2 border rounded w-1/2 mr-4"
          />
          <button @click="searchRecipes" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition mr-2">Buscar</button>
          <button @click="goToCreate" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">Adicionar Nova Receita</button>
        </div>
        <LoadingSpinner v-if="loading" />
        <template v-else>
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
                  <button class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition mr-2" @click="goToEdit(recipe.id)">Editar</button>
                  <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition">Excluir</button>
                </td>
              </tr>
              <tr v-if="recipes.length === 0">
                <td colspan="4" class="py-4 text-center text-gray-500">Nenhuma receita encontrada.</td>
              </tr>
            </tbody>
          </table>
        </template>
      </div>
    </template>
  </AdminLayout>
</template>

<script>
import AdminLayout from '@/layouts/AdminLayout.vue'
import LoadingSpinner from '@/components/LoadingSpinner.vue'

export default {
  name: 'AdminRecipes',
  components: { AdminLayout, LoadingSpinner },
  data() {
    return {
      search: ''
    }
  },
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
    },
    searchRecipes() {
      this.$store.dispatch('recipe/fetchRecipes', { title: this.search })
    },
    goToEdit(id) {
      this.$router.push({ name: 'AdminRecipeEdit', params: { id } })
    }
  },
  mounted() {
    this.$store.dispatch('recipe/fetchRecipes')
  }
}
</script>
