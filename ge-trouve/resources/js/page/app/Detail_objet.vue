<template>
    <v-container>
        <h1 class="my-4">Detail des objets perdus :</h1>
        <v-progress-circular v-if="isLoadingLost" indeterminate color="primary"></v-progress-circular>
        <v-row v-else>
            <v-col cols="12" sm="6" md="4" v-if="lostItems.length" v-for="item in lostItems" :key="item.id">
                <v-card>
                    <v-card-title>{{ item.name }}</v-card-title>
                    <v-card-text>
                        <p>Description: {{ item.description }}</p>
                        <p>Date: {{ new Date(item.created_at).toLocaleDateString('fr-FR') }}</p>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn color="primary" @click="openDiscussion(item)">Ouvrir discussion</v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
            <p v-else>Il n'y a pas d'objets perdus à afficher.</p>
        </v-row>

        <h1 class="my-4">Detail des objets trouvés :</h1>
        <v-progress-circular v-if="isLoadingFound" indeterminate color="primary"></v-progress-circular>
        <v-row v-else>
            <v-col cols="12" sm="6" md="4" v-if="foundItems.length" v-for="item in foundItems" :key="item.id">
                <v-card>
                    <v-card-title>{{ item.name }}</v-card-title>
                    <v-card-text>
                        <p>Description: {{ item.description }}</p>
                        <p>Date: {{ new Date(item.created_at).toLocaleDateString('fr-FR') }}</p>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn color="primary" @click="openDiscussion(item)">Ouvrir discussion</v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
            <p v-else>Il n'y a pas d'objets trouvés à afficher.</p>
        </v-row>
    </v-container>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            lostItems: [],
            foundItems: [],
            isLoadingLost: false,
            isLoadingFound: false
        }
    },
    created() {
        this.getLostItems();
        this.getFoundItems();
    },
    methods: {
        getLostItems() {
            this.isLoadingLost = true;
            axios.get('/api/lost-items')
                .then(response => {
                    this.lostItems = response.data;
                })
                .catch(error => {
                    console.error(error);
                })
                .finally(() => {
                    this.isLoadingLost = false;
                });
        },
        getFoundItems() {
            this.isLoadingFound = true;
            axios.get('/api/found-items')
                .then(response => {
                    this.foundItems = response.data;
                })
                .catch(error => {
                    console.error(error);
                })
                .finally(() => {
                    this.isLoadingFound = false;
                });
        },
        openDiscussion(item) {
            this.$router.push({ name: 'discussion', params: { itemId: item.id } });
        }
    }
}
</script>
