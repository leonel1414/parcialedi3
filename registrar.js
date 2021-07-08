addEventListener("load", load);
//llamo al servidor.
//var servi = "http://localhost:444";
//var servi = "https://serviback.herokuapp.com";
var servi = "https://serviback.herokuapp.com";

function $(demo){
    return document.getElementById(demo);
}

function load(){
    document.getElementById("enviar").addEventListener("click", click);
}

function click(){
   enviarMensajeAlServidorPost(servi,retornoDelClick);

}

function retornoDelClick(respuesta){
    alert(respuesta);
}


function enviarMensajeAlServidorPost(servidor, funcionARealizar) {

    //declaro el objeto
    var xmlhttp = new XMLHttpRequest();
    var datos = new FormData();
    datos.append("nombre",$("usuario1").value);
    datos.append("contrasena",$("contra1").value);
    
    // indico hacia donde va el mensaje
    xmlhttp.open("POST",servi +'/Frontend/Crear',true);
    //seteo el evento
    xmlhttp.onreadystatechange = function () {
        //Veo si llego la respuesta del servidor
        if (xmlhttp.readyState == XMLHttpRequest.DONE) {
            //Reviso si la respuesta es correcta
            if (xmlhttp.status == 200) {
                funcionARealizar(xmlhttp.responseText);
            }
            else {
                alert("ocurrio un error");
            }
        }
    }

   
    xmlhttp.setRequestHeader("enctype", "multipart/form-data");

    //envio el mensaje    
    xmlhttp.send(datos);
}
