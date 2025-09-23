export function verifyLogin(){
    const stored = localStorage.getItem("store");
    const saida = JSON.parse(stored)
    return saida.login;
}
