<script setup>
import Header from './Header.vue';
import Footer from './Footer.vue';
import { useStore } from '../stores/store.js';

const props = defineProps({
    product: Object
})

const store = useStore();

function addToCart(product){
    store.addToCart(product);
    store.showToast(props.product.id,
    props.product.product_images[0].path,
    props.product.name,props.product.price)
}

function addToFavorites(product){
    store.addToFavorite(product);
    store.showToast(props.product.id,
    props.product.product_images[0].path,
    props.product.name,props.product.price)
}

</script>

<template>
    <Header></Header>

    <div class="flex container mx-auto gap-7 mt-28">
        <div class="flex flex-col w-1/2 rounded-md">
            <div class="h-min bg-white border border-gray-200 p-20 ">
                <img class="" :src="`/storage/${props.product.product_images[0].path}`" />
            </div>
            <div class="flex mt-2 gap-1">
                <div v-for="pro in product.product_images"
                class="flex flex-row justify-between flex-wrap">
                    <img class="p-4 bg-white w-24 border rounded-md
                    transition-all
                    duration-300
                    hover:border
                    hover:border-blue-950"
                    :src="`/storage/${pro.path}`" />
                </div>

            </div>
        </div>
        <!------------------->
        <div class="w-1/2 bg-white p-4">
            <p class="text-4xl font-medium">
              {{product.name}}
            </p>
            <p class="text-2xl gap-2 font-semibold space-x-2 mt-4">
                <span class="text-black">R$ {{ product.from_price }}</span>
                <span class="line-through text-gray-500">R$ {{ product.price }}</span>
            </p>
            <div class="w-max flex nowrap p-3 mt-4 text-sm rounded-lg bg-green-200 text-green-700 font-medium">
                Em estoque
            </div>
            <div class="mt-5 text-lg text-gray-600">
                {{ product.description }}
            </div>
            <div class="flex justify-center gap-4 mt-6 ">
                <button @click="addToCart(product.id)" class="flex justify-center items-center py-3 gap-2 w-full
                bg-blue-800 hover:bg-blue-600 border-blue-300
                rounded-md
                text-white
                font-medium">
                    <ion-icon name="cart-outline" className=" text-2xl"></ion-icon>
                    <span class="">Add to Cart</span>
                </button>
                <button @click="addToFavorites(product.id)" class="flex flex-shrink-0 p-3 border  
                bg-blue-800 hover:bg-blue-600 rounded-md">
                    <ion-icon name="heart-outline" className="text-white text-2xl"></ion-icon>
                </button>
            </div>
            <div class="mt-7 text-sm font-medium border-b pb-5 border-gray-300">
                <div>
                    <p>43″ Class TU7000 Series Crystal UHD 4K Smart TV: Characteristics</p>
                </div>
            </div>
            <div class="flex gap-5 mt-7 flex-wrap text-sm justify-between
            border-b pb-5
            border-gray-300">
                <div class="flex items-center gap-1">
                    <ion-icon name="flash-outline" class="text-xl"></ion-icon>
                    <span>
                        Entrega Fast
                    </span>
                </div>
                <div class="flex items-center gap-1">
                    <ion-icon name="repeat-outline" class="text-xl"></ion-icon>
                    <span>
                        Devolução
                    </span>
                </div>
                <div class="flex items-center gap-1">
                    <ion-icon name="information-circle-outline" class="text-xl"></ion-icon>
                    <span>
                        Faça uma pergunta
                    </span>
                </div>
                <div class="flex items-center gap-1">
                    <ion-icon name="share-social-outline" class="text-xl"></ion-icon>
                    <span>
                        Compartilhe
                    </span>
                </div>

            </div>
            <div class="flex gap-4 mt-5">
                <div class="flex flex-col rounded-md border border-gray-300 py-3 px-3 items-center bg-white
                hover:border hover:border-blue-950
                transition-all duration-300">
                    <span class="font-semibold">Free Shipping</span>
                    <span class="text-sm text-gray-500">Free shipping over order $120</span>
                </div>
                <div class="flex flex-col rounded-md border border-gray-300 py-3 px-3 items-center bg-white
                hover:border hover:border-blue-950
                transition-all duration-300">
                    <span class="font-semibold">Flexibe Payment</span>
                    <span class="text-sm text-gray-500">Free shipping over order $120</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container mx-auto mt-10 mb-20">
        <div class="flex flex-row flex-wrap
        gap-4
        text-sm
        w-max
        rounded-lg">
            <div class="py-4 px-5
            hover:text-rose-600
            ">Descrição</div>
            <div class="py-4 px-5
            hover:text-rose-600
            ">Informações Adicionais</div>
            <div class="py-4 px-5
            hover:text-rose-600
            ">Reviews</div>
            <div class="py-4 px-5
            hover:text-rose-600
            ">Participantes</div>
        </div>
        <div class="text-sm mt-5 text-gray-500 w-1/2">
           {{ product.description }}
        </div>
    </div>

    <Footer></Footer>
</template>
