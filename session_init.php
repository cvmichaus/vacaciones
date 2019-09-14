<?php
date_default_timezone_set('America/Mexico_City');
$fecha_actual=date('Y-m-d');//fecha actual

if(isset($_POST["enviar"])) {
 
	require("class/cnmysql.php");
	  $loginNombre = $_POST["usuario"];    
	  $loginPassword = $_POST["password"]; 

	 //DESENCRIPTAMOS
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
 
 
   $pass_encriptado = encrypt($loginPassword,"wrimexico2019"); //ENCRIPTAR



		$consulta = "SELECT * FROM `tbl_usuarios` WHERE Usuario= '".$loginNombre."'  AND Clave= '".$pass_encriptado."' and estatus = 1 ";
		if($resultado = $mysqli->query($consulta)) {
				

				$row = $resultado->fetch_array();
 	
					 $userok = $row["Usuario"];        
					 $passok = $row["Clave"];             
					 $perfil = $row["Perfil"];           
					 $codusuariook =  $row["CodUsuario"];   

					if(isset($userok)){

						$consulta2 = "UPDATE `tbl_usuarios`  SET `Estatus`= 1 WHERE `CodUsuario` = '".$codusuariook."' ";
						if($resultado2 = $mysqli->query($consulta2)){
							
							if(isset($loginNombre) && isset($pass_encriptado)) {
								
									if($loginNombre == $userok && $pass_encriptado == $passok) {
										
											if($perfil == 1){

											session_start();
											$_SESSION["logueado"] = TRUE;
											$_SESSION['CodUsuario'] = $row["CodUsuario"];
											$_SESSION['UsuarioNombre'] = $row["Usuario"];
											//echo '<script language="javascript">alert("Perfil Admin");</script>';
											header("Location: sistema/admin/index.php");

											}

											elseif($perfil == 2){
											session_start();
											$_SESSION["logueado"] = TRUE;
											$_SESSION['CodUsuario'] = $row["CodUsuario"];
											$_SESSION['UsuarioNombre'] = $row["Usuario"];
											//echo '<script language="javascript">alert("Perfil Empleado");</script>';
											header("Location: sistema/empleado/index.php");
											}

											elseif($perfil == 3){
											session_start();
											$_SESSION["logueado"] = TRUE;
											$_SESSION['CodUsuario'] = $row["CodUsuario"];
											$_SESSION['UsuarioNombre'] = $row["Usuario"];
											//echo '<script language="javascript">alert("Perfil Gerente");</script>';
											header("Location: sistema/gerentes/index.php");
											}
											else{
											//echo '<script language="javascript">alert("Sin Perfil");</script>';
											header("Location: index.php?error=login");
											}

									}
									else{
									header("Location: index.php?error=login");	
									}	
							}
							else{
								header("Location: index.php?error=login");	
							}
						}
						else{
							header("Location: index.php?error=login");
						}

				
		}

	else{
		header("Location: index.php?error=login");
	}
}



	}else if(empty($_POST["enviar"])) {
		header("Location: index.php?error=login");
		}
		else {
			header("Location: index.php?error=login");
		}

?>