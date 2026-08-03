<script setup>
import Footer from './Footer.vue';
import Card from './Card.vue';
import Header from './Header.vue';
import { defineProps, onMounted, reactive } from 'vue';
import { useStore } from '../stores/store.js';
import { router, usePage } from '@inertiajs/vue3';

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
}

const products_aux = reactive({
    pro: props.products,
    filtered: props.products
})
const selectCategory = ((e) => {
    console.log(e)
    if(e === null) {
        return products_aux.filtered = products_aux.pro
    }
    products_aux.filtered = products_aux.pro.filter(item => item.category_id === e)
})

const params = new URLSearchParams(window.location.search);
const logout = params.get('logout');
if(logout ==1){
    console.log('Usuario fez logout')
    store.$reset();
    router.get('/home');
}

onMounted(()=> {  
/****** VERSAO 1 *******/
/***********************/
    //let storage = JSON.parse(localStorage.getItem("store"));
    // const urlParams = new URLSearchParams(page.url.split('?')[1]);
    // const login = urlParams.get('login'); 
 
    // // Primeiro login → redirecionamento
    // if(login === 'true') {
    //     store.login = true; 
    //     localStorage.setItem("store", JSON.stringify(store.$state));
         
    //     window.location.href = '/home';
    // } 
  
    // // Se o usuário está logado
    // if(storage.login === true){
    //     console.log("usuario Primeira sincronização após login");
  
    //     if(storage.item_id.length > 0){
    //         store.addToCart(storage.item_id);
    //     }
    //     if(storage.favorites_id.length > 0){
    //         store.addToFavorite(storage.favorites_id);
    //     }  
    //     initDefault();
    // }
/****** END VERSAO 1 *******/
/***************************/

/****** VERSAO 2 *******/
/***********************/

//if you are logged in and this is your first time
// if(user && storage.login){
//     console.log('usuario logado e storage true')
//     storage.login = false
//     localStorage.setItem("store", JSON.stringify(storage))
// }

let storage = JSON.parse(localStorage.getItem("store")); 

    if(user){
        const urlParams = new URLSearchParams(page.url.split('?')[1]);
        const login = urlParams.get('login'); 

        /* com o uso do (onMounted) ele executa 
        dentro do unmounted mas nao executa o  
        store.addToCart, por isso eu peguei a 
        URI e fiz um reload completo na pagina, 
        assim ele executa */
        if(login==='true'){
            store.login = true;
            store.firstLogin = true;
            router.get('/home'); 
        } 
        if(store.login && store.firstLogin){   
            let hasCart = storage.item_id.length > 0;
            let hasFavorites = storage.favorites_id.length > 0;

            // 1. sincroniza carrinho
            if (hasCart) {
                store.addToCart(storage.item_id);
            } 
            // 2. sincroniza favoritos
            if (hasFavorites) {
                store.addToFavorite(storage.favorites_id);
            } 
            //router.get('/home');
        }else{
            console.log('user - second login')
        }
        initDefault()   
    }else {
        if(store.qtd_cart >= 1 || store.qtd_favorites >= 1){
            console.log('usuario deslogado')
            console.log(store.qtd_favorites) 
        }else{
            store.$reset()
        }
       
    }  
 
}); 

</script>

