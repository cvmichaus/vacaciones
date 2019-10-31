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

                                        /*envia correo*/


                                require("../PHPMailer-master/src/PHPMailer.php");
                                require("../PHPMailer-master/src/SMTP.php");
                                require("../PHPMailer-master/src/Exception.php");


                                $mail3 = new PHPMailer\PHPMailer\PHPMailer();
                                $mail3->IsSMTP(); 

                                $mail3->CharSet="UTF-8";
                                $mail3->Host = "smtp.gmail.com";
                                //$mail3->Host = "smtp.office365.com";
                                //$mail3->SMTPDebug = 2; 
                                $mail3->Port = 587; //465 or 587

                                $mail3->SMTPSecure = 'tls';  
                                $mail3->SMTPAuth = true; 
                                $mail3->IsHTML(true);

                                //Authentication
                                $mail3->Username = "vacacioneswrimexico@gmail.com";
                                $mail3->Password = "Rueville10!";
                                //$mail3->Username = "recursos.humanos@wri.org";
                                // $mail3->Password = "WRIm3x1c086!";

                                //Set Params
                                $mail3->SetFrom("vacacioneswrimexico@gmail.com");
                                //$mail3->AddAddress($CorreoEmpleado2);
                                $mail3->AddAddress($CorreoEmpleado);


                                $mail3->Subject = "Solicitud de Vacaciones Aprobada";
                                $mail3->Body = '
                                <html>
                                <head>
                                <title>Bienvenido</title>
                                </head>
                                <body>
                                <h1>
                                Notificación de Solicitud de Vacaciones Aprobada:
                                </h1>
                                <p>

                               
                                Hola estimado Usuario tu solicitud ha sido aprobada <br>
                                Para revisar tus días restantes seguir el siguiente link:

                                <br>
                                http:localhost/sistemadevacaciones/index.php
                                </p>

                                </body>
                                </html>
                                ';


                                if(!$mail3->Send()) {
                                // echo "Mailer Error: " . $mail->ErrorInfo;
                                echo "Error al enviar Mensaje";
                                } else {

                                //header("Location: index.php");  

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


                              /*envia correo*/

                                require("../PHPMailer-master/src/PHPMailer.php");
                                require("../PHPMailer-master/src/SMTP.php");
                                require("../PHPMailer-master/src/Exception.php");


                                $mail4 = new PHPMailer\PHPMailer\PHPMailer();
                                $mail4->IsSMTP(); 

                                $mail4->CharSet="UTF-8";
                                $mail4->Host = "smtp.gmail.com";
                                //$mail4->Host = "smtp.office365.com";
                                //$mail4->SMTPDebug = 2; 
                                $mail4->Port = 587; //465 or 587

                                $mail4->SMTPSecure = 'tls';  
                                $mail4->SMTPAuth = true; 
                                $mail4->IsHTML(true);

                                //Authentication
                                $mail4->Username = "vacacioneswrimexico@gmail.com";
                                $mail4->Password = "Rueville10!";
                                //$mail4->Username = "recursos.humanos@wri.org";
                                // $mail4->Password = "WRIm3x1c086!";

                                //Set Params
                                $mail4->SetFrom("vacacioneswrimexico@gmail.com");
                                //$mail4->AddAddress($CorreoEmpleado2);
                                 $mail4->AddAddress($CorreoEmpleado);


                                $mail4->Subject = "Solicitud de Vacaciones Rechazada";
                                $mail4->Body = '
                                 <html>
                                <head>
                                <title>Bienvenido</title>
                                </head>
                                <body>
                                <h1>
                                Notificación de Solicitud de Vacaciones Aprobada:
                                </h1>
                                <p>

                               
                                Hola estimado Usuario tu solicitud ha sido aprobada <br>
                                Para revisar tus días restantes seguir el siguiente link:

                                <br>
                                http:localhost/sistemadevacaciones/index.php
                                </p>

                                </body>
                                </html>
                                </html>
                                ';


                                if(!$mail4->Send()) {
                                // echo "Mailer Error: " . $mail->ErrorInfo;
                                echo "Error al enviar Mensaje";
                                } else {

                                //header("Location: index.php");  

                                header("Location: index.php");  

                                }

                      }

                    }

         }


                                       
}else {
    header("Location: ../index.php");
  }