<template>
  <div v-if="user && authenticated" class="container p-0">
    <div class="profile-settings justify-content-between d-flex align-items-center">
      <i
        ref="dropdownMenu"
        @click.prevent="dropdown = !dropdown"
        class="fas fa-4x"
        :class="dropdown ? 'fa-bars' : 'fa-bars'"
      ></i>

     
      <ul v-if="dropdown" class="w-100 m-0 dropdown d-flex justify-content-around align-items-center">
        <li class="dropdown-link animate__animated animate__flipInX">
          <span >{{ user.name }}</span>
        </li>
        <li class="dropdown-link animate__animated animate__flipInX">
          <router-link  :to="{ name: 'create-todolist' }">Crea</router-link>
        </li>
        <li class="dropdown-link animate__animated animate__flipInX">
          <span  @click.prevent="logout" href="">Logout</span>
        </li>
      </ul>
      
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  name: "Nav",

  data() {
    return {
      dropdown: false,
    };
  },

  computed: {
    ...mapGetters({
      authenticated: "auth/authenticated",
      user: "auth/user",
    }),
  },

  methods: {
    ...mapActions({ logoutAction: "auth/logoutAction" }),

    logout() {
      this.logoutAction().then(() => {
        this.$router.push({ name: "home" });
      });
    },

    documentClick(e) {
      let el = this.$refs.dropdownMenu;
      let target = e.target;
      if (el !== target && !el.contains(target)) {
        this.dropdown = false;
      }
    },
  },

  created() {
    document.addEventListener("click", this.documentClick);
  },
  destroyed() {
    // important to clean up!!
    document.removeEventListener("click", this.documentClick);
  },
};
</script>



