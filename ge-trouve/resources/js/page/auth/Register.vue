<template>
    <v-container fluid class="register-container">
        <v-row align="center" justify="center">
            <v-col cols="12" sm="8" md="6" lg="4">
                <v-card class="elevation-12 register-card">
                    <v-sheet color="primary" dark flat class="register-header">
                        <span class="mx-auto">GE-Trouve</span>
                    </v-sheet>
                    <AlertMessage :message="registerError" type="error" />
                    <v-card-text>
                        <v-form ref="form" lazy-validation>
                            <v-text-field
                                label="Prénom et Nom"
                                v-model="firstname_lastname"
                                required
                                outlined
                                class="register-input"
                            ></v-text-field>
                            <v-text-field
                                label="Email"
                                v-model="email"
                                required
                                outlined
                                class="register-input"
                            ></v-text-field>
                            <v-text-field
                                label="Mot de passe"
                                type="password"
                                v-model="password"
                                required
                                outlined
                                class="register-input"
                            ></v-text-field>
                            <v-text-field
                                label="Vérification du mot de passe"
                                type="password"
                                v-model="password_confirmation"
                                required
                                outlined
                                class="register-input"
                            ></v-text-field>
                            <v-btn color="primary" block class="register-button" @click="register">S'inscrire</v-btn>
                        </v-form>
                        <div class="break-line"></div>
                        <v-btn color="secondary" block class="login-button" @click="goToLogin">Se connecter</v-btn>
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
            registerError: '',
            firstname_lastname: '',
            email: '',
            password: '',
            password_confirmation: '',
        }
    },
    methods: {
        goToLogin() {
            this.$router.push({ name: 'login' });
        },
        register() {
            axios.post('/register', {
                firstname_lastname: this.firstname_lastname,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation,
            }).then(response => {
                this.$router.push({ name: 'login' });
            }).catch(error => {
                this.registerError = error.response.data.message;
            });
        }
    }
}
</script>

<style scoped>
.register-container {
    background: url('/images/background.png') no-repeat center center fixed;
    background-size: cover;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.register-card {
    padding: 20px;
}

.register-header {
    font-size: 24px;
    font-weight: bold;
    text-align: center;
    padding: 20px 0;
}

.register-input {
    margin-bottom: 20px;
}

.register-button {
    margin-top: 20px;
}

.break-line {
    height: 1em;
}
</style>

