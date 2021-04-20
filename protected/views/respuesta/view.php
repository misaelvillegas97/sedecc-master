<?php 

if(!isset(Yii::app()->user->id)){
  header('Location: index.php?r=site/login');
}
?>
<?php
$dir = 'images/mensaje/';
if(isset($_POST['respuesta'])){
	// Guardar respuesta
	$sql = "INSERT INTO min_mensaje(res_id, men_emisor, men_mensaje) VALUES('".$model->res_id."','".Yii::app()->user->id."','".$_POST['respuesta']."')";
	Yii::app()->db->createCommand($sql)->execute();
	
	// Obtener id respuesta
	$id = Yii::app()->db->createCommand("SELECT MAX(men_id) FROM min_mensaje")->queryScalar();
	
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
	
	// Enviar correo
	$evaluacion = Yii::app()->db->createCommand("SELECT * FROM min_evaluacion WHERE eva_id = '".$model->eva_id."'")->queryRow();
	$email = '';
	// Obtener nombre de trabajador
	$trabaj = Yii::app()->db->createCommand("SELECT CONCAT(tra_nombres,' ',tra_apellidos) FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
	$email .='
	<p>Señores<br>
	<b>'.Yii::app()->db->createCommand("SELECT eess_nombre_corto FROM min_eess WHERE eess_rut = '".$evaluacion['eess_rut']."'")->queryScalar().'</b></p>
	<p>Informamos a usted que con fecha <b>'.date("d-m-Y").'</b> a las <b>'.date("H:i").'</b> hrs. <b>'.$trabaj.'</b> Ha respondido una de las inconformidades
	en la Evaluación de Desempeño <b>'.Yii::app()->controller->identificador($evaluacion['eva_evaluador'],$evaluacion['eva_fecha_evaluacion'],$evaluacion['eva_evaluador_correlativo']).'</b>.</p>
	<p>Con el objetivo de verificar que la respuesta sea conforme a lo solicitado, adjuntamos el detalle:</p>
	<h3>Pregunta:</h3>
	<p>'.$model->res_enunciado.'</p>
	<h3>Observación:</h3>
	<p>'.$model->res_observacion.'</p>
	<h3>Hilo de respuestas:</h3>
	';
	$sql = "SELECT * FROM min_mensaje WHERE res_id = '".$model->res_id."' ORDER BY men_creado";
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
		$emisor = $rows[$i]['men_emisor'];
		if($rows[$i]['men_emisor'] != 'admin'){
			$emisor = Yii::app()->db->createCommand("SELECT CONCAT(tra_nombres,' ',tra_apellidos) FROM min_trabajador WHERE tra_rut = '".$rows[$i]['men_emisor']."'")->queryScalar();
			$emisor .= Yii::app()->db->createCommand("SELECT eess_nombre_corto FROM min_eess WHERE eess_rut = '".$rows[$i]['men_emisor']."'")->queryScalar();
		}
		// Proceso archivo
		$archivo = '';
		if(file_exists($dir.$rows[$i]['men_id'])){
			$archivo = '<a target="_blank" href="http://innoapsion.cl/sedecc/'.$dir.$rows[$i]['men_id'].'">Ver archivo</a>';
		}
		// Mostrar listado de mensajes
		$email.= '
		<tr style="border-bottom:1px solid #cccccc;">
			<td style="padding:5px; width:150px;">'.$rows[$i]['men_creado'].'</td>
			<td style="padding:5px; width:100px;">'.$emisor.'</td>
			<td style="padding:5px; ">'.$rows[$i]['men_mensaje'].'</td>
			<td style="padding:5px; width:80px;">'.$archivo.'</td>
		</tr>
		';
	}
	$email.='</table>
	<p>Si la respuesta ha sido "conforme", agradeceremos ingresar a la <a href="http://www.innoapsion.cl/sedecc">siguiente plataforma</a>, presionar <b>APROBAR</b> e ingresar sus comentarios respectivos.</p>
	';
	
	$otrosemails = Yii::app()->db->createCommand("SELECT GROUP_CONCAT(ema_email) FROM min_email WHERE eess_rut = '".$evaluacion['eess_rut']."'")->queryScalar();
	$direccionesem = Yii::app()->db->createCommand("
	SELECT GROUP_CONCAT(tra_email) FROM `min_trabajador` WHERE 
	CONCAT(tra_nombres,' ',tra_apellidos) = '".$evaluacion['eva_nombres'].' '.$evaluacion['eva_apellidos']."' OR
	CONCAT(tra_nombres,' ',tra_apellidos) = '".$evaluacion['eva_supervisor']."' OR
	CONCAT(tra_nombres,' ',tra_apellidos) = '".$evaluacion['eva_jefe_faena']."' OR
	CONCAT(tra_nombres,' ',tra_apellidos) = '".$evaluacion['eva_apr']."' OR
	tra_rut = '".$evaluacion['eva_evaluador']."'
	")->queryScalar();
	$direccioneses = Yii::app()->db->createCommand("SELECT eess_email FROM `min_eess` WHERE eess_rut = '".$evaluacion['eess_rut']."'")->queryScalar();
		
	//$archivo = chunk_split(base64_encode(file_get_contents("http://innoapsion.cl/sedecc/index.php?r=evaluacion/pdf&id=".$obj->timestamp)));
	$headers = "From: Respuesta Evaluación de Desempeño <sedecc@innoapsion.cl> \r\n";
	$headers .= "Cc: ".$direccionesem.", ".$otrosemails." \r\n"; // 
	$headers .= "Bcc: ronnymunoz22@gmail.com, sebastiancarcamo@innoapsion.cl, eduardoacevedo@innoapsion.cl " . "\r\n"; // 
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
	mail(utf8_decode($direccioneses), utf8_decode('Respuesta Evaluación de Desempeño'), utf8_decode($email_message), utf8_decode($headers)); // Quitar email de prueba
}

if(isset($_POST['aprobarid'])){
	$sql = "UPDATE min_respuesta SET res_seguimiento = 1 WHERE res_id = '".$_POST['aprobarid']."'";
	Yii::app()->db->createCommand($sql)->execute();
	header('Location: index.php?r=evaluacion/view&id='.$model->eva_id);
}

$this->breadcrumbs=array(
	'Respuestas'=>array('index'),
	$model->res_id,
);
?>


<span style='float:right; display:none;'>
<?php echo CHtml::link('<i class="i i-list"></i>',array('index'),array('title'=>'Volver al listado','class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-plus2"></i>',array('create'),array('title'=>'Nueva','class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-pencil2"></i>',array('update','id'=>$model->res_id),array('title'=>'Modificar','class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-cross2"></i>',array('trash','id'=>$model->res_id),array('title'=>'Eliminar','class'=>'btn btn-rounded btn-sm btn-icon btn-default','onclick'=>'return confirm(\'¿Realmente desea eliminar?\');'));?>
<?php echo CHtml::link('<i class="i i-list2"></i>',array('admin'),array('title'=>'Volver al listado','class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
</span> 

<span style='float:right;'>
	<?php
	// Que solo el evaluador pueda aprobar
	$evaluador = Yii::app()->db->createCommand("SELECT eva_evaluador FROM min_evaluacion WHERE eva_id = '".$model->eva_id."'")->queryScalar();
	$eess = Yii::app()->db->createCommand("SELECT eess_rut FROM min_evaluacion WHERE eva_id = '".$model->eva_id."'")->queryScalar();
	//if((Yii::app()->user->id != $evaluador || Yii::app()->user->id == 'admin' || Yii::app()->user->id == $eess) && ($model->res_seguimiento != 1 && Yii::app()->controller->usertype() != 4)) 
	if(Yii::app()->controller->usertype() == 1 || Yii::app()->controller->usertype() == 2)echo '
	<form method="post" style="display:inline;">
	<input type="hidden" id="aprobarid" name="aprobarid" value="'.$model->res_id.'">
	<input type="submit" onclick="return confirm(\'¿Realmente desea aprobar esta solución?\')" class="btn btn-rounded btn-sm btn-success" value="Aprobar"/>
	</form>
	';
	?>
	<a class="btn btn-rounded btn-sm btn-primary" href="index.php?r=evaluacion/view&id=<?php echo $model->eva_id;?>">Volver a la evaluación</a>
</span>

<h1>Detalle Respuesta</h1>
<p><?php echo $model->car_id?> / <?php echo $model->tem_id?></p>
<h3>
	<?php echo $model->res_enunciado;?>
	<?php $label='warning'; if($model->res_respuesta == 'no') $label='danger'; if($model->res_respuesta == 'si') $label='success'; echo '<span class="label label-'.$label.'">'.strtoupper($model->res_respuesta).'</span>';?>
	<?php //$label='warning'; $text=''; if($model->res_seguimiento == '0'){$label='warning';$text='PENDIENTE';} if($model->res_seguimiento == '1'){$label='success';$text='CERRADA';} echo '<span class="label label-'.$label.'">'.$text.'</span>';?>
</h3>
<p><i><?php echo $model->res_observacion;?></i></p>
<div class="alert alert-info">
<?php
// Mostrar estado de seguimiento
$stsmf = 'margin-top:-7px; width:90px;';

// Get fecha de solución
if((Yii::app()->user->id == $evaluador || Yii::app()->user->id == 'admin') && $model->res_seguimiento != 1){
	if(isset($_POST['plazo_solucion'])){
		$model->res_plazo=$_POST['plazo_solucion'];
		Yii::app()->db->createCommand("UPDATE min_respuesta SET res_plazo = '".$model->res_plazo."' WHERE res_id = '".$model->res_id."'")->execute();
	}
	$fecha_solucion = '<form method="post"><input name="plazo_solucion" type="date" value='.$model->res_plazo.'><input style="padding:9px;" class="btn btn-primary" type="submit" value="Cambiar"></form>';
}
else{
	$fecha_solucion = (new DateTime($model->res_plazo))->format('d-m-Y');
}

if($model->res_seguimiento == 1){
	echo 'Plazo de solución: <b>'.$fecha_solucion.'</b> <img style="'.$stsmf.'" src="images/semaforo_verde.png" class="pull-right">';
}
else{
	$vencida = Yii::app()->db->createCommand("SELECT IF('".$model->res_plazo."' < NOW(), 1, 0)")->queryScalar();
	if($vencida == 0){
		echo 'Plazo de solución: <b>'.$fecha_solucion.'</b> <img style="'.$stsmf.'" src="images/semaforo_amarillo.png" class="pull-right">';
	}
	else{
		echo 'Plazo de solución: <b>'.$fecha_solucion.'</b> <img style="'.$stsmf.'" src="images/semaforo_rojo.png" class="pull-right">';
	}
}
?>
</div>

<hr>

<!--?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'res_id',
		'res_tiempo',
		'res_enunciado',
		'res_respuesta',
		'res_ponderacion',
		'pre_id',
		'car_id',
		'tem_id',
		'res_observacion',
		'res_foto',
		'eva_id',
		'res_seguimiento',
	),
)); ?-->

<div style="background:#ffffff; padding:20px;">

<?php
$sql = "SELECT * FROM min_mensaje WHERE res_id = '".$model->res_id."' ORDER BY men_creado";
$rows = Yii::app()->db->createCommand($sql)->queryAll();
echo '
<div class="row" style="font-weight:bold;">
	<div class="col-sm-2">Fecha</div>
	<div class="col-sm-2">Emisor</div>
	<div class="col-sm-7">Mensaje</div>
	<div class="col-sm-1">Archivo</div>
</div>
<hr>
';
for($i=0;$i<count($rows);$i++){
	// Proceso de emisor
	$emisor = $rows[$i]['men_emisor'];
	if($rows[$i]['men_emisor'] != 'admin'){
		$emisor = Yii::app()->db->createCommand("SELECT CONCAT(tra_nombres,' ',tra_apellidos) FROM min_trabajador WHERE tra_rut = '".$rows[$i]['men_emisor']."'")->queryScalar();
		$emisor .= Yii::app()->db->createCommand("SELECT eess_nombre_corto FROM min_eess WHERE eess_rut = '".$rows[$i]['men_emisor']."'")->queryScalar();
	}
	// Proceso archivo
	$archivo = '';
	if(file_exists($dir.$rows[$i]['men_id'])){
		$archivo = '
		<!-- Button trigger modal -->
		<h3 class="fa fa-file" data-toggle="modal" data-target="#myModal'.$rows[$i]['men_id'].'" style="cursor:pointer; margin:0px !important;"></h3>
		<div class="modal fade" id="myModal'.$rows[$i]['men_id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      <iframe src="'.$dir.$rows[$i]['men_id'].'" frameborder="0" style="width:100%; height:500px;"></iframe>
		    </div>
		  </div>
		</div>
		';
	}
	// Mostrar listado de mensajes
	echo '
	<div class="row">
		<div class="col-sm-2">'.(new DateTime($rows[$i]['men_creado']))->format('d-m-Y H:i:s').'</div>
		<div class="col-sm-2">'.$emisor.'</div>
		<div class="col-sm-7">'.$rows[$i]['men_mensaje'].'</div>
		<div class="col-sm-1">'.$archivo.'</div>
	</div>
	<hr>
	';
}
?>

<?php
$supervisor_nombre = Yii::app()->db->createCommand("SELECT eva_supervisor FROM min_evaluacion WHERE eva_id = '".$model->eva_id."'")->queryScalar();
$trabajador = Yii::app()->db->createCommand("SELECT tra_rut FROM min_evaluacion WHERE eva_id = '".$model->eva_id."'")->queryScalar();
$supervisor = Yii::app()->db->createCommand("SELECT tra_rut FROM min_trabajador WHERE CONCAT(tra_nombres,' ',tra_apellidos) = '".$supervisor_nombre."'")->queryScalar();
$respondetodo = Yii::app()->db->createCommand("SELECT tra_rut FROM min_trabajador WHERE eess_rut = '".Yii::app()->db->createCommand("SELECT eess_rut FROM min_evaluacion WHERE eva_id = '".$model->eva_id."'")->queryScalar()."' AND tra_responder_todo = 1 AND tra_rut = '".Yii::app()->user->id."'")->queryScalar();
if(
	Yii::app()->user->id == $evaluador ||
	Yii::app()->user->id == $trabajador ||
	Yii::app()->user->id == $supervisor ||
	Yii::app()->user->id == $respondetodo ||
	Yii::app()->user->id == 'admin' ||
	Yii::app()->controller->usertype() == 4
){
?>
<form method="post" enctype="multipart/form-data" style="margin-bottom:40px;">
	<input id="file" name="file" type="file">
	<input required class="form-control" id="respuesta" name="respuesta" type="text" placeholder="Escriba aquí su respuesta (Enter para enviar)">
	<input type="submit" class="btn btn-primary pull-right">
</form>
<?php
}
?>

</div>