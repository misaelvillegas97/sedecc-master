<?php
/* @var $this EvaluacionEquiposController */
/* @var $model EvaluacionEquipos */

/*$this->breadcrumbs=array(
	'Evaluacion Equiposes'=>array('index'),
	$model->eva_id,
);
?>


<span style='float:right;'>
<?php echo CHtml::link('<i class="i i-list"></i>',array('index'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-plus2"></i>',array('create'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-pencil2"></i>',array('update','id'=>$model->eva_id),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-cross2"></i>',array('trash','id'=>$model->eva_id),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default','onclick'=>'return confirm(\'¿Realmente desea eliminar?\');'));?>
<?php echo CHtml::link('<i class="i i-list2"></i>',array('admin'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
</span>
<h1>Detalle EvaluacionEquipos #<?php echo $model->eva_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'eva_id',
		'eva_creado',
		'eva_tipo',
		'eess_rut',
		'eq_tipo',
		'eq_codigo',
		'eq_marca',
		'eq_modelo',
		'eva_operador',
		'eva_apr',
		'eva_supervisor',
		'eva_jefe_faena',
		'eva_horometro',
		'eva_ot',
		'eva_fecha_evaluacion',
		'eva_geo_x',
		'eva_geo_y',
		'eva_campos_modificados',
		'eva_general_observacion',
		'eva_general_foto',
		'eva_general_fecha',
		'eva_evaluador',
		'eva_cache_porcentaje',
		'eva_evaluador_correlativo',
		'eva_fecha',
		'eva_hora',
		'eva_lugar',
		'eva_semaforo',
		'eva_item_nombre_0',
		'eva_item_nota_0',
		'eva_item_nombre_1',
		'eva_item_nota_1',
		'eva_item_nombre_2',
		'eva_item_nota_2',
		'eva_item_nombre_3',
		'eva_item_nota_3',
		'eva_item_nombre_4',
		'eva_item_nota_4',
		'eva_item_nombre_5',
		'eva_item_nota_5',
		'eva_item_nombre_6',
		'eva_item_nota_6',
		'eva_item_nombre_7',
		'eva_item_nota_7',
		'eva_item_nombre_8',
		'eva_item_nota_8',
		'eva_item_nombre_9',
		'eva_item_nota_9',
		'eva_item_nombre_10',
		'eva_item_nota_10',
	),
)); */ ?>
<?php

if(!isset(Yii::app()->user->id)){
	//$_SESSION['pag'] = "paginaprohibida.php";
	echo '<script>window.location ="http://innoapsion.cl/sedecc/index.php?r=site/login&returnurl=index.php?r=evaEquipos/view&id='.$model->eva_id.'"</script>';
} 

/*if(!isset(Yii::app()->user->id)){
  header('Location: index.php?r=site/login');
}*/
?>
<?php
/* @var $this EvaluacionController */
/* @var $model Evaluacion */

$this->breadcrumbs=array(
	'Evaluacions'=>array('index'),
	$model->eva_id,
);
?>


