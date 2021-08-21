<template>
  <!-- <div>
    <div class="container">
      <h4>Register</h4>
      <form action="#" @submit.prevent="submitRegistration" id="register">
        <div class="form-row">
          <input v-model="form.name" type="text" placeholder="Enter name" />
        </div>
        <div class="form-row">
          <input v-model="form.email" type="email" placeholder="Enter email" />
        </div>
        <div class="form-row">
          <input
            v-model="form.password"
            type="password"
            placeholder="Enter password"
          />
           <div v-if="errors.name && errors">{{ errors.name[0] }}</div> 
        </div>
        <div class="form-row">
          <input
            v-model="form.password_confirmation"
            type="password"
            placeholder="Confirm password"
          />
        </div>
        <button class="btn" type="submit">Register</button>
      </form>
      <div v-for="(error, index) in errors" :key="index">{{ error }}</div>
    </div>
  </div> -->
  
    <div
      class="d-flex
            flex-column
            align-items-center
            justify-content-center
            vh-100"
    >
      <h2 class="page-title">register</h2>
      <div class="form-container">
        <form  @submit.prevent="submitRegistration">
          <div class="form-data w-100">
            <input
              v-model="form.name"
              type="text"
              placeholder="Enter name"
              class="w-100 px-2 py-2"
            />
          </div>

          <div class="form-data w-100">
            <input
              v-model="form.email"
              class="w-100 px-2 py-2"
              type="email"
              placeholder="Enter email"
            />
          </div>

          <div class="form-data w-100">
            <input
              v-model="form.password"
              type="password"
              placeholder="Enter password"
              class="w-100 px-2 py-2"
            />
          </div>

          <div class="form-data mb-2 w-100">
            <input
              v-model="form.password_confirmation"
              type="password"
              placeholder="Confirm password"
              class="w-100 px-2 py-2"
            />
          </div>

          <button class="btn-grad w-100" type="submit">Sign Up</button>
        </form>
      </div>
      <div class="back">
        <router-link :to="{ name: 'home' }">
          <i class="fas fa-hand-point-left fa-2x"></i>
        </router-link>
      </div>
    </div>
</template>

<script>
import axios from "axios";
axios.defaults.withCredentials = true;

import { mapActions } from "vuex";

export default {
  name: "Register",

  data() {
    return {
      form: {
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
      },
    };
  },

  methods: {
    ...mapActions({
      register: "auth/register",
    }),

    submitRegistration() {
      this.register(this.form);
      this.$router.push({ name: "home" });
    },
  },
};
</script>