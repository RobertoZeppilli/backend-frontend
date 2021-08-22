<template>
  <div
    class="d-flex flex-column align-items-center justify-content-center vh-100"
  >
    <h1 class="page-title">todoodle</h1>
    <div>

      <login-form></login-form>

      <div class="text-center text-light">
        <span class="separator">OR</span>
      </div>
      
      <router-link class="btn-grad w-100" :to="{ name: 'register' }">sign up</router-link>

      <div>
        <p class="separator text-center text-uppercase">If you're not signed yet!</p>
      </div>
      
    </div>
  </div>
</template>

<script>
import LoginForm from '../components/LoginForm.vue';

export default {
    name: "HomeComponent",

    components: {
      LoginForm
    }

  };
</script>



         