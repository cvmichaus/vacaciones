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
        

              if($EstatusSolicitud == 1 ){//ACEPTADO
              /* busco si hay dias del periodo anterior*/
              echo '<script language="javascript">alert(" entro al if peticion aceptada ");</script>';

                    $qryConsulta98 = "SELECT COUNT(*) as SiHayDias FROM `tbl_periodoanterior` WHERE CodUsuario =  ".$CodEmpleado." ";           
                    if($resQryConsulta98 = $mysqli->query($qryConsulta98)) {
                    $dataCons98 = mysqli_fetch_assoc($resQryConsulta98);
                    /* pregunto si los hay en el usuario */

                              if($dataCons98['SiHayDias'] == 1 ){
                              echo '<script language="javascript">alert(" si hay dias del periodo anterior de este usuario ");</script>';
                              /*si los hay restamos los dias solicitados si queda residuo los restamos  con los doas de vacaciones oficiales*/
                              /*obtengo los dias del peiodo anterior*/


                                        $qryConsulta97 = "SELECT * FROM `tbl_periodoanterior` WHERE CodUsuario =  ".$CodEmpleado." ";
                                        if($resQryConsulta97 = $mysqli->query($qryConsulta97)) {
                                        $dataCons97 = mysqli_fetch_assoc($resQryConsulta97);   
                                        $CodPeriodoAntPHP =  $dataCons97['CodPeridoAnt']; 
                                        /*se hace la resta y se hace un update a la tabla del periodo anterior*/
                                        $DiasPeriodoAnt_PHP =  $dataCons97['DiasVacAnt']; 
                                        //$residuo =  $CodPeriodoAntPHP -
                                        //$qryConsulta94 = "UPDATE  `tbl_periodoanterior` SET SeUso = '1'  WHERE CodPeridoAnt =  ".$CodPeriodoAntPHP." ";
                                        echo '<script language="javascript">alert(" entro al if para obtener los datos del periodo anterior Dias del Periodo: '.$DiasPeriodoAnt_PHP.' clave del periodo : '.$CodPeriodoAntPHP.' ");</script>';

                                                  /*obtenemos sus dias de solicitados*/  
                                                  $sqlsol = "SELECT * FROM  `tbl_solicitud`  WHERE  CodUsuario  = ".$_POST["CodEmpleado"]." and CodSol = ".$CodSolicitud." ";
                                                  if($qrysol = $mysqli->query($sqlsol)) {
                                                  $datasol = mysqli_fetch_assoc($qrysol);
                                                  $DiasSolPHP = $datasol['DiasSolicitados'];

                                         echo '<script language="javascript">alert(" Los dias solicitados de ese empladoes : '.$DiasSolPHP.' ");</script>';
                                                     /* veo si es mayor o igual los dias para poder saber si necesito descontarmas dias*/

                                                if($DiasSolPHP == $DiasPeriodoAnt_PHP){ /* SI ES IGUAL */
                                                echo '<script language="javascript">alert(" son iguales se pondra en  0");</script>';
                                                    $residuo =  $DiasPeriodoAnt_PHP - $DiasSolPHP;
                                                     echo '<script language="javascript">alert(" Residuo : '.$residuo.' ");</script>';

                                                            $consulta2 = "UPDATE `tbl_periodoanterior` SET `DiasVacAnt` = '".$residuo."' WHERE  CodUsuario = '".$_POST["CodEmpleado"]."' ";             
                                                            if($resultado2 = $mysqli->query($consulta2)) {
                                                            echo '<script language="javascript">alert(" se realizo el Update del Residuo: '.$residuo.'  ");</script>';
                                                            }


                                                }else  if($DiasSolPHP > $DiasPeriodoAnt_PHP){/*ES MAYOR */
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
                                                                                                  } 
                                                                                                  else{
                                                                                                  echo '<script language="javascript">alert(" no se actualizo la tabla tbl_solicitud ");</script>';
                                                                                                  }

                                                                                              }

                                                                          }
                                                                            

                                                                 }

                                                         }
                                                          


                                                }
                                                else  if($DiasSolPHP < $DiasPeriodoAnt_PHP){/*ES MENOR */
                                                echo '<script language="javascript">alert(" si es menor no necesitara que se descuente ");</script>';
                                                      $residuo =  $DiasPeriodoAnt_PHP - $DiasSolPHP;
                                                      echo '<script language="javascript">alert(" Residuo : '.$residuo.' ");</script>';

                                                              $consulta2 = "UPDATE `tbl_periodoanterior` SET `DiasVacAnt` = '".$residuo."' WHERE  CodUsuario = '".$_POST["CodEmpleado"]."' ";             
                                                              if($resultado2 = $mysqli->query($consulta2)) {
                                                              echo '<script language="javascript">alert(" se realizo el Update del Residuo: '.$residuo.'  ");</script>';

                                                                          $consulta1 = "INSERT INTO `tbl_rasolicitud` (`CodRAS`, `CodSol`,  `CodUsuario`,`Motivo`, `FechaAR`, `HoraAR`, `EstatusSolicitud`, `Tipo`) VALUES (NULL,'".$_POST["CodS"]."', '".$_POST["CodEmpleado"]."', '".$_POST['observaciones']."', '".$fecha_del_dia."', '".$hora_actual."','".$_POST['EstatusSol']."','2')";             
                                                                          if($resultado1 = $mysqli->query($consulta1)) {
                                                                          echo '<script language="javascript">alert(" se interto la aceptacion de la solicitud ");</script>';
                                                                          
                                                                              $consulta3 = "UPDATE `tbl_solicitud` SET `Estatus` = '".$_POST['EstatusSol']."' WHERE  CodSol = '".$_POST["CodS"]."' ";
                                                                              if($resultado3 = $mysqli->query($consulta3)) {
                                                                              echo '<script language="javascript">alert(" se actualizo la tabla tbl_solicitud ");</script>';
                                                                               } 
                                                                               else{
                                                                                 echo '<script language="javascript">alert(" no se actualizo la tabla tbl_solicitud ");</script>';
                                                                               }
                                                                                 
                                                                          }

                                                              }

                                                }


                                                    }   

                                                  }


                              }else{
                                 echo '<script language="javascript">alert(" no hay dias del periodo anterior de este usuario ");</script>';

                              }

                    }


              } else if($EstatusSolicitud == 0){ /* TERMINA IF DE SI ES ACEPTADO  SI ES RECHAZADO*/
              echo '<script language="javascript">alert("peticion rechazada, jajaja");</script>';

              }
}else {
    header("Location: ../index.php");
}