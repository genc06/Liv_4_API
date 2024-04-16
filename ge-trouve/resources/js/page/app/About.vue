<!-- Apropos.vue -->

<template>

    <div class="about">
        <div id="logo_geTrouve">
            <img src="/public/logo.png" alt="GE-Trouve">
        </div>
        <h1>À Propos de GE-Trouve</h1>
        <div class="description">
            <p>La fonctionnalité en développement GE-Trouve représente une solution novatrice destinée à améliorer la gestion des objets trouvés dans la ville de Genève. Son objectif principal consiste à offrir aux résidents et aux visiteurs un outil pratique et efficace pour retrouver leurs biens égarés.</p>
            <br>
            <p>En facilitant le processus de signalement des objets perdus, en mettant à disposition une base de données régulièrement mise à jour des objets retrouvés, et en simplifiant la procédure de restitution, GE-Trouve aspire à simplifier et à rationaliser l'ensemble du processus de recherche et de récupération des biens perdus.</p>
            <br>
            <p>Cette initiative a pour vocation de contribuer à une expérience citoyenne plus fluide et satisfaisante à Genève, en permettant aux habitants et aux visiteurs de retrouver leurs biens perdus de manière plus rapide et efficace. En résumé, GE-Trouve ambitionne de jouer un rôle central dans l'amélioration des services de gestion des objets trouvés</p>
        </div>

        <h2>Objectifs</h2>
        <ul>
            <li>Centraliser les informations sur les objets perdus et trouvés à Genève.</li>
            <li>Faciliter la recherche et la réclamation des objets perdus.</li>
            <li>Promouvoir la collaboration entre les services des objets trouvés et la communauté de la ville.</li>
        </ul>


    </div>

    <div class="contact-info">
        <p>Téléphone: +4122 546 40 50</p>
        <p>Adresse: Chemin du Domaine-Patry 1, 1224 Chêne-Bougeries</p>
    </div>
</template>


<script>
export default {
    name: 'A propos'
}
</script>

    <!-- existing code -->





<style scoped>
.about {
    max-width: 800px;
    margin: auto;
    padding: 20px;
}
.description {
    text-align: justify; /* Justifier le texte */
    line-height: 1.5; /* Ajouter une interligne */
    max-width: 800px; /* Limiter la largeur pour une meilleure lisibilité */
    margin: auto; /* Centrer horizontalement */
    padding: 20px; /* Ajouter un espace intérieur */
}
.about h1,
.about h2 {
    margin-top: 30px;
}

.about ul {
    margin-top: 10px;
    margin-bottom: 20px;
}

.about li {
    margin-bottom: 10px;
}

#logo_geTrouve {
    display: block;
    margin: 0 auto;
    width: 100%;
}
.contact-info {
    margin-top: 30px;
    text-align: center;
}
</style>
