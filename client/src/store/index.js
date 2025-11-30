import { createStore } from 'vuex'

export default createStore({
  modules: {
    auth: require('./auth').default
  }
})
