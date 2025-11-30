<template>
    <div class="space-y-2">
        <TodoItem v-for="todo in todos" :key="todo.id" :todo="todo" />
    </div>
</template>
<script>
import TodoItem from  '@/components/TodoItem.vue'
export default {
    components: { TodoItem },
    computed: {
        todos () {
            return this.$store.state.todos
        }
    }
}
</script>
