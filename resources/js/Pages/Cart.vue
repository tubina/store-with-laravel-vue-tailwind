<script setup>
import Header from './Header.vue';
import Product from '../MyComponents/Product.vue';
import Footer from './Footer.vue';
import { defineProps, computed, ref } from 'vue';
import { useStore } from '../stores/store.js';

const store = useStore();

const props = defineProps({
    cart: Array
});

var totalPrice = computed(() => {
    return props.cart.reduce((acc, item) => acc + Number(item.product.price), 0);
})

const cartT = ref([...props.cart]);

function addFavorite(product_id) {
    store.addToFavorite(product_id);
}

function deleteFromCart(product_id) {
    const saida = store.deleteCart(product_id);
    saida.then(result => {
        cartT.value = cartT.value.filter(p => p.product.id !== result)
    })
}

</script>
<template>
    <Header></Header>

    <div class="container__own mx-auto mt-28 mb-32">
        <div class="flex gap-2 items-center">
            <ion-icon name="bag-handle-outline" class="text-3xl"></ion-icon>
           <span class="text-2xl font-medium mt-1"> Shooping Cart</span>
        </div>

        <div class=" grid grid-cols-3 gap-8 mt-5 items-start">

            <div class="bloco-a flex-col col-span-2 bg-white" :class="cartT.length ? 'border border-gray-200 rounded-md' : '' ">

                <div v-for="product in cartT" :key="product.id">
                    <Product :cart="product" @addToFavorite="addFavorite" @removeFromCart="deleteFromCart" />
                </div>

            </div>

            <div class="bloco-b  p-3 col-span-1 bg-white border bg-whiteborder-gray-200 rounded-md">
                <div class="text-sm font-medium">
                    Order Sumary
                </div>
                <div class="flex justify-between text-sm mt-4 text-16px">
                    <div>Subtotal:</div>
                    <div>R$ {{ totalPrice.toFixed(2) }}</div>
                </div>
                <div class="flex justify-between text-sm mt-4">
                    <div>Discount:</div>
                    <div>R$ 0</div>
                </div>
                <div class="flex justify-between font-semibold text-sm mt-4 pt-3 border-t bg-whiteborder-gray-200">
                    <div>Total:</div>
                    <div>R$ {{ totalPrice.toFixed(2) }}</div>
                </div>
                <div>
                    <button class="w-full rounded p-2 mt-3 bg-black text-white transition-all hover:bg-neutral-800">
                        Pay
                    </button>
                </div>
            </div>
        </div>
    </div>

    <Footer />

</template>
