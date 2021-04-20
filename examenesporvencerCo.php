<?php 
//----------------- 15 dias --------------------------

  extract($_GET);
    include("conexionQ.php");
    mysqli_set_charset( $mysqli, 'utf8');
  	$sql1 = "SELECT rut_eess, nombre_corto , GROUP_CONCAT(corma15 SEPARATOR ';') as Ecorma15, GROUP_CONCAT(corma30 SEPARATOR ';') as Ecorma30, GROUP_CONCAT(corma60 SEPARATOR ';') as Ecorma60, GROUP_CONCAT(ocupa15 SEPARATOR ';') as Eocupacional15, GROUP_CONCAT(ocupa30 SEPARATOR ';') as Eocupacional30, GROUP_CONCAT(ocupa60 SEPARATOR ';') as Eocupacional60, GROUP_CONCAT(licen15 SEPARATOR ';') as licencia15, GROUP_CONCAT(licen30 SEPARATOR ';') as licencia30, GROUP_CONCAT(licen60 SEPARATOR ';') as licencia60 FROM (
    SELECT tra_rut, tra_nombres, tra_apellidos, es.rut_eess, nombre_corto,

      CASE WHEN tra_fecha_vencimiento_corma BETWEEN date_format(curdate(), '%Y-%m-15') AND DATE_SUB(DATE_ADD(DATE_FORMAT(CURDATE(), '%Y-%m-01'), INTERVAL 1 MONTH), INTERVAL 1 DAY) THEN CONCAT(tra_nombres,' ',DATE_FORMAT(tra_fecha_vencimiento_corma, '%d-%m-%Y')) END as corma15,
      CASE WHEN DATE_FORMAT(tra_fecha_vencimiento_corma, '%Y-%m') = DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL 1 MONTH), '%Y-%m') THEN CONCAT(tra_nombres,' ',DATE_FORMAT(tra_fecha_vencimiento_corma, '%d-%m-%Y')) END as corma30,
      CASE WHEN DATE_FORMAT(tra_fecha_vencimiento_corma, '%Y-%m') = DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL 2 MONTH), '%Y-%m') THEN CONCAT(tra_nombres,' ',DATE_FORMAT(tra_fecha_vencimiento_corma, '%d-%m-%Y')) END as corma60,

      CASE WHEN tra_vencimiento_examen BETWEEN date_format(curdate(), '%Y-%m-15') AND DATE_SUB(DATE_ADD(DATE_FORMAT(CURDATE(), '%Y-%m-01'), INTERVAL 1 MONTH), INTERVAL 1 DAY) THEN CONCAT(tra_nombres,' ',DATE_FORMAT(tra_vencimiento_examen, '%d-%m-%Y')) END as ocupa15,
      CASE WHEN DATE_FORMAT(tra_vencimiento_examen, '%Y-%m') = DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL 1 MONTH), '%Y-%m') THEN CONCAT(tra_nombres,' ',DATE_FORMAT(tra_vencimiento_examen, '%d-%m-%Y')) END as ocupa30,
      CASE WHEN DATE_FORMAT(tra_vencimiento_examen, '%Y-%m') = DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL 2 MONTH), '%Y-%m') THEN CONCAT(tra_nombres,' ',DATE_FORMAT(tra_vencimiento_examen, '%d-%m-%Y')) END as ocupa60,

      CASE WHEN tra_vencimiento_licencia BETWEEN date_format(curdate(), '%Y-%m-15') AND DATE_SUB(DATE_ADD(DATE_FORMAT(CURDATE(), '%Y-%m-01'), INTERVAL 1 MONTH), INTERVAL 1 DAY) THEN CONCAT(tra_nombres,' ',DATE_FORMAT(tra_vencimiento_licencia, '%d-%m-%Y')) END as licen15,
      CASE WHEN DATE_FORMAT(tra_vencimiento_licencia, '%Y-%m') = DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL 1 MONTH), '%Y-%m') THEN CONCAT(tra_nombres,' ',DATE_FORMAT(tra_vencimiento_licencia, '%d-%m-%Y')) END as licen30,
      CASE WHEN DATE_FORMAT(tra_vencimiento_licencia, '%Y-%m') = DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL 2 MONTH), '%Y-%m') THEN CONCAT(tra_nombres,' ',DATE_FORMAT(tra_vencimiento_licencia, '%d-%m-%Y')) END as licen60

      FROM min_transporte as t
      JOIN innoapsi_axel.et_eess as es
      ON(t.tra_eess = es.rut_eess)) as zxc
      where (corma15 is not null or ocupa15 is not null or licen15 is not null or corma30 is not null or ocupa30 is not null or licen30 is not null or corma60 is not null or ocupa60 is not null or licen60 is not null)
      GROUP BY rut_eess";
  
    $result1 = mysqli_query($mysqli, $sql1)or die (mysqli_error());  
    while($fila1 = $result1 ->fetch_assoc()){

   

   // Varios destinatarios
$para = 'sebastiancarcamo@innoapsion.cl';
//$para .= ''.$correo.'';

// título
$título = 'Alerta - Vencimiento Certificaciones';

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



<tr>
<td>
<table>
  <tr>
    <td>
      15 al 30 del mes en curso
    </td>
    <td>
      1 al 30 del mes siguiente
    </td>
    <td>
      1 al 30 mes subsiguiente
    </td>
  </tr>
  <tr>';
  $mensaje .= '<td><b>CORMA</b></td>';
  if ($fila1['Ecorma15'] != '') {
    $mensaje .= '<td>'.str_replace(';', '<br>', $fila1['Ecorma15']).'</td>';
  }else{
    $mensaje .= '<td>Sin vencimientos</td>';
  }
  $mensaje .= '<td><b>CORMA</b></td>';
  if ($fila1['Ecorma30'] != '') {
    $mensaje .= '<td>'.str_replace(';', '<br>', $fila1['Ecorma30']).'</td>';
  }else{
    $mensaje .= '<td>Sin vencimientos</td>';
  }
  $mensaje .= '<td><b>CORMA</b></td>';
  if ($fila1['Ecorma60'] != '') {
    $mensaje .= '<td>'.str_replace(';', '<br>', $fila1['Ecorma60']).'</td>';
  }else{
    $mensaje .= '<td>Sin vencimientos</td>';
  }
  $mensaje .= '
  </tr>
  <tr>';
    $mensaje .= '<td><b>EXAMEN OCUPACIONAL</b></td>';
    if ($fila1['Eocupacional15'] != '') {
      $mensaje .= '<td>'.str_replace(';', '<br>', $fila1['Eocupacional15']).'</td>';
    }else{
      $mensaje .= '<td>Sin vencimientos</td>';
    }
    $mensaje .= '<td><b>EXAMEN OCUPACIONAL</b></td>';
    if ($fila1['Eocupacional30'] != '') {
      $mensaje .= '<td>'.str_replace(';', '<br>', $fila1['Eocupacional30']).'</td>';
    }else{
      $mensaje .= '<td>Sin vencimientos</td>';
    }
    $mensaje .= '<td><b>EXAMEN OCUPACIONAL</b></td>';
    if ($fila1['Eocupacional60'] != '') {
      $mensaje .= '<td>'.str_replace(';', '<br>', $fila1['Eocupacional60']).'</td>';
    }else{
      $mensaje .= '<td>Sin vencimientos</td>';
    }

  $mensaje .= '
  </tr>
  <tr>';
    $mensaje .= '<td><b>LICENCIA DE CONDUCIR</b></td>';
    if ($fila1['licencia15'] != '') {
      $mensaje .= '<td>'.str_replace(';', '<br>', $fila1['licencia15']).'</td>';
    }else{
      $mensaje .= '<td>Sin vencimientos</td>';
    }
    $mensaje .= '<td><b>LICENCIA DE CONDUCIR</b></td>';
    if ($fila1['licencia30'] != '') {
      $mensaje .= '<td>'.str_replace(';', '<br>', $fila1['licencia30']).'</td>';
    }else{
      $mensaje .= '<td>Sin vencimientos</td>';
    }
    $mensaje .= '<td><b>LICENCIA DE CONDUCIR</b></td>';
    if ($fila1['licencia60'] != '') {
      $mensaje .= '<td>'.str_replace(';', '<br>', $fila1['licencia60']).'</td>';
    }else{
      $mensaje .= '<td>Sin vencimientos</td>';
    }

  $mensaje .= '
  </tr>
</table>
</td>
</tr>

<br>

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