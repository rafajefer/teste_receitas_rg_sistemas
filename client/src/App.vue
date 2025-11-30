<template>
  <div class="px-3 py-10 md:px-10">
      <div class="w-full sm:w-1/2 lg:w-1/3 mx-auto">
          <TodoSpinner v-if="loading" />
          <template v-else>
            <TodoFormAdd />
            <TodoItems v-if="hasTodos" />
            <TodoEmpty v-else />
          </template>
      </div>
  </div>
</template>

<script>
import TodoEmpty from './components/TodoEmpty.vue';
import TodoFormAdd from './components/TodoFormAdd.vue';
import TodoItems from './components/TodoItems.vue';
import TodoSpinner from './components/TodoSpinner.vue'

export default {
  components: { TodoSpinner, TodoFormAdd, TodoItems, TodoEmpty },
  name: 'App',
  data () {
    return {
      loading: false
    }
  },
  computed: {
      hasTodos () {
        return this.$store.state.todos.length > 0
      }
  },
  async created () {
    this.loading = true
    await this.$store.dispatch('getTodos')
    this.loading = false
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
