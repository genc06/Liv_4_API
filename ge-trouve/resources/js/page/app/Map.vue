<template>
    <div>
        <div id="map" style="height:100vh; width:100vw;"></div>
    </div>
</template>
<script setup>
import { onMounted, ref } from 'vue';
import "leaflet/dist/leaflet.css";
import * as L from 'leaflet';
import Swal from 'sweetalert2'
import axios from 'axios';
import { authStore } from "@/stores/authstore.js";

const useAuth = authStore();

let items = ref([]);

onMounted(async () => {
    let map = L.map('map').setView([46.2044, 6.1432], 12);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    map.locate({ setView: true, maxZoom: 16 });


    map.on('locationfound', function (e) {

        let imHere = L.icon({
            iconUrl: '/images/im_here.png',
            iconSize: [30, 48], // taille réduite de l'icône
            shadowSize: [50, 64], // taille de l'ombre
            iconAnchor: [11, 47], // point de l'icône qui correspondra à l'emplacement du marqueur
            shadowAnchor: [4, 62],  // pareil pour l'ombre
            popupAnchor: [0, -38] // point à partir duquel la popup doit s'ouvrir par rapport à iconAnchor
        });

        L.marker([e.latitude, e.longitude], { icon: imHere })
            .addTo(map)
            .bindPopup("Vous êtes ici")
    });

    try {
        let response = await axios.get('/api/items');
        items.value = response.data;
    } catch (error) {
        console.error(error);
    }

    items.value.forEach(item => {
        let popupContent;
        let buttonText;
        if (item.type === 'Objet trouvé') {
            popupContent = `${item.type} : ${item.name}`;
            buttonText = "C'est mon objet";
        } else if (item.type === 'Objet perdu') {
            popupContent = `${item.type} : ${item.name}`;
            buttonText = "J'ai trouvé cet objet";
        }

        popupContent += `<br><button id="chat-button-${item.id}" style="color: green !important;">${buttonText}</button>`;

        let iconUrl;
        if (item.type === 'Objet trouvé') {
            iconUrl = '/images/info.png';
        } else if (item.type === 'Objet perdu') {
            iconUrl = '/images/information.png';
        }

        let icon = L.icon({
            iconUrl: iconUrl,
            iconSize: [30, 48],
            shadowSize: [50, 64],
            iconAnchor: [15, 47],
            shadowAnchor: [4, 62],
            popupAnchor: [0, -38]
        });

        let marker = L.marker([item.latitude, item.longitude], { icon: icon })
            .addTo(map)
            .bindPopup(popupContent);

        marker.on('popupopen', () => {
            let chatButton = document.getElementById(`chat-button-${item.id}`);
            chatButton.addEventListener('click', () => {
                Swal.fire({
                    title: 'Entrez votre message',
                    input: 'text',
                    inputLabel: 'Message',
                    inputPlaceholder: 'Entrez votre message...',
                    showCancelButton: true,
                    inputValidator: (value) => {
                        if (!value) {
                            return 'Vous devez écrire un message';
                        }
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        let message = result.value;
                        let itemId = item.id;
                        axios.post('/api/messages', {
                            content: message,
                            user_id: useAuth.user.id,
                            item_id: itemId
                        }).then(response => {
                            console.log(response.data);
                        }).catch(error => {
                            console.error(error);
                        });
                    }
                });
            });
        });
    });

    // Add a click event handler to the map
    map.on('click', function (e) {
        Swal.fire({
            title: 'Que voulez-vous faire?',
            showDenyButton: true,
            confirmButtonText: `Signaler un objet perdu`,
            denyButtonText: `Faire une annonce d'un objet trouvé`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            let objectType = result.isConfirmed ? "Objet perdu" : "Objet trouvé";
            if (result.isConfirmed || result.isDenied) {
                Swal.fire({
                    title: 'Entrez les détails de l\'objet',
                    html:
                        '<input id="swal-input1" class="swal2-input" placeholder="Nom de l\'objet">' +
                        '<input id="swal-input2" class="swal2-input" placeholder="Description de l\'objet">',
                    focusConfirm: false,
                    preConfirm: () => {
                        let name = document.getElementById('swal-input1').value;
                        let description = document.getElementById('swal-input2').value;
                        if (!name || !description) {
                            Swal.showValidationMessage(`Veuillez remplir tous les champs`);
                        } else {
                            return [name, description];
                        }
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        let popupContent = `${objectType} : ${result.value[0]}`;

                        let iconUrl;
                        if (objectType === 'Objet trouvé') {
                            iconUrl = '/images/info.png';
                        } else if (objectType === 'Objet perdu') {
                            iconUrl = '/images/information.png';
                        }

                        let icon = L.icon({
                            iconUrl: iconUrl,
                            iconSize: [30, 48],
                            shadowSize: [50, 64],
                            iconAnchor: [15, 47],
                            shadowAnchor: [4, 62],
                            popupAnchor: [0, -38]
                        });

                        L.marker([e.latlng.lat, e.latlng.lng], { icon: icon })
                            .addTo(map)
                            .bindPopup(popupContent)

                        // Ajouter l'objet à la base de données
                        let name = result.value[0];
                        let description = result.value[1];
                        let type = objectType;
                        let latitude = e.latlng.lat;
                        let longitude = e.latlng.lng;
                        axios.post('/api/items', {
                            name: name,
                            description: description,
                            type: type,
                            latitude: latitude,
                            longitude: longitude
                        }).then(response => {
                            console.log(response.data);
                        }).catch(error => {
                            console.error(error);
                        });
                    }
                });
            }
        })
    });
});
</script>
