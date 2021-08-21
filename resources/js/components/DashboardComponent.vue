<template>
  <div class="container">
    <div class="d-flex align-items-center">
      <Nav />
      <h2 class="m-0 page-title">Lists</h2>
    </div>
    <div v-if="todolists.length > 0 && !loading" class="todolist-row h-100 py-5" :class="todolists.length == 1 ? 'todolist-1' : '' ">
      <div class="todolist" v-for="todolist in todolists" :key="todolist.id">
        <div class="td-title">
          <h5 class="text-center m-0 py-2 text-light">
            {{ todolist.title }}
          </h5>
          <i class="fas fa-times" @click="cancel(todolist.id)"></i>
        </div>
        <div class="td-inputs d-flex align-items-center justify-content-center">
          <input class="px-2" type="text" />
          <input type="submit" value="Add" />
        </div>
        <div class="px-2">
          <p>todo goes here</p>
        </div>
      </div>
    </div>
    <div
      v-else-if="todolists.length < 0 || !loading"
      class="d-flex flex-column justify-content-center align-items-center h-100"
    >
      <h2 class="no-list-message">Create a list!</h2>
      <i class="fas fa-chevron-down fa-2x mb-2"></i>
      <div>
        <router-link class="btn-grad" :to="{ name: 'create-todolist' }"
          >New List</router-link
        >
      </div>
    </div>
    <Loader v-else />
  </div>
</template>

<script>
import Loader from "./Loader";
import Nav from "./Nav";

export default {
  name: "Dashboard",

  components: {
    Loader,
    Nav
  },

  data() {
    return {
      todolists: [],
      loading: true,
    };
  },

  methods: {
    getTodoLists() {
      axios
        .get("http://127.0.0.1:8000/api/todolists")
        .then((res) => {
          this.todolists = res.data;
          this.loading = false;
        })
        .catch((err) => {
          console.log(err);
        });
    },

    cancel(id) {
      axios
        .delete(`http://127.0.0.1:8000/api/todolists/${id}`)
        .then(() => {
          this.getTodoLists();
        })
        .catch((err) => {
          console.log(err);
        });
    },

    
  },

  created() {
    this.getTodoLists();
    
  },
};
</script>

