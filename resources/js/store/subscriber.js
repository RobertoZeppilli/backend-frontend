import store from './store';
import axios from 'axios';

store.subscribe((mutation) => {

    // accertarsi che negli headers ci sia sempre Authorization: Bearer
    switch (mutation.type) {
        case 'auth/SET_TOKEN':
            if (mutation.payload) {
                axios.defaults.headers.common['Authorization'] = `Bearer ${mutation.payload}`
                localStorage.setItem('token', mutation.payload)
            } else {
                axios.defaults.headers.common['Authorization'] = null
                localStorage.removeItem('token')
            }

            break;
    }
})

