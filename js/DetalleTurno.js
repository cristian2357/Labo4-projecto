function bindearBotones() {
    document.querySelector(".modal-detalle-turno .btn-si").onclick = function () {
        document.querySelector("input[name='punto-entrada']").value = "E"
        enviarForm();
    };
    document.querySelector(".modal-detalle-turno .btn-no").onclick = ocultarModal;
    document.querySelector(".btn-eliminar-turno").onclick = function () {
        document.querySelector("input[name='punto-entrada']").value = "R";
        enviarForm();
    }    
    document.querySelector(".btn-editar-turno").onclick = mostrarModal;
}

function mostrarModal() {    
    document.querySelector(".modal-detalle-turno").setAttribute("style", "display: block");
    document.querySelector(".content").setAttribute("style", "opacity:0.3");
    document.querySelector(".content").setAttribute("pointer-events", "none");
}

function ocultarModal() {
    document.querySelector(".modal-detalle-turno").setAttribute("style", "display: none");
    document.querySelector(".content").setAttribute("style", "opacity:1");
    document.querySelector(".content").setAttribute("pointer-events", "auto");
}

function enviarForm() {    
    document.querySelector(".form-detalle-turno").submit();
}