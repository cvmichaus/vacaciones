	<?php
session_start();
  if($_SESSION["logueado"] == TRUE) {

      set_time_limit(0);
      require("../../class/cnmysql.php");
      date_default_timezone_set('America/Mexico_City');
      $fecha_del_dia=date('Y-m-d');//fecha actual

      $user = $_SESSION['UsuarioNombre'];
      $iduser = $_SESSION['CodUsuario'];
      $ClaveUsuario = $_GET['cod']; 

      $sqlDAtosU = "SELECT * FROM `tbl_usuarios` as u INNER JOIN tbl_empleados as e ON u.CodUsuario = e.CodUsu INNER JOIN tbl_vacaciones_usuarioxanio as v ON v.CodEmpleado = e.CodUsu WHERE u.CodUsuario = '".$ClaveUsuario."' ";
    if($resqryDU = $mysqli->query($sqlDAtosU)) {
      $dataDU = mysqli_fetch_assoc($resqryDU);
     
      $CodUsuarioPHP = $dataDU['CodUsuario']; 
      $FechaAltaPHP = $dataDU['Fecha_Alta']; 

      $Usuariophp =   $dataDU['Usuario']; 
      $ClavePHP =    $dataDU['Clave']; 
      $CorreoPHP =    $dataDU['Correo']; 
      $PerfilPHP =    $dataDU['Perfil']; 

      $NombresPHP =   $dataDU['Nombres']; 
      $ApPaternoPHP =   $dataDU['ApellidoPaterno']; 
      $ApMaternoPHP =   $dataDU['ApellidoMaterno']; 
      $PosicionPHP =   $dataDU['Posicion']; 
      $AreaPHP =   $dataDU['Area']; 
      $ReportaPHP =    $dataDU['Reporta']; 
      $Jefe2PHP =   $dataDU['Jefe2']; 
      $FechaIngresoPHP =   $dataDU['fecha_ingreso']; 

    }
?>

	<form  class="form-horizontal form-label-left" action="modpass.php" method="post" accept-charset="utf-8" >

		<h2>Modificar Conytraseña de  Usuario <?php echo $dataDU["Nombres"]; echo " "; echo $dataDU["ApellidoPaterno"];  echo " "; echo $dataDU["ApellidoMaterno"]; ?></h2>

		 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Password</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input  type="password" id="passwd" size="20" name="passwd" placeholder="Pass" required >
                          <span class="fa fa-eye-slash form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>


  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Confirmar Password</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                     <input  type="password" id="passwd2" size="20" name="passwd2" placeholder="PassV" required onblur="validarPasswd();">
                          <span class="fa fa-eye-slash form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>


                       <input  type="hidden" id="correo" name="correo" placeholder="Correo" value='<?php echo $CorreoPHP; ?>'>
                           <input type="hidden" name="CodUsuario" id="CodUsuario" value="<?php echo $CodUsuarioPHP; ?>" >
                           


		             <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                        
 <input type="submit" value="Cambiar Clave" class="btn btn-primary">  


                        </div>
                      </div>

	
		
	</form>

    


	<?php
  } else {
    header("Location: ../index.php");
  }
 
 ?>