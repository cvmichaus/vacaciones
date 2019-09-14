<?php

$mysqli = new mysqli("localhost", "propulci_root", "V4c4c10n3$", "propulci_vacaciones");
if($mysqli->connect_errno) {
	echo "<b>Fallo al conectar a la BD: </b>" . $mysqli->connect_errno . "---" . $mysqli->connect_error;
}
return $mysqli;

?>
