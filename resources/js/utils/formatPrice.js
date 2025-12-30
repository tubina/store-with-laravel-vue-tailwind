export function formatPrice(value){
    // Garantir que é número
    let number = Number(value) || 0;

    // Separar parte inteira e decimal
    let [integerPart, decimalPart] = number.toFixed(2).split('.');

    // Adicionar ponto como separador de milhar
    integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

    // Juntar novamente com vírgula
    return `${integerPart},${decimalPart}`;
}