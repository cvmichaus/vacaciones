 
  function validarPasswd(){


    var p1 = document.getElementById("passwd").value;
    var p2 = document.getElementById("passwd2").value;

        var espacios = false;
    var cont = 0;
     
    while (!espacios && (cont < p1.length)) {
      if (p1.charAt(cont) == " ")
        espacios = true;
      cont++;
    }
     
    if (espacios) {
      alert ("La contraseña no puede contener espacios en blanco");
      return false;
    }

        if (p1.length == 0 || p2.length == 0) {
      alert("Los campos de la password no pueden quedar vacios");
      return false;
    }

        if (p1 != p2) {
      alert("Las passwords deben de coincidir");
      return false;
    } else {
      //alert("Todo esta correcto");
      return true; 
    }

}


 function CargaAntiguedad(str)
    {
    if (str=="")
    {
    document.getElementById("resultado").innerHTML="";
    return;
    }
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange=function()
    {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("resultado").innerHTML=xmlhttp.responseText;
    }
    }
    xmlhttp.open("GET","obtener_antiguedad.php?y="+str,true);
    xmlhttp.send();
    }  

 function ejecuta_ajax(archivo, parametros, capa){
        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
        }
        else
        {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange=function()
        {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
        document.getElementById(capa).innerHTML=xmlhttp.responseText;
        }
        }

        x = Math.random()*99999999;
        xmlhttp.open("GET",archivo+"?"+parametros+"&x="+x, true);
        xmlhttp.send();
        }


  function objetoAjax(){
                        var xmlhttp = false;
                        try {
                        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                        } catch (e) {
                        try {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                        } catch (E) {
                        xmlhttp = false; }
                        }
                        if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
                        xmlhttp = new XMLHttpRequest();
                        }
                        return xmlhttp;
                        }



  function enviarDatos(){
  //Recogemos los valores introducimos en los campos de texto
  dateini = document.formulario.dateini.value;
  datefin = document.formulario.datefin.value;
  //Aquí será donde se mostrará el resultado
  diassol = document.getElementById('diassol');
  //instanciamos el objetoAjax
  ajax = objetoAjax();
  //Abrimos una conexión AJAX pasando como parámetros el método de envío, y el archivo que realizará las operaciones deseadas
  ajax.open("POST", "fechas.php", true);
  //cuando el objeto XMLHttpRequest cambia de estado, la función se inicia
  ajax.onreadystatechange = function() {
  //Cuando se completa la petición, mostrará los resultados
  if (ajax.readyState == 4){
  //El método responseText() contiene el texto de nuestro 'consultar.php'. Por ejemplo, cualquier texto que mostremos por un 'echo'
  diassol.value = (ajax.responseText)
  }
  }
  //Llamamos al método setRequestHeader indicando que los datos a enviarse están codificados como un formulario.
  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  //enviamos las variables a 'consulta.php'
  ajax.send("&dateini="+dateini+"&datefin="+datefin)
  }

   function obtenerfechas (){
  
    var fechaini = new Date(document.getElementById('dateini').value);
  var fechafin = new Date(document.getElementById('datefin').value);
  var diasdif= fechafin.getTime()-fechaini.getTime();
  var contdias = Math.round(diasdif/(1000*60*60*24));

  //var diasd = fecha2.diff(fecha1);
  document.getElementById("diassol").value = contdias;
  }



 function restadias(){

  var diassol = document.getElementById('diassol').value;
  var diasperiodoant = document.getElementById('diasperiodoant').value;


        if(parseInt(diasperiodoant)  >= 1){
            var diastotalesPHP = document.getElementById('diastotales').value;

            //alert("Dias Vacaciones + Dias Ant " + diastotalesPHP );

                  if( parseInt(diassol) > parseInt(diastotalesPHP)) {
                  alert("No puedes Solicitar mas dias de los que tienes disponibles");
                  document.getElementById("btnsol").style.display = "none";
                  }else{ 
                  document.getElementById("btnsol").style.display = "inline";

                  if(diasperiodoant >= 1){
                  var totaldias = document.getElementById('diastotales').value;

                  var total =  parseInt(diastotalesPHP);
                  var res = parseInt(total) - parseInt(diassol);

                  if( res<0){
                  document.getElementById("diasres").value =Math.abs(res);
                  }else{
                  document.getElementById("diasres").value = res;
                  }

                  //document.getElementById("diasres").value = res;

                  } else if(diasperiodoant == 0){
                  var totaldias = document.getElementById('totaldias').value;


                  var res = parseInt(totaldias) - parseInt(diassol);

                  if( res<0){
                  document.getElementById("diasres").value =Math.abs(res);
                  }else{
                  document.getElementById("diasres").value = res;
                  }


                  }
                  }

        }else{
              var totaldiasPHP = document.getElementById('totaldias').value;
                //alert("Dias Vacaciones " + totaldiasPHP );

                  if( parseInt(diassol) > parseInt(totaldiasPHP)) {
                  alert("No puedes Solicitar mas dias de los que tienes disponibles");
                  document.getElementById("btnsol").style.display = "none";
                  }else{ 
                  document.getElementById("btnsol").style.display = "inline";

                  if(diasperiodoant >= 1){
                  var totaldias = document.getElementById('totaldias').value;

                  var total =  parseInt(diasperiodoant);
                  var res = parseInt(total) - parseInt(diassol);

                  if( res<0){
                  document.getElementById("diasres").value =Math.abs(res);
                  }else{
                  document.getElementById("diasres").value = res;
                  }

                  //document.getElementById("diasres").value = res;

                  } else if(diasperiodoant == 0){
                  var totaldias = document.getElementById('totaldias').value;


                  var res = parseInt(totaldias) - parseInt(diassol);

                  if( res<0){
                  document.getElementById("diasres").value =Math.abs(res);
                  }else{
                  document.getElementById("diasres").value = res;
                  }


                  }
                  }
        }

      

  }
