<?php
session_start();
  if($_SESSION["logueado"] == TRUE) {

      set_time_limit(0);
      require("../../class/cnmysql.php");
      date_default_timezone_set('America/Mexico_City');
      $fecha_del_dia=date('Y-m-d');//fecha actual

      $user = $_SESSION['UsuarioNombre'];
      $iduser = $_SESSION['CodUsuario'];
	 
	  
	  
?>

<form class="form-horizontal form-label-left" action="addusolicitud.php" method="post">
     <input id="CodEmpleado" name="CodEmpleado" type="hidden" value="<?php echo $iduser; ?>">
                        
						<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Periodo </label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                        <input id="periodo" name="periodo" type="text" class="form-control" data-inputmask="">
                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                        </div>

                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Fecha Inicio</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                        <input id="dateini" name="dateini" type="date" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" class="form-control" data-inputmask="" min="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>">
                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                        </div>

                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Fecha Final</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                        <input id="datefin" name="datefin" type="date" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" class="form-control" data-inputmask=""  min="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>"  onblur="obtenerfechas();">
                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                        </div>

						
							
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Dias Solicitados </label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
						<input id="diassol" name="diassol" type="text" class="form-control" data-inputmask="" onblur="restadias();">
                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                        </div>
						
						<?php
							 /*OBTENEMOS LOS DATOS PARA ENVIAR EL CORREO*/
			$sqlUsuario = "SELECT * FROM `tbl_usuarios` as u  
			INNER JOIN `tbl_empleados` as e ON u.CodUsuario = e.CodUsu 
			WHERE u.Estatus = 1 AND  u.CodUsuario = ".$iduser." ";
			
                           if($resqryUsuario = $mysqli->query($sqlUsuario)) {
                                while($row = mysqli_fetch_assoc($resqryUsuario)){ 
								$esp = " ";
								 $CorreoPHP = $row['Correo'];
								  $NombrePHP = $row['Nombres'].$esp.$row['ApellidoPaterno'].$esp.$row['ApellidoMaterno'];
								?>
				<input  id="NombreEmpleado" name="NombreEmpleado" type="hidden" class="form-control" data-inputmask="" value='<?php echo $NombrePHP; ?>'>
				<input  id="CorreoEmpleado" name="CorreoEmpleado" type="hidden" class="form-control" data-inputmask="" value='<?php echo $CorreoPHP; ?>'>
								<?php
								
								
								 $ReportaPHP = $row['Reporta'];
											$sqlUsuarioR = "SELECT * FROM `tbl_usuarios` as u  
											INNER JOIN `tbl_empleados` as e ON u.CodUsuario = e.CodUsu 
											WHERE u.Estatus = 1 AND  u.CodUsuario = ".$ReportaPHP." ";

											if($resqryUsuarioR = $mysqli->query($sqlUsuarioR)) {
											while($rowR = mysqli_fetch_assoc($resqryUsuarioR)){ 
										    $CorreoReportaPHP = $rowR['Correo'];
											?>
			<input  id="CorreoReporta" name="CorreoReporta" type="hidden" class="form-control" data-inputmask="" value='<?php echo $CorreoReportaPHP; ?>'>
								<?php
											
											}
											}
								}
						   }
		/*OBTENEMOS LOS DATOS PARA ENVIAR EL CORREO*/
						?>
													
						<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Dias Vacaciones </label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                        <input  id="totaldias" name="totaldias" type="text" class="form-control" data-inputmask="" value='<?php
							$sqlUsuario = "SELECT * FROM `tbl_usuarios` as u  INNER JOIN `tbl_empleados` as e ON u.CodUsuario = e.CodUsu WHERE u.Estatus = 1 AND  u.CodUsuario = ".$iduser." ";
                           if($resqryUsuario = $mysqli->query($sqlUsuario)) {
                                while($data = mysqli_fetch_assoc($resqryUsuario)){  
							
								$fecha1= new DateTime($fecha_del_dia);
								$fecha2= new DateTime($data['Fecha_Alta']);
								$diff = $fecha1->diff($fecha2);

									// El resultados sera 3 dias
									$diasd = $diff->days;
									$anios = $diff->y;

									if( $diasd <= 365){
									echo "0";
									}
									else {
										
										if($anios === 1 ){
								echo "6";
								}
								else if($anios === 2 ){
								echo "8";
								}
								else if($anios === 3 ){
								echo "10";
								}
								else if($anios === 4 ){
								echo "12";
								}
								else if (($anios >= 5) && ($anios <= 9)){ 
								echo "14";
								}
								else if (($anios >= 10) && ($anios <= 14)){ 
								echo "16";
								}
								else if (($anios >= 15) && ($anios <= 19)){ 
								echo "18";
								}
								else if (($anios >= 20) && ($anios <= 24)){ 
								echo "20";
								}
								else if (($anios >= 25) && ($anios <= 29)){ 
								echo "22";
								}
								else if (($anios >= 30) && ($anios <= 34)){ 
								echo "24";
								}
								else if (($anios >= 35) && ($anios <= 39)){ 
								echo "26";
								}
								else if (($anios >= 40) && ($anios <= 44)){ 
								echo "28";
								}
								else if (($anios >= 45) && ($anios <= 49)){ 
								echo "30";
								}

									}
							
								}
						   }
						?>'>
                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                        </div>
							
                          <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Dias Restantes</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                        <input id="diasres" name="diasres" type="text" class="form-control" data-inputmask="">
                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                        </div>

                        <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                        
 <input type="submit" value="ENVIAR SOLICITUD" class="btn btn-primary">  
                        </div>
                      </div>



</form>



<?php
  } else {
    header("Location: ../index.php");
  }
 
 ?>