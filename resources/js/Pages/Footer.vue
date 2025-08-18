<script setup>

const props = defineProps({
    class: Object
});

</script>

<template>
<div class="h-auto
        bg-blue-950
         border-gray-300 text-white"
         :class="class">

            <div class="container__own mx-auto py-7 flex justify-between flex-wrap">

                <div class="w-1/2">
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
                <div class="w-1/6">
                    <div className="font-medium">Categories</div>
                    <div className="mt-3 text-sm font-light">
                        <ul className="flex flex-col gap-2">
                            <li><a href="#">Celulares</a></li>
                            <li><a href="#">Eletrodomêsticos</a></li>
                            <li><a href="#">Termos e Condições</a></li>
                        </ul>
                    </div>
                </div>
                <div class="w-1/6 font-medium ">
                    <div>Populares</div>
                    <div className="text-sm mt-3 font-light">
                        Subscribe to our newsletter to receive <br/>
                        updates and exclusive offers.
                    </div>
                </div>
            </div>
            <div class="text-center text-sm py-4">
                &copy;2025 Todos os Direitos Reservados.
            </div>
        </div>
</template>
