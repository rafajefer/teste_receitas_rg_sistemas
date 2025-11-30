import axios from 'axios'

const apiUrl = process.env.VUE_APP_API_URL || 'http://localhost:8000/api'

export default {
  namespaced: true,
  state: {
    recipes: [],
    loading: false,
    error: ''
  },
  mutations: {
    setRecipes(state, recipes) {
      state.recipes = recipes
    },
    setLoading(state, loading) {
      state.loading = loading
    },
    setError(state, error) {
      state.error = error
    }
  },
  actions: {
    async fetchRecipes({ commit }, filter = {}) {
      commit('setLoading', true)
      commit('setError', '')
      try {
        let url = `${apiUrl}/recipes`
        if (filter.title) {
          url += `?title=${encodeURIComponent(filter.title)}`
        }
        const response = await axios.get(url)
        commit('setRecipes', response.data)
      } catch (e) {
        commit('setError', 'Erro ao buscar receitas.')
      }
      commit('setLoading', false)
    },
    async createRecipe({ commit, dispatch }, payload) {
        commit('setLoading', true)
        commit('setError', '')
        try {
            await axios.post(`${apiUrl}/recipes`, payload)
            dispatch('fetchRecipes')
        } catch (e) {
            commit('setError', 'Erro ao criar receita.')
        }
        commit('setLoading', false)
    },
    async editRecipe({ commit, dispatch }, { id, ...payload }) {
        commit('setLoading', true)
        commit('setError', '')
        try {
            await axios.put(`${apiUrl}/recipes/${id}`, payload)
            dispatch('fetchRecipes')
        } catch (e) {
            commit('setError', 'Erro ao editar receita.')
        }
        commit('setLoading', false)
    }
  },
  getters: {
    recipes: state => state.recipes,
    loading: state => state.loading,
    error: state => state.error
  }
}
