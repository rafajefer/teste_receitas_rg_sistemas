<template>
  <button @click="goToRegister" class="text-blue-600 hover:underline">Cadastrar-se</button>
</template>

<script>
export default {
  name: 'RegisterButton',
  methods: {
    goToRegister() {
      this.$router.push({ name: 'Register' })
    }
  }
}
</script>
