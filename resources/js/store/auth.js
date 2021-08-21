import axios from 'axios';
import { attempt } from 'lodash';

export default {
    namespaced: true,
    state: {
        token: null,
        form: null
    },

    getters: {
        authenticated(state) {
            return state.token && state.form
        },

        user(state) {
            return state.form
        }
    },

    mutations: {
        SET_TOKEN(state, token) {
            state.token = token
        },

        SET_USER(state, data) {
            state.form = data
        },

    },

    actions: {
        async login({ dispatch }, credentials) {
            
            await axios.post('http://127.0.0.1:8000/api/login', credentials).then(res => {
                if (res.data.success) {
                    console.log(res.data)

                    // controllo se il token è buono
                    return dispatch('attempt', res.data.token)
                }
            }).catch(err => {
                console.log(err)
            })
        },

        async attempt({ commit, state }, token) {

            // blocco in caso ci fosse o meno il token
            // se c'è il token 
            if (token) {
                commit('SET_TOKEN', token)
            }

            // se non c'è
            if(!state.token) {
                return
            }
            // /blocco in caso ci fosse o meno il token

            // provo a gettare l'user 
            try {
                await axios.get('http://127.0.0.1:8000/api/user')
                    .then(res => {
                        commit('SET_USER', res.data)
                    })
            } catch (e) {
                commit('SET_TOKEN', null)
                commit('SET_USER', null)
            }
        },

        async register({ }, credentials) {
            await axios.post('http://127.0.0.1:8000/api/register', credentials).then(res => {
            }).catch(err => {
                console.log(err)
            })
        },

        logoutAction({ commit }) {
            return axios.post('http://127.0.0.1:8000/api/logout')
                .then( () => {
                    commit('SET_TOKEN', null)
                    commit('SET_USER', null)
                })
        },

        
    }
}

