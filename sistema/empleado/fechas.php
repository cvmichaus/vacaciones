<?php

$dateini = $_POST['dateini'];
$datefin = $_POST['datefin'];

/*
$anio1 = substr($dateini, -10, 4);
$mes1 = substr($dateini, -5, 2);
$dia1 = substr($dateini, -2, 2);


$anio2 = substr($dateini, -10, 4);
$mes2 = substr($dateini, -5, 2);
$dia2 = substr($dateini, -2, 2);


$fecha1 = strtotime($dateini); 
$fecha2 = strtotime($datefin);  
for($fecha1;$fecha1<=$fecha2;$fecha1=strtotime('+1 day ' . date('Y-m-d',$fecha1))){ 
    if((strcmp(date('D',$fecha1),'Sun')!=0) and (strcmp(date('D',$fecha1),'Sat')!=0)){
        echo date('Y-m-d D',$fecha1); 
    }
}
*/

$total_days_left = (strtotime($datefin) - strtotime($dateini)) / (60 * 60 * 24);
while (strtotime($dateini) <= strtotime($datefin)) {
$timestamp = strtotime($dateini);
$day = dateini("D", $timestamp);

if($day=="Sat" || $day=="Sun") {
$count++ ;
}
echo $dateini = date ("Y-m-d", strtotime("+1 day", strtotime($dateini)));
}


//echo "2";

?>

