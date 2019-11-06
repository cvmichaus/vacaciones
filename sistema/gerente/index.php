<?php
session_start();
  if($_SESSION["logueado"] == TRUE) {

      set_time_limit(0);
      require("../../class/cnmysql.php");
      date_default_timezone_set('America/Mexico_City');
      $fecha_del_dia=date('Y-m-d');//fecha actual

      $user = $_SESSION['UsuarioNombre'];
      $iduser = $_SESSION['CodUsuario'];

      $DatosGerentes = "SELECT * FROM `tbl_usuarios` as u  INNER JOIN `tbl_empleados` as e ON u.CodUsuario = e.CodUsu WHERE u.Estatus = 1 AND  u.CodUsuario = ".$iduser." ";
     if($resDatosGerenetes = $mysqli->query($DatosGerentes)) {
      $dataGerentes = mysqli_fetch_assoc($resDatosGerenetes);  

                              }
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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


<!--
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
-->
<!--<script type="text/javascript" charset="utf8" src=""></script>-->

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
   $(document).ready(function()
   {
      $("#mostrarmodal").modal("show");
   });
</script>

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

  <button type="button" class="btn btn-round btn-success" onclick="ejecuta_ajax('formsolicitud.php','','ventana');"  data-toggle="modal" data-target=".bs-example-modal-sm" > Solicitar Vacaciones </button>

      <hr>
<!--TABLA DE SOLICITUDES DE VACACIONES-->
      <table id="example2" class="display compact" style="width:100%" >
      <thead>
      <tr style="text-align: center;vertical-align: middle;font-size: .9em; font-style: oblique;">
      <th>Usuario</th>
      <th>Fecha Inicio</th>
      <th>Fecha FinA</th>
      <th>Dias Solicitados</th>
       <th>Dias Vac Ant </th>
      <th>Dias Vac</th>
      <th>Dias Restantes</th>
      <th>Dias Vacaciones</th>
      <th>Estatus</th>
      <th>Observaciones</th>
      <th>Opciones</th>
      </tr>
    </thead>
    <tbody>
      <?php

        $sqlUsuarioS = "SELECT * FROM `tbl_solicitud` s 
                INNER JOIN `tbl_empleados` e ON e.CodUsu = s.CodUsuario
                WHERE e.Reporta = ".$iduser." ORDER BY s.CodSol DESC ";
                           if($resqryUsuarios = $mysqli->query($sqlUsuarioS)) {
                                while($row = mysqli_fetch_assoc($resqryUsuarios)){  

                                  $EstatusPHP2 = $row['Estatus'];
                            if($EstatusPHP2 == 0 )
                            { $estilo = 'text-align: center;vertical-align: middle;font-size: .7em; background-color: red; font-color:black;';  }
                            else if($EstatusPHP2 == 1){ 
                              $estilo = 'text-align: center;vertical-align: middle;font-size: .7em; background-color: green; font-color:white;';
                             }
                            else if($EstatusPHP2 == 2){ 
                              $estilo = 'text-align: center;vertical-align: middle;font-size: .7em; background-color: yellow; font-color:white;';
                             }
                            else { $estilo = 'text-align: center;vertical-align: middle;font-size: .7em;';  }

      ?>
              <tr style="<?php echo $estilo; ?>">
                 <td>
                  <?php
                  // echo $row['CodUsuario']; 

                          $ConsultaPrincipal = "SELECT * FROM `tbl_usuarios` as u  INNER JOIN `tbl_empleados` as e ON u.CodUsuario = e.CodUsu WHERE u.Estatus = 1 AND  u.CodUsuario = ".$row['CodUsuario']." ";
                          if($resqryUsuario = $mysqli->query($ConsultaPrincipal)) {
                          $data = mysqli_fetch_assoc($resqryUsuario);   
                                 $sqlObtenerU = "SELECT * FROM `tbl_empleados` as e WHERE  e.CodUsu = ".$data['CodUsu']."  ";
                                        if($resqry = $mysqli->query($sqlObtenerU)) {
                                        while($rowEmp = mysqli_fetch_assoc($resqry)){  
                                        echo $rowEmp['Nombres']; echo " "; echo $rowEmp['ApellidoPaterno']; echo " "; echo $rowEmp['ApellidoMaterno'];
                                         }
                                        }
                            
                          }

                   ?></td>
              
                <td><?php echo $row['FechaInicio']; ?></td>
                <td><?php echo $row['FechaFin']; ?></td>
                <td><?php echo $row['DiasSolicitados']; ?></td>
                 <td><?php
                       $qryConsulta98 = "SELECT COUNT(*) as SiHayDias FROM `tbl_periodoanterior` WHERE CodUsuario =  ".$data['CodUsu']." ";           
             if($resQryConsulta98 = $mysqli->query($qryConsulta98)) {
                                    $dataCons98 = mysqli_fetch_assoc($resQryConsulta98);
                                    /* pregunto si los hay en el usuario */
                                          if($dataCons98['SiHayDias'] == 1 ){

                                             $qryConsulta97 = "SELECT * FROM `tbl_periodoanterior` WHERE CodUsuario =  ".$data['CodUsu']." ";
                                                if($resQryConsulta97 = $mysqli->query($qryConsulta97)) {
                                                $dataCons97 = mysqli_fetch_assoc($resQryConsulta97);   
                                                echo $DiasPeriodoAnt_PHP =  $dataCons97['DiasVacAnt']; 

                                              }
                                          }
                                        }
                  ?></td>
                <td><?php echo $row['TotaldiasVac']; ?></td>
                <td><?php echo $row['DiasRestantes']; ?></td>
                <td><?php echo $row['TotaldiasVac'] + $DiasPeriodoAnt_PHP; ?></td>
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
                            $qryConsulta01 = "SELECT * FROM `tbl_rasolicitud`  WHERE  CodSol = ".$row['CodSol']." ";
                            if($resQryConsulta01 = $mysqli->query($qryConsulta01)) {
                            while($dataCons01 = mysqli_fetch_assoc($resQryConsulta01)){     
                                  echo nl2br($dataCons01['Motivo']); 
                            }

                            }

                   
                   ?></td>
              <td>
               <div class="btn-group btn-group-toggle" data-toggle="buttons">
               <?php
               if($EstatusPHP == 2  ){             
               ?>
               <button type="button" class="btn btn-round btn-success btn-sm" onclick="ejecuta_ajax('formaceptar.php','cods=<?php echo $row['CodSol']; ?>&codUsuario=<?php echo $row['CodUsuario']; ?>','ventana');"  data-toggle="modal" data-target=".bs-example-modal-sm" > Aceptar </button>
               &nbsp;&nbsp;
               <button type="button" class="btn btn-round btn-danger btn-sm" onclick="ejecuta_ajax('formrechazar.php','cods=<?php echo $row['CodSol']; ?>&codUsuario=<?php echo $row['CodUsuario']; ?>','ventana');"  data-toggle="modal" data-target=".bs-example-modal-sm" > Rechazar </button>
                  <?php
                          }
                       ?>
            
                  </div>
              </td>
             
                        </tr>
                       <?php
                          }
                        }
                       ?>
                      </tbody>
                    </table>

<hr>


      <!--TABLA DE SOLICITUDES DE VACACIONES-->
          <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">
                    <h2>Solicitud de Vacaciones </h2>
                     <table id="example3" class="table table-striped table-bordered " cellspacing="0" width="100%">
                      <thead>
                        <tr>
                         <th>Cod Solicitud</th>
                          <th>Usuario</th>
                          <th>Fecha Inicio</th>
                          <th>Fecha Fin</th>
                          <th>Dias Solicitados</th>
                          <th>Estatus</th>             
                        </tr>
                      </thead>
                      <tbody>
                        <?php
  $sqlUsuarioS = "SELECT * FROM `tbl_solicitud` u WHERE  u.CodUsuario = ".$iduser." ";
                           if($resqryUsuarios = $mysqli->query($sqlUsuarioS)) {
                                while($row = mysqli_fetch_assoc($resqryUsuarios)){  
                      ?>
                        <tr>
                         
                          <td><?php echo $row['CodSol']; ?></td>
                          <td><?php //echo $row['CodUsuario'];

          $sqlU = "SELECT * FROM `tbl_usuarios` as u INNER JOIN `tbl_empleados` as e ON u.CodUsuario = e.CodE  WHERE  u.CodUsuario = ".$row['CodUsuario']."  ";
                if($resqryU = $mysqli->query($sqlU)) {
                while($dataU = mysqli_fetch_assoc($resqryU)){  
                echo $dataU['Nombres']; echo " "; echo $dataU['ApellidoPaterno']; echo " "; echo $dataU['ApellidoMaterno'];
                  }
                }

                           ?></td>
                          <td><?php echo $row['FechaInicio']; ?></td>
                          <td><?php echo $row['FechaFin']; ?></td>
                           <td><?php echo $row['DiasSolicitados']; ?></td>
                         
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



                        </tr>
                       <?php
                          }
                        }
                       ?>
                      </tbody>
                    </table>
    
                
              </div>
            </div>

          </div>



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

<div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>Avisos</h3>
     </div>
         <div class="modal-body">
            <h6>Bienvenido <?php echo $dataGerentes['Nombres'];  echo " "; echo $dataGerentes['ApellidoPaterno']; echo " "; echo $dataGerentes['ApellidoMaterno']; ?></h6>
            <br>

      <?php

            $qryConsSol = "SELECT COUNT(*) as SiHaySol FROM `tbl_solicitud` s 
                         INNER JOIN `tbl_empleados` e ON e.CodUsu = s.CodUsuario 
                         WHERE e.Reporta = ".$iduser." AND s.Estatus = '2' ORDER BY s.CodSol DESC   ";
          if($resQryConsSol = $mysqli->query($qryConsSol)) {
                                         $dataConSol = mysqli_fetch_assoc($resQryConsSol);
                                        
                                if($dataConSol["SiHaySol"] == 1 ){

                                  echo "Tienes las siguientes solicitudes:<br>";

                                                                  $sqlUsuarioS2 = "SELECT * FROM `tbl_solicitud` s 
                                INNER JOIN `tbl_empleados` e ON e.CodUsu = s.CodUsuario
                                WHERE e.Reporta = ".$iduser." AND s.Estatus = '2' ORDER BY s.CodSol DESC ";
                               if($resqryUsuarios2 = $mysqli->query($sqlUsuarioS2)) {
                                      while($row2 = mysqli_fetch_assoc($resqryUsuarios2)){  


                                                          $ConsultaPrincipal2 = "SELECT * FROM `tbl_usuarios` as u  INNER JOIN `tbl_empleados` as e ON u.CodUsuario = e.CodUsu WHERE u.Estatus = 1 AND  u.CodUsuario = ".$row2['CodUsuario']." ";
                                                              if($resqryUsuario2 = $mysqli->query($ConsultaPrincipal2)) {
                                                              $data22 = mysqli_fetch_assoc($resqryUsuario2);   
                                                              $sqlObtenerU = "SELECT * FROM `tbl_empleados` as e WHERE  e.CodUsu = ".$data22['CodUsu']."  ";
                                                                    if($resqry22 = $mysqli->query($sqlObtenerU)) {
                                                                        while($rowEmp2 = mysqli_fetch_assoc($resqry22)){  
                                                                        echo $rowEmp2['Nombres']; echo " "; echo $rowEmp2['ApellidoPaterno']; echo " "; echo $rowEmp2['ApellidoMaterno']; echo "<br>";
                                                                        }
                                                                    }

                                                              }

                                                    } 

                                          }
                                        
                                         }else{ 
                                            echo " No hay Solicitudes por el momento."; 
                                            }

                                      }


                        
            ?>
          </span>
                  <hr>
                   <?php echo $dataGerentes['Nombres'];  echo " "; echo $dataGerentes['ApellidoPaterno']; echo " "; echo $dataGerentes['ApellidoMaterno']; ?>

                   <?php
      $qryConsulta02 = "SELECT DiasVac as DiasVacDisponibles,Anio FROM tbl_vacaciones_usuarioxanio WHERE CodEmpleado = ".$iduser." ";
                  if($resQryConsulta02 = $mysqli->query($qryConsulta02)) {
                      $dataCons02 = mysqli_fetch_assoc($resQryConsulta02);                        
                  }
    ?>

     Tienes <span style="color: green;font-weight: bolder;"> <?php  echo $dataCons02['DiasVacDisponibles']; ?> Dias de Vacaciones  del Periodo  <?php  echo $dataCons02['Anio']; ?> </span>

           <span style="color: red;font-weight: bolder;">
            <?php

        $qryConsulta01 = "SELECT COUNT(*) as SiHayDias FROM `tbl_periodoanterior` WHERE CodUsuario =  ".$iduser." ";

     if($resQryConsulta01 = $mysqli->query($qryConsulta01)) {
                                     $dataCons01 = mysqli_fetch_assoc($resQryConsulta01);
                                    
                                    if($dataCons01["SiHayDias"] == 1 ){

                                    $qryConsulta022 = "SELECT * FROM `tbl_periodoanterior` WHERE CodUsuario =  ".$iduser." ";
                                            if($resQryConsulta022 = $mysqli->query($qryConsulta022)) {
                                              $dataCons022 = mysqli_fetch_assoc($resQryConsulta022);   
                                                    $DiasVacAntPHP =  $dataCons022['DiasVacAnt'];

                                                      echo " , y tienes  ".$DiasVacAntPHP." Dias del Periodo Anterior , y vencen en  134 dias.";
                                            }
                                                                                
                                    }else{
                                        
                                    }

                                  }

                                  ?>

                                </span>
          
     </div>
         <div class="modal-footer">
        <a href="#" data-dismiss="modal" class="btn btn-danger">Cerrar</a>
     </div>
      </div>
   </div>
</div>

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



     <script>

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
  var diasperiodoant = document.getElementById('diasperiodoant').value;

      if(diasperiodoant >= 1){
      var totaldias = document.getElementById('totaldias').value;

      var total = parseInt(totaldias) + parseInt(diasperiodoant);
      var res = parseInt(total) - parseInt(diassol);
      document.getElementById("diasres").value = res;

      } else{
      var totaldias = document.getElementById('totaldias').value;
      var res = parseInt(totaldias) - parseInt(diassol);
      document.getElementById("diasres").value = res;
      }

  }


  </script>
<!-- RESTA DIAS -->

  </html>

  <?php
  } else {
    header("Location: ../index.php");
  }
 
 ?>
