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

        $EstatusSolicitud = $_POST['EstatusSol'];
        $CodEmpleado = $_POST["CodEmpleado"];


        /*para mamndar el correo al usuario*/
        $sqlUsuario = "SELECT * FROM `tbl_usuarios` as u INNER JOIN `tbl_empleados` as e ON u.CodUsuario = e.CodUsu WHERE u.estatus = 1 AND u.CodUsuario = ".$_POST["CodEmpleado"]." ";
        $resqryUsuario = $mysqli->query($sqlUsuario);
        $data = mysqli_fetch_assoc($resqryUsuario);
        $CorreoEmpleado = $data['Correo'];
        

         if($EstatusSolicitud == 1 ){//ACEPTADO


                $qryConsulta98 = "SELECT COUNT(*) as SiHayDias FROM `tbl_periodoanterior` WHERE CodUsuario =  ".$CodEmpleado." ";           
             if($resQryConsulta98 = $mysqli->query($qryConsulta98)) {
            $dataCons98 = mysqli_fetch_assoc($resQryConsulta98);

                if($dataCons98['SiHayDias'] == 1 ){

                      $qryConsulta97 = "SELECT * FROM `tbl_periodoanterior` WHERE CodUsuario =  ".$CodEmpleado." ";
                      if($resQryConsulta97 = $mysqli->query($qryConsulta97)) {

                            $dataCons97 = mysqli_fetch_assoc($resQryConsulta97);   
                             $CodPeriodoAntPHP =  $dataCons97['CodPeridoAnt']; 

                               $qryConsulta94 = "UPDATE  `tbl_periodoanterior` SET SeUso = '1'  WHERE CodPeridoAnt =  ".$CodPeriodoAntPHP." ";

                                  if($resQryConsulta94 = $mysqli->query($qryConsulta94)) {
                                  
                                  }

                      }

            }

            }


                      $consulta1 = "INSERT INTO `tbl_rasolicitud` (`CodRAS`, `CodSol`,  `CodUsuario`,`Motivo`, `FechaAR`, `HoraAR`, `EstatusSolicitud`, `Tipo`) VALUES (NULL,'".$_POST["CodS"]."', '".$_POST["CodEmpleado"]."', '".$_POST['observaciones']."', '".$fecha_del_dia."', '".$hora_actual."','".$_POST['EstatusSol']."','2')";             
                      if($resultado1 = $mysqli->query($consulta1)) {

                      $consulta2 = "UPDATE `tbl_solicitud` SET `Estatus` = '".$_POST['EstatusSol']."' WHERE  CodSol = '".$_POST["CodS"]."' ";             
                      if($resultado2 = $mysqli->query($consulta2)) {


                          $sqltrab = "SELECT * FROM  `tbl_empleados`   WHERE  CodUsu  = ".$_POST["CodEmpleado"]." ";
                        if($qrytrab = $mysqli->query($sqltrab)) {
                        $datatrab = mysqli_fetch_assoc($qrytrab);
                        $DiasVacPHP = $datatrab['DiasVac'];


                          $sqlsol = "SELECT * FROM  `tbl_solicitud`  WHERE  CodUsuario  = ".$_POST["CodEmpleado"]." ";
                              if($qrysol = $mysqli->query($sqlsol)) {
                              $datasol = mysqli_fetch_assoc($qrysol);
                              $DiasSolPHP = $datasol['DiasSolicitados'];

                                 $total = $DiasVacPHP - $DiasSolPHP;


                         $consulta3 = "UPDATE `tbl_vacaciones_usuarioxanio`  SET `DiasVac` = ".$total." WHERE  CodEmpleado = ".$_POST["CodEmpleado"]." ";  
                                    if($resultado3 = $mysqli->query($consulta3)) {




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
                          $mail->AddAddress($CorreoEmpleado2);
                          $mail->AddAddress("michusvalentin@hotmail.com");
                     

                          $mail->Subject = "Solicitud de Vacaciones Aprobada";
                          $mail->Body = '
                          <html>
                          <head>
                          <title>Bienvenido</title>
                          </head>
                          <body>
                          <h1>
                          Notificacion de Solicitud de Vacaciones Apropbada:
                          </h1>
                          <p>
                          
              Hola estimado Usuario  tu solicitud ha sido aprobada <br>
              Para revisar tus dias restantes segir el siguiente link:
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
                              
                              header("Location: index.php");  
                             
                    
                          }
                                        
                                    }else{
                                         ECHO "ERROR";
                                         echo mysql_errno($consulta3);
                                    }
                      
                              //

                              }



                      }

                    
                     

                      }

                      }

         }
         else if($EstatusSolicitud == 0){  /*ceptado*/

                 $consulta1 = "INSERT INTO `tbl_rasolicitud` (`CodRAS`, `CodSol`,  `CodUsuario`,`Motivo`, `FechaAR`, `HoraAR`, `EstatusSolicitud`, `Tipo`) VALUES (NULL,'".$_POST["CodS"]."', '".$_POST["CodEmpleado"]."', '".$_POST['observaciones']."', '".$fecha_del_dia."', '".$hora_actual."','".$_POST['EstatusSol']."','1')";             
                      if($resultado1 = $mysqli->query($consulta1)) {

                      $consulta2 = "UPDATE `tbl_solicitud` SET `Estatus` = '".$_POST['EstatusSol']."' WHERE  CodSol = '".$_POST["CodS"]."' ";             
                      if($resultado2 = $mysqli->query($consulta2)) {

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
              $mail->AddAddress("michusvalentin@hotmail.com");
                     

                          $mail->Subject = "Solicitud de Vacaciones Rechazada";
                          $mail->Body = '
                          <html>
                          <head>
                          <title>Bienvenido</title>
                          </head>
                          <body>
                          <h1>
                          Notificacion de Solicitud de Vacaciones Rechazada:
                          </h1>
                          <p>
                          
              Hola estimado Usuario  tu solicitud ha sido rechazada <br>
              Para revisar el motivo entrar al siguiente link:
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
                          //$alerta = "guardado";
                           header("Location: index.php");  
                          }

                      }

                    }

         }


                                       
}else {
    header("Location: ../index.php");
  }