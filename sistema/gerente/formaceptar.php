<?php
session_start();
  if($_SESSION["logueado"] == TRUE) {

      set_time_limit(0);
      require("../../class/cnmysql.php");
      date_default_timezone_set('America/Mexico_City');
      $fecha_del_dia=date('Y-m-d');//fecha actual

      $user = $_SESSION['UsuarioNombre'];
      $iduser = $_SESSION['CodUsuario'];
      
	  $CodSolicitudphp = $_GET['cods'];
    $CodUsuariophp = $_GET['codUsuario'];

?>
<form class="form-horizontal form-label-left" action="addrechazo.php" method="post">

<div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-3">Observacioness</label>
<div class="col-md-12 col-sm-12 col-xs-12">
<textarea id="observaciones" name="observaciones" type="text" class="form-control" data-inputmask=""></textarea>
<input id="CodS" name="CodS" type="hidden" class="form-control" value='<?php echo $CodSolicitudphp; ?>'>
<input id="CodEmpleado" name="CodEmpleado" type="hidden" class="form-control" value='<?php echo $CodUsuariophp; ?>'>
<input id="EstatusSol" name="EstatusSol" type="hidden" class="form-control" value="1">
<span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
</div>
</div>

<div class="form-group">
<div class="col-md-9 col-md-offset-3">

<input type="submit" value="Aceptar Solicitud" class="btn btn-success">  
</div>
</div>

</form>
<?php
  } else {
    header("Location: ../index.php");
  }
 
 ?>