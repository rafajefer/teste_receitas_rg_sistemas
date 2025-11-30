import axios from 'axios'

const apiUrl = process.env.VUE_APP_API_URL || 'http://localhost:8000/api'
console.log('API URL:', apiUrl)
export default {
  namespaced: true,
  state: {
    token: localStorage.getItem('token') || null,
    user: (() => {
      const userStr = localStorage.getItem('user');
      if (!userStr || userStr === 'undefined') return null;
      try {
        return JSON.parse(userStr);
      } catch {
        return null;
      }
    })()
  },
  mutations: {
    setToken(state, token) {
      state.token = token
      localStorage.setItem('token', token)
      axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
    },
    setUser(state, user) {
      state.user = user
      localStorage.setItem('user', JSON.stringify(user))
    }
  },
  actions: {
    async login({ commit }, { login, password }) {
      const response = await axios.post(`${apiUrl}/auth/login`, { login, password })
      commit('setToken', response.data.accessToken)
      commit('setUser', response.data.user)
      return response.data
    },
    async logout({ commit }) {
      await axios.post(`${apiUrl}/auth/logout`)
      commit('setToken', null)
      commit('setUser', null)
      localStorage.removeItem('token')
      localStorage.removeItem('user')
      delete axios.defaults.headers.common['Authorization']
    }
  },
  getters: {
    isAuthenticated: state => !!state.token,
    user: state => state.user
  }
}
