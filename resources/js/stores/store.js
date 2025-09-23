import { defineStore, storeToRefs } from 'pinia';
import { verifyLogin } from '@/utils/verifyLogin';

export const useStore = defineStore("store", {
    state:() =>({
        login: false,
        qtd_cart: 0,
        item_id: [],
        qtd_favorites: 0,
        favorites_id: []
    }),
    actions:{
        async fetchCart() {
            const { data } = await axios.get("/api/cart");
            this.qtd_cart =  data;
        },
        /*****************************************************/
        // async teste(productId){
        //     const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        //     console.log(token)
        //     console.log(typeof(productId));
        //     const saida = JSON.stringify(productId);
        //     console.log(saida);
        //     for(var result of saida){
        //         console.log(result);
        //     }
        //     console.log(typeof(saida));
        //     const response = await fetch('/api/cart', {
        //         method: 'POST',
        //         credentials: 'include',
        //         headers: {
        //             'X-CSRF-TOKEN': token, // token CSRF aqui
        //         },
        //         body: JSON.stringify({ product_id: productId }) // body como string JSON
        //     });
        //     const data = await response.json();
        // },
        async addToCart(productId) {

            var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            console.log(token)
            if(verifyLogin() === true){ 
                console.log(productId);
                await fetch('/api/cart', {
                    method: 'POST',
                    credentials: 'include', // necessário para cookies de sessão
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({ product_id: productId })
                });
                await this.fetchCart(); // retorna carrinho atualizado
            }else if(verifyLogin() === false) {
                if (!Array.isArray(productId)) {
                    this.item_id.push(productId);
                }
            }
        },
        /*****************************************************/
        async fetchFavorites() {
            const { data } = await axios.get("/api/favorite");
            this.qtd_favorites = data;
        },
        /*****************************************************/
        async addToFavorite(productId) {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            if(verifyLogin() === true){
                await fetch('/api/favorite', {
                    method: 'POST',
                    credentials: 'include',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token, // token CSRF aqui
                    },
                    body: JSON.stringify({product_id: productId})
                });
                await this.fetchFavorites();
            }else {
                this.favorites_id.push(productId); // retorna favoritos atualizados
            }
        }
    }
})
