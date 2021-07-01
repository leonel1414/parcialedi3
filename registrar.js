addEventListener("load", load);
//llamo al servidor.
//var servi = "http://localhost:444";
var servi = "https://serviback.herokuapp.com";

//var servi = "https://serviback.herokuapp.com/frontend";

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

function enviarMensajeAlServidor(servi, funcionARealizar){
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.open("GET",servi,true);

    xmlhttp.onreadystatechange = function(){

        if(xmlhttp.readyState == XMLHttpRequest.DONE){
            if(xmlhttp.status == 200){
                console.log(xmlhttp.response);
                funcionARealizar(xmlhttp.responseText);
            }else{
                alert("Ocurrio un error");
            }
        }

    }
    xmlhttp.send();

    
}


function enviarMensajeAlServidorPost(servidor, funcionARealizar) {

    //declaro el objeto
    var xmlhttp = new XMLHttpRequest();
    var datos = new FormData();
    datos.append("nombre",$("usuario1").value);
    datos.append("contrasena",$("contra1").value);
    var usuario=document.getElementById('usuario1').value;
    var contrasenia=document.getElementById('contra1').value;
    var msg="llenar los siguientes campos que estan vacios:\n";
    var ok=true;
    if(usuario==""){
        msg+="Usuario\n";
        ok=false;
    }
    if(contrasenia==""){
        msg+="contraseña\n";
        ok=false;
    }
    if(ok==false){
        alert(msg);
    }else{

    // indico hacia donde va el mensaje
    xmlhttp.open("POST", servidor, true);
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
}