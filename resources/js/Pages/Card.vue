<script setup>
import {Link} from '@inertiajs/vue3';
import { computed, defineProps, ref } from 'vue';
import { useStore } from '../stores/store.js';
import { verifyLogin } from '@/utils/verifyLogin.js';
import { formatPrice } from '../utils/formatPrice.js'

const { product } = defineProps({
    product: Object
});

const isFav = ref(product.product_has_favorite != null); 
const TrueconfFav = ['bg-gray-700', 'text-white'];
const FalseconfFav = ['bg-white', 'text-black']; 

let imagem = ''
const id = product?.id ?? '';
const name = product?.name ?? '';
const categoryName = product?.category?.name ?? '';
const from_price = product?.from_price ?? 0;
const price = product?.price ?? 0;
const description = product?.description ?? '';
if(product.product_images_just_one){
    if(product.product_images_just_one.path){
        imagem = product?.product_images_just_one.path ?? '';
    }
}

function firstFiveWords(text) {
  if (!text) return '';
  return text.split(' ').slice(0, 7).join(' ');
}
/***************************************************/
const store = useStore();

function addToCart(product){
    store.addToCart(product);
    store.showToast(id,imagem,name,price)
}
 
function addToFavorites(product){
    if(!isFav.value){
        store.addToFavorite(product);
        store.showToast(id,imagem,name,price)
        isFav.value = !isFav.value;
        console.log('inserido')
    }else{
        isFav.value = !isFav.value;
        removeToFavorites(product) 
    } 
} 
function removeToFavorites(product){
    store.deleteFromFavorite(product)
}

</script>

<template>
     <div class="flex flex-1 mt-4 relative pb-3 flex-col justify-between border 
     border-gray-200 rounded-md bg-white">

        <div :class="isFav ? TrueconfFav : FalseconfFav"
        class="absolute m-2 left-0 flex items-center p-1 hover:border-black 
        text-xl border border-gray-300 rounded-full" 
        @click.prevent="addToFavorites(product.id)">
            <ion-icon name="flame"></ion-icon> 
        </div>

        <div :class="isFav ? TrueconfFav : FalseconfFav"
        class="absolute m-2 right-0 flex items-center p-1 text-black hover:border-black 
        text-xl border border-gray-300 rounded-full "
        @click.prevent="[addToFavorites(product.id), buttonFavorite]"> 
             <!-- <ion-icon name="heart-outline"></ion-icon> -->
             <ion-icon name="heart"></ion-icon>
        </div>

        <div className="flex justify-center w-full p-7">
            <Link :href="`/product/${id}`" >
                <img  class="w-full h-56 object-cover" :src="imagem ? `/storage/${imagem}` : '/storage/products/uHUdvGKB8XIIK242LvklAnKEEGS2VRezFLJRl8SQ.jpg'" />
            </Link>
        </div>
        <div class="text-gray-400 text-xs mt-1 ml-3 uppercase">
            {{ categoryName }}
        </div>
        <p className="mt-1 ml-3 mr-3 font-bold text-sm h-10 text-wrap text-gray-900">
           {{firstFiveWords(name)}}
        </p>
        <div class=" ml-3 flex items-center mt-2">
            <ion-icon name="star" class="star"></ion-icon>
            <ion-icon name="star" class="star"></ion-icon>
            <ion-icon name="star" class="star"></ion-icon>
            <ion-icon name="star" class="star"></ion-icon>
            <ion-icon name="star" class="star"></ion-icon>
            <span className="text-gray-400 text-xs ml-1">(450)</span>
        </div>
        <div class="flex flex-col ml-3 mt-2 ">
            <div class="text-xs text-gray-500">
                R$ {{ formatPrice(price) }} em 4x sem juros
            </div>
            <div class="flex gap-2 items-center mt-1 h-10 ">
                <span className="text-md text-black font-semibold">R${{ formatPrice(price) }}</span>
                <span className="line-through text-sm font-normal text-gray-500 ">R$ {{ formatPrice(from_price) }}</span>
            </div>
        </div>
        <button @click.prevent="addToCart(product.id)" class="mx-auto w-auto
            flex
            justify-center
            items-center
            gap-2
            text-center
            bg-black
            hover:bg-gray-700
            text-white
            py-2
            mt-2
            ml-3
            mr-3 border
            rounded-md
            font-semibold
            ring-1
            ring-gray-700">
            <ion-icon name="cart-outline" class="text-xl"></ion-icon>
            <span class="text-sm">Add To Cart</span>
        </button>
    </div>
</template>
