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
            <select v-model.number="form.categoryId" class="w-full px-3 py-2 border rounded" required>
              <option value="" disabled>Selecione uma categoria</option>
              <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{ cat.nome }}</option>
            </select>
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
      stepsText: '',
      categories: [
        { id: 1, nome: 'Bolos e tortas doces' },
        { id: 2, nome: 'Carnes' },
        { id: 3, nome: 'Aves' },
        { id: 4, nome: 'Peixes e frutos do mar' },
        { id: 5, nome: 'Saladas, molhos e acompanhamentos' },
        { id: 6, nome: 'Sopas' },
        { id: 7, nome: 'Massas' },
        { id: 8, nome: 'Bebidas' },
        { id: 9, nome: 'Doces e sobremesas' },
        { id: 10, nome: 'Lanches' },
        { id: 11, nome: 'Prato Único' },
        { id: 12, nome: 'Light' },
        { id: 13, nome: 'Alimentação Saudável' }
      ]
    }
  },
  methods: {
    async submit() {
      this.form.ingredients = this.ingredientsText.split('\n').filter(i => i.trim())
      this.form.steps = this.stepsText.split('\n').filter(s => s.trim())
      await this.$store.dispatch('recipe/createRecipe', this.form)
      this.$router.push({ name: 'AdminRecipes' })
    },
    cancel() {
      this.$router.push({ name: 'AdminRecipes' })
    }
  }
}
</script>
