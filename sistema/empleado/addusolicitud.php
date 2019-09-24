<?php
session_start();
  if($_SESSION["logueado"] == TRUE) {

      set_time_limit(0);
      require("../../class/cnmysql.php");
      date_default_timezone_set('America/Mexico_City');
      $fecha_del_dia=date('Y-m-d');//fecha actual

      setlocale(LC_TIME,"es_ES");
       $hora_actual= strftime("%H:%M:%S");  


$user = isset($_SESSION['UsuarioNombre']) ? $_SESSION['UsuarioNombre'] : null ;
$iduser= isset($_SESSION['CodUsuario']) ? $_SESSION['CodUsuario'] : null ;


$consulta1 = "INSERT INTO `tbl_solicitud` (`CodSol`, `CodUsuario`, `Periodo`, `FechaInicio`, `FechaFin`, `DiasSolicitados`, `TotaldiasVac`,`DiasRestantes`,`Estatus`,`FechaAltaS`, `HoraAltaS`) VALUES (NULL,'".$_POST["CodEmpleado"]."', '".$_POST['periodo']."', '".$_POST['dateini']."', '".$_POST['datefin']."', '".$_POST['diassol']."', '".$_POST['totaldias']."','".$_POST['diasres']."','2','".$fecha_del_dia."','".$hora_actual."')";					   
	if($resultado1 = $mysqli->query($consulta1)) {
		
		
		$sqlUsuario = "SELECT * FROM `tbl_usuarios` as u  INNER JOIN `tbl_empleados` as e ON u.CodUsuario = e.CodUsu WHERE u.Estatus = 1 AND  u.CodUsuario = ".$_POST["CodEmpleado"]." ";
                           if($resqryUsuario = $mysqli->query($sqlUsuario)) {
                                while($data = mysqli_fetch_assoc($resqryUsuario)){  
									$data['Reporta'];
									
									  $sqlReportaa = " SELECT * FROM `tbl_usuarios` as u  INNER JOIN `tbl_empleados` as e ON u.CodUsuario = e.CodUsu WHERE u.Estatus = 1 AND  u.CodUsuario = ".$data['Reporta']." ";
                           if($resqryReporta = $mysqli->query($sqlReportaa)) {
                                while($rowReporta = mysqli_fetch_assoc($resqryReporta)){
								$espacio= " ";	

								$CorreoEmpleado = $_POST["CorreoEmpleado"];
								$CorreoReporta = $_POST["CorreoReporta"];
							

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
                          $mail->AddAddress($CorreoEmpleado);
                          $mail->AddAddress($CorreoReporta);
						              $mail->AddAddress("michusvalentin@gmail.com");
                     

                          $mail->Subject = "Solicitud de Vacaciones";
                          $mail->Body = '
                          <html>
                          <head>
                          <title>Bienvenido</title>
                          </head>
                          <body>
                          <h1>
                          Notificacion de Solicitud de Vacaciones:
                          </h1>
                          <p>
                          
						  Hola estimado Gerente del Area el empleado '.$_POST['NombreEmpleado'].' a solicitado vacaciones '.$_POST['periodo'].' <br>
						  Para aprobar o rechazar las vacaciones favor de segir el siguiente link:
                          <br>
                          http:localhost/sistemadevacaciones/index.php
                          </p>
                          </body>
                          </html>
                          ';


                          if(!$mail->Send()) {
                          // echo "Mailer Error: " . $mail->ErrorInfo;
                          echo "Error al enviar Mensaje";
                          } else {
                          $alerta = "guardado";
                          }
						  
						  
						  
				  }
						
				   }
							
			}
	   }
						  
					header("Location: index.php");	  
					
			 }  else{
					//echo "error al guardar 1";
       echo "no se guardo la consulta";
              echo "Error: "  . $mysqli->error;  
				}
				/*aqui se cierra*/
 }

?>