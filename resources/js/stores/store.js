import { defineStore } from 'pinia';
import { verifyLogin } from '@/utils/verifyLogin';

export const useStore = defineStore("store", {
    state:() =>({
        login: false,
        qtd_cart: 0,
        item_id: [],
        qtd_favorites: 0,
        favorites_id: [],
        toastImage: '',
        toastName: '',
        toastPrice: '',
        toastKey: 0,
        toasts: [], 
        firstLogin: false
    }),
    actions:{
        showToast(id, image, name, price) {
            const dateNow = Date.now() // id único
            this.toasts.push({ id, dateNow, image, name, price })

            // 🔹 remove o toast após 5 segundos
            setTimeout(() => {
                this.toasts = this.toasts.filter(t => t.dateNow !== dateNow)
            }, 3000)
        },
        /*****************************************************/
        async fetchCart() {
            const { data } = await axios.get("/cart-get");
            this.qtd_cart =  data;
        },
        /*****************************************************/
        async addToCart(productId) {
            // Marca como sincronizado 
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
                
                if(response.ok){
                    //this.login = false
                    this.item_id = []
                    //coloquei aqui porque no Home.vue ele nao espera a resposta 
                    //entao preferi verificar aqui
                    this.firstLogin = false;
                }
            }else if(verifyLogin() === false) {
                if(!Array.isArray(productId)) {
                    this.item_id.push(productId);
                    this.qtd_cart += 1 ;
                }
            }
        },
        /*****************************************************/
        async fetchFavorites(){
            const { data } = await axios.get("/favorite-get");
            this.qtd_favorites = data;
        },
        /*****************************************************/
        async addToFavorite(productId) {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            if(verifyLogin() === true){
                const responseF = await fetch('/favorite-insert', {
                    method: 'POST',
                    credentials: 'include',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token, // token CSRF aqui
                    },
                    body: JSON.stringify({product_id: productId})
                });  
                await this.fetchFavorites();
                if(responseF.ok){
                    //this.login = false
                    this.favorites_id = []
                    //coloquei aqui porque no Home.vue ele nao espera a resposta 
                    //entao preferi verificar aqui
                    this.firstLogin = false;
                }
            } else if(verifyLogin() === false) {
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
        /*****************************************************/
        async deleteFromFavorite(productId) {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const result = await fetch('/favorite-delete', {
                method: 'DELETE',
                credentials: 'include',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({ product_id: productId })
            })
            
            if(result.ok){
                this.fetchFavorites();
                return productId;
            }
        }
    }
})
