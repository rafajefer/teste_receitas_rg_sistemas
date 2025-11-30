import { createStore } from 'vuex'
const apiUrl = process.env.VUE_APP_API_URL

export default createStore({
  state: {
    todos: []
  },
  getters: {
  },
  mutations: {
    addTodos(state, todos) {
      state.todos = todos
    },
    addTodo(state, todo) {
      state.todos.push(todo)
    },
    updateTodo: (state, todo) => {
      const index = state.todos.findIndex(t => t.id === todo.id)
      if (index !== -1) {
        state.todos.splice(index, 1, todo)
      }
    },
    deleteTodo: (state, id) => {
      state.todos = state.todos.filter(t => t.id !== id)
    }
  },
  actions: {
    async getTodos({ commit }) {
      try {
        const response = await fetch(`${apiUrl}/todos`)
        const data = await response.json()
        commit('addTodos', data)
      } catch (error) {
        alert('Error: ', error)
      }
    },
    async addTodo({ commit }, title) {
      try {
        const response = await fetch(`${apiUrl}/todos`,  {
          method: 'POST',
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            title: title,
            completed: false
          })
        })
        const data = await response.json()
        commit('addTodo', data)
      } catch (error) {
        alert('Error: ', error)
      }
    },
    async updateTodo({ commit }, { id, data }) {
      try {
        console.log(data)
        const response = await fetch(`${apiUrl}/todos/${id}`,  {
          method: 'PUT',
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(data)
        })
        const res = await response.json()
        commit('updateTodo', res)
      } catch (error) {
        alert('Error: ', error)
      }
    },
    async deleteTodo ({ commit }, id) {
      try {
        await fetch(`${apiUrl}/todos/${id}`, {
          method: 'DELETE'
        })
        commit('deleteTodo', id)
      } catch (error) {
        alert('Error: ', error)
      }
    }
  },
  modules: {
  }
})
