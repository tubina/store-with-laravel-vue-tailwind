<script setup>
import { Link } from '@inertiajs/vue3';
import { useSlots } from 'vue';
import Card from '../../Card.vue'; 

const slots = useSlots();

const props = defineProps({
    category: Array,
    products: Array
});

async function deleteProduct(id){

    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')

    const response = await fetch(`/profile/deletePhoto/${id}`,{
       method: 'DELETE',
       headers:{
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': token,
       }
    });
    const resp = await response.json();
    console.log(resp)
    if(resp.ok){
        window.location.reload();
    }
}

</script>
<template>
    <div class="container__own">
        <div class="flex gap-10 mt-10">
            <div class="flex flex-col">
                <Link :href="route('admin.product')">Produtos</Link>
                <Link :href="route('admin.add.product')">Adicionar produto</Link>
                <Link :href="route('admin.category')">Categorys</Link>
                <Link :href="route('admin.add.product')">Usuários</Link>
            </div>
            <div class="flex-1  ">
                <template v-if="slots.default">
                    <slot></slot><!----------------------------SLOT--------------------------------------------------->
                </template>
                <template v-else>
                    <div class="flex flex-row gap-5">
                        <div  v-for="category in category" :key="category.id"  >
                            <Link href="/home">{{ category.name }}</Link>
                        </div>
                    </div>
                    <div class="grid grid-cols-4 gap-3">
                        <div v-for="product in props.products" :key="product.id">
                            <Card :product="product" />
                            <div class="flex justify-between mt-2">
                                <button @click="deleteProduct(product.id)"
                                    class="rounded-sm px-2 text-sm bg-red-500 text-white">
                                    Excluir
                                </button>

                                <Link :href="route('admin.edit.product', {product: product.id})"
                                    class="rounded-sm px-2 text-sm bg-green-500 text-white">
                                    Editar
                                </Link>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</template>
