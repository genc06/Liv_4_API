<template>
    <div>
        <h1>Discussion</h1>
        <div v-if="isLoading">Chargement...</div> <!-- Écran de chargement -->
        <v-list two-line>
            <v-list-item v-for="message in sortedMessages" :key="message.id">
                <v-list-item-content>
                    <v-list-item-title>{{ message.user }}:</v-list-item-title>
                    <v-list-item-subtitle>{{ message.content }}</v-list-item-subtitle>
                </v-list-item-content>
            </v-list-item>
        </v-list>
        <v-text-field v-model="newMessage" label="Nouveau message"></v-text-field>
        <v-btn @click="sendMessage">Envoyer</v-btn>
    </div>
</template>

<script>
import axios from "axios";
import {authStore} from "@/stores/authstore.js";

const useAuth = authStore();

export default {
    data() {
        return {
            messages: [],
            newMessage: '',
            isLoading: false
        };
    },
    props: ['itemId'],
    created() {
        this.isLoading = true;
        axios.get(`/api/messages/${this.itemId}`)
            .then(response => {
                this.messages = response.data.map(message => ({
                    id: message.id,
                    user: message.user.firstname_lastname, // Assuming the user object has firstname and lastname properties
                    content: message.content,
                    date: new Date(message.created_at)
                }));
                this.isLoading = false;
            })
            .catch(error => {
                console.error(error);
                this.isLoading = false;
            });
    },
    computed: {
        sortedMessages() {
            // Trie les messages par date, du plus ancien au plus récent.
            return this.messages.sort((a, b) => a.date - b.date);
        }
    },
    methods: {
        sendMessage() {
            let message = this.newMessage;
            let itemId = this.itemId;
            axios.post('/api/messages', {
                content: message,
                user_id: useAuth.user.id,
                item_id: itemId
            }).then(response => {
                this.messages.push({
                    id: response.data.id,
                    user: useAuth.user.firstname_lastname,
                    content: message,
                    date: new Date()
                });
                this.newMessage = '';
                console.log(response.data);
            }).catch(error => {
                console.error(error);
            });
        }
    }
}
</script>
