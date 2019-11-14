<?php
header( 'Content-type: text/html; charset=iso-8859-1' );
//$string =$_POST['contra'];
//
$string ="qdjl3OTU6s0=";
//qdjl3OTU6s0=


//$string='hnq1d3bDvsSmvoejppq7t7Jv';
$key='wrimexico2019';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
$result = '';
$string = base64_decode($string);
for($i=0; $i<strlen($string); $i++) {
   $char = substr($string, $i, 1);
   $keychar = substr($key, ($i % strlen($key))-1, 1);
   $char = chr(ord($char)-ord($keychar));
   $result.=$char;
}

 echo $result;
?>
