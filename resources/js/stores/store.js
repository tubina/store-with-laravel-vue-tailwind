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
        async addToCart(productId) {
            var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            if(verifyLogin() === true){
                console.log(productId);
                const response = await fetch('/api/cart', {
                    method: 'POST',
                    credentials: 'include', // necessário para cookies de sessão
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({ product_id: productId })
                });
                console.log(response.ok, "+++++")
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
