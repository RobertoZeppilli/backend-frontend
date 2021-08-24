<template>
  <div
    class="d-flex flex-column align-items-center justify-content-center vh-100"
  >
    <h1 class="page-title animate__animated animate__fadeInDown">todoodle</h1>
    <div>
      <login-form></login-form>
    </div>
  </div>
</template>

<script>
import LoginForm from "../components/LoginForm.vue";


export default {
  name: "HomeComponent",

  components: {
    LoginForm,
  },
};
</script>



         