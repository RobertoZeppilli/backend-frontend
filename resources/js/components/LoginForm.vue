<template>
  <div class="form-container">
    <form action="#" @submit.prevent="submit">
      <div class="form-data w-100">
        <input
          v-model="form.email"
          class="w-100 px-2 py-2 home-input"
          type="email"
          placeholder="Enter email"
        />
      </div>

      <div class="form-data mb-2 w-100">
        <input
          v-model="form.password"
          type="password"
          placeholder="Enter password"
          class="w-100 px-2 py-2 home-input"
        />
      </div>

      <button class="btn-grad w-100" type="submit">Login</button>
    </form>
  </div>
</template>

<script>
import axios from "axios";
axios.defaults.withCredentials = true;
import { mapActions } from "vuex";
import { mapGetters } from "vuex";

export default {
  name: "Login",
  data() {
    return {
      form: {
        email: "",
        password: "",
      },
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
      login: "auth/login",
    }),

    submit() {
      this.login(this.form).then(() => {
        this.$router.replace({ name: "dashboard" }).catch((err) => {
          // Ignore the vuex err regarding  navigating to the page they are already on.
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
      });
    },
  },
};
</script>

