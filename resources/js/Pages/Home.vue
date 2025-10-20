<script setup>
import Footer from './Footer.vue';
import Card from './Card.vue';
import Header from './Header.vue';
import { defineProps, onMounted, watch } from 'vue';
import { useStore } from '../stores/store.js';
import { usePage } from '@inertiajs/vue3';

const user = usePage().props.auth.user;

const props = defineProps({
    products: Array,
    category: Array,
    loginStatus: String
});

const store = useStore();

const page = usePage()

function initDefault(){
    store.fetchCart();
    store.fetchFavorites();
    store.login = true;
}

watch(user, (oldValue, newValue)=>{
    console.log('login mudado')
});

onMounted(()=>{

    const urlParams = new URLSearchParams(page.url.split('?')[1]);
    const login = urlParams.get('login');

    var storeStorage = localStorage.getItem("store");
    var saida = JSON.parse(storeStorage);

    if (login === 'true') {
       window.location.href = '/home';
    }
    if(login === 'logout'){
        window.location.href = '/home';
    }

    if(user && saida.login != 'false'){
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        //primeiro login e cadastra produtos em standyBy
        if(saida.item_id.length > 0){
            store.addToCart(saida.item_id);
        }
        if(saida.favorites_id.length > 0){
            store.addToFavorite(saida.favorites_id)
        }
        initDefault();
    }//usuario deslogado
    else if(saida.login === true){
        store.login = false;
        store.qtd_cart = 0;
        store.item_id = [];
        store.qtd_favorites = 0;
        store.favorites_id = [];
    }
    if(user === 'null'){
        alert("Glória a Deus");
    }
})

</script>

<template>
    <div>
        <div className="relative">

            <Header></Header>

            <div className="w-full mb-10 -z-50 h-96 bg-slate-200 mx-auto flex flex-row justify-around items-center">
                <div className="flex flex-col ">
                    <span className="text-4xl font-semibold text-black">Grab Upto 50% Off on</span>
                    <span className="text-4xl font-semibold text-black flex-shrink-0">Selected headphone</span>
                    <button className="bg-white text-shadow-xl text-black font-bold text-sm py-3 px-9 w-max mt-4 rounded-md
                    hover:bg-green-700 ">
                        Buy Now
                    </button>
                </div>
                <div>
                    Imagem
                </div>
            </div>

            <div className="container__own border-2 border-gray-200 rounded-md mb-10">
                <div class="
                grid
                grid-cols-4
                h-24">
                    <div class="
                        flex
                        justify-center
                        items-center
                        gap-2
                        border-r
                        border-gray-200">
                        <ion-icon name="cube-outline" class="faixa__two__icon text-gray-700"></ion-icon>
                        <div class="flex flex-col">
                            <p class="uppercase font-medium  text-sm">fast delivery</p>
                            <p class="text-xs text-slate-500 mt-1">Delivered in 7 days</p>
                        </div>
                    </div>
                    <div class="
                        flex
                        justify-center
                        items-center
                        gap-2
                        border-r
                        border-gray-200">
                        <ion-icon name="trophy-outline" class="faixa__two__icon text-gray-700"></ion-icon>
                        <div class="flex flex-col">
                            <p class="uppercase font-medium  text-sm">24 Hour Return</p>
                            <p class="text-xs text-slate-500 mt-1">100% money-back guarantee</p>
                        </div>
                    </div>
                    <div class="
                        flex
                        justify-center
                        items-center
                        gap-2
                        border-r
                        border-gray-200">
                        <ion-icon name="card-outline" class="faixa__two__icon text-gray-700"></ion-icon>
                        <div class="flex flex-col">
                            <p class="uppercase font-medium  text-sm">secure payment</p>
                            <p class="text-xs text-slate-500 mt-1">Your money is safe</p>
                        </div>
                    </div>
                    <div class="
                        flex
                        justify-center
                        items-center
                        gap-2">
                        <ion-icon name="call-outline" class="faixa__two__icon text-gray-700"></ion-icon>
                        <div class="flex flex-col">
                            <p class="uppercase font-medium  text-sm">support 24/7</p>
                            <p class="text-xs text-slate-500 mt-1">Live contact/message</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container__own h-80 bg-gray-300">

            </div>

            {{ props.message }}

            <div className="container__own flex pt-5 pb-5 text-sm flex-wrap mt-10">
                <p class="text-2xl font-semibold">Nossos Produtos</p>
                <div class="w-full">
                    <ul className="flex mt-5 mb:gap-3 gap-7 font-medium flex-wrap">
                    <li className="md:mt-0 mt-1" v-for="cat in category">
                        <a href="#" className="hover:underline">{{ cat.name }}</a>
                    </li>
                </ul>
                </div>
            </div>

            <div className="container__own relative mx-auto
                grid
                grid-cols-5
                gap-2
                pb-10">
                <!--sm:justify-between-->
                 <div v-for="product in props.products" :key="product.id">
                    <Card :product="product"/>
                 </div>
            </div>

            <div class="h-96 flex flex-col items-center text-white justify-center font-light text-lg
           bg-blue-700">
                <p class="text-xl">Se inscreva para receber as novidades</p>
                <p class="text-sm mt-2">Ofertas e conteúdos exclusivos no seu e-mail.</p>
                <div>
                    <input type="text" placeholder="Digite seu email" class="w-72 h-11 text-sm text-black mt-4 border rounded-md" />
                </div>
            </div>

            <Footer></Footer>
        </div>
    </div>
</template>
