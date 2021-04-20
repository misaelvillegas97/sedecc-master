<?php

require("PHPMailer/src/PHPMailer.php");
    require("PHPMailer/src/SMTP.php");
    require("PHPMailer/src/Exception.php");


for ($i=0; $i < 201; $i++) { 
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->IsSMTP(); 

    $mail->CharSet="utf-8";
    $mail->Host = "smtp.gmail.com";
    // $mail->Host = gethostbyname('smtp.gmail.com');
    $mail->SMTPDebug = 1; 
    $mail->Port = 587 ; //465 or 587
    $mail->Mailer = "smtp";

    $mail->SMTPSecure = 'tls';  
    $mail->SMTPAuth = true; 
    $mail->IsHTML(true);

    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    //Authentication
    $mail->Username = "riesgoempresa@gmail.com";
    $mail->Password = "Innoapsion123.";

    //Set Params
    $mail->setFrom('sebastian.carcamo398@gmail.com', 'Sebastian Bien Bellakito Para Usted');
    $mail->AddAddress('sebastian.carcamo398@gmail.com', 'Sebastian Carcamo Gmail');
    $mail->AddAddress('constanzacifuentev@gmail.com', 'Constanza Cifuentes Gmail');
    $mail->AddAddress('david.misa97@gmail.com', 'David Villegas Gmail');
    $mail->AddAddress('soporte@innoapsion.cl', 'Soporte');
    $mail->AddAddress('davidvillegas@innoapsion.cl', 'David Villegas Innoapsion');
    $mail->AddAddress('sebastiancarcamo@innoapsion.cl', 'Sebastian Carcamo Innoapsion');
    $mail->AddAddress('adminstracion@innoapsion.cl', 'Adminstracion');
    $mail->AddAddress('soporteinnoapsion@gmail.com', 'Soporte Gmail');
    $mail->Subject = "Test";
    $mail->Body = "Mensaje Nº".$i;


     if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
     } else {
        echo "Message has been sent";
     }
}

    

function save_mail($mail)
{
    //You can change 'Sent Mail' to any other folder or tag
    $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";
    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
    $imapStream = imap_open($path, $mail->Username, $mail->Password);
    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);
    return $result;
}
?>