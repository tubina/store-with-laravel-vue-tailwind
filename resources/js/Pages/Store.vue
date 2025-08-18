<script setup>
import Header from './Header.vue';
import Card from './Card.vue';
import { defineProps, onMounted } from 'vue';
import Footer from './Footer.vue';

const props = defineProps({
    products: Array
});

</script>

<template>
    <Header></Header>

    <div class="container__own mt-28 flex mx-auto ">
        <div class="nav__left  w-64 h-min p-6 border-gray-200
        border-t">
            <div class="font-semibold text-base">
                Product Categories
            </div>
            <ul class="flex flex-col gap-2 font-normal text-sm mt-2">
                <li><a href="#" class="hover:underline">Acessórios</a></li>
                <li><a href="#" class="hover:underline">Eletrônicos</a></li>
                <li><a href="#" class="hover:underline">Câmeras</a></li>
            </ul>
        </div>

        <div class="grid grid-cols-4 w-full gap-3 flex-grow-1 flex-wrap border-l pl-5 border-gray-200
        border-t">
            <div v-for="product in props.products" :id="product.id">
                <Card :product="product" />
            </div>
        </div>
    </div>

<Footer class="mt-20"/>

</template>
