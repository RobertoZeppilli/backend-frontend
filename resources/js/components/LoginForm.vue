<template>
  <div class="form-container animate__animated animate__fadeInLeftBig animate__delay-2s">
    <form action="#" @submit.prevent="submit(form)">
      <div class="form-data w-100">
        <input
          v-model="form.email"
          class="w-100 px-2 py-2 home-input"
          type="email"
          placeholder="Enter email"
          :class="loginErrors && loginErrors.email ? 'invalid' : ''"
        />
        <div v-if="loginErrors" class="animate__animated animate__fadeIn">
          <small
            class="text-danger"
            v-for="(error, index) in loginErrors.email"
            :key="index"
            >{{ error }}</small
          >
        </div>
      </div>

      <div class="form-data mb-2 w-100">
        <input
          v-model="form.password"
          type="password"
          placeholder="Enter password"
          class="w-100 px-2 py-2 home-input"
          :class="loginErrors && loginErrors.password ? 'invalid' : ''"
        />
        <div v-if="loginErrors" class="animate__animated animate__fadeIn">
          <small
            class="text-danger"
            v-for="(error, index) in loginErrors.password"
            :key="index"
            >{{ error }}</small
          >
        </div>
      </div>

      <button class="btn-grad w-100" type="submit">Login</button>
    </form>
    <div class="text-center text-light">
      <span class="separator">OR</span>
    </div>

    <router-link class="btn-grad w-100" :to="{ name: 'register' }"
      >sign up</router-link
    >

    <div>
      <p class="separator text-center text-uppercase">
        If you're not signed yet!
      </p>
    </div>
  </div>
</template>

<script>
import axios from "axios";
axios.defaults.withCredentials = true;
import { mapGetters, mapActions } from "vuex";

export default {
  name: "Login",
  data() {
    return {
      form: {
        email: "",
        password: "",
      },
      loginErrors: null,
    };
  },

  computed: {
    ...mapGetters({
      authenticated: "auth/authenticated",
      user: "auth/user",
    }),
  },

  methods: {
    ...mapActions({
      attempt: "auth/attempt",
    }),

    submit(credentials) {
      axios
        .post("http://127.0.0.1:8000/api/login", credentials)
        .then(async (res) => {
          // console.log(res.data);
          if (res.data.success) {
            // controllo se il token è buono
            await this.attempt(res.data.token);
          }

          if (res.data.errors) {
            this.loginErrors = res.data.errors;
          } else {
            this.$router.push({ name: "dashboard" });
            // location.href = '/dashboard'
          }
        })
        .catch((err) => {
          if (
            err.name !== "NavigationDuplicated" &&
            !err.message.includes(
              "Avoided redundant navigation to current location"
            )
          ) {
            // But print any other errors to the console
            console.log(err);
          }
        });
    },
  },
};
</script>

