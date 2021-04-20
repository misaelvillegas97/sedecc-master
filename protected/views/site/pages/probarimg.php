<?php 
$ruta = "images/eess/"; // Indicar ruta
		 $filehandle = opendir($ruta); // Abrir archivos
		  while ($file = readdir($filehandle)) {
		   if ($file != "." && $file != "..") {
		    $tamanyo = GetImageSize($ruta . $file);

			 if ($file == '76885630.jpg'){
		     	$logo2 = '<img src="'.$ruta.$file.'" width="100px" height="100px">';
		     	echo $logo2;
		     }
		   }
		  } 
		closedir($filehandle); // Fin lectura archivos

 ?>