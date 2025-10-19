<script setup>
import Header from './Header.vue';
import Favorite from '../MyComponents/Favorite.vue'
import Footer from './Footer.vue';

    defineProps({
        favorites: Object
    })
</script>

<template>
    <div>
        <Header />

        <div class="mb-32 w-full">
            <div class="container__own mt-24 overflow-x-auto border rounded-lg">
                <table class="min-w-full border-gray-200 text-sm bg-white">
                <thead class="border-b">
                    <tr>
                    <th class="px-4 py-2 text-left">Image</th>
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
                        <Favorite :favorite="favorite" />
                     </tr>

                </tbody>
                </table>
            </div>
        </div>

        <Footer />
    </div>
</template>
