//Funciones que anula la escritura de caracteres que generar un error en el sumbit del UpdatePanel
function supressUpdatePanelRequestErrorCharacters(inputName) {
    document.querySelector(inputName).onkeydown = function (e) {
        if (e != undefined) {
            if (e.char == "<" || e.char == ">")
                return false;
        }
    }
}