<script setup>
import {Link} from "@inertiajs/vue3";
import { useStore } from '../stores/store.js';

const props = defineProps({
    favorite: Array,
    select: Array
});

const emit = defineEmits(['update:selectIds']);

function toggleCheckbox(event){
    const checked = event.target.checked;
    emit('update:selectIds', {id:props.favorite.id, checked})
}

const store = useStore();

function addToCart(product){
    store.addToCart(product);
}

function findProductById(){
    const saida = props.select.find(p=> p === props.favorite.id)
    return saida ? true : false;
}

function removeFromFavorite(favorite) {
    console.log(favorite)
    store.deleteFromFavorite(favorite);
}

</script>

<template>
        <td class="px-4 py-2">
            <button class="bg-white text-black px-2 py-1 rounded
                hover:bg-gray-100 text-xs font-bold">
                    <input type="checkbox" :checked="findProductById()" @change="toggleCheckbox"/>
            </button>
        </td>

        <td class="px-41''' py-2">
            <div class="flex items-center gap-2">
                <button @click="removeFromFavorite(favorite.id)" class="ml-2  py-1 px-2 bg-gray-100 rounded">x</button>
                <img
                :src="`/storage/${favorite.product_images_just_one.path}`"
                alt="Product"
                class="rounded border border-gray-200 w-20 p-1"
                />
            </div>
        </td>
        <td>

        </td>
        <td class="px-4 py-2 font-medium">
            <Link :href="`/product/${favorite.id}`">
            {{ favorite.name }}
            </Link>
        </td>
        <td class="px-4 py-2">{{ favorite.category.name }}</td>
        <td class="px-4 py-2 text-green-800 font-semibold">In Stock</td>
        <td class="px-4 py-2">xxxxxx</td>
        <td class="px-4 py-2">${{ favorite.price }}</td>
        <td class="px-4 py-2">
            <button @click.prevent="addToCart(favorite.id) "class="text-xs bg-black text-white px-3 py-2 rounded hover:bg-neutral-800">
                Add to Cart
            </button>
        </td>

</template>
