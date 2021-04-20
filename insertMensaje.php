	<?php


	extract($_GET);
  	include("conexion.php");
	mysqli_set_charset( $mysqli, 'utf8');

	$mensaje = $_POST['mensaje'];
	$acu_id = $_POST['acu_id'];
	$id_ar = $_POST['id_ar'];



		$sql = "INSERT INTO min_reunion_mensaje(ms_id, ms_mensaje, acu_id, ms_tipo, ms_fecha)
		VALUES  ( NULL, '$mensaje', '$acu_id', '1', now())";
			$result = mysqli_query($mysqli, $sql)or die (mysqli_error());

		$sql11 = "UPDATE min_reunion_acuerdo SET acu_seguimiento  = '0' WHERE acu_id = '$acu_id'";
			$result11 = mysqli_query($mysqli, $sql11)or die (mysqli_error());


		$sql2 = "SELECT MAX(ms_id) as id FROM min_reunion_mensaje";
			$result2 = mysqli_query($mysqli, $sql2)or die (mysqli_error());
			$fila2 = $result2 ->fetch_assoc();
			$id = $fila2['id'];
$j = 0;
for ($i=1; $i <= count($_FILES['archivos'.$acu_id]['name']); $i++) {

	$base641 = '';
	if(!isset($_FILES['archivos'.$acu_id][$j])){
	    $errors=array();
	    $allowed_ext= array('jpg','jpeg','png','gif','pdf');
	    $file_name =$_FILES['archivos'.$acu_id]['name'][$j];
	    $file_ext = strtolower( end(explode('.',$file_name)));

	    $file_size=$_FILES['archivos'.$acu_id]['size'][$j];
	    $file_tmp= $_FILES['archivos'.$acu_id]['tmp_name'][$j];
	    //echo $file_tmp;echo "<br>";

	    $type = pathinfo($file_tmp, PATHINFO_EXTENSION);
	    $data = file_get_contents( $file_tmp );
	    if (base64_encode($data)!= "" and $file_ext != "pdf") {
	 	$base64 = 'data:image/' . $file_ext . ';base64,' . base64_encode($data);
	 }elseif (base64_encode($data)!= "" and $file_ext == "pdf") {
	 	$base64 = 'data:application/' . $file_ext . ';base64,' . base64_encode($data);
	 }else{
	 	$base64 = "";
	 }
	 //print_r(count($_FILES['archivos1']['name']));
	}
	$j++;

	$sql3 = "INSERT INTO min_reunion_imagen(img_id, img_foto, ms_id)
		VALUES  (NULL, '$base64', '$id')";
			$result3 = mysqli_query($mysqli, $sql3)or die (mysqli_error());
}


	//----------------- INICIO NOTIFICACION RESPUESTA --------------------------
	$sql4 = "SELECT GROUP_CONCAT(tra_email) as correo FROM min_trabajador WHERE eess_rut = '96960670' AND car_id = '21'";
	$result4 = mysqli_query($mysqli, $sql4)or die (mysqli_error());
	$geren_ope = $result4 ->fetch_assoc();

	$sql5 = "SELECT GROUP_CONCAT(tra_email) as correo FROM min_trabajador WHERE eess_rut = '96960670' AND car_id = '20'";
	$result5 = mysqli_query($mysqli, $sql5)or die (mysqli_error());
	$geren_gen = $result5 ->fetch_assoc();

	$sql6 = "SELECT GROUP_CONCAT(tra_email) as correo FROM min_trabajador WHERE eess_rut = '96960670' AND car_id = '2'";
	$result6 = mysqli_query($mysqli, $sql6)or die (mysqli_error());
	$apr = $result6 ->fetch_assoc();

	$correos_cc = $geren_ope['correo'].', '.$geren_gen['correo'].', '.$apr['correo'];
	//extract($_GET);
	$sql2 = "SELECT r.reu_id, date_format(m.ms_fecha, '%d-%m-%Y') as fech, date_format(m.ms_fecha, '%H:%i') as hor, r.eess_rut, e.eess_nombre_corto, a.acu_id, a.acu_descripcion, m.ms_id, m.ms_mensaje, m.ms_fecha, m.ms_tipo, e.eess_email as correoES, e.eess_representante_email, r.reu_tipo, CONCAT(UPPER(LEFT(r.reu_tipo, 1)), LOWER(SUBSTRING(r.reu_tipo, 2))) as r_tipo,  r.reu_correlativo, r.reu_evaluador
			FROM min_eess as e
            JOIN min_reunion as r
            ON(e.eess_rut = r.eess_rut)
			JOIN min_reunion_acuerdo as a
			ON(r.reu_id = a.reu_id)
			JOIN min_reunion_mensaje as m
			ON(a.acu_id = m.acu_id)
			WHERE r.reu_id = '$id_ar' and a.acu_id = '$acu_id'";

	//echo $sql;

		$result2 = mysqli_query($mysqli, $sql2)or die (mysqli_error());
			$cont = -1;
			while($fila = $result2 ->fetch_assoc()){

				$nombreeess = strtoupper($fila['eess_nombre_corto']);
				$fecha = $fila['fech'];
				$hora = $fila['hor'];
				$acudescripcion = strtoupper($fila['acu_descripcion']);
				$correoEESS = $fila['correoES'];
				$lugar = $fila['reu_lugar'];
				$reutipo = $fila['r_tipo'];
				$reucorrelativo = $fila['reu_correlativo'];
				$correlativo = $fila['reu_correlativo'];
				/*$obs = strtoupper($fila['r_documento']);
				$preg = $fila['enunciado_pregunta'];
				$hora = $fila['hora'];
				$correoEESS = $fila['correoEESS'];
				$correoE = $fila['correoE'];
				$correo_apr = $fila['correo_apr'];
				$fecha = $fila['fecha2'];
				$id_correlativo = $fila['id_correlativo'];*/




          $cont= $cont+1;

          $Mens[] = $fila['ms_mensaje'];
          $fech[] = $fila['ms_fecha'];

          if($fila['ms_tipo'] == 1){
          	$tipo[] = "Evaluador:";
          }else{
          	$tipo[] = "Contratista:";
          }

          //$log[] = '<img src="'.$fila["logo"].'" width="60px" height="60px" style=" margin-right : 20px;">';
}
$soluc = '';
for ($i=0; $i <= $cont ; $i++) {
	$soluc = $soluc.'<tr>

					<td VALIGN="TOP" style="padding-top: 10px; border-bottom: black 1px solid; width: 80px;">'.$tipo[$i].'</td>
					<td align="justify" style="padding-right:10px; padding-bottom:10px; padding-top: 10px; border-bottom: black 1px solid; width: 660px;">'.$Mens[$i].'</td>
					<td VALIGN="TOP" style="font-size: 8px; padding-top: 10px; border-bottom: black 1px solid; width: 100px;">'.$fech[$i].'</td>
				</tr>'; //$log[$i].
}

		// Varios destinatarios
