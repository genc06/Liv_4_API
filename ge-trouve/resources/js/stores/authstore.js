import { defineStore } from "pinia";
import axios from 'axios';

export const authStore = defineStore('auth', {
    state: () => ({
        authUser: null
    }),

    getters: {
        user: (state) => state.authUser,
    },

    actions: {
        async getToken(){
            try {
                await axios.get('/sanctum/csrf-cookie');
            } catch (error) {
                console.error('Error getting CSRF cookie:', error);
            }
        },

        async getUser(){
            try {
                const response = await axios.get('/api/user');
                this.authUser = response.data;
            } catch (error) {
                console.error('Error getting user:', error);
            }
        },

        async logout() {
            try {
                await axios.post('/logout');
                this.authUser = null;
            } catch (error) {
                console.error('Error logging out:', error);
            }
        }
    }
});
