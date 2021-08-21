<template>
  <div v-if="user && authenticated" class="container p-0">
    <div class="profile-settings d-flex align-items-center">
      <div class="d-flex icon" ref="dropdownMenu">
        <a href="" @click.prevent="dropdown = !dropdown">
          <i
            class="fas fa-4x"
            :class="dropdown ? 'fa-ellipsis-h' : 'fa-ellipsis-v'"
          ></i>
        </a>
        <div
          v-if="dropdown"
          class="ml-2 d-flex align-items-center justify-content-center"
        >
          <ul class="dropdown d-flex flex-column">
            <li class="dropdown-link h-100">
              {{ user.name }}
            </li>
            <li class="dropdown-link">
              <router-link :to="{ name: 'create-todolist' }">Crea</router-link>
            </li>
            <li class="dropdown-link">
              <a @click.prevent="logout" href="">Logout</a>
            </li>
          </ul>
        </div>
      </div>
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



<i class="fas fa-ellipsis-v"></i>