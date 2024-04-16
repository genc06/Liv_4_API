<template>
    <div class="container">
        <div
            class="rotating-icon"
            v-for="(image, index) in images"
            :key="index"
            :style="{ backgroundImage: `url(${image.url})`, top: `${image.top}%`, left: `${image.left}%` }"
        ></div>
        <h1 class="title">Bienvenue</h1>
        <p class="subtitle">GE-Trouve vous permet de trouver des objets perdus ou en annoncer!</p>
        <div class="buttons">
            <button @click="goToLogin" class="btn">Se connecter</button>
            <button @click="goToRegister" class="btn">S'inscrire</button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            images: [
                { url: '/images/items/bague.png', top: 10, left: 20 },
                { url: '/images/items/ballon.png', top: 30, left: 40 },
                { url: '/images/items/bonnet.png', top: 80, left: 20 },
                { url: '/images/items/carte.png', top: 80, left: 40 },
                { url: '/images/items/casque.png', top: 30, left: 10 },
                { url: '/images/items/chaussure.png', top: 60, left: 70 },
                { url: '/images/items/cle.png', top: 30, left: 50 },
                { url: '/images/items/vetement.png', top: 70, left: 60 },
                { url: '/images/items/gameboy.png', top: 10, left: 40 },
                { url: '/images/items/gourde.png', top: 70, left: 10 },
                { url: '/images/items/horloge.png', top: 30, left: 60 },
                { url: '/images/items/lunette.png', top: 70, left: 40 },
                { url: '/images/items/parapluie.png', top: 10, left: 50 },
                { url: '/images/items/pc.png', top: 10, left: 70 },
                { url: '/images/items/sac.png', top: 30, left: 70 },
            ]
        };
    },
    methods: {
        goToRegister() {
            this.$router.push({ name: 'register' });
        },
        goToLogin() {
            this.$router.push({ name: 'login' });
        }
    }
}
</script>

<style scoped>
.container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    animation: gradient 3s ease-in-out infinite;
}

.title, .subtitle {
    text-align: center;
    animation: fadeIn 2s ease-in-out;
}

.buttons {
    margin-top: 20px;
}

.btn {
    margin: 0 10px;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    background-color: #4b79a1;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #8ebece;
}

@keyframes gradient {
    0% {background-position: 0% 50%;}
    50% {background-position: 100% 50%;}
    100% {background-position: 0% 50%;}
}

@keyframes fadeIn {
    0% {opacity: 0;}
    100% {opacity: 1;}
}

.rotating-icon {
    mix-blend-mode: color-burn;
    position: absolute;
    width: 90px;
    height: 90px;
    animation: rotate 5s linear infinite;
}

@keyframes rotate {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}
</style>
