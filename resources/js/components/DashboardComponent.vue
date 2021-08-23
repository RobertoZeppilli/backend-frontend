<template>
  <div class="container">
    <div class="d-flex align-items-center py-2">
      <Nav />
    </div>
    <h2 class="m-0 page-title">
      {{ todolists.length > 1 ? "my lists" : "my list" }}
    </h2>
    <div
      v-if="todolists.length > 0 && !loading"
      class="todolist-row h-100 py-5"
      :class="todolists.length == 1 ? 'todolist-1' : ''"
    >
      <div class="todolist" v-for="todolist in todolists" :key="todolist.id">
        <div class="td-title">
          <h5 class="text-center m-0 py-2 text-light">
            {{ todolist.title }}
          </h5>
        </div>
        <form
          @submit.prevent="addTodo(todolist.id)"
          class="td-inputs d-flex align-items-center justify-content-center"
        >
          <input v-model="getTitle" class="px-2" type="text" />
          <button type="submit">
            <i class="fas fa-plus fa-2x"></i>
          </button>
        </form>
        <div>
          <div v-for="item in todolist.todos" :key="item.id" class="todo">
            {{ item.title }}
          </div>

          <div>
            <i class="fas fa-times" @click="cancel(todolist.id)"></i>
          </div>
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
    Nav,
  },

  data() {
    return {
      todolists: [],
      loading: true,
      todo: {
        title: "",
        todolist_id: "",
        user_id: "",
      },
      todolist_ids: []
    };
  },

  

  computed: {
    getTitle: {
      get: function () {
        return "";
      },

      set: function (value) {
        
        this.todo.title = value;
       
      },
    },
  },

  methods: {
    getTodoLists() {
      axios
        .get("http://127.0.0.1:8000/api/todolists")
        .then((res) => {
          this.todolists = res.data;
          console.log("todolists: ", res.data);
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
    addTodo(todolist) {
      axios
        .post(`http://127.0.0.1:8000/api/${todolist}/todos`, this.todo)
        .then(() => {
          console.log("todo added: ", this.todo);
          this.todo = {};
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

