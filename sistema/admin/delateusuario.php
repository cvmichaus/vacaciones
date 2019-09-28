<?php
session_start();
  if($_SESSION["logueado"] == TRUE) {

      set_time_limit(0);
      require("../../class/cnmysql.php");
      date_default_timezone_set('America/Mexico_City');
      $fecha_del_dia=date('Y-m-d');//fecha actual


	date_default_timezone_set('America/Mexico_City');
	$fecha_del_dia=date('Y-m-d');//fecha actual
	setlocale(LC_TIME,"es_ES");
	$hora_actual= strftime("%H:%M:%S");  

  $IDUsuarioPHP = $_GET["codUsuario"];    


 $sqlDelete1 = "DELETE FROM  `tbl_usuarios` WHERE  CodUsuario = ".$IDUsuarioPHP." ";
        if($resdelete1 = $mysqli->query($sqlDelete1)) {
      			
				$sqldelete2 = "DELETE FROM  `tbl_empleados` WHERE  CodUsu = ".$IDUsuarioPHP." ";
				if($resdelete2 = $mysqli->query($sqldelete2)) {

						header("Location: index.php");

				}else{echo "error delete 2";}

        }else{echo "error delete1";}
        
/**se elimina de usuarios y trabajadores y se regresa el limit */


 } else {
    header("Location: ../index.php");
  }

?>