<?php
/*
$mysqli = new mysqli("localhost", "root", "", "propulci_vacaciones");
if($mysqli->connect_errno) {
	echo "<b>Fallo al conectar a la BD: </b>" . $mysqli->connect_errno . "---" . $mysqli->connect_error;
}
return $mysqli;
*/

$mysqli = new mysqli("localhost", "urbanis6_canvas", "Q3j,FA!Lyi#u", "urbanis6__vacaciones");
if($mysqli->connect_errno) {
	echo "<b>Fallo al conectar a la BD: </b>" . $mysqli->connect_errno . "---" . $mysqli->connect_error;
}
return $mysqli;
7
?>
