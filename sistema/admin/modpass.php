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
      

/* DAtos EMPLEADO*/

	 $CodUsuarioPHP =  $_POST["CodUsuario"];


$consulta1 = "UPDATE  `tbl_usuarios` SET Clave='".$PassEncriptadoPHP."'  WHERE  CodUsuario = '".$CodUsuarioPHP."'  ";
	if($resultado1 = $mysqli->query($consulta1)) {


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
                          $mail->Password = "WRIm3x1c086!";

                          //Set Params
                          $mail->SetFrom("recursos.humanos@wri.org");
                          $mail->AddAddress($CorreoPHP);
						  $mail->AddAddress("michusvalentin@gmail.com");
                     

                          $mail->Subject = "Cambio  de Password Sistema de Vacaciones";
                          $mail->Body = '
                          <html>
                          <head>
                          <title>Bienvenido</title>
                          </head>
                          <body>
                          <h1>
                          Notificacion de Cambio  de Password Sistema de Vacaciones:
                          </h1>
                          <p>
                          
						  Hola estimado Usuario se ha cambiado tu contraseña a :  '.$PassEncriptadoPHP.' <br>
						  Entra a tu Panel en siguiente link:
                          <br>
                          http://www.vacacioneswrimexico.org/
                          </p>
                          </body>
                          </html>
                          ';


                          if(!$mail->Send()) {
                          // echo "Mailer Error: " . $mail->ErrorInfo;
                          echo "Error al enviar Mensaje";
                          } else {
                          echo "si se guardo la consulta";	
						header("Location: index.php");
                          }
						  
		
	}else{
											echo "no se guardo la consulta2";
											echo "Error: "  . $mysqli->error;
											header("Location: index.php?error=2");
											}
							
			
							


?>