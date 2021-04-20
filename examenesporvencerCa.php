<?php 
//----------------- 15 dias --------------------------

  extract($_GET);
    include("conexionQ.php");
    mysqli_set_charset( $mysqli, 'utf8');
  	$sql1 = "SELECT rut_eess, nombre_corto , GROUP_CONCAT(corma SEPARATOR ';') as Ecorma FROM (
    SELECT tra_rut, tra_nombres, tra_apellidos, es.rut_eess, es.nombre_corto,
CASE WHEN FECHA_TERMINO BETWEEN date_format(curdate(), '%Y-%m-15') AND DATE_SUB(DATE_ADD(DATE_FORMAT(CURDATE(), '%Y-%m-01'), INTERVAL 1 MONTH), INTERVAL 1 DAY) THEN CONCAT(tra_nombres,' ',DATE_FORMAT(t.FECHA_TERMINO, '%d-%m-%Y')) END as corma
FROM min_base as t
JOIN innoapsi_axel.et_eess as es
ON(t.NOM_RUT_EESS = es.rut_eess)) as zxc
where (corma is not null)
GROUP BY rut_eess";
  
    $result1 = mysqli_query($mysqli, $sql1)or die (mysqli_error());  
    while($fila1 = $result1 ->fetch_assoc()){

   

   // Varios destinatarios
$para = 'sebastiancarcamo@innoapsion.cl';
//$para .= ''.$correo.'';

// título
$título = 'Alerta - Vencimiento Certificaciones 15';

// mensaje
$mensaje = '
<html>
<head>
  
</head>
<body>

<tr>
<table>

<tr>
<td>Señores</td>
</tr>
<tr>
<td>'.$fila1['nombre_corto'].'</td>
</tr>

<br>

<tr>
<td>Informamos a usted que están próximo a la fecha de vencimiento las certificaciones de los siguientes trabajadores:</td>
</tr>

<br>
';
if ($fila1['Ecorma'] != '') {
	$mensaje .= '
<tr>
<td><u>CORMA:</u></td>
</tr>
<tr>
<td>'.str_replace(';', '<br>', $fila1['Ecorma']).'</td>
</tr>

<br>';
}

if ($fila1['Eocupacional'] != '') {
	$mensaje .= '
<tr>
<td><u>EXAMEN OCUPACIONAL:</u></td>
</tr>
<tr>
<td>'.str_replace(';', '<br>', $fila1['Eocupacional']).'</td>
</tr>

<br>';
}

if ($fila1['licencia'] != '') {
	$mensaje .= '
<tr>
<td><u>LICENCIA DE CONDUCIR:</u></td>
</tr>
<tr>
<td>'.str_replace(';', '<br>', $fila1['licencia']).'</td>
</tr>

<br>';
}

$mensaje .= '

<tr>
<td>Atte.</td>
</tr>
 <tr>
<td>Innoapsion.</td>
</tr>

  </table>
  </tr>
</body>
</html>
';

// Para enviar un correo HTML, debe establecerse la cabecera Content-type
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Cabeceras adicionales
$cabeceras .= 'To: Sebastian <sebastiancarcamo@innoapsion.cl>' . "\r\n";
$cabeceras .= 'From: Monitoreo Instrucción en Terreno <no-reply@innoapsion.cl>' . "\r\n";
$cabeceras .= 'Cc:  sebastiancarcamo@innoapsion.cl' . "\r\n";
$cabeceras .= 'Bcc: sebastiancarcamo@innoapsion.cl' . "\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8". "\r\n";


// Enviarlo
mail(utf8_decode($para), utf8_decode($título), utf8_decode($mensaje), utf8_decode($cabeceras));


}


  ?>

  <?php 
//----------------- 30 dias --------------------------

  
  	$sql2 = "SELECT rut_eess, nombre_corto , GROUP_CONCAT(corma SEPARATOR ';') as Ecorma FROM (SELECT tra_rut, tra_nombres, tra_apellidos, es.rut_eess, es.nombre_corto,
