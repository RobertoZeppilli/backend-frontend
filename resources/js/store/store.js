import Vue from 'vue';
import Vuex from 'vuex';
import auth from './auth';
import todolist from './todolist';


Vue.use(Vuex)

export default new Vuex.Store({
    state: {

    },

    getters: {

    },

    mutations: {

    },

    actions: {

    },

    modules: {
        auth,
        todolist
    }
})