<script setup>
import Header from './Header.vue';
import Favorite from '../MyComponents/Favorite.vue'
import Footer from './Footer.vue';

    defineProps({
        name: String
    })
</script>

<template>
    <div>
        <Header />

        <div class="mb-32">
            <Favorite />
        </div>

        <Footer />
    </div>
</template>
