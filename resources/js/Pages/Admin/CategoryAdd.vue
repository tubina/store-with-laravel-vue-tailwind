<script setup>
import Main from './partials/Main.vue';
import { ref } from 'vue';


var selectedOption = ref('selecione');

const props = defineProps({
    category: Object
})

function editCategory(){
    console.log(selectedOption.value.id);
    fetch("`/admin/categoryEdit/${selectedOption.value.id}`",{
        method: 'DELETE',
        body:{
            'X-CSRF-TOKEN': token
        }
    })
}

</script>

<template>
    <Main :category="category">

        <div class="flex w-auto justify-center">
            <div class="flex w-auto justify-center gap-2">
                    <div class="flex flex-col">
                        <div class="bg-blue-200 p-2">
                            <select @change="changeInput" v-model="selectedOption" >
                                <option value="selecione">Selecione a categoria</option>
                                <option v-for="cat in category" :key="cat.id" :value="cat">{{ cat.name }}</option>
                            </select>
                            <div v-if="selectedOption != 'selecione'" class="flex flex-col mt-2">
                                <input type="text" :ref="inputRef" :value="selectedOption.name" />
                                <button @click="editCategory" class="bg-green-400 pt-1 mt-2">Editar</button>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="flex w-auto justify-center">

            </div>

         </div>

    </Main>

</template>
