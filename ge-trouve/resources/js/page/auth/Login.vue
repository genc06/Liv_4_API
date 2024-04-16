<template>
    <v-container fluid class="login-container">
        <v-row align="center" justify="center">
            <v-col cols="12" sm="8" md="6" lg="4">
                <v-card class="elevation-12 login-card">
                    <v-sheet color="primary" dark flat class="login-header">
                        <span class="mx-auto">GE-Trouve</span>
                    </v-sheet>
                    <AlertMessage :message="loginError" type="error" />
                    <v-card-text>
                        <v-form ref="form" lazy-validation>
                            <v-text-field
                                label="Email"
                                v-model="email"
                                required
                                outlined
                                class="login-input"
                            ></v-text-field>
                            <v-text-field
                                label="Mot de passe"
                                type="password"
                                v-model="password"
                                required
                                outlined
                                class="login-input"
                            ></v-text-field>
                            <v-btn color="primary" block class="login-button" @click="login">Se connecter</v-btn>
                        </v-form>
                        <div class="break-line"></div>
                        <v-btn color="secondary" block class="register-button" @click="goToRegister">S'inscrire</v-btn>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import AlertMessage from "@/components/AlertMessage.vue";
import axios from "axios";

export default {
    components: {
        AlertMessage
    },
    data() {
        return {
            loginError: '',
            email: '',
            password: '',
        }
    },
    methods: {
        goToRegister() {
            this.$router.push({ name: 'register' });
        },
        login() {
            axios.post('/login', {
                email: this.email,
                password: this.password,
            }).then(response => {
                this.$router.push({ name: 'map' });
            }).catch(error => {
                this.loginError = error.response.data.message;
            });
        }
    }
}
</script>

<style scoped>
.login-container {
    background: url('/images/background.png') no-repeat center center fixed;
    background-size: cover;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.login-card {
    padding: 20px;
}

.login-header {
    font-size: 24px;
    font-weight: bold;
    text-align: center;
    padding: 20px 0;
}

.login-input {
    margin-bottom: 20px;
}

.login-button {
    margin-top: 20px;
}

.break-line {
    height: 1em;
}
</style>
