<?php
/*DATOS USUARIO*/
    require("../../class/cnmysql.php");
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
	 $CodUPHP = $_POST["CodU"];
	 $CodUsuarioPHP =  $_POST["CodUsuario"];


$consulta1 = "UPDATE  `tbl_usuarios` SET Usuario='".$UsuarioPHP."'  , Correo = '".$CorreoPHP."' , Perfil = '".$PerfilPHP."' WHERE  CodUsuario = '".$CodUsuarioPHP."'  ";
	if($resultado1 = $mysqli->query($consulta1)) {

				$consulta2 = "UPDATE  `tbl_empleados` SET Nombres='".$nombrePHP."'  , ApellidoPaterno = '".$appaternoPHP."' , ApellidoMaterno = '".$apmaternoPHP."', Posicion ='".$PosicionPHP."' , Area ='".$areaPHP."' , Reporta ='".$reportaPHP."' , Jefe2 ='".$jefePHP."'  WHERE  CodE = '".$CodUPHP."'  ";
				if($resultado2 = $mysqli->query($consulta2)) {

						echo "si se guardo la consulta";	
						header("Location: index.php");

				}else{
											echo "no se guardo la consulta1";
											echo "Error: "  . $mysqli->error;
											header("Location: index.php?error=1");
											}


	}else{
											echo "no se guardo la consulta2";
											echo "Error: "  . $mysqli->error;
											header("Location: index.php?error=2");
											}
							
			
							




?>