CASE WHEN '2017-12-11' = DATE_SUB(t.FECHA_TERMINO, INTERVAL 30 DAY) THEN CONCAT(tra_nombres,' ',DATE_FORMAT(t.FECHA_TERMINO, '%d-%m-%Y')) END as corma
FROM min_base as t
JOIN innoapsi_axel.et_eess as es
ON(t.NOM_RUT_EESS = es.rut_eess)) as zxc
where (corma is not null)
GROUP BY rut_eess";
  
    $result2 = mysqli_query($mysqli, $sql2)or die (mysqli_error());  
    while($fila2 = $result2 ->fetch_assoc()){

    
   // Varios destinatarios
$para = 'sebastiancarcamo@innoapsion.cl';
//$para .= ''.$correo.'';

// título
$título = 'Alerta - Vencimiento Certificaciones 30';

// mensaje
$mensaje = '
<html>
<head>
  
</head>
<body>

<tr>
<table>

<tr>
<td>Señores</td>
</tr>
<tr>
<td>'.$fila2['nombre_corto'].'</td>
</tr>

<br>

<tr>
<td>Informamos a usted que están próximo a la fecha de vencimiento las certificaciones de los siguientes trabajadores:</td>
</tr>

<br>
';
if ($fila2['Ecorma'] != '') {
	$mensaje .= '
<tr>
<td><u>CORMA:</u></td>
</tr>
<tr>
<td>'.str_replace(';', '<br>', $fila2['Ecorma']).'</td>
</tr>

<br>';
}

if ($fila2['Eocupacional'] != '') {
	$mensaje .= '
<tr>
<td><u>EXAMEN OCUPACIONAL:</u></td>
</tr>
<tr>
<td>'.str_replace(';', '<br>', $fila2['Eocupacional']).'</td>
</tr>

<br>';
}

if ($fila2['licencia'] != '') {
	$mensaje .= '
<tr>
<td><u>LICENCIA DE CONDUCIR:</u></td>
</tr>
<tr>
<td>'.str_replace(';', '<br>', $fila2['licencia']).'</td>
</tr>

<br>';
}

$mensaje .= '

<tr>
<td>Atte.</td>
</tr>
 <tr>
<td>Innoapsion.</td>
</tr>

  </table>
  </tr>
</body>
</html>
';

// Para enviar un correo HTML, debe establecerse la cabecera Content-type
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Cabeceras adicionales
$cabeceras .= 'To: Sebastian <sebastiancarcamo@innoapsion.cl>' . "\r\n";
$cabeceras .= 'From: Monitoreo Instrucción en Terreno <no-reply@innoapsion.cl>' . "\r\n";
$cabeceras .= 'Cc:  sebastiancarcamo@innoapsion.cl' . "\r\n";
$cabeceras .= 'Bcc: sebastiancarcamo@innoapsion.cl' . "\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8". "\r\n";


// Enviarlo
mail(utf8_decode($para), utf8_decode($título), utf8_decode($mensaje), utf8_decode($cabeceras));


}


  ?>



<?php 
//----------------- 60 dias --------------------------

  	$sql3 = "SELECT rut_eess, nombre_corto , GROUP_CONCAT(corma SEPARATOR ';') as Ecorma FROM (SELECT tra_rut, tra_nombres, tra_apellidos, es.rut_eess, es.nombre_corto,
CASE WHEN curdate() = DATE_SUB(t.FECHA_TERMINO, INTERVAL 60 DAY) THEN CONCAT(tra_nombres,' ',DATE_FORMAT(t.FECHA_TERMINO, '%d-%m-%Y')) END as corma
FROM min_base as t
JOIN innoapsi_axel.et_eess as es
ON(t.NOM_RUT_EESS = es.rut_eess)) as zxc
where (corma is not null)
GROUP BY rut_eess";
  
    $result3 = mysqli_query($mysqli, $sql3)or die (mysqli_error());  
    while($fila3 = $result3 ->fetch_assoc()){

   // Varios destinatarios
$para = 'sebastiancarcamo@innoapsion.cl';
//$para .= ''.$correo.'';

// título
$título = 'Alerta - Vencimiento Certificaciones 60';

// mensaje
$mensaje = '
<html>
<head>
  
</head>
<body>

<tr>
<table>

<tr>
<td>Señores</td>
</tr>
<tr>
<td>'.$fila3['nombre_corto'].'</td>
</tr>

<br>

<tr>
<td>Informamos a usted que están próximo a la fecha de vencimiento las certificaciones de los siguientes trabajadores:</td>
</tr>

<br>
';
if ($fila3['Ecorma'] != '') {
	$mensaje .= '
<tr>
<td><u>CORMA:</u></td>
</tr>
<tr>
<td>'.str_replace(';', '<br>', $fila3['Ecorma']).'</td>
</tr>

<br>';
}

if ($fila3['Eocupacional'] != '') {
	$mensaje .= '
<tr>
<td><u>EXAMEN OCUPACIONAL:</u></td>
</tr>
<tr>
<td>'.str_replace(';', '<br>', $fila3['Eocupacional']).'</td>
</tr>

<br>';
}

if ($fila3['licencia'] != '') {
	$mensaje .= '
<tr>
<td><u>LICENCIA DE CONDUCIR:</u></td>
</tr>
<tr>
<td>'.str_replace(';', '<br>', $fila3['licencia']).'</td>
</tr>

<br>';
}

$mensaje .= '

<tr>
<td>Atte.</td>
</tr>
 <tr>
<td>Innoapsion.</td>
</tr>

  </table>
  </tr>
</body>
</html>
';

// Para enviar un correo HTML, debe establecerse la cabecera Content-type
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Cabeceras adicionales
$cabeceras .= 'To: Sebastian <sebastiancarcamo@innoapsion.cl>' . "\r\n";
$cabeceras .= 'From: Monitoreo Instrucción en Terreno <no-reply@innoapsion.cl>' . "\r\n";
$cabeceras .= 'Cc:  sebastiancarcamo@innoapsion.cl' . "\r\n";
$cabeceras .= 'Bcc: sebastiancarcamo@innoapsion.cl' . "\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8". "\r\n";


// Enviarlo
mail(utf8_decode($para), utf8_decode($título), utf8_decode($mensaje), utf8_decode($cabeceras));


}


  ?>