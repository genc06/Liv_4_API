<template>
    <v-alert v-if="message" :type="type">{{ message }}</v-alert>
</template>

<script>
export default {
    props: {
        message: {
            type: String,
            default: ''
        },
        type: {
            type: String,
            default: 'erreur'
        }
    }
}
</script>
