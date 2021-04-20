<?php

if(!isset(Yii::app()->user->id)){
  header('Location: index.php?r=site/login');
}
$dir = 'images/respuesta_medidas_control/';
function enviarCorreo($idAccidente,$medidaControlId){
		// Enviar correo
	$accidente = Yii::app()->db->createCommand("SELECT * FROM min_accidente WHERE id_accidente = '".$idAccidente."'")->queryRow();
	$email = '';
	$dir = 'images/respuesta_medidas_control/';
	// Obtener nombre de trabajador
	$trabaj = Yii::app()->db->createCommand("SELECT CONCAT(tra_nombres,' ',tra_apellidos) FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
	$fechaAccidente = Yii::app()->db->createCommand("SELECT fecha_accidente from min_accidente WHERE id_accidente=".$idAccidente." ")->queryScalar();
	$tipoAccidente = Yii::app()->db->createCommand("SELECT acc_tipo_accidnte from min_accidente WHERE id_accidente=".$idAccidente."")->queryScalar();
	$descripcionAccidente = Yii::app()->db->createCommand("SELECT Descripcion from min_accidente WHERE id_accidente=".$idAccidente."")->queryScalar();
	$causaBasica = Yii::app()->db->createCommand("SELECT cbl.cl_descripcion FROM min_medidas_control mc JOIN min_causas_inmediatas ci on ci.ci_id=mc.ci_id JOIN min_causas_basicas cb on cb.cb_id=ci.cb_id JOIN min_causas_list cbl on cbl.cl_id=cb.cbl_id WHERE mc.mc_id=".$medidaControlId." ")->queryScalar();
	$causaInmediata = Yii::app()->db->createCommand("SELECT cil.cl_descripcion FROM min_medidas_control mc JOIN min_causas_inmediatas ci on ci.ci_id=mc.ci_id JOIN min_causas_list cil on cil.cl_id=ci.cil_id WHERE mc.mc_id=".$medidaControlId." ")->queryScalar();
	$medidaControl = Yii::app()->db->createCommand("SELECT mcl.mcl_descripcion FROM min_medidas_control mc JOIN min_medidas_control_list mcl on mcl.mcl_id=mc.mcl_id WHERE mc.mc_id=".$medidaControlId." ")->queryScalar();
	$email .='
	<p>Señores<br>
	<b>'.Yii::app()->db->createCommand("SELECT eess_nombre_corto FROM min_eess WHERE eess_rut = '".$accidente['rut_eess']."'")->queryScalar().'</b></p>
	<p>Informamos a usted que con fecha <b>'.date("d-m-Y").'</b> a las <b>'.date("H:i").'</b> hrs. <b>'.$trabaj.'</b> Se ha respondido una de las medidas de control
	en el accidente '.$idAccidente.' .</p>
	<p>Con el objetivo de verificar que la respuesta sea conforme a lo solicitado, adjuntamos el detalle:</p>
	<h3>Fecha Accidente:</h3>
	<p>'.$fechaAccidente.'</p>
	<h3>Tipo Accidente:</h3>
	<p>'.$tipoAccidente.'</p>
	<h3>Descripción:</h3>
	<p>'.$descripcionAccidente.'</p>
	<h3>Causa Básica:</h3>
	<p>'.$causaBasica.'</p>
	<h3>Causa Inmediata:</h3>
	<p>'.$causaInmediata.'</p>
	<h3>Medida Control:</h3>
	<p>'.$medidaControl.'</p>
	<h3>Hilo de respuestas:</h3>
	';
	$sql = "SELECT * FROM min_respuesta_medida_control WHERE mc_id = '".$medidaControlId."' ORDER BY rmc_fecha";
	$rows = Yii::app()->db->createCommand($sql)->queryAll();
	$email.='<table style="border-collapse:collapse; background:#f3f3f3;">
	<tr style="border-bottom:1px solid #cccccc;">
		<td style="padding:5px;"><b>Fecha</b></td>
		<td style="padding:5px;"><b>Emisor</b></td>
		<td style="padding:5px;"><b>Mensaje</b></td>
		<td style="padding:5px;"><b>Archivo</b></td>
	</tr>
	';
	// Incluir historial de resuestas
	for($i=0;$i<count($rows);$i++){
		// Proceso de emisor
		$emisor = $rows[$i]['rmc_emisor'];
		/*if($rows[$i]['rmc_emisor'] != 'ADMIN'){
			$emisor = Yii::app()->db->createCommand("SELECT CONCAT(tra_nombres,' ',tra_apellidos) FROM min_trabajador WHERE tra_rut = '".$rows[$i]['men_emisor']."'")->queryScalar();
			$emisor .= Yii::app()->db->createCommand("SELECT eess_nombre_corto FROM min_eess WHERE eess_rut = '".$rows[$i]['men_emisor']."'")->queryScalar();
		}*/
		// Proceso archivo
		$archivo = '';
		if(file_exists($dir.$rows[$i]['rmc_id'])){
			$archivo = '<a target="_blank" href="http://innoapsion.cl/sedecc/'.$dir.$rows[$i]['rmc_id'].'">Ver archivo</a>';
		}
		// Mostrar listado de mensajes
		$email.= '
		<tr style="border-bottom:1px solid #cccccc;">
			<td style="padding:5px; width:150px;">'.$rows[$i]['rmc_fecha'].'</td>
			<td style="padding:5px; width:100px;">'.$emisor.'</td>
			<td style="padding:5px; ">'.$rows[$i]['rmc_observacion'].'</td>
			<td style="padding:5px; width:80px;">'.$archivo.'</td>
		</tr>
		';
	}
	$email.='</table>
	<p>Si la respuesta ha sido "conforme", agradeceremos ingresar a la <a href="http://www.innoapsion.cl/sedecc">siguiente plataforma</a>, presionar <b>APROBAR</b> e ingresar sus comentarios respectivos.</p>
	';

	//$otrosemails = Yii::app()->db->createCommand("SELECT GROUP_CONCAT(ema_email) FROM min_email WHERE eess_rut = '".$evaluacion['eess_rut']."'")->queryScalar();
	/*$direccionesem = Yii::app()->db->createCommand("
	SELECT GROUP_CONCAT(tra_email) FROM `min_trabajador` WHERE
	CONCAT(tra_nombres,' ',tra_apellidos) = '".$evaluacion['eva_nombres'].' '.$evaluacion['eva_apellidos']."' OR
	CONCAT(tra_nombres,' ',tra_apellidos) = '".$evaluacion['eva_supervisor']."' OR
	CONCAT(tra_nombres,' ',tra_apellidos) = '".$evaluacion['eva_jefe_faena']."' OR
	CONCAT(tra_nombres,' ',tra_apellidos) = '".$evaluacion['eva_apr']."' OR
	tra_rut = '".$evaluacion['eva_evaluador']."'
	")->queryScalar();
	*/
	$direccioneses = Yii::app()->db->createCommand("SELECT eess_email FROM `min_eess` WHERE eess_rut = '".$accidente['rut_eess']."'")->queryScalar();

	//$archivo = chunk_split(base64_encode(file_get_contents("http://innoapsion.cl/sedecc/index.php?r=evaEquipos/pdf&id=".$obj->timestamp)));
	$headers = "From: Respuesta Evaluación de Desempeño <sedecca@innoapsion.cl> \r\n";
	//$direccioneses = "jose.rodriguez@mecharv.cl";
	//$headers .= "Cc: jorgeiraira55@gmail.com \r\n"; //
	//$headers .= "Bcc: jorgeiraira55@gmail.com,eduardoacevedo@innoapsion.cl " . "\r\n";
	$headers .= "Cc:  ".$direccioneses." \r\n"; //
	$headers .= "Bcc: ronnymunoz22@gmail.com, sebastian.carcamo398@gmail.com, eduardoacevedo@innoapsion.cl, gustavoogueda@innoapsion.cl " . "\r\n"; //
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: multipart/mixed; boundary=\"=A=G=R=O=\"\r\n\r\n";
	$email_message = "--=A=G=R=O=\r\n";
	$email_message .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$email_message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
	$email_message .= $email . "\r\n\r\n";
	$email_message .= "--=A=G=R=O=\r\n";
	/*
	$email_message .= "Content-Type: application/octet-stream; name=\"Evaluaciones.pdf\"\r\n";
	$email_message .= "Content-Transfer-Encoding: base64\r\n";
	$email_message .= "Content-Disposition: attachment; filename=\"Evaluaciones.pdf\"\r\n\r\n";
	$email_message .= $archivo . "\r\n\r\n";
	$email_message .= "--=A=G=R=O=\r\n";
	*/
	mail(utf8_decode($direccioneses), utf8_decode('Respuesta Medidas de Control'), utf8_decode($email_message), utf8_decode($headers)); // Quitar email de prueba
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	extract($_POST);
	if ($action == "aprobar"){
		$aprobar= "UPDATE min_medidas_control set
								mc_semaforo=2
								where mc_id=".$aprobarId." ";
									//return;
		Yii::app()->db->createCommand($aprobar)->execute();
		header("Location: http://innoapsion.cl/sedecc/index.php?r=accidente/view&id=".$accidente);
		die();
	}
	if ($action == "responder"){
		
		$emisor='';
		// Cuando el tipo de usuario es empresa
		if(Yii::app()->controller->usertype() == 1){
			$emisor = Yii::app()->db->createCommand("SELECT eess_nombre_nombre_corto FROM min_eess WHERE eess_rut = '".Yii::app()->user->id."'")->queryScalar();
		}
		// Cuando el tipo de usuario es admin
		if(Yii::app()->controller->usertype() == 2){
			$emisor = 'ADMIN';
		}
		// Cuando el tipo de usuario es evaluador
		if(Yii::app()->controller->usertype() == 3){
			$emisor = Yii::app()->db->createCommand("SELECT CONCAT(tra_nombres,' ',tra_apellidos) FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
		}
		$aprobar= "UPDATE min_medidas_control set
								mc_semaforo=1
								where mc_id=".$aprobarId." ";
								
		$respuesta= "INSERT into min_respuesta_medida_control (
					rmc_id,
					rmc_fecha,
					mc_id,
					rmc_observacion,
					rmc_emisor
					) VALUES(
						NULL,
						CURRENT_TIMESTAMP,
						".$aprobarId.",
						'".$observacion."',
						'".$emisor."'	
					)";
		Yii::app()->db->createCommand($aprobar)->execute();
		Yii::app()->db->createCommand($respuesta)->execute();
		// Obtener id respuesta
		$id = Yii::app()->db->createCommand("SELECT MAX(rmc_id) FROM min_respuesta_medida_control")->queryScalar();
	
		// Subir imagen
		if(isset($_FILES['file'])){
			if(!file_exists($dir)) mkdir($dir, 0777, true);
			$uploadfile = $dir.$id;
	
			if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
				    	//echo "Archivo subido correctamente";
			} else {
				    	//echo "Error al subir archivo";
			}
		}
		enviarCorreo($accidente,$aprobarId);
		header("Location: http://innoapsion.cl/sedecc/index.php?r=accidente/view&id=".$accidente);
		die();
	}
}else{
	extract($_GET);
}


