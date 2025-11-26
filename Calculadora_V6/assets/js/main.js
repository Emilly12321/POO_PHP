function validaFormulario() {

    let campo1 = document.getElementById('valor1');
    let campo2 = document.getElementById('valor2');
    let valor1 = campo1.value.trim();
    let valor2 = campo2.value.trim();


    // Regex para numero inteiro ou decimal, com sinal opcional
    const numRegex = /^\s*[+-]?\d+(?:[\.,]\d+)?\s*$/;

    if (!numRegex.test(valor1)) {
        alert("Valor inválido no primeiro campo, favor preeencher corretamente");
        campo1.focus();
        return false;
    } else if (!numRegex.test(valor2)) {
            alert("Valor inválido no segundo campo, favor preeencher corretamente");
            campo2.focus();
            return false;
    }else{
        
        return true;
    }
}