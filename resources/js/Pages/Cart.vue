<script setup>
import Header from './Header.vue';
import Product from '../MyComponents/Product.vue';
import Footer from './Footer.vue';
import { defineProps, computed, ref } from 'vue';
import { useStore } from '../stores/store.js';
import { ShieldCheck, PackageOpen } from 'lucide-vue-next'

const store = useStore();

const props = defineProps({
    cart: Array
});

const cartT = ref([...props.cart]);

var totalPrice = computed(() => {
    return cartT.value.reduce((acc, item) => acc + Number(item.product.price), 0);
});

function addFavorite(product_id) {
    store.addToFavorite(product_id);
}

function deleteFromCart(product_id) {
    let storage = JSON.parse(localStorage.getItem("store"));
    storage.item_id = [];
    localStorage.setItem("store", JSON.stringify(storage))
    const saida = store.deleteCart(product_id);
    saida.then(result => {
        cartT.value = cartT.value.filter(p => p.product.id !== result)
    })
}

</script>
<template>
    <Header></Header>

    <div class="max-w-7xl mx-auto mt-28 mb-32 ">
        <div class="flex flex-col gap-2"> 
            <div class="text-3xl font-bold mt-1 uppercase "> SEU CARRINHO</div>
            <p class="text-gray-600">Compra imediata e pacotes de lances. Os créditos entram na conta na hora.</p>
        </div>

        <div class=" grid grid-cols-3 gap-8 mt-5 items-start">

            <div class="flex-col col-span-2 ">

                <div v-for="(product, index) in cartT" :key="product.id">
                    <Product :cart="product" @addToFavorite="addFavorite" @removeFromCart="deleteFromCart"/>
                </div>

            </div>

            <div class="p-7 col-span-1 bg-white border bg-whiteborder-gray-200 rounded-xl">
                <div class="text-md font-semibold uppercase">
                    Resumo do Pedido
                </div>
                <div class="flex justify-between text-sm mt-4 text-16px">
                    <div class="text-gray-500">Subtotal:</div>
                    <div>R$ {{ totalPrice.toFixed(2) }}</div>
                </div>
                <div class="flex justify-between text-sm mt-4">
                    <div class="text-gray-500">Frete:</div>
                    <div class="text-green-600">Grátis</div>
                </div>
                <div class="flex justify-between font-semibold text-sm mt-4 pt-3 border-t bg-whiteborder-gray-200">
                    <div>Total:</div>
                    <div class="text-2xl
                    text-[#EC7B00] 
                bg-gradient-to-b from-orange-500 to-orange-700 bg-clip-text text-transparent">R$ {{ totalPrice.toFixed(2) }}</div>
                </div>
                <div>
                    <button class="w-full shadow-sm uppercase text-white font-semibold  rounded-xl
                    bg-orange-500 shadow-orange-500  
                        py-4
                        bg-gradient-to-r from-orange-400 to-orange-700
                    p-2 mt-3 transition-all hover:bg-neutral-800
                    hover:scale-105">
                        Finalizar Compra
                    </button>
                </div>
                <div class="flex items-center justify-center mt-3">
                    <div class="flex items-center gap-1">
                        <ShieldCheck class="text-green-600 w-4 "/>
                        <div class="text-xs text-gray-500">Pagamento protegido e criptografado</div>
                    </div>
                </div>
                <div class="flex border rounded-xl p-3 text-xs mt-3 bg-[#F1F4F8] text-gray-600"> 
                    <PackageOpen class="mr-2 text-orange-500 w-4" /> 
                    <div class="w-[80%]">Os créditos de lance são entregues automaticamente na sua conta após a confirmação do pagamento.</div>
                </div>
            </div>
        </div>
    </div>

    <Footer />

</template>
