<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-sm p-8 bg-white rounded shadow">
      <LoginForm />
      <div class="mt-6 text-center">
        <RegisterButton />
      </div>
    </div>
  </div>
</template>

<script>
import LoginForm from './components/LoginForm.vue';
import RegisterButton from './components/RegisterButton.vue';

export default {
  name: 'App',
  components: { LoginForm, RegisterButton }
}
</script>

<style>
body {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  background: #f3f4f6;
}
</style>
