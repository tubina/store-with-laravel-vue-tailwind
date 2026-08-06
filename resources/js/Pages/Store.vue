<script setup>
import Header from './Header.vue';
import Card from './Card.vue';
import { defineProps } from 'vue';
import Footer from './Footer.vue';

const props = defineProps({
    products: Array
});

</script>

<template>
    <Header></Header>

     <div class="mt-24">
            Banner
        </div>

    <div class="flex mx-auto max-w-7xl px-10 mt-28 ">
        <div class="nav__left  w-64 h-min pt-6">
            <div class="font-semibold text-base">
                Product Categories
            </div>
            <ul class="flex flex-col gap-2 font-normal text-sm mt-2">
                <li><a href="#" class="hover:underline">Acessórios</a></li>
                <li><a href="#" class="hover:underline">Eletrônicos</a></li>
                <li><a href="#" class="hover:underline">Câmeras</a></li>
            </ul>
        </div> 

        <div class="grid grid-cols-3 w-full gap-3 flex-grow-1 flex-wrap pl-5">
            <div v-for="product in props.products" :id="product.id">
                <Card :product="product" />
            </div>
        </div>
    </div>

<Footer class="mt-20"/>

</template>
