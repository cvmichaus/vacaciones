<?php
session_start();
  if($_SESSION["logueado"] == TRUE) {

      set_time_limit(0);
      require("../../class/cnmysql.php");
      date_default_timezone_set('America/Mexico_City');

		$iduser = $_SESSION['CodUsuario'];
		$fecha_actual= date('Y-m-d');//fecha actual

        $consulta = "UPDATE `tbl_usuarios` u SET u.en_session='0',ult_act_usu='".$fecha_actual."' WHERE u.cod_usuario = '".$iduser."' ";
        if($resultado = $mysqli->query($consulta)) {

			    @session_start();
				session_destroy();
				header("Location: ../../index.php");

        }

}

?>
