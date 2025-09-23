export function persistPlugin({ store }) {

    // Carrega do localStorage ao iniciar
    const stored = localStorage.getItem(store.$id);
    if (stored) {
        // const parsed = JSON.parse(stored);
        // const isLoggedIn = parsed.login === true || parsed.login === "true";

        store.$patch(JSON.parse(stored));
    }else {
        localStorage.setItem(store.$id, JSON.stringify(store.$state));
    }

    // Sempre que o estado mudar, salva no localStorage
    store.$subscribe((_mutation, state) => {
    localStorage.setItem(store.$id, JSON.stringify(state));
    });
}
