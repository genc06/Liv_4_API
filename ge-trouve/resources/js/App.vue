<template>
    <component :is="layout">
        <router-view />
    </component>
</template>

<script setup>
import DefaultLayout from "./layouts/DefaultLayout.vue";
import { useRoute } from 'vue-router';
import {computed} from "vue";

const route = useRoute();

const layout = computed(() => {
    return route.path.startsWith('/app') ? DefaultLayout : { template: '<div><router-view/></div>' };
});
</script>
