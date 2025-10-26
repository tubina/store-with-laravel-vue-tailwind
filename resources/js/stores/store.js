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
            const { data } = await axios.get("/cart-get");
            this.qtd_cart =  data;
        },
        /*****************************************************/
        async addToCart(productId) {
            var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            if(verifyLogin() === true){
                const response = await fetch('/cart-insert', {
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
                    this.qtd_cart += 1 ;
                }
            }
        },
        /*****************************************************/
        async fetchFavorites() {
            const { data } = await axios.get("/favorite-get");
            this.qtd_favorites = data;
        },
        /*****************************************************/
        async addToFavorite(productId) {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            if(verifyLogin() === true){
                await fetch('/favorite-insert', {
                    method: 'POST',
                    credentials: 'include',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token, // token CSRF aqui
                    },
                    body: JSON.stringify({product_id: productId})
                });
                await this.fetchFavorites();
            }else if(verifyLogin() === false) {
                if (!Array.isArray(productId)) {
                    this.favorites_id.push(productId);
                    this.qtd_favorites += 1 ;
                }
            }
        },
        /*****************************************************/
        async deleteCart(productId) {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const result = await fetch('/cart-delete', {
                method: 'DELETE',
                credentials: 'include',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({ product_id: productId })
            });

            if(result.ok){
                this.fetchCart();
                return productId;
            }

        },
    }
})
