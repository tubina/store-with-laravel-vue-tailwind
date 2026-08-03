<script setup>

const props = defineProps({
    class: Object
});

</script>

<template>
<div class="px-2 sm:px-0 sm:pt-5 pt-2 mt-20 h-auto bg-white-950 border-t border-gray-200 text-black" :class="class">

            <div class="sm:w-[80%] mx-auto py-7 flex flex-wrap justify-between ">

                <div class="sm:w-1/2">
                    <div className="font-medium">Logo</div>
                </div>

                <div class="w-1/6">
                    <div className="font-medium">About</div>
                    <div className="mt-3 text-sm font-light">
                        <ul className="flex flex-col gap-2 ">
                            <li><a href="#">Sobre nós</a></li>
                            <li><a href="#" >Contato</a></li>
                            <li><a href="#" >Termos e Condições</a></li>
                        </ul>
                    </div>
                </div>
                <div class="sm:w-1/6">
                    <div className="font-medium">Categories</div>
                    <div className="mt-3 text-sm font-light">
                        <ul className="flex flex-col gap-2">
                            <li><a href="#">Celulares</a></li>
                            <li><a href="#">Eletrodomêsticos</a></li>
                            <li><a href="#">Termos e Condições</a></li>
                        </ul>
                    </div>
                </div>
                <div class="sm:w-1/6 font-medium sm:mt-0 mt-4">
                    <div>Populares</div>
                    <div className="text-sm mt-3 font-light">
                        Subscribe to our newsletter to receive <br/>
                        updates and exclusive offers.
                    </div>
                </div>
            </div>
            <div class="text-center text-[13px] py-7 mt-5 border-t text-gray-600">
                &copy;&nbsp;2026  SIDOWCASH. All rights reserved.
            </div>
        </div>
</template>
