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

	 $PeriodoAntPHP = $_POST["PeriodoAnt"];   
	 $DiasVacPeriodoAntPHP = $_POST["DiasVacPeriodoAnt"];   

	

	$consulta1 = "INSERT INTO `tbl_usuarios` (`CodUsuario`, `Usuario`, `Clave`, `Correo`, `Estatus`, `Perfil`, `Fecha_Alta`, `Hora_Alta`) VALUES (NULL,'".$UsuarioPHP."', '".$PassEncriptadoPHP."', '".$CorreoPHP."', '1', '".$PerfilPHP."','".$fecha_del_dia."', '".$hora_actual."')";

	if($resultado1 = $mysqli->query($consulta1)) {


		$traerid = "SELECT CodUsuario FROM `tbl_usuarios` WHERE Usuario= '".$UsuarioPHP."' AND Perfil = '".$PerfilPHP."' AND  Clave = '".$PassEncriptadoPHP."' ";

		if($resid = $mysqli->query($traerid)) {
				$data = $resid->fetch_array();

					 $UsuarioCod =  $data["CodUsuario"];


							$consulta2 = "INSERT INTO `tbl_empleados` (`CodE`,`CodUsu`,`Nombres`,`ApellidoPaterno`,`ApellidoMaterno`,`Posicion`, `Area`, `Reporta`, `Jefe2`, `fecha_ingreso`,`aniosA`,`mesesA`,`diasA`,`DiasVac`) VALUES (NULL,'".$UsuarioCod."','".$_POST["nombre"]."','".$_POST["appaterno"]."','".$_POST["apmaterno"]."','".$_POST["Posicion"]."', '".$_POST['area']."', '".$_POST['reporta']."', '".$_POST['jefe']."', '".$_POST['fecha_ingreso']."', '".$_POST['ant_anios']."', '".$_POST['ant_mes']."', '".$_POST['ant_dias']."','".$_POST['diasvacaciones']."')";

							if($resultado2 = $mysqli->query($consulta2)) {

							

							$aniophp =	date("Y");

										$consulta3 = "INSERT INTO `tbl_vacaciones_usuarioxanio` (`CodVac`,`CodEmpleado`,`Anio`,`DiasVac`) VALUES (NULL,'".$UsuarioCod."','".$aniophp."','".$_POST['diasvacaciones']."' )";

											if($resultado3 = $mysqli->query($consulta3)) {

											//echo "si se guardo la consulta";

													if($PeriodoAntPHP <> 0 or $PeriodoAntPHP <> NULL){
															
													      $consulta4 = "INSERT INTO `tbl_periodoanterior` (`CodPeridoAnt`,`CodUsuario`,`PeriodoAnt`,`DiasVacAnt`) VALUES (NULL,'".$UsuarioCod."','".$PeriodoAntPHP."','".$DiasVacPeriodoAntPHP."' )";

															if($resultado4 = $mysqli->query($consulta4)) {

															//echo "si se guardo la consulta4";	

																	require("../PHPMailer-master/src/PHPMailer.php");
																	require("../PHPMailer-master/src/SMTP.php");
																	require("../PHPMailer-master/src/Exception.php");


																	$mail2 = new PHPMailer\PHPMailer\PHPMailer();
																	$mail2->IsSMTP(); 

																	$mail2->CharSet="UTF-8";
																	$mail2->Host = "smtp.office365.com";
																	//$mail2->SMTPDebug = 2; 
																	$mail2->Port = 587; //465 or 587

																	$mail2->SMTPSecure = 'tls';  
																	$mail2->SMTPAuth = true; 
																	$mail2->IsHTML(true);

																	//Authentication
																	$mail2->Username = "recursos.humanos@wri.org";
																	$mail2->Password = "WRIm3x1c086! ";

																	//Set Params
																	$mail2->SetFrom("recursos.humanos@wri.org");
																	$mail2->AddAddress($CorreoPHP);
																	//$mail2->AddAddress("michusvalentin@gmail.com");


																	$mail2->Subject = "Alta en el Sistema de Solicitud de Vacaciones WRI";
																	$mail2->Body = '
																	<html>
																	<head>
																	<title>Bienvenido Usuario '.$nombrePHP.'  </title>
																	</head>
																	<body>
																	<h1>
																	Notificacion de Alta en Sistema de Solicitud de Vacaciones WRI:
																	</h1>
																	<p>

																	Hola estimado Usuario '.$nombrePHP.' se te ha dado de alta en el sistema de Vacaciones WRI <br>
																	Tus Datos son los Siguientes:
																	<br>
																	Usuario: '.$UsuarioPHP.'
																	<br>
																	Clave: '.$PassPHP.'
																	<br>
																	Puedes entrar a tu perfil a solicitar vacaciones  desde 
																	http:localhost/sistemadevacaciones/index.php
																	</p>
																	</body>
																	</html>
																	';


																	if(!$mail2->Send()) {
																	// echo "Mailer Error: " . $mail->ErrorInfo;
																	echo "Error al enviar Mensaje 2";
																	} else {
																	//$alerta = "guardado";
																	header("Location: index.php");
																	}


															

															}

													}else if($PeriodoAntPHP == 0 or $PeriodoAntPHP == NULL){

														require("../PHPMailer-master/src/PHPMailer.php");
														require("../PHPMailer-master/src/SMTP.php");
														require("../PHPMailer-master/src/Exception.php");


														$mail = new PHPMailer\PHPMailer\PHPMailer();
														$mail->IsSMTP(); 

														$mail->CharSet="UTF-8";
														$mail->Host = "smtp.office365.com";
														//$mail->SMTPDebug = 2; 
														$mail->Port = 587; //465 or 587

														$mail->SMTPSecure = 'tls';  
														$mail->SMTPAuth = true; 
														$mail->IsHTML(true);

														//Authentication
														$mail->Username = "recursos.humanos@wri.org";
														$mail->Password = "WRIm3x1c086! ";

														//Set Params
														$mail->SetFrom("recursos.humanos@wri.org");
														$mail->AddAddress($CorreoPHP);
														//$mail->AddAddress("michusvalentin@gmail.com");


														$mail->Subject = "Alta en el Sistema de Solicitud de Vacaciones WRI";
														$mail->Body = '
														<html>
														<head>
														<title>Bienvenido Usuario '.$nombrePHP.'  </title>
														</head>
														<body>
														<h1>
														Notificacion de Alta en Sistema de Solicitud de Vacaciones WRI:
														</h1>
														<p>

														Hola estimado Usuario '.$nombrePHP.' se te ha dado de alta en el sistema de Vacaciones WRI <br>
														Tus Datos son los Siguientes:
														<br>
														Usuario: '.$UsuarioPHP.'
														<br>
														Clave: '.$PassPHP.'
														<br>
														Puedes entrar a tu perfil a solicitar vacaciones  desde 
														http:localhost/sistemadevacaciones/index.php
														</p>
														</body>
														</html>
														';


														if(!$mail->Send()) {
														// echo "Mailer Error: " . $mail->ErrorInfo;
														echo "Error al enviar Mensaje";
														} else {
														//$alerta = "guardado";
														header("Location: index.php");
														}
						  

													     
													}	
											

											}
											/*else{
											echo "no se guardo la consulta";
											echo "Error: "  . $mysqli->error;
											}*/

							}

							/*else{
							echo "no se guardo la consulta";
							echo "Error: "  . $mysqli->error;
							}*/



			}


	}
							
			
							




?>