<?php 
//----------------- 15 dias --------------------------

  extract($_GET);
    include("conexion.php");
    mysqli_set_charset( $mysqli, 'utf8');
    $sql1 = "SELECT eess_rut, eess_nombre_corto , mes1, mes2, GROUP_CONCAT(corma15 SEPARATOR ';') as Ecorma15, GROUP_CONCAT(corma30 SEPARATOR ';') as Ecorma30, GROUP_CONCAT(corma60 SEPARATOR ';') as Ecorma60, GROUP_CONCAT(ocupa15 SEPARATOR ';') as Eocupacional15, GROUP_CONCAT(ocupa30 SEPARATOR ';') as Eocupacional30, GROUP_CONCAT(ocupa60 SEPARATOR ';') as Eocupacional60, GROUP_CONCAT(licen15 SEPARATOR ';') as licencia15, GROUP_CONCAT(licen30 SEPARATOR ';') as licencia30, GROUP_CONCAT(licen60 SEPARATOR ';') as licencia60 FROM (SELECT tra_rut, tra_nombres, tra_apellidos, es.eess_rut, eess_nombre_corto,   DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL 1 MONTH), '%m') mes1,
    DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL 2 MONTH), '%m') mes2,
    CASE WHEN tra_fecha_vencimiento_corma BETWEEN date_format(curdate(), '%Y-%m-15') AND DATE_SUB(DATE_ADD(DATE_FORMAT(CURDATE(), '%Y-%m-01'), INTERVAL 1 MONTH), INTERVAL 1 DAY) THEN CONCAT(tra_rut,' ',SUBSTRING_INDEX(tra_nombres, ' ', 1 ),' ',SUBSTRING_INDEX(tra_apellidos, ' ', 1 ),' ',DATE_FORMAT(tra_fecha_vencimiento_corma, '%d-%m-%Y')) END as corma15,
      CASE WHEN DATE_FORMAT(tra_fecha_vencimiento_corma, '%Y-%m') = DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL 1 MONTH), '%Y-%m') THEN CONCAT(tra_rut,' ',SUBSTRING_INDEX(tra_nombres, ' ', 1 ),' ',SUBSTRING_INDEX(tra_apellidos, ' ', 1 ),' ',DATE_FORMAT(tra_fecha_vencimiento_corma, '%d-%m-%Y')) END as corma30,
      CASE WHEN DATE_FORMAT(tra_fecha_vencimiento_corma, '%Y-%m') = DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL 2 MONTH), '%Y-%m') THEN CONCAT(tra_rut,' ',SUBSTRING_INDEX(tra_nombres, ' ', 1 ),' ',SUBSTRING_INDEX(tra_apellidos, ' ', 1 ),' ',DATE_FORMAT(tra_fecha_vencimiento_corma, '%d-%m-%Y')) END as corma60,

      CASE WHEN tra_vencimiento_examen BETWEEN date_format(curdate(), '%Y-%m-15') AND DATE_SUB(DATE_ADD(DATE_FORMAT(CURDATE(), '%Y-%m-01'), INTERVAL 1 MONTH), INTERVAL 1 DAY) THEN CONCAT(tra_rut,' ',SUBSTRING_INDEX(tra_nombres, ' ', 1 ),' ',SUBSTRING_INDEX(tra_apellidos, ' ', 1 ),' ',DATE_FORMAT(tra_vencimiento_examen, '%d-%m-%Y')) END as ocupa15,
      CASE WHEN DATE_FORMAT(tra_vencimiento_examen, '%Y-%m') = DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL 1 MONTH), '%Y-%m') THEN CONCAT(tra_rut,' ',SUBSTRING_INDEX(tra_nombres, ' ', 1 ),' ',SUBSTRING_INDEX(tra_apellidos, ' ', 1 ),' ',DATE_FORMAT(tra_vencimiento_examen, '%d-%m-%Y')) END as ocupa30,
      CASE WHEN DATE_FORMAT(tra_vencimiento_examen, '%Y-%m') = DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL 2 MONTH), '%Y-%m') THEN CONCAT(tra_rut,' ',SUBSTRING_INDEX(tra_nombres, ' ', 1 ),' ',SUBSTRING_INDEX(tra_apellidos, ' ', 1 ),' ',DATE_FORMAT(tra_vencimiento_examen, '%d-%m-%Y')) END as ocupa60,

      CASE WHEN tra_vencimiento_licencia BETWEEN date_format(curdate(), '%Y-%m-15') AND DATE_SUB(DATE_ADD(DATE_FORMAT(CURDATE(), '%Y-%m-01'), INTERVAL 1 MONTH), INTERVAL 1 DAY) THEN CONCAT(tra_rut,' ',SUBSTRING_INDEX(tra_nombres, ' ', 1 ),' ',SUBSTRING_INDEX(tra_apellidos, ' ', 1 ),' ',DATE_FORMAT(tra_vencimiento_licencia, '%d-%m-%Y')) END as licen15,
      CASE WHEN DATE_FORMAT(tra_vencimiento_licencia, '%Y-%m') = DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL 1 MONTH), '%Y-%m') THEN CONCAT(tra_rut,' ',SUBSTRING_INDEX(tra_nombres, ' ', 1 ),' ',SUBSTRING_INDEX(tra_apellidos, ' ', 1 ),' ',DATE_FORMAT(tra_vencimiento_licencia, '%d-%m-%Y')) END as licen30,
      CASE WHEN DATE_FORMAT(tra_vencimiento_licencia, '%Y-%m') = DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL 2 MONTH), '%Y-%m') THEN CONCAT(tra_rut,' ',SUBSTRING_INDEX(tra_nombres, ' ', 1 ),' ',SUBSTRING_INDEX(tra_apellidos, ' ', 1 ),' ',DATE_FORMAT(tra_vencimiento_licencia, '%d-%m-%Y')) END as licen60


