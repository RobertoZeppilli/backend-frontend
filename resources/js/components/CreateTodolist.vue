<template>
  <div
    class="d-flex flex-column align-items-center justify-content-center vh-100"
  >
    <h2 class="page-title animate__animated animate__fadeInLeftBig">
      add list
    </h2>
    <div
      class="
        form-container
        animate__animated animate__fadeInLeftBig animate__delay-2s
      "
    >
      <form action="#" @submit.prevent="create">
        <div class="form-data w-100">
          <input
            v-model="newTodolist.title"
            class="w-100 px-2 py-2 create-input"
            type="text"
            name="title"
            placeholder="Write a title..."
          />
        </div>

        <button class="btn-grad w-100" type="submit">Save</button>
      </form>
    </div>
    <div class="back animate__animated animate__fadeInLeftBig animate__delay-3s">
      <router-link :to="{ name: 'dashboard' }">
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

      if (!this.newTodolist.title) {
        this.newTodolist.title = "no title given";
      }
      this.$router.push({ name: "dashboard" });
    },
  },
};
</script>

<style>
</style>