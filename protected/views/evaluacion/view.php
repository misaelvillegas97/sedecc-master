<?php 

if(!isset(Yii::app()->user->id)){
	//$_SESSION['pag'] = "paginaprohibida.php";
	echo '<script>window.location ="http://innoapsion.cl/sedecc/index.php?r=site/login&returnurl=index.php?r=evaluacion/view&id='.$model->eva_id.'"</script>';
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
if($es_evaluador != 1 || Yii::app()->user->id == 'admin') echo CHtml::link('<img src="img/edit.png" width="40px;">',array('update','id'=>$model->eva_id),array('title'=>'Modificar'));
?>
<!--?php echo CHtml::link('<i class="i i-cross2"></i>',array('trash','id'=>$model->eva_id),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default','onclick'=>'return confirm(\'¿Realmente desea eliminar?\');'));?-->
<!--?php echo CHtml::link('<i class="i i-list2"></i>',array('admin'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?-->

<?php 
$pdf_safco = Yii::app()->db->createCommand("SELECT eess_rut FROM min_evaluacion WHERE eva_id = '".$model->eva_id."'")->queryScalar();


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
				'eva_evaluador',
				'eva_tipo',
				array(
					'name'=>'eess_rut',
					'type'=>'raw',
					'value'=>function($data){
						return Yii::app()->db->createCommand("SELECT eess_nombre_corto FROM min_eess WHERE eess_rut = '".$data->eess_rut."'")->queryScalar();
					},
				),
				'tra_rut',
				'eva_apellidos',
				'eva_nombres',
				array(
					'name'=>'tra_rut',
					'label'=>'CARGO',
					'type'=>'raw',
					'value'=>function($data){
						$carid = Yii::app()->db->createCommand("SELECT car_id FROM min_trabajador WHERE tra_rut = '".$data->tra_rut."'")->queryScalar();
						$cargo = Yii::app()->db->createCommand("SELECT car_descripcion FROM min_cargo WHERE car_id = '".$carid."'")->queryScalar();
						if($cargo == '') return '<i>(sin cargo registrado)</i>'; else return strtoupper($cargo);
					},
				),
				'eva_fecha_evaluacion',
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
				'eva_comuna',
				'eva_fundo',
				'eva_faena',
				'eva_jefe_faena',
				'eva_supervisor',
				'eva_linea',
				'eva_vencimiento_corma',
				'eva_tipo_cosecha',
				/*
				'eva_general_observacion',
				'eva_general_foto',
				'eva_general_fecha',
				'eva_cache_porcentaje',*/
			);
		}
		else{
			$array = array(
				'eva_comuna',
				'eva_fundo',
				'eva_faena',
				'eva_jefe_faena',
				'eva_supervisor',
				'eva_geo_x',
				'eva_geo_y',
				'eva_linea',
				'eva_vencimiento_corma',
				'eva_tipo_cosecha',
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
		else echo '<iframe frameborder="0" style="width:100%; height:261px;" src="https://static.parastorage.com/services/santa/1.1433.24/static/external/googleMap.html?addressInfo='.$model->eva_nombres.' '.$model->eva_apellidos.'%0A&language=es&lat='.$model->eva_geo_x.'&long='.$model->eva_geo_y.'&mapInteractive=true&mapType=ROADMAP&showMapType=true&showPosition=true&showStreetView=true&showZoom=true&ts=640&zoom=12"></iframe>';
		?>
	</div>
	<div class="col-sm-12">
		<?php
		$sql = "SELECT res_respuesta,tem_id,res_foto,res_enunciado,res_seguimiento,res_observacion,res_id,res_plazo FROM min_respuesta WHERE eva_id = '".$model->eva_id."' ORDER BY pre_id";
		$rows = Yii::app()->db->createCommand($sql)->queryAll();
		
		$arrcat = array();
		echo '
		<table class="table nw" style="margin-top:15px; border-collapse: none !important; background:#ffffff;">
		<thead style="margin-buttom: 0px;"><th>#</th><th>ÍTEM</th><th>RESPUESTA</th><th class="text-center">SEGUIMIENTO</th><th>OBSERVACIÓN</th><th style="text-align:right;">IMAGEN</th></thead>
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
				echo '<tr class="alert alert-success"><td colspan="30" style="color: white; background-color: #ffb210; margin-top: 0px;"><small><b>'.$rows[$i]['tem_id'].'</b></small></td></tr>';
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
				$rows[$i]['res_enunciado'] = '<a href="index.php?r=respuesta/view&id='.$rows[$i]['res_id'].'"><b>'.$rows[$i]['res_enunciado'].'</b></a>';
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
		echo '<tr class="alert alert-success" style="margin-top: 20px"><td colspan="30"><small><b>Observaciones generales</b></small></td></tr>';
		echo '<tr><td colspan="4">'.$model->eva_general_observacion.'</td><td style="width:100px; text-align:right;">'.$img.'</td></tr>';
		// mensaje para mostrar visualizador si la respuesta negativa es critica
		
		//$ver= Yii::app()->db->createCommand("SELECT res_enunciado FROM min_respuesta WHERE eva_id = '".$model->eva_id."' ORDER BY pre_id")->query()->readAll();
		$ver = $rows;
		$eval_id = $model->eva_id;
		$alerta1 = '';
		$alerta2 = '';
		$tienecritico ='no';
		
		$critico = Yii::app()->db->createCommand("SELECT 1 from min_respuesta r where r.res_critico='si' AND res_respuesta='no' AND r.eva_id = '".$eval_id."' ")->queryScalar();
		if($critico>0){
			$alerta1 = '¡Precaución!: Trabajador ha incumplido una pregunta considerada crítica.';
			$alerta2 = ' Se recomienda Identificar las desviaciones, implementar las medidas correctivas y un realizar un seguimiento sistemático.';
			$tienecritico ='si';
		}
			
		/*for($s=0;$s<count($ver);$s++){

			$enun = $ver[$s]['res_enunciado'];
			
			
			
			for($d=0;$d<count($critico);$d++){
				if($critico[$d]['critico'] == 'si'&&$critico[$d]['res_respuesta']=='no'){
					$alerta1 = '¡Precaución!: Trabajador ha incumplido una pregunta considerada crítica.';
					$alerta2 = ' Se recomienda Identificar las desviaciones, implementar las medidas correctivas y un realizar un seguimiento sistemático.';
					$tienecritico ='si';
					
				}else{
					$alerta1 = '';
					$alerta2 = '';
					$tienecritico = 'no';
				}
			}
		}*/
		
			
		$verpromedio = Yii::app()->db->createCommand("SELECT eva_cache_porcentaje From min_evaluacion WHERE eva_id=".$eval_id)->queryScalar();
		$limit1 = Yii::app()->params['riesgoalto'];
		

		for($t=0;$t<count($verpromedio);$t++){
			$notapromedio = number_format(floor($verpromedio));
			if($notapromedio>$limit1 and $tienecritico=='si'){
				$alerta1 = '¡Precaución!: Trabajador ha incumplido una pregunta considerada crítica.'; 
				$alerta2 = ' Se recomienda Identificar las desviaciones, implementar las medidas correctivas y un realizar un seguimiento sistemático.';

			}elseif($notapromedio<=$limit1 or $tienecritico=='si'){
				$alerta1 = ' ¡ALERTA! Trabajador en Nivel de Riesgo ALTO';
				$alerta2 = ' Se recomienda detener los trabajos y reinstruir al trabajador.';
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
		/*for($t=0,$y=1;$t<count($rows);$t++,$y++){
			
			}*/
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
				<div class="col-md-4" style="margin-top: 20px;"">
                    <img src="img/barra-N1.png" style="width: 120%; ">
                    <span style="position: absolute;font-size: 50px;color: #176897;font-weight: bold;margin-left: 70%;margin-top: -23%;">'.floor($model->eva_cache_porcentaje).'%</span>
				</div>
				<div class="col-md-1">
				<h1> 
				</h1></div>
				<div class="col-md-4" style="margin-top: 20px;"">
                    <img src="img/barra-N2.png" style="width: 120%; ">
                    <span style="position: absolute;font-size: 50px;color: #176897;font-weight: bold;margin-left: 70%;margin-top: -23%;">'.$nota.'</span>
				</div>
			</div>
		</div>';
		
		
		
		//print_r($rows);
		?>
	</div>
</div>









