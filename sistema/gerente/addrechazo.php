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
        $CodSolicitud= $_POST["CodS"];


        /*para mamndar el correo al usuario*/
        $sqlUsuario = "SELECT * FROM `tbl_usuarios` as u INNER JOIN `tbl_empleados` as e ON u.CodUsuario = e.CodUsu WHERE u.estatus = 1 AND u.CodUsuario = ".$_POST["CodEmpleado"]." ";
        $resqryUsuario = $mysqli->query($sqlUsuario);
        $data = mysqli_fetch_assoc($resqryUsuario);
        $CorreoEmpleado = $data['Correo'];
        
              /* ACEPTADO */
              if($EstatusSolicitud == 1 ){//ACEPTADO

                    $qryConsulta98 = "SELECT COUNT(*) as SiHayDias FROM `tbl_periodoanterior` WHERE CodUsuario =  ".$CodEmpleado." ";           
                    if($resQryConsulta98 = $mysqli->query($qryConsulta98)) {
                    $dataCons98 = mysqli_fetch_assoc($resQryConsulta98);

                         if($dataCons98['SiHayDias'] == 1 ){

                                 $qryConsulta97 = "SELECT * FROM `tbl_periodoanterior` WHERE CodUsuario =  ".$CodEmpleado." ";
                                        if($resQryConsulta97 = $mysqli->query($qryConsulta97)) {
                                        $dataCons97 = mysqli_fetch_assoc($resQryConsulta97);   
                                        $CodPeriodoAntPHP =  $dataCons97['CodPeridoAnt']; 
                                        /*se hace la resta y se hace un update a la tabla del periodo anterior*/
                                        $DiasPeriodoAnt_PHP =  $dataCons97['DiasVacAnt']; 

                                             /*obtenemos sus dias de solicitados*/  
                                                  $sqlsol = "SELECT * FROM  `tbl_solicitud`  WHERE  CodUsuario  = ".$_POST["CodEmpleado"]." and CodSol = ".$CodSolicitud." ";
                                                  if($qrysol = $mysqli->query($sqlsol)) {
                                                  $datasol = mysqli_fetch_assoc($qrysol);
                                                  $DiasSolPHP = $datasol['DiasSolicitados'];

                                                              if($DiasSolPHP == $DiasPeriodoAnt_PHP){ /* SI ES IGUAL */
                                                              echo '<script language="javascript">alert(" son iguales se pondra en  0");</script>';
                                                              $residuo =  $DiasPeriodoAnt_PHP - $DiasSolPHP;
                                                              echo '<script language="javascript">alert(" Residuo : '.$residuo.' ");</script>';

                                                                    $consulta2 = "UPDATE `tbl_periodoanterior` SET `DiasVacAnt` = '".$residuo."' WHERE  CodUsuario = '".$_POST["CodEmpleado"]."' ";             
                                                                    if($resultado2 = $mysqli->query($consulta2)) {
                                                                    echo '<script language="javascript">alert(" se realizo el Update del Residuo: '.$residuo.'  ");</script>';
                                                                    }


                                                              }/* SI ES IGUAL */
                                                                  else  if($DiasSolPHP > $DiasPeriodoAnt_PHP){/*ES MAYOR */
                                                                  echo '<script language="javascript">alert(" si es mayor necesitara que se descuente ");</script>';
                                                                  $residuo =  $DiasSolPHP - $DiasPeriodoAnt_PHP ;
                                                                  echo '<script language="javascript">alert(" Residuo : '.$residuo.' ");</script>';

                                                                      $residuo0=0;

                                                                      $consulta2 = "UPDATE `tbl_periodoanterior` SET `DiasVacAnt` = '".$residuo0."', SeUso=1 WHERE  CodUsuario = '".$_POST["CodEmpleado"]."' ";             
                                                                      if($resultado2 = $mysqli->query($consulta2)) {
                                                                      echo '<script language="javascript">alert(" se realizo el Update del Residuo: '.$residuo0.'  ");</script>';

                                                                              $sqltrab = "SELECT * FROM  `tbl_empleados`   WHERE  CodUsu  = ".$_POST["CodEmpleado"]." ";
                                                                              if($qrytrab = $mysqli->query($sqltrab)) {
                                                                              $datatrab = mysqli_fetch_assoc($qrytrab);
                                                                              $DiasVacPHP = $datatrab['DiasVac'];

                                                                                      $residuo2 = $residuo -  $DiasVacPHP;

                                                                                    $consulta4 = "UPDATE `tbl_vacaciones_usuarioxanio`  SET `DiasVac` = ".$residuo2." WHERE  CodEmpleado = ".$_POST["CodEmpleado"]." ";  
                                                                                    if($resultado3 = $mysqli->query($consulta4)) {
                                                                                    echo '<script language="javascript">alert(" entro al if donde el residuo2 se desconto del dis vac tiene valor  Residuo2: '.$residuo2.'  ");</script>';

                                                                                      $consulta1 = "INSERT INTO `tbl_rasolicitud` (`CodRAS`, `CodSol`,  `CodUsuario`,`Motivo`, `FechaAR`, `HoraAR`, `EstatusSolicitud`, `Tipo`) VALUES (NULL,'".$_POST["CodS"]."', '".$_POST["CodEmpleado"]."', '".$_POST['observaciones']."', '".$fecha_del_dia."', '".$hora_actual."','".$_POST['EstatusSol']."','2')";             
                                                                                      if($resultado1 = $mysqli->query($consulta1)) {

                                                                                      echo '<script language="javascript">alert(" se interto la aceptacion de la solicitud ");</script>';

                                                                                              $consulta3 = "UPDATE `tbl_solicitud` SET `Estatus` = '".$_POST['EstatusSol']."' WHERE  CodSol = '".$_POST["CodS"]."' ";
                                                                                              if($resultado3 = $mysqli->query($consulta3)) {
                                                                                              echo '<script language="javascript">alert(" se actualizo la tabla tbl_solicitud ");</script>';
                                                                                              header("Location: index.php");  
                                                                                              }  else{
                                                                                              echo '<script language="javascript">alert(" no se actualizo la tabla tbl_solicitud ");</script>';
                                                                                              }

                                                                                      }

                                                                                    }

                                                                              }

                                                                      }

                                                                  }/* ES MAYOR */

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
                                                                      $mail4->AddAddress("michusvalentin@gmail.com");



                                                                      $mail4->Subject = "Solicitud de Vacaciones Aprobada";
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

                                                                      Hola estimado Usuario tu solicitud ha sido Aprobada <br>
                                                                      Para revisar tus dias o generar otra solicitud ingresar al siguiente link:

                                                                      <br>
                                                                      http://192.168.3.65/sistemadevacaciones/
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

                                                                      header("Location: index.php?accion=aprobada");  

                                                                      }

                                                }

                                      }


                         }

                    }

                           // header("Location: index.php?accion=aceptado");  
                      
                /* ACEPTADO */  
                 } else if($EstatusSolicitud == 0){ 
                  /* TERMINA IF DE SI ES ACEPTADO  SI ES RECHAZADO*/

              //echo '<script language="javascript">alert("peticion rechazada, jajaja");</script>';

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
                                   $mail4->AddAddress("michusvalentin@gmail.com");



                                $mail4->Subject = "Solicitud de Vacaciones Rechazada";
                                $mail4->Body = '
                                 <html>
                                <head>
                                <title>Bienvenido</title>
                                </head>
                                <body>
                                <h1>
                                Notificación de Solicitud de Vacaciones Rechazada:
                                </h1>
                                <p>

                               Hola estimado Usuario tu solicitud ha sido Rechazada <br>
                                Para revisar tus dias o generar otra solicitud ingresar al siguiente link:

                                <br>
                                http://192.168.3.65/sistemadevacaciones/
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

                                header("Location: index.php?accion=rechazado");  

                                }
                                
                       }
                    }

              /* TERMINA IF DE SI ES ACEPTADO  SI ES RECHAZADO*/
            }
}else {
    header("Location: ../index.php");
}