<script setup>
import Footer from './Footer.vue';
import Card from './Card.vue';
import Header from './Header.vue';
import { defineProps } from 'vue';

const props = defineProps({
    products: Array,
});

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
                        <ion-icon name="cube-outline" class="faixa__two__icon text-blue-900"></ion-icon>
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
                        <ion-icon name="trophy-outline" class="faixa__two__icon text-blue-900"></ion-icon>
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
                        <ion-icon name="card-outline" class="faixa__two__icon text-blue-900"></ion-icon>
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
                        <ion-icon name="call-outline" class="faixa__two__icon text-blue-900"></ion-icon>
                        <div class="flex flex-col">
                            <p class="uppercase font-medium  text-sm">support 24/7</p>
                            <p class="text-xs text-slate-500 mt-1">Live contact/message</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container__own h-80 bg-gray-300">

            </div>


            <div className="container__own flex pt-5 pb-5 text-sm flex-wrap mt-10">
                <p class="text-2xl font-semibold">Nossos Produtos</p>
                <ul className="container mt-5 mb:gap-3 gap-1  mx-auto flex font-medium flex-wrap">
                    <li className="md:mt-0 mt-1">
                        <a href="#" className="
                        transition-all
                        duration-300
                        hover:underline
                        ">Gadgets</a>
                    </li>
                    <li className="md:mt-0 mt-1">
                        <a href="#" className="
                        hover:bg-black
                        hover:text-white
                        transition-all
                        duration-300
                        rounded-full
                        px-5 py-2">Acessórios</a>
                    </li>
                    <li className="md:mt-0 mt-1">
                        <a href="#" className="
                        hover:bg-black
                        hover:text-white
                        transition-all
                        duration-300
                         rounded-full px-5 py-2">Gadgets</a>
                    </li>
                    <li className="md:mt-0 mt-1">
                        <a href="#" className="
                        hover:bg-black
                        hover:text-white
                        transition-all
                        duration-300
                         rounded-full px-5 py-2">Outros</a>
                    </li>
                </ul>
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
