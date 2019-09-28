<?php
session_start();
  if($_SESSION["logueado"] == TRUE) {

      set_time_limit(0);
      require("../../class/cnmysql.php");
      date_default_timezone_set('America/Mexico_City');
      $fecha_del_dia=date('Y-m-d');//fecha actual

      $user = $_SESSION['UsuarioNombre'];
      $iduser = $_SESSION['CodUsuario'];
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistema para Control de Vacaciones</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">


<!--<script src="//code.jquery.com/jquery-3.4.1.min.js" ></script>-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<!--
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
-->
<!--<script type="text/javascript" charset="utf8" src=""></script>-->
<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">


<script type="text/javascript" language="javascript" class="init">
 $(document).ready(function() {
        var selected = [];

        $('#example2').DataTable( {
          dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
            stateSave: true,
            "order": [[ 1, "desc" ]],
        } );

        $('#example tbody').on('click', 'tr', function () {
            var id = this.id;
            var index = $.inArray(id, selected);

            if ( index === -1 ) {
                selected.push( id );
            } else {
                selected.splice( index, 1 );
            }

            $(this).toggleClass('selected');
        } );

    } )


</script>



<script type="text/javascript" language="javascript" class="init">
 $(document).ready(function() {
        var selected = [];

        $('#example3').DataTable( {
          dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
            stateSave: true,
            "order": [[ 1, "desc" ]],
        } );

        $('#example tbody').on('click', 'tr', function () {
            var id = this.id;
            var index = $.inArray(id, selected);

            if ( index === -1 ) {
                selected.push( id );
            } else {
                selected.splice( index, 1 );
            }

            $(this).toggleClass('selected');
        } );

    } )


</script>


</head>
<style type="text/css" media="screen">
  /*
Full screen Modal 
*/
.fullscreen-modal .modal-dialog {
  margin: 0;
  margin-right: auto;
  margin-left: auto;
  width: 100%;
}
@media (min-width: 768px) {
  .fullscreen-modal .modal-dialog {
    width: 750px;
  }
}
@media (min-width: 992px) {
  .fullscreen-modal .modal-dialog {
    width: 970px;
  }
}
@media (min-width: 1200px) {
  .fullscreen-modal .modal-dialog {
     width: 1170px;
  }
}
</style>
<body>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
 <a href="logout.php"  class="btn btn-default navbar-btn">Salir</a>
  <a   class="btn btn-default navbar-btn"> 
    Bienvenido <?php echo $user; ?> | 
    <?php
                  // Obtenemos el número del día
                  $dia2=date("d");

                  // Obtenemos y traducimos el nombre del mes
                  $mes=date("F");
                  if ($mes=="January") $mes="Enero";
                  if ($mes=="February") $mes="Febrero";
                  if ($mes=="March") $mes="Marzo";
                  if ($mes=="April") $mes="Abril";
                  if ($mes=="May") $mes="Mayo";
                  if ($mes=="June") $mes="Junio";
                  if ($mes=="July") $mes="Julio";
                  if ($mes=="August") $mes="Agosto";
                  if ($mes=="September") $mes="Setiembre";
                  if ($mes=="October") $mes="Octubre";
                  if ($mes=="November") $mes="Nov";
                  if ($mes=="December") $mes="Dic";

                  // Obtenemos el año
                  $ano=date("Y");
                  // Imprimimos la fecha completa
                  echo " $dia2 de $mes $ano";
                ?>
                |
                <script language="JavaScript" type="text/javascript">
                  function show5()
                  {
                    if (!document.layers&&!document.all&&!document.getElementById)
                      return
                    var Digital=new Date()
                    var hours=Digital.getHours()
                    var minutes=Digital.getMinutes()
                    var seconds=Digital.getSeconds()

                    var dn="PM"
                    if (hours<12)
                      dn="AM"
                    if (hours>12)
                      hours=hours-12
                    if (hours==0)
                      hours=12

                    if (minutes<=9)
                      minutes="0"+minutes
                    if (seconds<=9)
                      seconds="0"+seconds
                    //change font size here to your desire
                    myclock=""+hours+":"+minutes+" "+dn+"</b></font>"
                    if (document.layers)
                    {
                      document.layers.liveclock.document.write(myclock)
                      document.layers.liveclock.document.close()
                    }
                    else if (document.all)
                      liveclock.innerHTML=myclock
                    else if (document.getElementById)
                      document.getElementById("liveclock").innerHTML=myclock
                    setTimeout("show5()",1000)
                  }
                  window.onload=show5
                </script>
                <span id="liveclock" ></span>
  </a>
</nav>


  <div class="container-fluid">



      <hr>
<!--TABLA DE SOLICITUDES DE VACACIONES-->
      <table id="example2" class="display compact" style="width:100%" >
      <thead>
      <tr>
      <th>Cod Solicitud</th>
      <th>Usuario</th>
      <th>Periodo</th>
      <th>Fecha Inicio</th>
      <th>Fecha FinA</th>
      <th>Dias Solicitados</th>
      <th>Dias Vac</th>
      <th>Dias Restantes</th>
      <th>Dias Vacaciones</th>
      <th>Estatus</th>
      <th>Opciones</th>
      </tr>
    </thead>
    <tbody>
      <?php

        $sqlUsuarioS = "SELECT * FROM `tbl_solicitud` s 
                INNER JOIN `tbl_empleados` e ON e.CodUsu = s.CodUsuario
                WHERE e.Reporta = ".$iduser." ";
                           if($resqryUsuarios = $mysqli->query($sqlUsuarioS)) {
                                while($row = mysqli_fetch_assoc($resqryUsuarios)){   
      ?>
                <td><?php echo $row['CodSol']; ?></td>
                 <td>
                  <?php
                  // echo $row['CodUsuario']; 

                          $ConsultaPrincipal = "SELECT * FROM `tbl_usuarios` as u  INNER JOIN `tbl_empleados` as e ON u.CodUsuario = e.CodUsu WHERE u.Estatus = 1 AND  u.CodUsuario = ".$row['CodUsuario']." ";
                          if($resqryUsuario = $mysqli->query($ConsultaPrincipal)) {
                          while($data = mysqli_fetch_assoc($resqryUsuario)){    
                                 $sqlObtenerU = "SELECT * FROM `tbl_empleados` as e WHERE  e.CodUsu = ".$data['CodUsu']."  ";
                                        if($resqry = $mysqli->query($sqlObtenerU)) {
                                        while($rowEmp = mysqli_fetch_assoc($resqry)){  
                                        echo $rowEmp['Nombres']; echo " "; echo $rowEmp['ApellidoPaterno']; echo " "; echo $rowEmp['ApellidoMaterno'];
                                        }
                                        }
                          }
                          }

                   ?></td>
                <td><?php echo $row['Periodo']; ?></td>
                <td><?php echo $row['FechaInicio']; ?></td>
                <td><?php echo $row['FechaFin']; ?></td>
                <td><?php echo $row['DiasSolicitados']; ?></td>
                <td><?php echo $row['TotaldiasVac']; ?></td>
                <td><?php echo $row['DiasRestantes']; ?></td>
                <td><?php echo $row['TotaldiasVac']; ?></td>
                <td>
              <?php 
               $EstatusPHP = $row['Estatus'];
                if($EstatusPHP == 0 )
                { echo "Rechazado ";}
                else if($EstatusPHP == 1){ 
                echo "APROBADO";}
                else if($EstatusPHP == 2){ 
                echo "PROCESO";}
                else {echo "NA";}
              ?>
              </td>
              <td>
               <?php
               if($EstatusPHP == 2  ){             
               ?>
               <button type="button" class="btn btn-round btn-success btn-xs" onclick="ejecuta_ajax('formaceptar.php','cods=<?php echo $row['CodSol']; ?>&codUsuario=<?php echo $row['CodUsuario']; ?>','ventana');"  data-toggle="modal" data-target=".bs-example-modal-sm" > Aceptar </button>
               
               <button type="button" class="btn btn-round btn-danger btn-xs" onclick="ejecuta_ajax('formrechazar.php','cods=<?php echo $row['CodSol']; ?>&codUsuario=<?php echo $row['CodUsuario']; ?>','ventana');"  data-toggle="modal" data-target=".bs-example-modal-sm" > Rechazar </button>
              </td>
              <?php
                          }
                       ?>
                        </tr>
                       <?php
                          }
                        }
                       ?>
                      </tbody>
                    </table>

<hr>


  <!--SMALL MODAL-->
 <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2"> </h4>
                        </div>
                        <div class="modal-body">
                          <div id="ventana">
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>

                      </div>
                    </div>
                  </div>
<!--SMALL MODAL-->



    <hr>








  </div>
</body>

<script>

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

</script>

  <script>
    /*PRECARGAR DATOS EN SELCT */
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

    </script>


    <script>
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

   </script>

   <!-- DIFERENCIA DE FECHAS -->
  <script type="text/javascript">

  function obtenerfechas (){
  
    var fechaini = new Date(document.getElementById('dateini').value);
  var fechafin = new Date(document.getElementById('datefin').value);
  var diasdif= fechafin.getTime()-fechaini.getTime();
  var contdias = Math.round(diasdif/(1000*60*60*24));

  //var diasd = fecha2.diff(fecha1);
  document.getElementById("diassol").value = contdias;
  }
  </script>

<!-- DIFERENCIA DE FECHAS -->

<!-- RESTA DIAS -->
  <script type="text/javascript">
  function restadias(){
  var diassol = document.getElementById('diassol').value;
  var totaldias = document.getElementById('totaldias').value;
  var res = parseInt(totaldias) - parseInt(diassol);
  document.getElementById("diasres").value = res;
  }
  </script>
<!-- RESTA DIAS -->

  </html>

  <?php
  } else {
    header("Location: ../index.php");
  }
 
 ?>