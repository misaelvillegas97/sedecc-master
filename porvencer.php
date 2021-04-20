<a href=""></a>
<?php 
//----------------- INICIO NOTIFICACION RESPUESTA --------------------------

  extract($_GET);
  include("conexion.php");
  mysqli_set_charset( $mysqli, 'utf8');

  	$sql = "
SELECT eess_rut, fecha, tra_email, eva_evaluador, GROUP_CONCAT(info SEPARATOR ';') as datos, tra_nombres, tra_apellidos from (
          SELECT *, count(eva_id) as preg, concat('Evaluación N° <a href=http://innoapsion.cl/sedecc/index.php?r=evaluacion/view&id=',eva_id,' >',CAST(cod1 AS CHAR CHARACTER SET utf8),CAST(ano_eva AS CHAR CHARACTER SET utf8), CAST(cod AS CHAR CHARACTER SET utf8),'</a>, del ',fecha_eva) as info from(
            SELECT e.eess_rut, DATE_FORMAT(r.res_plazo, '%d-%m-%Y') as fecha, r.eva_id, t.tra_email, e.eva_evaluador, DATE_FORMAT(e.eva_fecha_evaluacion, '%d-%m-%Y') as fecha_eva, DATE_FORMAT(e.eva_fecha_evaluacion, '%Y') as ano_eva, t.tra_nombres, t.tra_apellidos, UPPER(CONCAT(SUBSTRING(tra_nombres,1,3),SUBSTRING(tra_apellidos,1,3))) as cod1, LPAD(e.eva_evaluador_correlativo,5,'0') as cod,
            CASE
          WHEN CURDATE() = DATE_SUB(res_plazo, INTERVAL 2 DAY) THEN 1 END as porVencer
          FROM min_respuesta as r
          JOIN min_evaluacion as e
          ON(r.eva_id = e.eva_id)
          JOIN min_trabajador as t
          ON(e.eva_evaluador = t.tra_rut) ) as zxc
        WHERE porVencer = 1
        GROUP BY eva_id
                ORDER BY eess_rut ASC, eva_id ASC) as cxz
                GROUP BY eva_evaluador
                ";
  
    $result = mysqli_query($mysqli, $sql)or die (mysqli_error());  
    //$empresa = '';
    while($fila = $result ->fetch_assoc()){
    	/*if ($empresa == $fila['eess_rut'] or $empresa == '') {
    		echo '1, ';
    		$empresa = $fila['eess_rut'];
    	}else{
    		echo '2, ';
    		$empresa = $fila['eess_rut'];
    	}*/

         // Varios destinatarios
$para = ''.$fila['tra_email'].'';
//$para .= ''.$correo.'';

// título
$título = 'Alerta de Vencimiento Plazo de Control';

// mensaje
$mensaje = '
<html>
<head>
  
</head>
<body>

<tr>
<table>

<tr>
<td>Señor</td>
</tr>
<tr>
<td>'.$fila['tra_nombres'].' '.$fila['tra_apellidos'].'</td>
</tr>

<br>

<tr>
<td>Informamos a usted que el '.$fila['fecha'].' vencerá el plazo de control de las siguientes inconformidades detectadas en Evaluaciones anteriores:</td>
</tr>

<br>

<tr>
<td>'.str_replace(';', '<br>', $fila['datos']).'</td>
</tr>

<br>

 <tr>
<td>Con el objetivo de evitar incumplimientos, le recomendamos dar solución en el plazo establecido.</td>
</tr>

<br>

<tr>
<td>Atte.</td>
</tr>
 <tr>
<td>Innoapsion</td>
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
//$cabeceras .= 'To: Sebastian <sebastiancarcamo@innoapsion.cl>' . "\r\n";
$cabeceras .= 'From: Sedecc <sedecc@innoapsion.cl>' . "\r\n";
//$cabeceras .= 'Cc:  sebastiancarcamo@innoapsion.cl' . "\r\n";
$cabeceras .= 'Bcc: sebastiancarcamo@innoapsion.cl, eduardoacevedo@innoapsion.cl, rmunoz@innoapsion.cl' . "\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8". "\r\n";


// Enviarlo
mail(utf8_decode($para), utf8_decode($título), utf8_decode($mensaje), utf8_decode($cabeceras));

}
  ?>