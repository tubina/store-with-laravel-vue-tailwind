<script setup>
import Header from './Header.vue';
import Favorite from '../MyComponents/Favorite.vue'
import Footer from './Footer.vue';
import { ref, computed } from 'vue';
import { useStore } from '../stores/store.js';

const props = defineProps({
    favorites: Array
})

let favoritesList = ref([...props.favorites]);

let favoritesRef = ref([]);

const allSelected = computed({
    get() {
        return favoritesRef.value.length === props.favorites.length;
    },
    set(value) {
        if(value){
        favoritesRef.value = props.favorites.map(p=> p.id)
        }else {
        favoritesRef.value = []
        }
    }
});

function handleUpdate({ id, checked }) {
    if(checked){
        favoritesRef.value.push(id)
    }else {
        favoritesRef.value = favoritesRef.value.filter(f => f !== id)
    }
}

const store = useStore();

const someSelected = computed(() => {
    return favoritesRef.value
});
function addToCart(){
    store.addToCart(favoritesRef.value);
}

function removeFavorite(favoriteId) {
    favoritesList.value = favoritesList.value.filter(e => e.id !== favoriteId.favoriteId)
}

</script>

<template>
    <div>
        <Header />

        <div class="mb-32 w-full">

            <div class="container__own overflow-x-auto">

                <div class="flex items-center justify-between mt-28 ">
                    <div class="flex items-center gap-2">
                        <ion-icon name="heart-outline" class="text-3xl"></ion-icon>
                        <span class="text-2xl font-medium mt-1">Favorites</span>
                    </div>

                </div>
                <div class="mt-5">
                    <table class="min-w-full ">
                        <thead class="border-b">
                            <tr class="text-shadow text-lg font-semibold">
                                <th class="flex items-center  pl-6 py-3 text-left">
                                    <input type="checkbox" v-model="allSelected" /> &nbsp;All
                                </th>
                                <th class="px-4 py-2 text-left">Image</th>

                                <th class="px-4 py-2 text-left">Name</th>
                                <th class="px-4 py-2 text-left">Category</th>
                                <th class="px-4 py-2 text-left">Status</th>
                                <th class="px-4 py-2 text-left">Users</th>
                                <th class="px-4 py-2 text-left">Price</th>
                                <th class="flex text-left">
                                    <span class="px-4 py-2 text-left">Action</span>
                                    <span v-if="someSelected.length" class="flex items-center">
                                        <button @click="addToCart"
                                        class=" text-left bg-green-600 hover:bg-green-500
                                        text-white text-xs px-3 py-2 border rounded">
                                            All to Cart
                                        </button>
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- item 1 -->
                            <tr v-for="favorite in favoritesList" :key="favorite.id" class=" border-t">
                                <Favorite
                                :favorite="favorite"
                                :select="favoritesRef"
                                @update:selectIds="handleUpdate"
                                @removeFavorite="removeFavorite"/>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <Footer />
    </div>
</template>
