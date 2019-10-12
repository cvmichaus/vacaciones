<?php

            require("PHPMailer-master/src/PHPMailer.php");
            require("PHPMailer-master/src/SMTP.php");
            require("PHPMailer-master/src/Exception.php");


            $mail3 = new PHPMailer\PHPMailer\PHPMailer();
            $mail3->IsSMTP(); 

            $mail3->CharSet="UTF-8";
            $mail3->Host = "smtp.gmail.com";
            //$mail3->Host = "smtp.office365.com";
            //$mail3->SMTPDebug = 2; 
            $mail3->Port = 587; //465 or 587

            $mail3->SMTPSecure = 'tls';  
            $mail3->SMTPAuth = true; 
            $mail3->IsHTML(true);

            //Authentication
            $mail3->Username = "vacacioneswrimexico@gmail.com";
            $mail3->Password = "Rueville10!";
            //$mail3->Username = "recursos.humanos@wri.org";
           // $mail3->Password = "WRIm3x1c086!";

            //Set Params
            $mail3->SetFrom("vacacioneswrimexico@gmail.com");
            //$mail3->AddAddress($CorreoEmpleado2);
            $mail3->AddAddress("michusvalentin@hotmail.com");
             $mail3->AddAddress("michusvalentin@gmail.com");


            $mail3->Subject = "Solicitud de Vacaciones Aprobada";
            $mail3->Body = '
            <html>
            <head>
            <title>Bienvenido</title>
            </head>
            <body>
            <h1>
            Notificacion de Solicitud de Vacaciones Apropbada:
            </h1>
            <p>

            Hola estimado Usuario  tu solicitud ha sido aprobada <br>
            Para revisar tus dias restantes segir el siguiente link:
            <br>
            http:localhost/sistemadevacaciones/index.php
            </p>
            </body>
            </html>
            ';


            if(!$mail3->Send()) {
            // echo "Mailer Error: " . $mail->ErrorInfo;
            echo "Error al enviar Mensaje";
            } else {

            //header("Location: index.php");  
             echo "se mando mail"; 

            }

   /*

   require("PHPMailer/src/PHPMailer.php");
   require("PHPMailer/src/SMTP.php");
   require("PHPMailer/src/Exception.php");
   //$error = false;

  $mail = new PHPMailer\PHPMailer\PHPMailer();
   $mail->IsSMTP();
  $mail->CharSet="UTF-8";
$mail->Host = "mail.suiteadministrativa.com";
$mail->Port = 465;


$mail->SMTPSecure = 'ssl';  
$mail->SMTPAuth = true;
$mail->IsHTML(true);

    //Authentication
    $mail->Username = "notificaciones@suiteadministrativa.com";
    $mail->Password = "Incapital2018.";

    //Set Params
  $mail->SetFrom("notificaciones@suiteadministrativa.com");

 
  $mail->AddAddress("c.michaus@incapital.mx");
 
                     
$mail->Subject = 'Prueba';
    $mail->Body = 'Esto es una prueba';

    $mail->SMTPOptions = array(
                    'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                    )
                    );


$statusEnvio = 0;
    if ($mail->Send())
    {
    echo "Si";
    }
    else
    {
    echo "Mailer Error: " . $mail->ErrorInfo;
    }

    */
?>