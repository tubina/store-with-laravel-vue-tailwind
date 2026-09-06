<script setup>
import { defineEmits } from 'vue';
import { useStore } from '../stores/store.js';
import { reactive } from 'vue';
import { formatPrice } from '../utils/formatPrice.js';
import { ref } from 'vue';
import { Heart, Trash2 } from 'lucide-vue-next';


const props = defineProps({
    cart: {
        type: Object,
        required: true
    }
}) 

var qtdProduct = ref(1);
if(props.cart.product.qtd_cart.quantity > 1){
    qtdProduct = ref(props.cart.product.qtd_cart.quantity);
}else{
    qtdProduct = ref(1);
}

const isFav = ref(false); 
if(props.cart.product.product_has_favorite != null){
    if(props.cart.product.product_has_favorite.user_id != null){
        isFav.value = true;
    }else{
        isFav.value = false;
    }
}
const TrueconfFav = ['text-orange-500', 'fill-orange-500'];
const FalseconfFav = ['text-gray-500']; 

const store = useStore();

const emit = defineEmits(['removeFromCart', 'addToFavorite']);

function removeToFavorites(product){
    store.deleteFromFavorite(product)
    console.log(product)
}
 
function addFavorite(product_id) {
    emit('addToFavorite', product_id);
    if(isFav.value = !isFav.value){
        store.showToast(props.cart.product.id,
        props.cart.product.product_images_just_one.path,
        props.cart.product.name,
        props.cart.product.price)
    }else{      
        removeToFavorites(product_id) 
    }
}

function deleteCart(product_id) {
    emit('removeFromCart', product_id);
    store.showToast(props.cart.product.id,
    props.cart.product.product_images_just_one.path,
    props.cart.product.name,
    props.cart.product.price)
}

function capitalizeWords(text) {
    return text.replace(/\b\w/g, char => char.toUpperCase());
}
const modal = reactive({
    show: false,
    indexToDelete: null
});
function removeFromCart(favorite) {
    modal.show = true;
    modal.indexToDelete = favorite;
}

function deleteProduct(){
    deleteCart(modal.indexToDelete)
    console.log(modal.indexToDelete)
}
function closeModal() {
    modal.show = false;
}

function incrementalQtd(){
    qtdProduct.value++;
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    const addQtdCart = fetch(`/cart-insert-increment-product/${props.cart.product.id}`, {
        method: 'POST',
        credentials: 'include',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token, // token CSRF aqui
        },
        body: JSON.stringify({product_id: props.cart.product.id})
    });
}
function decrementalQtd(product_id){
    if(qtdProduct.value > 1){
        qtdProduct.value--;
    }else if(qtdProduct.value == 1) {
        removeFromCart(product_id)
    }
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    const removeQtdCart = fetch(`/cart-decrement-product/${props.cart.product.id}`, {
        method: 'POST',
        credentials: 'include',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token, // token CSRF aqui
        },
        body: JSON.stringify({product_id: props.cart.product.id})
    });

} 

</script>
<template>

<!-- Modal -->
    <div v-if="modal.show" class="modal-overlay">
      <div class="modal">
        <h3 class="text-2xl font-bold">Confirmar Exclusão</h3>
        <p class="text-sm">Tem certeza que deseja excluir este produto?</p>
        <div class="flex justify-center gap-3 mt-4">
            <button @click="closeModal()" class="bg-black px-5 py-1 rounded-md text-white">Cancelar</button>
            <button @click="deleteProduct()" class="bg-green-600 px-5 py-1 rounded-md text-white">Sim</button>
        </div>
      </div>
    </div>
<!-------->

    <div class="flex gap-4 items-start justify-center
    mb-3 px-5 py-3 bg-white rounded-xl border shadow-sm">

        <!-- Imagem -->
        <img
            :src="`/storage/${cart.product.product_images_just_one.path}`"
            class="p-1 rounded-2xl w-24 h-24 object-cover" 
        />

        <!-- Conteúdo -->
        <div class="flex flex-col flex-1 min-h-[100px]">

            <!-- Topo -->
            <div class="classe-a flex justify-between">
                <div class="flex flex-col">
                    <div class="text-lg">
                        <div class="font-semibold text-[#0a0a0a]">
                            {{ capitalizeWords(cart.product.name) }}
                        </div>
                        <div class="text-sm mt-2 text-[#0a0a0a]">
                            Category:
                            <span class="font-semibold">
                                {{ cart.product.category.name }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class=" text-lg font-semibold text-right">
                    R$ {{ formatPrice(cart.product.price) }}
                </div>
            </div>

            <div class="class-b mt-auto flex justify-between items-end ">
                <div class="flex items-center gap-3">
                    <button @click="addFavorite(cart.product.id)" class="flex gap-1 items-center pt-2">
                        <Heart :class="isFav ? TrueconfFav : FalseconfFav" class="h-4 w-4"></Heart>
                        <span class="text-sm">Favoritar</span>
                    </button>
                    <button @click="removeFromCart(cart.product.id)" class="flex gap-1 items-center pt-2">
                        <Trash2 class="h-4 w-4 text-gray-500"></Trash2>
                        <span class="text-sm">Remover</span>
                    </button>
                </div>
 
                <div class="flex items-center gap-1">
                    <button
                        @click="decrementalQtd(cart.product.id)"
                        class="flex items-center justify-center w-8 h-8 border rounded-lg text-2xl"
                    >
                        -
                    </button>

                    <input
                        type="text"
                        v-model="qtdProduct"
                        class="w-10 h-8 border rounded-lg text-center outline-none border-gray-300"
                    />

                    <button
                        @click="incrementalQtd"
                        class="flex items-center justify-center w-8 h-8 border rounded-lg text-2xl"
                    >
                        +
                    </button>
                </div>

            </div>

        </div>
    </div>

</template>


<style scoped>
/* Modal */
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0,0,0,0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}
.modal {
  background: white;
  padding: 24px;
  border-radius: 8px;
  text-align: center;
}

/* Toast */
.toast {
  position: fixed;
  bottom: 30px;
  left: 50%;
  transform: translateX(-50%);
  background: #333;
  color: white;
  padding: 16px 24px;
  border-radius: 8px;
}
</style>



