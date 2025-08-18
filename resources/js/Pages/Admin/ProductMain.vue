<script setup>
import Main from "./partials/Main.vue";

const props = defineProps({
    category: Array,
    products: Array,
});

</script>

<template>
    <Main
    :category="props.category"
    :products="props.products">
    
    </Main>

</template>
