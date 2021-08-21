<template>
  <div
    class="d-flex flex-column align-items-center justify-content-center vh-100"
  >
    <h2 class="page-title">create</h2>
    <div class="form-container">
      <form action="#" @submit.prevent="create">
        <div class="form-data w-100">
          <input
            v-model="newTodolist.title"
            class="w-100 px-2 py-2"
            type="text"
            name="title"
            placeholder="Write a title..."
          />
        </div>

        <button class="btn-grad w-100" type="submit">Save</button>
      </form>
      <div class="back">
        <router-link :to="{ name: 'dashboard' }">
          <i class="fas fa-hand-point-left fa-2x"></i>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";

export default {
  name: "CreateTodolist",

  data() {
    return {
      newTodolist: {
        title: "",
      },
    };
  },

  methods: {
    ...mapActions({
      createTodolist: "todolist/createTodolist",
    }),

    create() {
      this.createTodolist(this.newTodolist);
      this.$router.push({ name: "dashboard" });
    },
  },
};
</script>

<style>
</style>