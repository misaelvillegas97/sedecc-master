<?php
require("sendgrid-php/sendgrid-php.php");
//require 'vendor/autoload.php'; // If you're using Composer (recommended)
// Comment out the above line if not using Composer
// require("<PATH TO>/sendgrid-php.php");
// If not using Composer, uncomment the above line and
// download sendgrid-php.zip from the latest release here,
// replacing <PATH TO> with the path to the sendgrid-php.php file,
// which is included in the download:
// https://github.com/sendgrid/sendgrid-php/releases
$email = new \SendGrid\Mail\Mail(); 
$email->setFrom("prueba@gmail.com", "innoapsion");
$email->setSubject("Asunto Innoapsion");
$email->addTo("soporteinnoapsion@gmail.com","seba");
$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent(
   "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
);
$sendgrid = new \SendGrid('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');
try {
   $response = $sendgrid->send($email);
   //print $response->statusCode() . "\n";
   print_r($response->headers());
   print $response->body() . "\n";
} catch (Exception $e) {
   echo 'Caught exception: '. $e->getMessage() ."\n";
}
?>