FROM min_trabajador as t
JOIN min_eess as es
ON(t.eess_rut = es.eess_rut)) as zxc
where (corma15 is not null or ocupa15 is not null or licen15 is not null or corma30 is not null or ocupa30 is not null or licen30 is not null or corma60 is not null or ocupa60 is not null or licen60 is not null)  and eess_rut='79633220'
GROUP BY eess_rut LIMIT 0,1";
  
    $result1 = mysqli_query($mysqli, $sql1)or die (mysqli_error());  
    while($fila1 = $result1 ->fetch_assoc()){


    $sql11 = "SELECT GROUP_CONCAT(tra_email) as correos FROM min_trabajador WHERE eess_rut = '".$fila1['eess_rut']."' and tra_email is not null and tra_email != ''";
    $result11 = mysqli_query($mysqli, $sql11)or die (mysqli_error());  
   /** **/
   if ($fila1['mes1'] == '01') {
     $mes1 = 'Enero';
   }else if ($fila1['mes1'] == '02') {
     $mes1 = 'Febrero';
   }else if ($fila1['mes1'] == '03') {
     $mes1 = 'Marzo';
   }else if ($fila1['mes1'] == '04') {
     $mes1 = 'Abril';
   }else if ($fila1['mes1'] == '05') {
     $mes1 = 'Mayo';
   }else if ($fila1['mes1'] == '06') {
     $mes1 = 'Junio';
   }else if ($fila1['mes1'] == '07') {
     $mes1 = 'Julio';
   }else if ($fila1['mes1'] == '08') {
     $mes1 = 'Agosto';
   }else if ($fila1['mes1'] == '09') {
     $mes1 = 'Septiembre';
   }else if ($fila1['mes1'] == '10') {
     $mes1 = 'Octubre';
   }else if ($fila1['mes1'] == '11') {
     $mes1 = 'Noviembre';
   }else if ($fila1['mes1'] == '12') {
     $mes1 = 'Diciembre';
   }

   if ($fila1['mes2'] == '01') {
     $mes2 = 'Enero';
   }else if ($fila1['mes2'] == '02') {
     $mes2 = 'Febrero';
   }else if ($fila1['mes2'] == '03') {
     $mes2 = 'Marzo';
   }else if ($fila1['mes2'] == '04') {
     $mes2 = 'Abril';
   }else if ($fila1['mes2'] == '05') {
     $mes2 = 'Mayo';
   }else if ($fila1['mes2'] == '06') {
     $mes2 = 'Junio';
   }else if ($fila1['mes2'] == '07') {
     $mes2 = 'Julio';
   }else if ($fila1['mes2'] == '08') {
     $mes2 = 'Agosto';
   }else if ($fila1['mes2'] == '09') {
     $mes2 = 'Septiembre';
   }else if ($fila1['mes2'] == '10') {
     $mes2 = 'Octubre';
   }else if ($fila1['mes2'] == '11') {
     $mes2 = 'Noviembre';
   }else if ($fila1['mes2'] == '12') {
     $mes2 = 'Diciembre';
   }

   // Varios destinatarios
//$para = 'sebastiancarcamo@innoapsion.cl';
$para = 'jorgeiraira55@gmail.com';
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
<td>'.$fila1['eess_nombre_corto'].' '.$fila11['correos'].'</td>
</tr>

<br>

<tr>
<td>Informamos de los próximos vencimientos en las Certificaciones y/o Licencias de los siguientes Conductores.</td>
</tr>
<tr>
<td>Agradeceremos gestionar la renovación de los mismos y enviar oportunamente los respaldos al siguiente correo infotransporte@qualivita.cl.</td>
</tr>

<br>

<tr>
<td>
<table border=1 cellspacing=0 cellpadding=2>
  <tr bgcolor="#cdcbcc" align="center">
    <td style="width: 300px;">
      15 al 30 del mes en curso
    </td>
    <td style="width: 300px;">
      '.$mes1.'
    </td>
    <td style="width: 300px;">
      '.$mes2.'
    </td>
  </tr>';
  $mensaje .= '<tr><td style="border: inset 0pt;"><b>CORMA</b></td><td style="border: inset 0pt;"><b>CORMA</b></td><td style="border: inset 0pt;"><b>CORMA</b></td></tr><tr>';
  if ($fila1['Ecorma15'] != '') {
    $mensaje .= '<td valign="top" style="font-size:10px; border: inset 0pt;">'.str_replace(';', '<br>', $fila1['Ecorma15']).'</td>';
  }else{
    $mensaje .= '<td valign="top" style="font-size:10px; border: inset 0pt;" >SIN VENCIMIENTOS</td>';
  }

  if ($fila1['Ecorma30'] != '') {
    $mensaje .= '<td valign="top" style="font-size:10px; border: inset 0pt;" >'.str_replace(';', '<br>', $fila1['Ecorma30']).'</td>';
  }else{
    $mensaje .= '<td valign="top" style="font-size:10px; border: inset 0pt;" >SIN VENCIMIENTOS</td>';
  }

  if ($fila1['Ecorma60'] != '') {
    $mensaje .= '<td valign="top" style="font-size:10px; border: inset 0pt;" >'.str_replace(';', '<br>', $fila1['Ecorma60']).'</td>';
  }else{
    $mensaje .= '<td valign="top" style="font-size:10px; border: inset 0pt;">SIN VENCIMIENTOS</td>';
  }
  $mensaje .= '
  </tr>';
    $mensaje .= '<tr><td style="border: inset 0pt;"><b>EXAMEN OCUPACIONAL</b></td><td style="border: inset 0pt;"><b>EXAMEN OCUPACIONAL</b></td><td style="border: inset 0pt;"><b>EXAMEN OCUPACIONAL</b></td></tr><tr>';
    if ($fila1['Eocupacional15'] != '') {
      $mensaje .= '<td valign="top" style="font-size:10px; border: inset 0pt;">'.str_replace(';', '<br>', $fila1['Eocupacional15']).'</td>';
    }else{
      $mensaje .= '<td valign="top" style="font-size:10px; border: inset 0pt;">SIN VENCIMIENTOS</td>';
    }
    
    if ($fila1['Eocupacional30'] != '') {
      $mensaje .= '<td valign="top" style="font-size:10px; border: inset 0pt;">'.str_replace(';', '<br>', $fila1['Eocupacional30']).'</td>';
    }else{
      $mensaje .= '<td valign="top" style="font-size:10px; border: inset 0pt;">SIN VENCIMIENTOS</td>';
    }
    
    if ($fila1['Eocupacional60'] != '') {
      $mensaje .= '<td valign="top" style="font-size:10px; border: inset 0pt;">'.str_replace(';', '<br>', $fila1['Eocupacional60']).'</td>';
    }else{
      $mensaje .= '<td valign="top" style="font-size:10px; border: inset 0pt;">SIN VENCIMIENTOS</td>';
    }

  $mensaje .= '
  </tr>';
    $mensaje .= '<tr><td style="border: inset 0pt;"><b>LICENCIA DE CONDUCIR</b></td><td style="border: inset 0pt;"><b>LICENCIA DE CONDUCIR</b></td><td style="border: inset 0pt;"><b>LICENCIA DE CONDUCIR</b></td></tr><tr>';
    if ($fila1['licencia15'] != '') {
      $mensaje .= '<td valign="top" style="font-size:10px; border: inset 0pt;">'.str_replace(';', '<br>', $fila1['licencia15']).'</td>';
    }else{
      $mensaje .= '<td valign="top" style="font-size:10px; border: inset 0pt;">SIN VENCIMIENTOS</td>';
    }
    
    if ($fila1['licencia30'] != '') {
      $mensaje .= '<td valign="top" style="font-size:10px; border: inset 0pt;">'.str_replace(';', '<br>', $fila1['licencia30']).'</td>';
    }else{
      $mensaje .= '<td valign="top" style="font-size:10px; border: inset 0pt;">SIN VENCIMIENTOS</td>';
    }
    
    if ($fila1['licencia60'] != '') {
      $mensaje .= '<td valign="top" style="font-size:10px; border: inset 0pt;">'.str_replace(';', '<br>', $fila1['licencia60']).'</td>';
    }else{
      $mensaje .= '<td valign="top" style="font-size:10px; border: inset 0pt;">SIN VENCIMIENTOS</td>';
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
<td>Subgerencia de Seguridad y Salud Ocupacional.</td>
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
/**
$cabeceras .= 'To: Sebastian <sebastiancarcamo@innoapsion.cl>' . "\r\n";
$cabeceras .= 'From: Sedecc <sedecc@innoapsion.cl>' . "\r\n";
$cabeceras .= 'Cc:  sebastiancarcamo@innoapsion.cl' . "\r\n";
$cabeceras .= 'Bcc: sebastiancarcamo@innoapsion.cl' . "\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8". "\r\n";
**/
$cabeceras .= 'To: Sebastian <jorgeiraira55@gmail.com>' . "\r\n";
$cabeceras .= 'From: Sedecc <sedecc@innoapsion.cl>' . "\r\n";
$cabeceras .= 'Cc:  jorgeiraira55@gmail.com' . "\r\n";
$cabeceras .= 'Bcc: jorgeiraira55@gmail.com' . "\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8". "\r\n";


// Enviarlo
mail(utf8_decode($para), utf8_decode($título), utf8_decode($mensaje), utf8_decode($cabeceras));


}


  ?>

 