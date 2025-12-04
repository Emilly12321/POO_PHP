document.addEventListener("DOMContentLoaded", function(){
    const form = document.getElementById("menuForm");

    if(form){
        form.addEventListener("submit", function(event){
            const button = event.submitter || document.activeElement;
            const acao = button ? button.value : "desconhecida";

            const confirmar = window.confirm("Confirma a ação: " + acao + "?");

            if(!confirmar){
                event.preventDefault(); /* Cancelando o envio*/
                console.log("Envio foi cancelado");
            }else{
                console.log("Envio confirmado para o PHP");
            }

        });
    }
})