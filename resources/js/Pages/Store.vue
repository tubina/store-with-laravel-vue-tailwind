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

     
    <div class="mx-auto max-w-7xl px-2 mt-28 sm:mt-20">

        <div class="pt-3">
            <div class="uppercase text-4xl title__font__family">Toda a Loja</div>
            <p class="w-[70%] text-gray-500">Produtos comprados com o lucro dos nossos investimentos e devolvidos à comunidade em forma de leilão. <br>
                Escolha uma categoria e entre na disputa.</p>
        </div>

        <div class="flex">
            <div class="w-56 h-min mt-6 ">
                <div class="font-semibold text-base">
                    Categorias
                </div>
                <ul class="flex flex-col gap-2 font-normal text-sm mt-2">
                    <li><a href="#" class="hover:underline">Acessórios</a></li>
                    <li><a href="#" class="hover:underline">Eletrônicos</a></li>
                    <li><a href="#" class="hover:underline">Câmeras</a></li>
                </ul>
            </div> 

            <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 w-full gap-3 flex-grow-1 flex-wrap pl-5 mt-6 ">
                <div v-for="product in props.products" :id="product.id">
                    <Card :product="product" class="" />
                </div>
            </div>
        </div>
    </div>

<Footer class="mt-20"/>

</template>
