<script setup>
import { defineEmits } from 'vue';
import { useStore } from '../stores/store.js';

const props = defineProps({
    cart: Array
})

const store = useStore();

const emit = defineEmits(['removeFromCart', 'addToFavorite']);

function addFavorite(product_id) {
    emit('addToFavorite', product_id);
    store.showToast(props.cart.product.id,
    props.cart.product.product_images_just_one.path,
    props.cart.product.name,
    props.cart.product.price)
}

function deleteCart(product_id) {
    emit('removeFromCart', product_id);
    store.showToast(props.cart.product.id,
    props.cart.product.product_images_just_one.path,
    props.cart.product.name,
    props.cart.product.price)
}

function capitalizeWords(text) {
  return text.replace(/\b\w/g, char => char.toUpperCase());
}

</script>
<template>
<div class="flex gap-4 items-start mt-3 pl-3 pr-3 pb-3 border-b bg-white border-gray-200">

    
    <!-- Imagem -->
    <img
        :src="`/storage/${cart.product.product_images_just_one.path}`"
        class="border rounded-md w-32 p-2"
    />

    <!-- Conteúdo -->
    <div class="flex flex-col flex-1 min-h-[160px]">

        <!-- Topo -->
        <div class="classe-a flex justify-between">
            <div class="flex flex-col">
                <div class="text-lg">
                    <div class="text-shadow font-semibold text-[#0a0a0a]">
                        {{ capitalizeWords(cart.product.name) }}
                    </div>
                    <div class="text-sm mt-2 text-[#0a0a0a]">
                        Category:
                        <span class="text-shadow font-semibold">
                            {{ cart.product.category.name }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="text-shadow text-lg font-semibold text-right">
                R$ {{ cart.product.price }}
            </div>
        </div>

        <div class="class-b mt-auto flex justify-between items-end ">
            <div class="flex gap-2">
                <button @click="addFavorite(cart.product.id)" class="flex p-2 rounded-2xl bg-gray-200 w-min h-min ">
                    <ion-icon name="heart-outline" class="text-black text-base"></ion-icon>
                </button>
                <button @click="deleteCart(cart.product.id)" class="pt-2">
                    <ion-icon name="trash-outline" class="text-black text-base"></ion-icon>
                </button>
            </div>

            <select class="border w-12 h-10 text-xs border-gray-300 rounded px-3
                            py-2 focus:outline-none focus:ring focus:ring-blue-300">
                <option v-for="n in 5" :value="n" :selected="cart.quantity == n">
                    {{ n }}
                </option>
            </select>
        </div>

    </div>
</div>

</template>