$para = 'sebastiancarcamo@innoapsion.cl';
//$para .= ''.$correo.'';

// título
$título = 'Respuesta '.$reutipo.'';

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
<td>'.$nombreeess.'</td>
</tr>

<tr>
<td>para: '.$correoEESS.'</td>
</tr>
<tr>
<td>cc: '.$correos_cc.'</td>
</tr>

<br>

<tr>
<td>Informamos a usted que con fecha '.$fecha.', a las '.$hora.' hrs se ha respondido uno de los acuerdos en la Minuta de '.$reutipo.' '.$correlativo.'.</td>
</tr>
<tr>
<td>Con el objetivo de verificar que la respuesta sea conforme a lo solicitado, adjuntamos el detalle:</td>
</tr>

<br>
<tr>
<td>Acuerdo:</td>
</tr>
<tr>
<td>'.$acudescripcion.'</td>
</tr>

<tr>
<td style="border-bottom: black 1px dotted;"></td>
</tr>
<tr>
<td colspan="2">
<table cellspacing="0" cellpadding="0">
      '.$soluc.'
</table>
</td>
</tr>

<br>
<br>

<tr>
<td>Atte.</td>
</tr>
 <tr>
<td>Sedecc.</td>
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
$cabeceras .= 'From: Minuta '.$reutipo.' SSO <evaluaciondeterreno@innoapsion.cl>' . "\r\n";
//$cabeceras .= 'Cc: '.$correoEva.'' . "\r\n";
$cabeceras .= 'Bcc: sebastiancarcamo@innoapsion.cl' . "\r\n";
//$cabeceras .= 'Bcc: ronnymunoz22@gmail.com, sebastiancarcamo@innoapsion.cl, eduardoacevedo@innoapsion.cl' . "\r\n";
$cabeceras .= "Content-Type: text/html; charset=UTF-8". "\r\n";


// Enviarlo
mail(utf8_decode($para), utf8_decode($título), utf8_decode($mensaje), utf8_decode($cabeceras));




		mysqli_close($mysqli);

//----------------- FIN NOTIFICACION RESPUESTA --------------------------

   		echo "<script ; type='text/javascript'>location.href='http://innoapsion.cl/sedecc/index.php?r=site/page&view=reunionD&id=$id_ar';</script>";


?>
