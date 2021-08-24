<template>
  <div
    class="d-flex flex-column align-items-center justify-content-center vh-100"
  >
    <h2 class="page-title animate__animated animate__fadeInLeftBig">
      register
    </h2>
    <div
      class="
        form-container
        animate__animated animate__fadeInLeftBig animate__delay-2s
      "
    >
      <form @submit.prevent="submitRegistration(form)">
        <div class="form-data w-100">
          <input
            v-model="form.name"
            type="text"
            placeholder="Enter name"
            class="w-100 px-2 py-2 home-input"
            :class="errors && errors.name ? 'invalid' : ''"
          />
          <div v-if="errors" class="animate__animated animate__fadeIn">
            <small
              class="text-danger"
              v-for="(error, index) in errors.name"
              :key="index"
              >{{ error }}</small
            >
          </div>
        </div>

        <div class="form-data w-100">
          <input
            v-model="form.email"
            class="w-100 px-2 py-2 home-input"
            type="email"
            placeholder="Enter email"
            :class="errors && errors.email ? 'invalid' : ''"
          />
          <div v-if="errors" class="animate__animated animate__fadeIn">
            <small
              class="text-danger"
              v-for="(error, index) in errors.email"
              :key="index"
              >{{ error }}</small
            >
          </div>
        </div>

        <div class="form-data w-100">
          <input
            v-model="form.password"
            type="password"
            placeholder="Enter password"
            class="w-100 px-2 py-2 home-input"
            :class="errors && errors.password ? 'invalid' : ''"
          />
          <div v-if="errors" class="animate__animated animate__fadeIn">
            <small
              class="text-danger"
              v-for="(error, index) in errors.password"
              :key="index"
              >{{ error }}</small
            >
          </div>
        </div>

        <div class="form-data mb-2 w-100">
          <input
            v-model="form.password_confirmation"
            type="password"
            placeholder="Confirm password"
            class="w-100 px-2 py-2 home-input"
            :class="errors && errors.password ? 'invalid' : ''"
          />
          <div v-if="errors" class="animate__animated animate__fadeIn">
            <small
              class="text-danger"
              v-for="(error, index) in errors.password_confirmation"
              :key="index"
              >{{ error }}</small
            >
          </div>
        </div>

        <button class="btn-grad w-100" type="submit">Sign Up</button>
      </form>
    </div>
    <div class="back animate__animated animate__fadeInLeftBig animate__delay-3s">
      <router-link :to="{ name: 'home' }">
        <i
          class="
            fas
            fa-hand-point-left fa-2x
            animate__animated
            animate__heartBeat
            animate__infinite
          "
        ></i>
      </router-link>
    </div>
  </div>
</template>

<script>
import axios from "axios";
axios.defaults.withCredentials = true;

import { mapGetters } from "vuex";

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
      errors: null,
    };
  },

  computed: {
    ...mapGetters({
      user: "auth/user",
    }),
  },

  methods: {
    submitRegistration(credentials) {
      axios
        .post("http://127.0.0.1:8000/api/register", credentials)
        .then((res) => {
          if (res.data.errors) {
            this.errors = res.data.errors;
          } else {
            this.errors = null;

            this.$router.push({ name: "home" });
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>