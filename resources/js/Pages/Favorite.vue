<script setup>
import Header from './Header.vue';
import Favorite from '../MyComponents/Favorite.vue'
import Footer from './Footer.vue';
import { ref, computed } from 'vue';
import { useStore } from '../stores/store.js';
import Card from "@/Pages/Card.vue";

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

        <div class="max-w-7xl mx-auto px-3 mt-28 mb-32 ">
 

            <div class="flex flex-col gap-2"> 
                <div class="text-3xl font-bold mt-1 uppercase ">Meus Favoritos</div>
                <p class="text-gray-600">Os leilões que você salvou para acompanhar de perto.</p>
            </div>
            <div class="mt-5"> 
                
                <div class="grid sm:grid-cols-4 grid-cols-2 smgap-8 gap-2 items-start">
                    <!-- item 1 -->
                    <div v-for="favorite in favoritesList" :key="favorite.id">
                        <Card :product="favorite" @updateView="updateView"/>
                        <!-- <Favorite
                        :favorite="favorite"
                        :select="favoritesRef"
                        @update:selectIds="handleUpdate"
                        @removeFavorite="removeFavorite"/> -->
                    </div>
                </div>
            </div> 
        </div>

        <Footer />
    </div>
</template>
