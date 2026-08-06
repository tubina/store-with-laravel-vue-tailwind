<script setup>
import Header from './Header.vue';
import Footer from './Footer.vue';
import { useStore } from '../stores/store.js';
import { ref } from 'vue';

const props = defineProps({
    product: Object
})

const mainImage = ref(
    `/storage/${props.product.product_images[0].path}`
);
setTimeout(()=>{
 //console.log(mainImage.value)
},1000)

const store = useStore();

function addToCart(product){
    store.addToCart(product);
    store.showToast(props.product.id,
    props.product.product_images[0].path,
    props.product.name,props.product.price)
}

function addToFavorites(product){
    store.addToFavorite(product);
    store.showToast(props.product.id,
    props.product.product_images[0].path,
    props.product.name,props.product.price)
}

function changeImage(imagePath){
    mainImage.value = `/storage/${imagePath}`
}

function changeImageCel(imagePath) {
    mainImage.value = `/storage/${imagePath}`
}
</script>

<template>
    <Header></Header>

   <div class="sm:mt-10 sm:pt-1 mt-20">

        <div class="sm:flex items-start sm:max-w-7xl   px-2 sm:mt-16 mt-7 mx-auto gap-4 ">
 
            <div class="flex flex-col  sm:w-[30%] bg-white border rounded-xl border-gray-200 pb-5">

                <div class="flex font-semibold text-red-500 text-sm pt-5 pl-5 pb-2">
                   <div class="flex items-center gap-1 bg-red-100 rounded-lg px-3 py-1">
                        <div class="w-2 h-2 bg-red-500 border rounded-full animate-blink"></div>
                        <div class="text-xs">AO VIVO</div>
                    </div>
                </div>

               <div class="flex h-min sm:px-5 sm:pb-3 p-3 pt-0 gap-1"> 
                    <!-- thumbnails --> 
                        <div class="flex flex-col gap-1">
                            <div v-for="pro in product.product_images" class="w-10 h-10  ">  
                                <img class="w-full h-full object-cover
                                border rounded-md
                                transition-all
                                duration-300
                                hover:border
                                hover:border-blue-950"
                                    :src="`/storage/${pro.path}`"
                                    @mouseenter="changeImage(pro.path)"
                                    @click="changeImageCel(pro.path)"
                                />
                            </div>  
                        </div>
                    <!-- imagem principal -->
                    <div>
                        <img :src="mainImage" class="border rounded-xl object-cover" />
                    </div> 
                </div>  
 
               
                <div class="text-sm px-3 py-2 text-center text-gray-500">
                  Lacrado, nota fiscal e 1 ano de garantia oficial. Frete grátis para todo o Brasil, enviado em até 48h após o encerramento.  
                </div>

                <div class="flex justify-around mt-3 text-md text-gray-600">
                    <div class="grid grid-cols-2 w-full gap-2 px-5">
                        <div class="w-full bg-gray-100 px-3 py-1 border rounded-md">                        
                            <div class="text-[13px] text-gray-500">Processador:</div>
                            <div class="text-[15px] font-bold">5 GhZ</div>
                        </div>
                        <div class="w-full bg-gray-100 px-3 py-1 border rounded-md">                        
                            <div class="text-[13px] text-gray-500">Memória:</div>
                            <div class="text-[15px] font-bold">256 GB</div>
                        </div>
                        <div class=" bg-gray-100 px-3 py-1 border rounded-md">                        
                            <div class="text-[13px] text-gray-500">Cor:</div>
                            <div class="text-[15px] font-bold">Titanio</div>
                        </div> 
                        <div class=" bg-gray-100 px-3 py-1 border rounded-md">                        
                            <div class="text-[13px] text-gray-500">Marca:</div>
                            <div class="text-[15px] font-bold">Apple</div>
                        </div>
                        <div class=" bg-gray-100 px-3 py-1 border rounded-md">                        
                            <div class="text-[13px] text-gray-500">Sistema Operacional:</div>
                            <div class="text-[15px] font-bold">IOS</div>
                        </div> 
                        <div class=" bg-gray-100 px-3 py-1 border rounded-md">                        
                            <div class="text-[13px] text-gray-500">Modelo:</div>
                            <div class="text-[15px] font-bold">Iphone 17 Pro Max</div>
                        </div> 
                    </div>
                </div>

            </div>
            <!-------------------> 
            <div class="sm:w-[40%] ">

                <div class="bg-white p-5 rounded-xl border border-gray-200">

                    <p class="sm:text-2xl sm:font-medium text-2xl">
                        {{product.name}} 
                    </p>
                    
                    <div class="flex gap-2 py-3 font-bold">
                            <div>
                                <ion-icon name="alert-circle-outline" class="text-2xl text-orange-600 "></ion-icon>
                            </div>
                            <div>
                                <div class="uppercase">Como funciona o leilao</div>
                                <div class="pb-5 text-sm">
                                    <p class="font-light">Lorem Ipsum é um texto padrão em latim usado na indústria gráfica e de design para preencher espaços de layout. Ele serve para testar a tipografia, a formatação e a aparência visual de páginas antes de receberem o conteúdo real.</p>
                                </div>
                            </div>
                    </div> 
    
                    <div class="flex gap-3">
                        <div class="w-1/2 border rounded-xl px-5 py-3 bg-[#F1F4F8]">
                            <div class="flex items-center uppercase font-normal text-gray-500">
                                <ion-icon name="alarm-outline" class="text-sm"></ion-icon>
                                <div class="text-[12px] pl-1">
                                    Encerra em 
                                </div>
                            </div>
                            <div class="text-2xl">
                                <span>100.000</span> <span class="text-lg font-bold text-gray-500">Tokens</span>
                            </div>
                        </div>
                        <div class="w-1/2 border rounded-xl px-5 py-3 bg-[#F1F4F8]">
                            <div class="flex items-center  uppercase font-normal text-gray-500">
                                <ion-icon name="flash-outline" class="text-sm"></ion-icon>
                                <div class="text-[12px]  pl-1">
                                    Seus lances
                                </div>
                            </div>
                            <div class="text-2xl">
                                5
                            </div>
                        </div>
                    </div>

                    <div class="bg-[#FCF1E7] text-[#EC7B00] px-5 py-3 mt-3 border rounded-lg border-[#F3BE91]">
                        <div class="uppercase text-[13px] font-semibold">
                            Valor Atual
                        </div>
                        <div class="text-4xl">
                            R$<span class="pl-5"> {{ 389.45 }}</span>
                        </div>
                    </div>   

                    <div class="flex gap-3 py-3">
                        <div class="w-1/2 border rounded-xl px-5 py-3 bg-white">
                            <div class="flex items-center uppercase font-normal text-gray-500">
                                <div class="text-[12px]">
                                    Valor Inicial
                                </div>
                            </div>
                            <div class="flex gap-3 text-xl line-through text-gray-500">
                                R$ <span class="">549.99</span>
                            </div>
                        </div>
                        <div class="w-1/2 border rounded-xl px-5 py-3 bg-white">
                            <div class="flex items-center  uppercase font-normal text-gray-500">
                                <ion-icon name="trending-down-outline" class="text-sm"></ion-icon>
                                <div class="text-[12px] pl-1">
                                    Sua Economia
                                </div>
                            </div>
                            <div class="text-xl text-[#009351]">
                                R$ 245.58 <span class="text-xs pl-2">(90%)</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="w-full ">
                        <button class="flex items-center justify-center gap-2 uppercase border w-full
                        bg-orange-500 shadow-orange-500 shadow-sm
                        py-4
                        bg-gradient-to-r from-orange-400 to-orange-700
                        text-white px-6 rounded-lg font-semibold 
                        transition duration-300
                        hover:scale-105">
                        <ion-icon name="hammer-outline" class="text-lg"></ion-icon>
                        Escolha Um Valor</button>
                    </div>  
                </div>

                <div class="bg-white p-5 rounded-xl border border-gray-200 mt-4">
                    <div class="flex justify-between">
                        <div class="flex items-center gap-2 uppercase font-semibold">
                            <ion-icon name="people-outline" class="text-[#EC7B00] text-xl"></ion-icon>
                            <div>Quem está participando</div>
                        </div>
                        <div class="text-xs text-gray-500 border rounded-xl px-2 py-1 bg-gray-100">7 disputando</div>
                    </div>
                </div>

            </div>
            <!------------------->
            <div class="sm:w-[30%] bg-white 
            sm:px-5 sm:mb-5 mb-4 mt-3 sm:mt-0 pt-5 pb-5 rounded-xl border">
                <div class="uppercase font-bold">
                    Comprar agora
                </div>
                <div class="text-sm text-gray-600 py-3">
                    Não quer esperar o cronômetro? Leve o produto na hora, sem disputa.
                </div>
                <p class="text-2xl gap-2 font-semibold space-x-2">
                    <span class="text-black">R$ {{ product.from_price }}</span>
                    <span class="line-through text-gray-500">R$ {{ product.price }}</span>
                </p>
                <div class="text-sm text-gray-600">ou 12x de R$ 19.00</div>
                <div class="flex flex-wrap p-3 mt-4 text-sm rounded-lg 
                bg-[#E6F5EE] text-green-700 font-normal border border-[#8ACEAF]">
                    Seus 12 créditos usados neste leilão viram desconto: -R$ 24,00
                </div> 
                <div class="flex justify-center sm:gap-4 md:gap-1 gap-1 mt-3">
                    <button @click="addToCart(product.id)" class="flex justify-center 
                    items-center py-3 gap-2 w-full md:px-3
                    bg-black hover:bg-gray-700 border-blue-300 rounded-md text-white font-medium">
                        <ion-icon name="cart-outline" className=" text-2xl"></ion-icon>
                        <span class="">Adicionar ao Carrinho</span>
                    </button>
                    <button @click="addToFavorites(product.id)" 
                    class="flex flex-shrink-0 items-center p-3 border bg-black hover:bg-gray-700 rounded-md">
                        <ion-icon name="heart-outline" className="text-white text-2xl"></ion-icon>
                    </button>
                </div>

                <div class="flex flex-col gap-1 mt-5 text-sm font-normal border-b pb-5
                text-gray-500 border-gray-300">
                    <div class="flex items-center gap-2">
                        <ion-icon name="shield-checkmark-outline" class="text-green-700"></ion-icon>
                        <p>Pagamento protegido e criptografado</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <ion-icon name="shield-checkmark-outline" class="text-green-700"></ion-icon>
                        <p>Envio em até 48h após a confirmação</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <ion-icon name="shield-checkmark-outline" class="text-green-700"></ion-icon>
                        <p>7 dias para devolução sem custo</p>
                    </div>
                </div>
                 
                <div class="flex gap-4 mt-5">
                    <div class="flex flex-col flex-1 rounded-md border border-gray-300 py-3 px-3 items-center bg-white
                    hover:border hover:border-blue-950
                    transition-all duration-300">
                        <span class="font-semibold">Free Shipping</span>
                        <span class="text-sm text-gray-500">Free shipping over order $120</span>
                    </div>
                    <div class="flex flex-col flex-1 rounded-md border border-gray-300 py-3 px-3 items-center bg-white
                    hover:border hover:border-blue-950
                    transition-all duration-300">
                        <span class="font-semibold">Flexibe Payment</span>
                        <span class="text-sm text-gray-500">Free shipping over order $120</span>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="sm:max-w-7xl p-2 mx-auto mt-10 mb-20 ">
            <div class="flex flex-row flex-wrap gap-4 text-sm rounded-lg">
                <div class="text-xl">{{product.name}} </div> 
            </div>
            <div class="text-sm mt-5 text-gray-500 ">
            {{ product.description }}
            </div>
        </div>

   </div>

    <Footer></Footer>
</template>
