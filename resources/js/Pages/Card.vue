<script setup>
import {Link} from '@inertiajs/vue3';
import { defineProps, ref } from 'vue';
import { useStore } from '../stores/store.js';
import { verifyLogin } from '@/utils/verifyLogin.js';
import { formatPrice } from '../utils/formatPrice.js'
//import Tooltip from '@/Components/Tooltip.vue'

const { product } = defineProps({
    product: Object
});

const isFav = ref(product.product_has_favorite != null); 
const TrueconfFav = ['bg-white', 'text-red-600'];
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
     <div class="flex flex-1 relative pb-3 flex-col justify-between border 
     border-gray-200 rounded-xl bg-white shadow-sm">

        <div class="flex items-center justify-between px-3 my-4 ">

            <div class="font-semibold text-red-500">
                <div class="flex items-center gap-1 bg-red-100 rounded-lg px-3 py-1">
                    <div class="w-2 h-2 bg-red-500 border rounded-full animate-blink"></div>
                    <div class="text-xs">AO VIVO</div>
                </div>
            </div>
    

            <div class="flex items-center text-xl gap-1">
                <ion-icon name="flame" class="text-sm text-gray-500"></ion-icon>
                <div class="text-sm text-gray-500">1043</div>

                <Tooltip text="Quantidade todal de lances nesse produto."> 
                    <ion-icon name="alert-circle-outline" class="text-md text-orange-600 "></ion-icon>
                </Tooltip>
            </div>
        </div>

        

        <div className=" flex justify-center w-full px-5 mb-4">
            <Link :href="`/product/${id}`" >
                <img  class="rounded-xl w-44 h-44 object-cover" :src="imagem ? `/storage/${imagem}` : 'https://camo.githubusercontent.com/1689710c566f80df259f21d6a68e6e901f431ac2b165a3538b5167b027ef3192/68747470733a2f2f7a7562652e696f2f66696c65732f706f722d756d612d626f612d63617573612f33363664616462316461323032353338616531333332396261333464393030362d696d6167652e706e67'" />
            </Link> 
        </div>


         <!-- <div :class="isFav ? TrueconfFav : FalseconfFav"
            class=" mr-3 bottom-0 flex items-center p-1 text-black hover:border-black 
            text-xl border border-gray-300 rounded-full "
            @click.prevent="[addToFavorites(product.id), buttonFavorite]">  
                <ion-icon name="heart"></ion-icon>
            </div>  -->


        <div class="text-gray-400 text-xs ml-3 uppercase">
            {{ categoryName }}
        </div>

        <div className="title__font__family text-xl
         mt-1 ml-3 mr-3 h-10 text-wrap text-gray-900">
           {{firstFiveWords(name)}}
        </div>
          
        <div class="flex flex-col px-3 mt-2 ">
            
            <!-- <div class="flex gap-2 items-center mt-3">
                <span className="text-md text-black font-semibold">R${{ formatPrice(price) }}</span>
                <span className="line-through text-sm font-normal text-gray-500 ">R$ {{ formatPrice(from_price) }}</span>
            </div>  -->

            <div class="flex gap-2 items-center mt-3"> 
                <span className="line-through text-xs font-normal text-gray-500 ">R$ {{ formatPrice(from_price) }}</span>
            </div> 

            <div class="flex items-center justify-between gap-2 mt-1">
                <span className="text-2xl font-semibold text-[#EC7B00] 
                bg-gradient-to-b from-orange-300 to-orange-700 bg-clip-text text-transparent">R$ {{ formatPrice(price) }}</span>
                <div class="bg-[#E6F5EE] text-green-700 text-xs font-bold rounded-md px-2 py-1">-10%</div>
            </div>
            
            <div class="flex items-center gap-1 mt-1">
                <ion-icon name="alarm-outline" class="text-sm text-red-500 "></ion-icon>
                <div class="text-sm text-red-500 font-medium">00:05:00</div>
                <div class="text-gray-500 text-xs font-medium">AGUARDANDO</div>

                <Tooltip text="Nós trabalhamos com transparência, sem robos, sem perfis falsos. 
                Sendo assim precisamos ter a quantidade necessária de investidores para girar capital e pagar pelo produto.
                Caso acabem seus creditos e você não levar o produto para casa, não se preocupe, você recebera toda semana 
                creditos novos para poder usar novamente.
                Lembrando que a cada token comprado você se torna um investidor de nossos projetos e não apenas comprador de nossa loja.
                A loja(leilão) em si é apenas uma forma de retribuir uma parte dos lucros para os investidores."> 
                    <ion-icon name="alert-circle-outline" class="text-md text-orange-600 "></ion-icon>
                </Tooltip>

            </div>
             
        </div>


        <button @click.prevent="addToCart(product.id)" class="mx-auto w-auto
            flex
            justify-center
            items-center
            gap-2
            text-center
            uppercase
            bg-gradient-to-r from-orange-400 to-orange-700
            hover:bg-gray-700
            text-white
            py-2
            mt-2
            ml-3
            mr-3 border
            rounded-md
            font-semibold 
            transition-all duration-200 hover:-translate-y-[2px]">
            <ion-icon name="hammer-outline" class="text-lg"></ion-icon>
            <span class="text-sm">Dar lance</span>
        </button>

        <button @click.prevent="addToCart(product.id)" class="
            mx-auto w-auto
            flex
            justify-center
            items-center
            gap-2
            text-center
            bg-white
            hover:bg-gray-100
            text-black
            py-2
            mt-2
            ml-3
            mr-3 
            border
            border-gray-300
            rounded-md
            font-semibold
            transition-all  duration-300
            ">
            <ion-icon name="cart-outline" class="text-lg text-[#EC7B00]"></ion-icon>
            <span class="text-sm">Comprar por R$ {{ formatPrice(from_price) }}</span>
        </button>
    </div>
</template>