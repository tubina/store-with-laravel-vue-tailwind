<script setup>
import {Link} from "@inertiajs/vue3";
import { useStore } from '../stores/store.js';

defineProps({
    favorite: Object
});

const store = useStore();

function addToCart(product){
    store.addToCart(product);
}

</script>

<template>
        <td class="px-4 py-2">
            <div class="flex items-center gap-2">
                <button class="bg-white text-black px-2 py-1 rounded
                    hover:bg-gray-100 text-xs font-bold">X</button>
                <img
                src="https://www.nextdaycamera.co.uk/acatalog/CanonEOSR5+RF24-105f4L+adapter-2.jpg"
                alt="Product"
                class="rounded border border-gray-200 w-20
                p-2"
                />
            </div>
        </td>
        <td class="px-4 py-2 font-medium">
            <Link href="/product">
            {{favorite}}
            </Link>
        </td>
            <td class="px-4 py-2">Television</td>
            <td class="px-4 py-2 text-green-800 font-semibold">In Stock</td>
            <td class="px-4 py-2">xxxxxx</td>
            <td class="px-4 py-2">$1,599.00</td>
            <td class="px-4 py-2">
            <button @click.prevent="addToCart(favorites.id) "class="text-xs bg-black text-white px-3 py-2 rounded hover:bg-neutral-800">
            Add to Cart
            </button>
    </td>

</template>
