<?php
/*DATOS USUARIO*/
	date_default_timezone_set('America/Mexico_City');
	$fecha_del_dia=date('Y-m-d');//fecha actual
	setlocale(LC_TIME,"es_ES");
	$hora_actual= strftime("%H:%M:%S");  

 $UsuarioPHP = $_POST["usuario"];    
 $PassPHP = $_POST["passwd"];          

   function encrypt($string, $key) 
  {
    $result = '';
        for($i=0; $i<strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key))-1, 1);
        $char = chr(ord($char)+ord($keychar));
        $result.=$char;
    }
    return base64_encode($result);
  }

	$PassEncriptadoPHP = encrypt($PassPHP,"wrimexico2019");  
	$CorreoPHP = $_POST["correo"];  
	$PerfilPHP = $_POST["perfil"];        

/* DAtos EMPLEADO*/


	 $nombrePHP = $_POST["nombre"];   
	 $appaternoPHP = $_POST["appaterno"];   
	 $apmaternoPHP = $_POST["apmaterno"];   
	 $PosicionPHP = $_POST["Posicion"];   
	 $areaPHP = $_POST["area"];   
	 $reportaPHP = $_POST["reporta"];   
	 $jefePHP = $_POST["jefe"];   
	 $fecha_altaPHP = $_POST["fecha_ingreso"];   
	 $ant_aniosPHP = $_POST["ant_anios"];   
	 $ant_mesPHP = $_POST["ant_mes"];   
	 $ant_diasPHP = $_POST["ant_dias"];   
	 $diasvacacionesPHP = $_POST["diasvacaciones"];   
	//echo $ PHP = $_POST[""];    echo "<br>";
	

	$consulta1 = "INSERT INTO `tbl_usuarios` (`CodUsuario`, `Usuario`, `Clave`, `Correo`, `Estatus`, `Perfil`, `Fecha_Alta`, `Hora_Alta`) VALUES (NULL,'".$UsuarioPHP."', '".$PassEncriptadoPHP."', '".$CorreoPHP."', '1', '".$PerfilPHP."','".$fecha_del_dia."', '".$hora_actual."')";

	if($resultado1 = $mysqli->query($consulta1)) {


		$traerid = "SELECT CodUsuario FROM `tbl_usuarios` WHERE Usuario= '".$UsuarioPHP."' AND Perfil = '".$PerfilPHP."' AND  Clave = '".$PassEncriptadoPHP."' ";

		if($resid = $mysqli->query($traerid)) {
				while($data = $resid->fetch_array()) {

					$UsuarioCod =  $data["cod_usuario"];

							$consulta2 = "INSERT INTO `tbl_empleados` (`codE`,`CodUsu `,`Nombres`,`ApellidoPaterno`,`ApellidoMaterno`,`Posicion`, `Area`, `Reporta`, `Jefe2`, `fecha_ingreso`,`añosA`,`mesesA`,`diasA`,`DiasVac`) VALUES (NULL,'".$UsuarioCod."','".$_POST["nombre"]."','".$_POST["appaterno"]."','".$_POST["apmaterno"]."','".$_POST["Posicion"]."', '".$_POST['area']."', '".$_POST['reporta']."', '".$_POST['jefe']."', '".$_POST['fecha_ingreso']."',, '".$_POST['ant_anios']."', '".$_POST['ant_mes']."', '".$_POST['ant_dias']."', '".$_POST['diasvacaciones']."' )";

							if($resultado2 = $mysqli->query($consulta2)) {

										$aniophp =	date("Y");

										$consulta3 = "INSERT INTO `tbl_vacaciones_usuarioxanio` (`CodVac`,`CodEmpleado `,`Anio`,` 	DiasVac`) VALUES (NULL,'".$UsuarioCod."','".$aniophp."','".$_POST['diasvacaciones']."' )";

										if($resultado3 = $mysqli->query($consulta3)) {

										header("Location: index.php");

										}

							// echo "<script language=Javascript> location.href= 'index.php'; </script> ";
							//header("Location: sistema/admin/index.php");
							

							}
							else{
							echo "error al guardar 2";
							}


				}

			}


	}



?>