<span style='float:right;'>
<?php echo CHtml::link('<img src="img/list.png" width="40px;">',array('index'),array('title'=>'Volver al listado')); ?>
<!--?php echo CHtml::link('<i class="i i-plus2"></i>',array('create'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?-->
<?php
$es_evaluador = Yii::app()->db->createCommand("SELECT tra_evaluador FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
if(Yii::app()->controller->usertype() == 1 || Yii::app()->controller->usertype() == 2 ){
	echo CHtml::link('<img src="img/edit.png" width="40px;">',array('update','id'=>$model->eva_id),array('title'=>'Modificar'));
}

?>
<!--?php echo CHtml::link('<i class="i i-cross2"></i>',array('trash','id'=>$model->eva_id),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default','onclick'=>'return confirm(\'¿Realmente desea eliminar?\');'));?-->
<!--?php echo CHtml::link('<i class="i i-list2"></i>',array('admin'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?-->

<?php
$pdf_safco = Yii::app()->db->createCommand("SELECT eess_rut FROM min_evaluacion_equipos WHERE eva_id = '".$model->eva_id."'")->queryScalar();


if ($pdf_safco == '76885630') {
 	$tipo_pdf = "pdfsafco";
}else{
	$tipo_pdf = "pdf";
}


 ?>
<?php echo CHtml::link('<img src="img/pdf.png" width="40px;">',array($tipo_pdf,'id'=>$model->eva_id),array('title'=>'Exportar PDF','target'=>'_blank')); ?>
</span>
<h1>Detalle Evaluación <!--?php echo $model->eva_id; ?--></h1>





<div class="row">
	<div class="col-sm-4">
		<?php
			$array = array(
				//'eva_id',
				array(
					'name'=>'eva_id',
					'type'=>'raw',
					'value'=>function($data){
						return Yii::app()->controller->identificador($data->eva_evaluador,$data->eva_fecha_evaluacion,$data->eva_evaluador_correlativo);
					},
				),
				//'eva_creado',
				'eq_codigo',
        'eq_maquina',
				'eq_marca',
				'eq_modelo',
				'eva_operador',
				'eva_evaluador',
				'eva_tipo',
				'eva_horometro',
				'eva_ot',


			);

		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>$array,
		));
		?>
	</div>
	<div class="col-sm-4">
		<?php
		if($model->eva_geo_x == 0){
			$array = array(
        array(
					'name'=>'eess_rut',
					'type'=>'raw',
					'value'=>function($data){
						return Yii::app()->db->createCommand("SELECT eess_nombre_corto FROM min_eess WHERE eess_rut = '".$data->eess_rut."'")->queryScalar();
					},
				),
        'eva_fecha_evaluacion',
				'eva_jefe_faena',
				'eva_supervisor',
				/*
				'eva_general_observacion',
				'eva_general_foto',
				'eva_general_fecha',
				'eva_cache_porcentaje',*/
			);
		}
		else{
			$array = array(
        array(
					'name'=>'eess_rut',
					'type'=>'raw',
					'value'=>function($data){
						return Yii::app()->db->createCommand("SELECT eess_nombre_corto FROM min_eess WHERE eess_rut = '".$data->eess_rut."'")->queryScalar();
					},
				),
        'eva_fecha_evaluacion',
				'eva_jefe_faena',
				'eva_supervisor',
				'eva_geo_x',
				'eva_geo_y',
				/*
				'eva_general_observacion',
				'eva_general_foto',
				'eva_general_fecha',
				'eva_cache_porcentaje',*/
			);
		}
		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>$array,
		));
		?>
	</div>
	<div class="col-sm-4">
		<?php
		if($model->eva_geo_x == 0) echo '<div class="alert alert-warning text-center">No se han capturado coordenadas GPS para esta evaluación.</div>';
		else echo '<iframe frameborder="0" style="width:100%; height:261px;" src="https://static.parastorage.com/services/santa/1.1433.24/static/external/googleMap.html?addressInfo='.$model->eq_maquina.' '.$model->eq_tipo.'%0A&language=es&lat='.$model->eva_geo_x.'&long='.$model->eva_geo_y.'&mapInteractive=true&mapType=ROADMAP&showMapType=true&showPosition=true&showStreetView=true&showZoom=true&ts=640&zoom=12"></iframe>';
		?>
	</div>
	<div class="col-sm-12">
		<?php
		$sql = "SELECT * FROM min_respuesta_equipos WHERE eva_id = '".$model->eva_id."' ORDER BY pre_id";
		$rows = Yii::app()->db->createCommand($sql)->queryAll();


		$arrcat = array();
		echo '
		<table class="table nw" style="margin-top:15px;background:#ffffff;">
		<thead><th>#</th><th>ÍTEM</th><th>RESPUESTA</th><th>SEGUIMIENTO</th><th>OBSERVACIÓN</th><th style="text-align:right;">IMAGEN</th></thead>
		';
		for($i=0,$j=1;$i<count($rows);$i++,$j++){
			$label = 'warning';
			$text = '<img src="img/na.png" width="30px;">';
			if($rows[$i]['res_respuesta'] == 'si'){
				$label = 'success';
				$text = '<img src="img/check.png" width="30px;">';
			}
			if($rows[$i]['res_respuesta'] == 'no'){
				$label = 'danger';
				$text = '<img src="img/mal.png" width="30px;"';
			}
			if(!in_array($rows[$i]['tem_id'],$arrcat)){
				$arrcat[] = $rows[$i]['tem_id'];
				echo '<tr class="alert alert-success"><td colspan="30" style="color: white; background-color: #ffb210;"><small><b>'.$rows[$i]['tem_id'].'</b></small></td></tr>';
				$j=1;
			}
			$img = '';
			if($rows[$i]['res_foto'] != ''){
				$datahdr = '';
				if(strlen($rows[$i]['res_foto'])>30) $datahdr = 'data:image/png;base64,';
				$img = '
					<img data-toggle="modal" data-target="#myModal'.$i.'" style="cursor:pointer;" title="Ver fotografía" src="http://findicons.com/files/icons/1686/led/16/image_1.png">
					<div class="modal fade" id="myModal'.$i.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-body">
					        <img src="'.$datahdr.$rows[$i]['res_foto'].'" style="width:100%;">
					      </div>
					    </div>
					  </div>
					</div>
				';
			}
			if($rows[$i]['res_respuesta'] == 'no'){
				$rows[$i]['res_enunciado'] = '<a href="index.php?r=respuestaEquipos/view&id='.$rows[$i]['res_id'].'"><b>'.$rows[$i]['res_enunciado'].'</b></a>';
			}

			$stsmf = 'width:50px;';
			if($rows[$i]['res_seguimiento'] == 1){
				$smf = '<img style="'.$stsmf.'" src="images/semaforo_verde.png">';
			}
			else{
				$vencida = Yii::app()->db->createCommand("SELECT IF('".$rows[$i]['res_plazo']."' < NOW(), 1, 0)")->queryScalar();
				if($vencida == 0){
					$smf = '<img style="'.$stsmf.'" src="images/semaforo_amarillo.png">';
				}
				else{
					$smf = '<img style="'.$stsmf.'" src="images/semaforo_rojo.png">';
				}
			}

			echo '<tr><td>'.$j.'</td><td>'.$rows[$i]['res_enunciado'].'</td><td style="width:80px; color:#ffffff; font-weight:bold; text-align:center;">'.$text.'</td><td style="text-align:center;">'.$smf.'</td><td><small>'.$rows[$i]['res_observacion'].'</small></td><td style="width:100px; text-align:right;">'.$img.'</td></tr>';
		}

		// Observaciones, fecha y fotos
		$img = '';
		if($model->eva_general_foto != ''){
			$img = '
					<img data-toggle="modal" data-target="#myModal'.$i.'" style="cursor:pointer;" title="Ver fotografía" src="http://findicons.com/files/icons/1686/led/16/image_1.png">
					<div class="modal fade" id="myModal'.$i.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <!--div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
					      </div-->
					      <div class="modal-body">
					        <img src="data:image/png;base64,'.$model->eva_general_foto.'" style="width:100%;">
					      </div>
					      <!--div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					        <button type="button" class="btn btn-primary">Save changes</button>
					      </div-->
					    </div>
					  </div>
					</div>
			';
		}
		echo '<tr class="alert alert-success"><td colspan="30"><small><b>Observaciones generales</b></small></td></tr>';
		echo '<tr><td colspan="4">'.$model->eva_general_observacion.'</td><td style="width:100px; text-align:right;">'.$img.'</td></tr>';
		// mensaje para mostrar visualizador si la respuesta negativa es critica

		$ver= Yii::app()->db->createCommand("SELECT * FROM min_respuesta_equipos WHERE eva_id = '".$model->eva_id."' ORDER BY pre_id")->query()->readAll();


			for($s=0;$s<count($ver);$s++){

			$enun = $ver[$s]['res_enunciado'];
			$eval_id = $model->eva_id;

			$critico = Yii::app()->db->createCommand("SELECT critico,pre_enunciado,res_enunciado, r.eva_id,res_respuesta,r.car_id,p.car_id FROM min_pregunta p inner join min_respuesta_equipos r on (pre_enunciado=res_enunciado) where res_enunciado = '".$enun."' AND r.eva_id = '".$eval_id."' ")->query()->readAll();
						for($d=0;$d<count($critico);$d++){
							if($critico[$d]['critico'] == 'si'&&$critico[$d]['res_respuesta']=='no'){
								$alerta1 = '¡Precaución!: Maquina ha incumplido una pregunta considerada crítica.';//';
								$alerta2 = ' Se recomienda Identificar las desviaciones, implementar las medidas correctivas y un realizar un seguimiento sistemático.';//';
								$tienecritico ='si';

							}else{
								$alerta1 = '';
								$alerta2 = '';
								$tienecritico = 'no';
							}
						}
			}


		$verpromedio = Yii::app()->db->createCommand("SELECT eva_cache_porcentaje From min_evaluacion_equipos WHERE eva_id='".$model->eva_id."'")->query()->readAll();
		$limit1 = Yii::app()->params['riesgoalto'];

		for($t=0;$t<count($verpromedio);$t++){
			$notapromedio = number_format(floor($verpromedio[$t]['eva_cache_porcentaje']));
			if($notapromedio>$limit1 and $tienecritico=='si'){
				$alerta1 = '¡Precaución!: Maquina ha incumplido una pregunta considerada crítica.';//';
				$alerta2 = ' Se recomienda Identificar las desviaciones, implementar las medidas correctivas y un realizar un seguimiento sistemático.';//';

			}elseif($notapromedio<=$limit1 or $tienecritico=='si'){
				$alerta1 = ' ¡ALERTA! Maquina en Nivel de Riesgo ALTO';//';
				$alerta2 = ' Se recomienda detener los trabajos y reparar Equipo.';//';
			}elseif($notapromedio>$limit1 and $tienecritico=='no'){
				$alerta1 = '';
				$alerta2 = '';
			}
		}
		echo '
					<tr><td colspan="30" style="text-align: center; color:red;"><b>'.$alerta1.'</b></td></tr>
			  		<tr><td colspan="30" style="text-align: center;"><b>'.$alerta2.'</b></td><br></tr>
				';
		/****/
		for($t=0,$y=1;$t<count($rows);$t++,$y++){

			}
		echo '</table>';

		// Mostrar resultado
		//obtencion de valores de <tr><td></td><td colspan="4" style="color:red; text-align="center">'.$alerta1.'</td><td></td></tr>riesgo y actualizacion
			$limit1 = Yii::app()->params['riesgoalto'];
			$limit2 = Yii::app()->params['riesgomedio'];

			$MalNotaBaja = Yii::app()->params['MalNotaBaja'];
          	$RalLimBajo = Yii::app()->params['RalLimBajo'];

          	$MalNotaMedia = Yii::app()->params['MalNotaMedia'];
          	$RalLimMedio = Yii::app()->params['RalLimMedio'];

          	$MalNotaAlta = Yii::app()->params['MalNotaAlta'];
			$RalLimAlto = Yii::app()->params['RalLimAlto'];
		// Calcular nota
		$nota = '';
		if($model->eva_cache_porcentaje>=0 && $model->eva_cache_porcentaje<=$limit1) $nota = (($MalNotaBaja*$model->eva_cache_porcentaje)+$RalLimBajo);
		if($model->eva_cache_porcentaje>$limit1 && $model->eva_cache_porcentaje<=$limit2) $nota = (($MalNotaMedia*$model->eva_cache_porcentaje)-$RalLimMedio);
		if($model->eva_cache_porcentaje>$limit2 && $model->eva_cache_porcentaje<=100) $nota = (($MalNotaAlta*$model->eva_cache_porcentaje)-$RalLimAlto);
		$nota = number_format(floor($nota*10)/10,1,",",".");

		echo '
		<div class="row">
			<div class="col-md-12" style="padding-bottom: 100px;">
				<div class="col-md-1"></div>
				<div class="col-md-4" style="margin-top: 20px;">
					<img src="img/barra-N1.png" style="width: 120%; ">
				</div>
				<div class="col-md-1" style="margin-top: 20px; margin-top: 55px">
					<span style="font-size: 50px; color: #176897; margin-left: -110px; font-weight: bold;">'.floor($model->eva_cache_porcentaje).'%</span>
				</div>
				<div class="col-md-1">
				<h1>
				</h1></div>
				<div class="col-md-4" style="margin-top: 20px;">
					<img src="img/barra-N2.png" style="width: 120%;">
				</div>
				<div class="col-md-1" style="margin-top: 20px; margin-top: 55px">
					<span style="font-size: 50px; color: #176897; margin-left: -90px; font-weight: bold;">'.$nota.'</span>
				</div>
			</div>
		</div>';



		//print_r($rows);
		?>
	</div>
</div>