?>
<div class="span-19">
	<div id="content">
		
		<span style="float:right;">
			<form method="post" style="display:inline;" action="index.php?r=site/page&view=respuestaMedidaControl&id=<?php echo $id;?>&accidente=<?php echo $accidente;?>">
				<input type="hidden" id="aprobarId" name="aprobarId" value="<?php echo $id;?>">
				<input type="hidden" id="accidente" name="accidente" value="<?php echo $accidente;?>">
				<input type="hidden" id="action" name="action" value="aprobar">
				<input type="submit" onclick="return confirm('¿Realmente desea aprobar esta medida de control?')" class="btn btn-rounded btn-sm btn-success" value="Aprobar">
			</form>
			<a class="btn btn-rounded btn-sm btn-primary" href="/sedecc/index.php?r=accidente/view&id=<?php echo $accidente;?>">Volver al accidente</a>
		</span>
		<h1>Respuesta a medida de control</h1>
		<?php 
			$medidaControl = Yii::app()->db->createCommand("SELECT mcl.mcl_descripcion FROM min_medidas_control mc JOIN min_medidas_control_list mcl on mcl.mcl_id=mc.mcl_id WHERE mc.mc_id=".$id." ")->queryScalar();
			$plazo = Yii::app()->db->createCommand("SELECT mc.mc_plazo FROM min_medidas_control mc  WHERE mc.mc_id=".$id." ")->queryScalar();
			$seguimiento = Yii::app()->db->createCommand("SELECT mc.mc_semaforo  FROM min_medidas_control mc  WHERE mc.mc_id=".$id." ")->queryScalar();
			$semaforo='';
			switch($seguimiento){
				case 0:
					$semaforo='<img  src="images/semaforo_rojo.png" style="width:90px; margin-top:-7px;" class="pull-right">';
					break;
				case 1:
					$semaforo='<img  src="images/semaforo_amarillo.png" style="width:90px; margin-top:-7px;" class="pull-right">';
					break;
				case 2:
					$semaforo='<img  src="images/semaforo_verde.png" style="width:90px; margin-top:-7px;" class="pull-right">';
					break;
			}
			echo '<h3>'.$medidaControl.'</h3>';
			echo '<div class="alert alert-info">';
			echo 'Plazo de solución: ';
			echo '<b>'.$plazo.'</b>';
			echo $semaforo;
			echo '</div>';
		?>
		<section class="panel panel-default">
			<!--header class="panel-heading font-bold">Horizontal form</header-->
			<div class="panel-body">
				<div class="row" style="font-weight:bold;">
					<div class="col-sm-2">Fecha</div>
					<div class="col-sm-2">Emisor</div>
					<div class="col-sm-7">Mensaje</div>
					<div class="col-sm-1">Archivo</div>
				</div>
				<hr>
				<?php 
					$respuestas = Yii::app()->db->createCommand("SELECT * FROM min_respuesta_medida_control WHERE mc_id=".$id ." ")->query()->readAll();
					for($mc=0;$mc<count($respuestas);$mc++){
						// Proceso archivo
						$archivo = '';
						if(file_exists($dir.$respuestas[$mc]['rmc_id'])){
							$archivo = '
							<!-- Button trigger modal -->
							<h3 class="fa fa-file" data-toggle="modal" data-target="#myModal'.$respuestas[$mc]['rmc_id'].'" style="cursor:pointer; margin:0px !important;"></h3>
							<div class="modal fade" id="myModal'.$respuestas[$mc]['rmc_id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							  <div class="modal-dialog modal-lg" role="document">
							    <div class="modal-content">
							      <iframe src="'.$dir.$respuestas[$mc]['rmc_id'].'" frameborder="0" style="width:100%; height:500px;"></iframe>
							    </div>
							  </div>
							</div>
							';
						}
						echo '<div class="row" >';
						echo '<div class="col-sm-2">'.$respuestas[$mc]['rmc_fecha'].'</div>';
						echo '<div class="col-sm-2">'.$respuestas[$mc]['rmc_emisor'].'</div>';
						echo '<div class="col-sm-7">'.$respuestas[$mc]['rmc_observacion'].'</div>';
						echo '<div class="col-sm-1">'.$archivo.'</div>';		
						echo '</div >';
						echo '<hr>';
					}
				?>
				<div class="bs-example form-horizontal" style="margin-top: 30px;">
					 <!-- FORMULARIO PARA SOICITAR LA CARGA DEL EXCEL -->
				   <form method="post" enctype="multipart/form-data" style="margin-bottom:40px;">
					   	<input type="hidden" id="aprobarId" name="aprobarId" value="<?php echo $id;?>">
						<input type="hidden" id="accidente" name="accidente" value="<?php echo $accidente;?>">
						<input type="hidden" id="action" name="action" value="responder">
						<input id="file" name="file" type="file">
						<input required="" class="form-control" id="observacion" name="observacion" type="text" placeholder="Escriba aquí su respuesta (Enter para enviar)">
						<input type="submit" class="btn btn-primary pull-right">
					</form>
				    <!-- CARGA LA MISMA PAGINA MANDANDO LA VARIABLE upload -->
				</div>
			</div>
		</section>
			
	</div>
</div>