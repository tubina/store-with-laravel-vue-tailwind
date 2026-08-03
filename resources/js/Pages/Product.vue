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

   <div class="bg-[#f9fafb] sm:mt-10 sm:pt-1">

        <div class="sm:flex sm:w-[80%] p-2 mx-auto gap-4 sm:mt-16 mt-7">

            <div class="flex flex-col sm:w-1/3 rounded-md ">
                <div class="h-min bg-white border rounded-md border-gray-200 sm:p-7 p-6 ">
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
            <div class="sm:w-1/2 bg-white p-5 rounded-md shadow-sm">
                <p class="sm:text-2xl sm:font-light text-2xl">
                    {{product.name}}
                    {{product.name}}
                </p>
                
                <div class="py-3 text-orange-600 font-bold">
                    20
                </div>

                <div class="pb-5 text-sm">
                    <p class="font-light">Lorem Ipsum é um texto padrão em latim usado na indústria gráfica e de design para preencher espaços de layout. Ele serve para testar a tipografia, a formatação e a aparência visual de páginas antes de receberem o conteúdo real.</p>
                </div>

                <div class="flex justify-between gap-5 pb-5">
                    <div>
                        Lances Disponiveis <span class="text-orange-600 font-bold">100</span>
                    </div>
                    <div class="flex">
                        <div class="underline">
                            Sugestao de N.</:>
                        </div>
                        <div>
                            Dar lance
                        </div>
                    </div>
                </div>

                <div class="rounded-lg overflow-hidden border border-gray-300">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-[#EDEDED]" >
                                <th class="w-1/3 text-center py-2 text-sm">Valor inicial</th>
                                <th class="w-1/3 text-center py-2 text-sm">Valor atual</th>
                                <th class="w-1/3 text-center py-2 text-sm">Economia</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td class="text-lg font-bold text-center py-2">
                                    R$ 450,00
                                </td>

                                <td class="text-lg font-bold text-center py-2">
                                    R$ 389,50
                                </td>

                                <td class="text-lg font-bold text-center py-2">
                                    R$ 250.00
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-5 rounded-lg overflow-hidden border border-gray-300">
                    <table class="w-full ">
                        <thead>
                            <tr class="bg-[#EDEDED] ">
                                <th class="w-1/3 text-center text-sm py-2">Usuário</th>
                                <th class="w-1/3 text-center text-sm py-2">Valor Escolhido</th>
                                <th class="w-1/3 text-center text-sm py-2">Horário</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                              <tr v-for="x in 4" :key="x" class="border-t" >
                                <td class="flex items-center justify-center gap-2 text-center 
                                font-light py-2">
                                    <img 
                                    :src="'https://t4.ftcdn.net/jpg/03/64/21/11/360_F_364211147_1qgLVxv1Tcq0Ohz3FawUfrtONzz8nq3e.jpg'"
                                    class="w-8 h-8 border rounded-full object-cover">
                                    Felipe
                                </td>
                                <td class="text-center font-light py-2">R$ 250,49</td>
                                <td class="text-center font-light py-2">21:49:30</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <!------------------->
            <div class="sm:w-1/3 bg-white sm:px-5 sm:mb-5 mb-4 mt-3 sm:mt-0 pt-5 pb-5 rounded-md shadow-sm">
                
                <p class="text-2xl gap-2 font-semibold space-x-2">
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
                    <div class="flex flex-col flex-1 rounded-md border border-gray-300 py-3 px-3 items-center bg-white
                    hover:border hover:border-blue-950
                    transition-all duration-300">
                        <span class="font-semibold">Free Shipping</span>
                        <span class="text-sm text-gray-500">Free shipping over order $120</span>
                    </div>
                    <div class="flex flex-col flex-1 rounded-md border border-gray-300 py-3 px-3 items-center bg-white
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

   </div>

    <Footer></Footer>
</template>
