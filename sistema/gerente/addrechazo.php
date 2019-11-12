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

          echo '<script language="javascript">alert(" es una peticion aceptada");</script>';


                    $qryConsulta98 = "SELECT COUNT(*) as SiHayDias FROM `tbl_periodoanterior` WHERE CodUsuario =  ".$CodEmpleado." ";           
                    if($resQryConsulta98 = $mysqli->query($qryConsulta98)) {

                    $dataCons98 = mysqli_fetch_assoc($resQryConsulta98);

                              if($dataCons98['SiHayDias'] == 1 ){/*SI HAY DIAS ANTERIORES*/

                              echo '<script language="javascript">alert(" si hay dias anteriores ");</script>';



                              }else{/* NO HAY DIAS ANTERIORES TOMAS LOS DIAS VACACIONES */
                                 echo '<script language="javascript">alert(" no hay dias anteriores ");</script>';

                                                $sqlsol = "SELECT * FROM  `tbl_solicitud`  WHERE  CodUsuario  = ".$_POST["CodEmpleado"]." and CodSol = ".$CodSolicitud." ";
                                                if($qrysol = $mysqli->query($sqlsol)) {
                                                $datasol = mysqli_fetch_assoc($qrysol);
                                                $DiasSolPHP = $datasol['DiasSolicitados'];
                                                echo '<script language="javascript">alert(" DiasSolPHP : '.$DiasSolPHP.' ");</script>';

                                                }

                                                $sqlsol2 = "SELECT * FROM  `tbl_vacaciones_usuarioxanio`  WHERE  CodEmpleado  = ".$_POST["CodEmpleado"]." ";
                                                if($qrysol2 = $mysqli->query($sqlsol2)) {
                                                $datos2 = mysqli_fetch_assoc($qrysol2);
                                                $DiasVacOriginales = $datos2['DiasVac'];
                                                echo '<script language="javascript">alert(" DiasVacOriginales : '.$DiasVacOriginales.' ");</script>';

                                                }
                                                   
                                                $residuo =  $DiasVacOriginales - $DiasSolPHP;
                                                echo '<script language="javascript">alert(" Residuo : '.$residuo.' ");</script>';

                                                  $consulta4 = "UPDATE `tbl_vacaciones_usuarioxanio`  SET `DiasVac` = ".$residuo." WHERE  CodEmpleado = ".$_POST["CodEmpleado"]." ";  
                                                  if($resultado3 = $mysqli->query($consulta4)) {

                                                              $consulta1 = "INSERT INTO `tbl_rasolicitud` (`CodRAS`, `CodSol`,  `CodUsuario`,`Motivo`, `FechaAR`, `HoraAR`, `EstatusSolicitud`, `Tipo`) VALUES (NULL,'".$_POST["CodS"]."', '".$_POST["CodEmpleado"]."', '".$_POST['observaciones']."', '".$fecha_del_dia."', '".$hora_actual."','".$_POST['EstatusSol']."','2')";             
                                                              
                                                              if($resultado1 = $mysqli->query($consulta1)) {

                                                               echo '<script language="javascript">alert(" se inserto la aceptacion de la solicitud ");</script>';

                                                                        $consulta3 = "UPDATE `tbl_solicitud` SET `Estatus` = '".$_POST['EstatusSol']."' WHERE  CodSol = '".$_POST["CodS"]."' ";
                                                                        if($resultado3 = $mysqli->query($consulta3)) {
                                                                         echo '<script language="javascript">alert(" se actualizo la tabla tbl_solicitud ");</script>';
                                                                                  
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

                                                                        }  else{
                                                                        echo '<script language="javascript">alert(" no se actualizo la tabla tbl_solicitud ");</script>';
                                                                        }


                                                              }





                                                  }



                                                    

                              }/* NO HAY DIAS ANTERIORES TOMAS LOS DIAS VACACIONES */

                        }/* QUERY DIAS ANTERIORES*/          
                        
                      
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