<template>
    <div class="bg-[#fbfbfb]">
        <div className="relative"> 
            <Header></Header>  
            <div className="sm:flex sm:flex-row flex-col justify-around items-center 
            w-full sm:mb-10 -z-50 sm:h-[550px] h-[450px] border-b mx-auto mt-24 sm:mt-0 bg-white">

                <div className="flex flex-col sm:pl-0 px-4">
                    <span className="sm:text-5xl text-3xl font-semibold text-black">Lorem ipsum dolor sit amet,</span> 
                    <span className="sm:text-5xl text-xl font-semibold text-black flex-shrink-0">consectetur adipisicing elit.</span>

                    <div class="sm:hidden mt-5">
                        <div class="">
                            <img class="sm:w-96" src="https://www.apple.com/v/iphone-17/d/images/meta/iphone-17_overview__d4o74q28yjma_og.png?202512230653" />
                        </div>
                    </div>

                    <span className="sm:text-lg text-lg font-semibold text-black flex-shrink-0 mt-5">Get incredible deals, up to 12% off</span>
                    <button className="flex justify-around items-center gap-3 bg-black text-shadow-xl text-white font-bold 
                    text-sm py-3 px-8 w-max mt-4 rounded-md shadow-2xl
                    hover:bg-white hover:border hover:transition-all ease-out hover:text-black">
                        <span>Order Now </span>
                        <ion-icon name="chevron-forward-outline"></ion-icon> 
                    </button>
                </div>

                <div class="hidden sm:block">
                    <div class="">
                        <img class="sm:w-96" src="https://www.apple.com/v/iphone-17/d/images/meta/iphone-17_overview__d4o74q28yjma_og.png?202512230653" />
                    </div>
                </div>

            </div>

            <div className="sm:w-[80%] mx-auto px-2 sm:px-0 rounded-md sm:mt-16 mt-5">
                <div class="sm:flex justify-between sm:h-28 gap-4 sm:space-y-0 space-y-3">
                    <div class="flex-1 flex
                        justify-start
                        items-center
                        gap-2 rounded-md  px-3 shadow-md 
                        sm:h-24
                        h-20
                        bg-white
                        ">
                        <img class="sm:w-24 sm:h-min w-12" src="https://p1-ofp.static.pub/MOTO/edge70/edge-70-PANTONE-Gadget-Grey-UK-bundle-product.png" />
                                            
                        <div class="flex flex-col">
                            <p class="uppercase font-bold text-sm">Gadget <br>Accessories</p>
                            <p class="text-sm text-slate-500 mt-1">Delivered in 7 days</p>
                        </div>
                    </div>
                    <div class="flex-1 flex
                        justify-start
                        items-center 
                        gap-2 rounded-md px-3 shadow-md
                        sm:h-24 
                        h-20
                        bg-white
                        ">
                        <img class="sm:w-24 sm:h-min w-12" src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxITEBISEBMQEBUVFRAVEA8VEBAVEBAVFRIXGBUVFRUYHiggGBolGxUWITIjJSkrLy4vFx8zODMsNygtMCsBCgoKDg0OFw8PFSsdFR0rKy0rLSsrLS0rLS0rLS03KystKy0rKystKy0rLTctKystLSs3LSstKzc3Ky0tNystK//AABEIAMIBAwMBIgACEQEDEQH/xAAcAAEAAQUBAQAAAAAAAAAAAAAABQIDBAYHAQj/xABREAABAwIBBggIBwwJBQAAAAABAAIDBBEhBQYSMUFREyIyYXGRobEHI1JygbLB0RQkM3OCkvAXJUJiY4OTorPC0+EVFkRUZHSEo9JDU5Skw//EABYBAQEBAAAAAAAAAAAAAAAAAAABAv/EABYRAQEBAAAAAAAAAAAAAAAAAAABEf/aAAwDAQACEQMRAD8A7iiIgIiICIiAiIgIiICIiAo6XLlO1xa6VoINiLOwPTZZNfUcHE9/kgkc52DrsuZ5S+Vf0juCix0VmWqY/wDWi9L2jvWRFWxO5Mkbuh7T3FcoKpKaY7Ai5HDK5vIc5nmuI7llR5bqmkaM8v0nafrXTTHUkWkU2c9QBxtB/S2x/VspKhzsDyA+Ijna4HsICaY2VFj0lYyS+je4tcEWIve3cVkKoIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIg17PGqsyOMfhuufNb/MjqWlVx8Y7pHcFN5zVOnVHcyzB6MXdpPUoGqPHd0qNRZKpQlGqC60JoqtoXtkVk24qqyZr9K8ZyV5k7B5RG7ZBPGfztj73qZUDm27F/mt7yp5aZEREBERAREQEREBERAREQEREBERAREQEREBERAREQc4yh8tL85J65UZV8t/nHvXlbXPE0l7EcJJ65SqPjH+c7vKy1Fgles1j7bCqFcYNyDGrah7ZNEEW0WnEbSSNYVNJWvLmg6BBvci9xYdJ3LPfBpYlrSd5GNt2pUMo2gg6IuNViRbDHC6upjPpjgrtKzjXVmDDmWdSjEqK2PNvlu80d62BQGQflbb2O7HN96n1pkREQEREBERAREQEREBERAREQEREBERAREQEREBERByOvi48h/Gee0r2o5b/ADn+sVm1cPLPne1Yko8Y/wA5/rFZajD2q/GFZIxWREEVkNCqARgVYCg9AWRRO49t6tgKiJ1nhEbXkI+OHzcnrxrYlq2bcl6g+Y/vb7ltK2yIiICIiAiIgIiICIiAiIgIiICIiAiKl0gBAJAJvogkXNtdhtQVIvHOA1kD0qMyhlpsT2t0Q5pBL5OFiaGW1ABxBcTzYYa0Eoigq7OqCMA2kkGk0HQYTa+ANzYHGw17VRT530zpGx+MbpEgPeGtaDa4vc3F9V7a0GwIseCuie4sZJG9wBJY17S4AGxJAO8hXyg0Goi4rug9yiLcd/nO7ytiqGcU9BUEG2keNznd5Wa1EfIOMVfiCtVI4yv06islgVwNRgVxrUCyxpNazSFiTtxRE1mk+9SfMPsW6LSM08Kn6DlsNVnLSse2MzNc5zmtDWcexJtxi3BuvatspZFTpjnHoKB43jrQVIiICIiAiIgIiICIiAiIgIUXhKDm2VfCrDG57A5ukxxa4NY9xBBIIxAH4J2rWcreEVzpAfgz3yBg0S9kTXCNwD8Lh5DTgcN3MsClfVfBhHHROEoq21Bke1jRLo1JmaXlxDjbBlt20aldyvkCtq6kzFkLLtjaGukc5zWtuSLMBBBLjr2ADeSGVHlfK1SyKSKKJjJnObGZJHO0g2MvL7adtGzXfgbt6sz5KryyV0lfFCBOyFvBgNFnOALtJgZawN8ceLs1qSyfmVX8HBGZ5AIHEx6MLtoI0dJ7gNGxItbFXZcwImB/wupc1sj+EkbLU08cZdhiQBcWAGF9g3BBqdVk8Q5UpmCeSpsxr3Pe4uLX8G4GxJOBt3raJpxtsoxrMnueX0pD5Wy6D5C+VxdaN9ywvNnNwGLcNSsVcpvbfqQZ4ynwbg6Nzo3Nvoua4i19dtikc3c9Kls2g48O14OkJHPu3QjcbtNzYmwvgtQkcsjIjvHg7mzH/acgzv66TSuAAbGHFo0Q4utcgbQtjB8bJ5zvWK5lk35SP5yL12rpTTx5Ol3rLNajGqNav0axpTir1E7FRUowK6xqpYFfjagpc1Y8zFmlqtyMwVZa5nVPwdI9+4xg/SeB7Vz+bLV2u1kgYXPONgw7FvefrPvZOdz6btqIx7VyR7rB/MHdmPsWoj6gZlqnZBBPPLBAyZkbg5zhGdJ8enYOw5z6FkNyjTSg8BPFKbG2hOyQk23XK0UZNcaWCmqYGTthZE0G7CCY49DSAdttfZtUZDm1SxVEVQyKohdE4uAa28ZuLEG7dWvURrTTHQK7KYjfGxpe50r9FgFjtA0ji2w4zetWcqZwGnYXv03AOa02wIu7RBsdl9vOtfygxkzWkufGWkFj8QAcMDYi4uAcCDcAgrJmDZGFkjy+4Gk7BpJDgb2tbWFdMZcefkeHGdj5UZ0fSQFt+T6rhI2v1XvcbiDYrlsuakDjcPkO8O4JzdVtQH2suhZrYROaTpWcMd/FGPYoYmUREBERAREQEREBWK51opDuY89TSr6i86p9CgrH+RTVLvqxOPsQcKPhTqn2NPT0dOLDEsMj8duk63co+fPvKz73rXtHkxxwxgdBY0FavQNsD6B1BZJQX6nKVVJfhaqrlvrD6iVw6nEqPFM0A2GvXicenesgqmTUeg9yDLzJb8bHNHL3D3rbKk8cfbaFq2Y4+MuO6J/aWraJuWOkd6CxP8ofOPrK9k59nTWthFKQbC4tuOzXZY7vlPpfvKqkPy5/IzexBF5ONpIzYmz4ybAk2a8EmwxOAJW4f1kpg55e90QJNjJDNGCb6gXtFytQyR8tD89B+1augh2L/ttWa1EM/OOjP9oh+uArtJnDSf3mnHTNGPasyYqqmjBBuAfQEGfT5x0Rt8bpL7vhEN+9SEOVKc8menPRNGfarVDRxPaNKOJ3TGw94V52QqU8qmpj0wRH2IMptQw6nsPQ9p9qrLbjDFRrs1aA/wBjpP8Ax4vcrf8AVGgGIpYGne1mif1bIiNz/Z96azmNKf8A24lxmc4S9EvcV1vPfIUDMnVb2te10bGuZaafQ+VZfSZpaLsN4NlyKc/K/ne5y0j6Ra64B3gHsV7JkHCyFox0baesBt8bEjbbG3ON4vHwzAQMedQjY4nm0ASpXJ9V8DyW+pkHHETp5G7TI9umGdbg0cwCjVWs6st5Jo7MrDFpuaCIBG6WS2NnFjQS0a+MbdK1qDKtPKzhaMiWMO0XRljg5mANuOLg2Iw1YrimWBJNNJNMXzSSOLnPN8XO2AbBqAGwW2WU9mFl2Wnk4JwLonEg8XURgTfbq9mrVWXXmMY4AgYHVrC23NiNog4otxnX3nUtcoI3PoIJXtDJODidK0avGtDusOcQtizYPiXeefVao1UwiIqyIiICIiAiIgLXPCNJo5Iygf8ADVA+tGW+1bGtQ8Lk2hkasO9sTPrzxs/eQfOFHyT0+xX7rGp5QBY79yrNS3n6kF0q1NyT0HuVBqm/jdQ96ty1IIIAPYgmsxR46Q/k+9wWyn5QdLfWWu5hjxkx/Jt7XfyWxX8a3pZ6yDFbyx0jvWVkqDSjq3eTTyHrLViR8tvS3vU5myz4plE/4e3W9qDVsjjx8Hz1P+2at6vi5aTkcfGIPnof2jVuRdi77fb+azWoolcsylbxVGOdipikGCKkcjuwspdoUJQmxU1C64RKqsllW4IAjLVs/m/e2tG+F3Y4H2LhsnKkHzncV3fP5v3uq/mZfVXCTy3dLu1aHdmHSyc22OlSM9N6cKQ8J95MhVZiuWuippWuHJDGvhcR9VpUfmy69BR3201Nf9C1U5Pq3NoJqGRhlaxz4pBfjcCW8Ui+zQLe3cpFrhlHC8sBD9EsAlHSDca91gpnOmt4Op026FwGPAta2k27WkaiQ22POFi5WyOaScwVRIYD8qLXnjuTdjb46QsBuJx1FUZNpX5SyiLM4r3B0gGpkbcAOoBo9CqPo3InGogP8LGfSI2kKRzVPEePxgesfyUVkRzm0D3SNLHXlga0gi7WTPjDhfYWtDhzKSzUPyo8z95RU+iIqgiIgIiICIiAtR8KeTZanJksEOjpvfBbSdZtmStecehi25R2XBdjR+NfsPvQfO/3Nq/dT/pj/wAV59zWv30o/PSfw1210StOjQcX+5nXeVSfpZf4aqb4MazbJSD85Mf/AJrsTmK25qDl+Ss2ZKJ7+FfG8yMbbQ0sNFx16QG9Vg+MHSFsmc58aB+THa93uWstPH6+xqCabPQ01LTy1FK6Z8jmsDmyTl73uLi0BjXAahbVsV6mzqpI2SMjyZVBsgDZRwVSQ4A3sSX4YrV/CQfvVSDfJEf9l/vXNmMGiMAg6tF4QckMcHMoQC0gtOg8kEG4OMivnwr5PF7UN7m58UMeuRciIVBCDr33WaD+4M/QR/xFW3wxUg5NE0fmIv8AmuO2VD0H0/NlYtxENOcDYCnbc4jddUDOOW+ETANhEAx5uT09Siss5SigaHzSCFpOiHEuF3a7XAOwHqUOc7aIi3wuPVblyfw+1B07JDGTwiSVp0iXA6Lnx6jbUwhXn5MjHJMrfzrnevdYGZlayWiY+J4kYXSaLxcg2dbWQL4i2rYpZ7kGpZ/ZPAybWuD5HWgmwcI7ck7mhfPYPH9Le4L6Qz7N8mV3+WqP2ZXzaw8YfQ7gg7nmg6+T6P8Ay8A6owFlVcDg8TRYvA0XsvbhWXvo32OBJIJ3kbbiOzHffJ1J800dVx7FOKNITKeRqetvw2kdhFmiSI9Dhh0EEHXjgszNfMTJ9JIyd1TI4tN2wuMMYc7YXNjaHSEbtXMVnOiadYBtqJAw6FVHE0G4AB2mwufSmpiTyrlDhSA0FrG8kbTzkbFm5r8qTob2E+9QzQprNzlu832hCtgREVQREQEREBERAUflZtw0HHX7FILS/CblKSCKF0UZkJe8OAnliIbo6/FuaXY2wxQSBp27h1BWnU43DqC5Q7wjuZyoZR01db+8Sn3Ux5EzfNqA714yg6k6Abh1BWXQjcOpcyPhOb5Vf0AZPI7Y1Wzwmxbfh3SY6E91kEtnS74y4bBFDhsuXy39i1qV1ibbQQehZMmW46p75WOe7CNp0owwi2kbWBIPKWBUSIPPCebZPohzx9kP81zxnJHQt/8ACtJ8Wom9J6mMHtWgNPFHQEFJVsqtyoKDwqh2tVrxo4zekd6DtHhLydLPTMZCwyObM1xALRZoa4E3cRtI61z12bVZj8Wk64z+8uzVFiSDYjHYDtB2rHylQcDwRe0aMjtC4Eekx5BLQWlmIs04g4YYbgkvBRTvhyTTxytLHtdPpNOsXmcR2EH0ranSLVaCtEUYYN7jsGvHUMFcdllBmZ3G9BWDfT1A/wBty+a4HavR2LuucGWQaWoB/wCzNf8ARlcHh2IOz5guJydTWIHFeOTfVK8b+ZbCNLyv1QtX8Hr7ZOgBuPlrYbDM8g9S2PhelRdZAafKPU33K41h8t3Uz3LCNSBrNupWZcqxtBvJGMDrewe1MNSrb31yn6DLdZap3NzlnEniu1huwjcBuWknOylabGpphzGoiv3rZ8zMocO4Pj0Xx+M8a1wLeVsI14oNxREVQREQEREBERAWqZ70rZdBjmB+iCR4x7LaWH4IPkra1C5Yiu/0BByquzPgdrjmb5lQ13rsURNmLBs+HjnPwRw7DddVkpftYrHfSjmQclqMw4/wZ5W8zqGR562OWI/McbKmL6dPPF3hdgdRqy6jQcwyPkAxNe1zoJruB0o3uewcXUbgY+9Zf9E7mMHQ0LdXUPGefxh6jV63J3Mg1LK+QoKpsYqDODHpaBjkY0cYNvcOY6/JGq21RMng9ozyZqtnSyF/tap7KVbE2wmmEOlfRvNwVwNdsRfWFGS5NppcRPJ0sqseu5ugiz4N4dlZN6aJn8dUO8Gzfwa0fSpnj1XOUqM2fIq68f6i47l6ch1A5FdUDzmsf32QQEng2lvxaujI5xWNPUISO1W/ucVOyooj+cnHrRhbD/RdcNVcD51LF/NemnykOTNSP86N7fVCDZjVOvs2+xUyylzmF1nFl9C+kQy97kC9r4nHnO9azp5UB5NC/oMw7yFX8OrwMaWN53MnYB1uPsQbG+YlU3Wqy12U5Dox08dNve+Rr+q3uKrgzbnedKqq5X/iMAaztw/VCCfyjCXQSgNkfpRyAaMb33uwgckLlwyS4fgj0Cy6jk/JccfIab+USS7rOr0LHkyQNyC5mVkIS0UT3BwI02WNRUW4jy0WbpWGAGAU8c0oTyo4nec0u9ZSmZtMG0gabCz5e11/apzQbvHWFFahHmbSjVBTD/TRX7llNzdiAwZGOiNg9i2YRjn+q73KoRcx6rd6CBiyS0asOgAexSuQKTQnBF9ZGvYW+8rJFNzO+sR3FZdFDZ7cBrG0kqiaRERBERAREQEREBYlTFcrLXhCCLfTrHfTKYdErZhO5BCPpBuHUrTqTp6yp40/MqDTc3Yg1v4Jien2K5HSa/ttU8KPmVQpcCg+cvCNk4ukg5mP7XD3LVXZAwBu7UF9A5dzWEjmm2ptu1YDszRbV2IODf0Q9pu1xHOLgqsCrbyZph0SSD2ruD8yx5PYrLsyR5PYg40zKle3VNMelxd6yuszmyg0gGQnEYGKIg9J0brrpzIHk9itOzFF+T2ILTmG+o7VTttt3WxW8nIWOrelXkBjuDs0NLTe+GAxuL6ze6DSWsO4q9HTk7FuQyFzK6zIvMg1anpTuUhNk7m+11sEeSbbFJOoBuQRWblLowkW/wCo/uapURLIpKbRaRzk9g9yv8EgwREqhEssxKpkQ3IMQQq5HFiPQsrQXoag9REQEREBERAREQEREBERAREQEREBeWREHmgNw6k4Mbh1BEQecE3yW9QTgm+S3qCIg90BuHUmiNwREDQG4dS90RuHUiIGiF6iICIiAiIgIiICIiAiIgIiIP/Z" />
                        
                        <div class="flex flex-col">
                            <p class="uppercase font-bold text-sm">Appliances</p>
                            <p class="text-sm text-slate-500 mt-1">Delivered in 7 days</p>
                        </div>
                    </div>
                    <div class="flex-1 flex
                        justify-start
                        items-center 
                        gap-2 rounded-md px-3 shadow-md
                        sm:h-24
                        h-20 
                        bg-white
                        " >
                        <img class="sm:w-24 sm:h-min w-12" src="data:image/jpeg;base64,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" />
                        
                        <div class="flex flex-col">
                            <p class="uppercase font-bold text-sm">Cameras</p>
                            <p class="text-sm text-slate-500 mt-1">Delivered in 7 days</p>
                        </div>
                    </div>
                    <div class="flex-1 flex
                        justify-start
                        items-center 
                        gap-2 rounded-md px-3 shadow-md
                        sm:h-24
                        h-20
                        bg-white
                        " >
                        <img class="sm:w-24 sm:h-min w-12" src="data:image/jpeg;base64,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"/>
                        
                        <div class="flex flex-col">
                            <p class="uppercase font-bold text-sm">Eletronics</p>
                            <p class="text-sm text-slate-500 mt-1">Delivered in 7 days</p>
                        </div>
                    </div>
                </div>
            </div>
 

            <div class="bg-gray-50 sm:mt-16 ">
                
                <div class="w-[80%] mx-auto flex justify-center sm:pt-3 pt-0 pb-5 flex-wrap mt-18">
                <!-- <p class="text-2xl font-semibold">Nossos Produtos</p> -->
                    <div class="w-full">
                        <ul class="flex justify-center mb:gap-3 mt-7 gap-3 text-[16px] font-medium flex-wrap">
                            <li class="md:mt-0 border px-4 py-2 rounded-full shadow-sm transition-all ease-out cursor-pointer
                            first:bg-black first:text-white
                            hover:bg-black hover:text-white">
                                <a href="#" class="" @click.prevent="selectCategory(null)">Todos</a>
                            </li>
                            <li class="md:mt-0 border px-4 py-2 rounded-full shadow-sm transition-all ease-out cursor-pointer
                            first:bg-black first:text-white
                            hover:bg-black hover:text-white" v-for="cat in category" :key="cat.id"
                            @click.prevent="selectCategory(cat.id)">
                                <a href="#" class="">{{ cat.name }}</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="sm:w-[80%] relative mx-auto
                grid
                sm:grid-cols-5
                grid-cols-2
                sm:gap-2
                gap-1
                mt-3
                pb-24
                px-2">
                <!--sm:justify-between--> 
                    <div v-for="product in products_aux.filtered" :key="product.id"> 
                        <Card :product="product"/>
                    </div> 
                </div>
            </div>

            <!--Details Foot-->
            <div class="w-full py-10 border-t border-gray-200 bg-white">
                <div className="container__own rounded-md">
                    <div class="
                    lg:flex
                    flex-col
                    flex-wrap
                    sm:w-full
                    justify-end
                    lg:h-20
                    xs:space-y-0
                    space-y-5 
                    ">
                        <div class="
                            sm:flex-1
                            sm:flex
                            sm:justify-center
                            sm:items-center 
                            lg:border-r lg:border-gray-100 
                            gap-2            
                        ">
                            <ion-icon name="cube-outline" class="faixa__two__icon text-gray-700"></ion-icon>
                            <div class="flex flex-col">
                                <p class="uppercase font-bold text-sm">fast delivery</p>
                                <p class="text-sm text-slate-500 mt-1">Delivered in 7 days</p>
                            </div>
                        </div>
                        <div class="
                            sm:flex-1
                            sm:flex
                            sm:justify-center
                            sm:items-center 
                            lg:border-r lg:border-gray-100 
                            gap-2    ">
                            <ion-icon name="trophy-outline" class="faixa__two__icon text-gray-700"></ion-icon>
                            <div class="flex flex-col">
                                <p class="uppercase font-bold  text-sm">24 Hour Return</p>
                                <p class="text-sm text-slate-500 mt-1">100% money-back guarantee</p>
                            </div>
                        </div>
                        <div class="
                            sm:flex-1
                            sm:flex
                            sm:justify-center
                            sm:items-center 
                            lg:border-r lg:border-gray-100 
                            gap-2    ">
                            <ion-icon name="card-outline" class="faixa__two__icon text-gray-700"></ion-icon>
                            <div class="flex flex-col">
                                <p class="uppercase font-bold  text-sm">secure payment</p>
                                <p class="text-sm text-slate-500 mt-1">Your money is safe</p>
                            </div>
                        </div>
                        <div class="
                           sm:flex-1
                            sm:flex
                            sm:justify-center
                            sm:items-center  
                            gap-2    ">
                            <ion-icon name="call-outline" class="faixa__two__icon text-gray-700"></ion-icon>
                            <div class="flex flex-col">
                                <p class="uppercase font-bold  text-sm">support 24/7</p>
                                <p class="text-sm text-slate-500 mt-1">Live contact/message</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="h-96 flex flex-col items-center text-white 
            justify-center font-light text-lg bg-black">
                <p class="text-xl">Se inscreva para receber as novidades</p>
                <p class="text-sm mt-2">Ofertas e conteúdos exclusivos no seu e-mail.</p>
                <div class="space-x-1">
                    <input type="text" placeholder="Digite seu email" class="w-72 h-11 
                    text-sm mt-4 border rounded-md text-gray-700" />
                    <button class="bg-white h-11 px-4 text-sm rounded-md text-gray-700
                    hover:bg-gray-300">Cadastrar</button>
                </div>
            </div>

            <Footer></Footer>
        </div>
    </div>
</template>
