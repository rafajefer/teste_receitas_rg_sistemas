<template>
  <AdminLayout>
    <template #default>
      <div class="max-w-xl mx-auto">
        <h2 class="text-2xl font-bold mb-6">Nova Receita</h2>
        <form @submit.prevent="submit">
          <div class="mb-4">
            <label class="block mb-1 font-semibold">Título</label>
            <input v-model="form.title" type="text" class="w-full px-3 py-2 border rounded" required />
          </div>
          <div class="mb-4">
            <label class="block mb-1 font-semibold">Tempo de preparo (minutos)</label>
            <input v-model.number="form.preparationTimeMinutes" type="number" min="0" class="w-full px-3 py-2 border rounded" required />
          </div>
          <div class="mb-4">
            <label class="block mb-1 font-semibold">Porções</label>
            <input v-model.number="form.servings" type="number" min="1" class="w-full px-3 py-2 border rounded" required />
          </div>
          <div class="mb-4">
            <label class="block mb-1 font-semibold">Ingredientes (um por linha)</label>
            <textarea v-model="ingredientsText" class="w-full px-3 py-2 border rounded" rows="4" required></textarea>
          </div>
          <div class="mb-4">
            <label class="block mb-1 font-semibold">Passos (um por linha)</label>
            <textarea v-model="stepsText" class="w-full px-3 py-2 border rounded" rows="4" required></textarea>
          </div>
          <div class="mb-4">
            <label class="block mb-1 font-semibold">Categoria</label>
            <input v-model.number="form.categoryId" type="number" min="1" class="w-full px-3 py-2 border rounded" required />
          </div>
          <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">Salvar</button>
          <button type="button" @click="cancel" class="ml-2 bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500 transition">Cancelar</button>
        </form>
      </div>
    </template>
  </AdminLayout>
</template>

<script>
import AdminLayout from '@/layouts/AdminLayout.vue'

export default {
  name: 'AdminRecipeCreate',
  components: { AdminLayout },
  data() {
    return {
      form: {
        title: '',
        preparationTimeMinutes: null,
        servings: null,
        ingredients: [],
        steps: [],
        userId: 1, // Ajuste conforme autenticação
        categoryId: null
      },
      ingredientsText: '',
      stepsText: ''
    }
  },
  methods: {
    submit() {
      this.form.ingredients = this.ingredientsText.split('\n').filter(i => i.trim())
      this.form.steps = this.stepsText.split('\n').filter(s => s.trim())
      // Aqui você pode enviar para a API
      console.log('Receita criada:', this.form)
      this.$router.push({ name: 'AdminRecipes' })
    },
    cancel() {
      this.$router.push({ name: 'AdminRecipes' })
    }
  }
}
</script>
