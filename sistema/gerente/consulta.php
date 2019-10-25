<?php

 $fecha11 = $_POST['fecha1'];  
 $fecha22 = $_POST['fecha2'];



$fecha1 = strtotime($fecha11);
$fecha2 = strtotime($fecha22);
$total=0;
for($fecha1;$fecha1<=$fecha2;$fecha1=strtotime('+1 day ' . date('Y-m-d',$fecha1))){
   if((strcmp(date('D',$fecha1),'Sun')!=0) AND (strcmp(date('D',$fecha1),'Sat')!=0)){
        date('Y-m-d D',$fecha1) . '<br />';
$total++;
   }
}

echo $total;

