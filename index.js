addEventListener("load", load);
//llamo al servidor.
//var servi = "http://localhost:444/login";
var servi = "https://serviback.herokuapp.com";

 //var servi = "https://serviback.herokuapp.com/frontend";

function $(demo){
    return document.getElementById(demo);
}



function load(){
    document.getElementById("ingresar").addEventListener("click", click);
}

function click(){
   enviarMensajeAlServidorPost(servi,retornoDelClick);

}

function retornoDelClick(respuesta){
    if(respuesta == 'Bienvenido'){
        location.replace("pantallaprincipal.html");
    }else{
        alert('error al ingresar');
    }
}


function enviarMensajeAlServidorPost(servidor, funcionARealizar) {

    //declaro el objeto
    var xmlhttp = new XMLHttpRequest();
    var datos = new FormData();
    datos.append("nombre",$("usuario").value);
    datos.append("contrasena",$("contrasenia").value);

    var usuario=document.getElementById('usuario').value;
    var contrasenia=document.getElementById('contrasenia').value;
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
    xmlhttp.open("POST", servidor +'/Frontend/Login', true);
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
