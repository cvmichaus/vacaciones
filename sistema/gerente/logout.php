<?php
session_start();
  if($_SESSION["logueado"] == TRUE) {

      set_time_limit(0);
      require("../../class/cnmysql.php");
      date_default_timezone_set('America/Mexico_City');

    $iduser = $_SESSION['CodUsuario'];
    $fecha_actual= date('Y-m-d');//fecha actual

        
          @session_start();
        session_destroy();
        header("Location: ../../index.php");

        

}

?>
