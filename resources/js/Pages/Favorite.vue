<script setup>
import Header from './Header.vue';
import Favorite from '../MyComponents/Favorite.vue'
import Footer from './Footer.vue';
import { ref, computed } from 'vue';

    const props = defineProps({
        favorites: Array
    })

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
    })

</script>

<template>
    <div>
        <Header />

        <div class="mb-32 w-full">

            <div class="container__own overflow-x-auto">

                <div class="flex gap-2 items-center mt-28 ">
                    <ion-icon name="heart-outline" class="text-3xl"></ion-icon>
                    <span class="text-2xl font-medium mt-1"> Favorites</span>
                </div>
                {{ favoritesRef }}
                <div class=" border rounded-lg mt-5">
                    <table class="min-w-full border-gray-200 text-sm ">
                    <thead class="border-b">
                        <tr>
                        <th class="pl-6 py-2 text-left"> <input type="checkbox" v-model="allSelected" /> &nbsp;All</th>
                        <th class="px-4 py-2 text-left"> Image</th>
                        <th class="px-4 py-2 text-left">Name</th>
                        <th class="px-4 py-2 text-left">Category</th>
                        <th class="px-4 py-2 text-left">Action</th>
                        <th class="px-4 py-2 text-left">Users</th>
                        <th class="px-4 py-2 text-left">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- item 1 -->
                        <tr  v-for="favorite in favorites" :key="favorite.id">
                            <Favorite :favorite="favorite" :select="favoritesRef" />
                        </tr>

                    </tbody>
                    </table>
                </div>
            </div>
        </div>

        <Footer />
    </div>
</template>
