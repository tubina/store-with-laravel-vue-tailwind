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
    store.showToast(props.cart.product.product_images_just_one.path,props.cart.product.name)
}

function deleteCart(product_id) {
    emit('removeFromCart', product_id);
}

</script>
<template>
    <div class="flex flex-wrap gap-4 items-start
                mt-3 pl-3 pr-3 pb-3
                border-b
                bg-whiteborder-gray-200">

        <!-- Imagem -->
        <img
            :src="`/storage/${cart.product.product_images_just_one.path}`"
            class="w-24 rounded-md  p-2"
        />
        <!-- Conteúdo -->
        <div class="flex flex-col flex-1 h-full ">
            <div class="flex justify-between md:w-auto flex-1">
                <!-- Informações do produto -->
                <div class="flex flex-col justify-between">
                    <div class="text-sm font-medium">
                        <div>{{ cart.product.name }}</div>
                        <div class="text-xs mt-2">
                            {{cart.product.category.name}}
                        </div>
                    </div>
                </div>

                <!-- Preço -->
                <div class="text-sm font-medium text-right self-start ml-4">
                    <div>
                        R$ {{ cart.product.price }}
                    </div>
                </div>
            </div> 

            <div class="flex justify-between mt-2">
                <div class="flex gap-2">
                    <button @click="addFavorite(cart.product.id)">
                        <ion-icon name="heart-outline" class="text-black text-lg"></ion-icon>
                    </button>
                    <button @click="deleteCart(cart.product.id)">
                        <ion-icon name="trash-outline" class="text-black text-lg"></ion-icon>
                    </button>
                </div>
                <div class="flex">
                    <select class="border w-12 h-10 text-xs border-gray-300 rounded px-3
                    py-2 focus:outline-none focus:ring focus:ring-blue-300">
                        <option v-for="n in 5" :value="n" :selected="cart.quantity == n">{{n}}</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</template>


