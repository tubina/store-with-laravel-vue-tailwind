<script setup>
import Header from './Header.vue';
import Footer from './Footer.vue';
import { useStore } from '../stores/store.js';
import { ref } from 'vue';

const props = defineProps({
    product: Object
})

const mainImage = ref(
    `/storage/${props.product.product_images[0].path}`
);
setTimeout(()=>{
 //console.log(mainImage.value)
},1000)

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

function changeImage(imagePath){
    mainImage.value = `/storage/${imagePath}`
}

function changeImageCel(imagePath) {
    mainImage.value = `/storage/${imagePath}`
}
</script>

<template>
    <Header></Header>

    <div class="sm:flex sm:w-[80%] p-2 mx-auto gap-7 sm:mt-28 mt-20">
        <div class="flex flex-col sm:w-1/2 rounded-md">
            <div class="h-min bg-white border rounded-md border-gray-200 sm:p-20 p-6 ">
                <img :src="mainImage" />
            </div>
            <div class="flex mt-2 gap-1">
                <div v-for="pro in product.product_images"
                class="flex flex-row justify-between flex-wrap">
                    <img class="lg:p-4 
                    bg-white 
                    sm:w-24 w-12
                    sm:p-10 
                    p-0
                    object-cover
                    sm:ob
                    border rounded-md
                    transition-all
                    duration-300
                    hover:border
                    hover:border-blue-950"
                    :src="`/storage/${pro.path}`" 
                    @mouseenter="changeImage(pro.path)"
                    @click="changeImageCel(pro.path)"/>
                </div> 
            </div>
        </div>
        <!------------------->
        <div class="sm:w-1/2 bg-white sm:px-4 sm:mb-5 mb-4 mt-3 sm:mt-0">
            <p class="sm:text-4xl sm:font-medium text-2xl">
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
            <div class="flex justify-center sm:gap-4 gap-1 mt-6">
                <button @click="addToCart(product.id)" class="flex justify-center items-center py-3 gap-2 w-full
                bg-black hover:bg-gray-700 border-blue-300 rounded-md text-white font-medium">
                    <ion-icon name="cart-outline" className=" text-2xl"></ion-icon>
                    <span class="">Add to Cart</span>
                </button>
                <button @click="addToFavorites(product.id)" class="flex flex-shrink-0 p-3 border  
                bg-black hover:bg-gray-700 rounded-md">
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
    <div class="sm:w-[80%] p-2 sm:p-0 mx-auto sm:mt-10 mt-0 mb-20 ">
        <div class="flex flex-row flex-wrap gap-4 text-sm rounded-lg">
            <div class="sm:py-4 sm:px-5 py-0
            hover:text-rose-600
            ">Descrição</div>
            <div class="sm:py-4 sm:px-5 py-0
            hover:text-rose-600
            ">Informações Adicionais</div>
            <div class="sm:py-4 sm:px-5
            hover:text-rose-600
            ">Reviews</div>
            <div class="sm:py-4 sm:px-5"
            hover:text-rose-600
            ">Participantes</div>
        </div>
        <div class="text-sm mt-5 text-gray-500 sm:w-1/2">
           {{ product.description }}
        </div>
    </div>

    <Footer></Footer>
</template>
