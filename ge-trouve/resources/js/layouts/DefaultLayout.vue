<template>
    <v-app id="inspire">
        <v-app-bar app clipped-left hide-on-scroll>
            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
            <v-toolbar-title>GE-Trouve</v-toolbar-title>
        </v-app-bar>

        <v-navigation-drawer
            v-model="drawer"
            app
            class="pt-4"
            color="grey-lighten-3"
        >
            <v-col class="d-block text-center mx-auto mb-9">
                <v-avatar class="avatar-large" image="https://i.pinimg.com/236x/b6/f1/f3/b6f1f329f978fb11a612c1e271242852.jpg"></v-avatar>
                <div class="user-name mt-3" v-if="useAuth.user">
                    {{ useAuth.user.firstname_lastname }}
                </div>
                <div class="user-name mt-3" v-else>Déconnecté</div>
            </v-col>
            <v-list>
                <template v-for="(category, index) in categories" :key="`category-${index}`">
                    <v-list-item @click="toggleCategory(index)">
                        <v-list-item-title>{{ category.name }}</v-list-item-title>
                    </v-list-item>
                    <v-list-item
                        v-for="({ text, route, icon, action }, index) in links.filter(link => link.category === category.name)"
                        :key="index"
                        :to="route && { name: route}"
                        :prepend-icon="icon"
                        @click="action && action()"
                        v-show="category.isOpen"
                    >
                        {{ text }}
                    </v-list-item>
                    <v-divider v-if="index < categories.length - 1"></v-divider>
                </template>
            </v-list>
        </v-navigation-drawer>

        <v-main>
            <slot />
        </v-main>
    </v-app>
</template>

<script setup>
import {onMounted, ref} from "vue";
import {authStore} from "@/stores/authStore";
import {useRouter} from "vue-router";

const useAuth = authStore();
const router = useRouter();

const links = ref([
    {text: "Map", route: "map", icon: "mdi-map", category: "Général"},
    {text: "Details Objets", route: "detail_objet", icon: "mdi-book-open-variant", category: "Général"},
    {text: "A propos", route: "about", icon: "mdi-help-circle", category: "Général"},
    {text: "Se déconnecter", icon: "mdi-logout", action: logout, category: "Général"},
]);

const categories = ref([
    { name: "Général", isOpen: true },
]);

if (useAuth.user && useAuth.user.role === "Administrator") {
    links.value.push({
        text: "Admin",
        route: "admin",
        icon: "mdi-account-cog",
        category: "Admin",
    });

    categories.value.push({ name: "Admin", isOpen: true });
}

function toggleCategory(index) {
    categories.value[index].isOpen = !categories.value[index].isOpen;
}

const drawer = ref(false);

onMounted(async () => {
    await useAuth.getUser();
});

async function logout() {
    await useAuth.logout();
    await router.push({name: 'login'});
}
</script>

<style scoped>
.avatar-large {
    width: 60px !important;
    height: 60px !important;
}

.user-name {
    margin-top: 10px;
}
</style>
