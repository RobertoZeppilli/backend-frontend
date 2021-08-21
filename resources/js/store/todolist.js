import axios from 'axios';

axios.defaults.withCredentials = true;

export default {
    namespaced: true,

    state: {
        newTodolist: null,
    },

    actions: {
      async createTodolist({commit}, newtodo) {
        await axios.post('http://127.0.0.1:8000/api/todolists', newtodo)
            .then( res => {
                console.log(res.data)
                commit('SET_TODOLIST', res.data)
            })
            .catch( err => {
                console.error(err)
            })
        },


    },

    mutations: {
        SET_TODOLIST(state, newtodo) {
            state.newTodolist = newtodo 
        }
    },

    getters: {

    }
}