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
 
    const response = await fetch(`/admin/product/delete/${id}`,{
       method: 'DELETE',
       headers:{
        'X-CSRF-TOKEN': token,
        'Content-Type': 'application/json', 
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
    <div class="">
        <div class="flex">
            <div class="flex w-60 h-screen flex-col pt-3 p-3 bg-black text-white ">
                <Link :href="route('admin.product')">Produtos</Link>
                <Link :href="route('admin.add.product')">Adicionar produto</Link>
                <Link :href="route('admin.category')">Categorys</Link>
                <Link :href="route('admin.add.product')">Usuários</Link>
            </div>
            <div class="flex-1">
                <template v-if="slots.default">
                    <slot></slot><!----------------------------SLOT--------------------------------------------------->
                </template>
                <template v-else>
                    <div class="flex flex-row gap-5 bg-black text-white p-4">
                            <Link :href="route('admin.product')">
                                    Todos
                            </Link>
                        <div v-for="category in category" :key="category.id"  >
                            <Link :href="route('admin.product.fromcategory', {id: category.id})">
                                {{category.id }} - {{ category.name }}
                            </Link>
                        </div>
                    </div>
                    <div class="flex ml-5 flex-wrap gap-5">
                        <div v-for="product in props.products" :key="product.id" class="w-48"> 
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
