<?php 

if(!isset(Yii::app()->user->id)){
  header('Location: index.php?r=site/login');
}
?>
<?php
/* @var $this EvaluacionController */
/* @var $model Evaluacion */

$this->breadcrumbs=array(
	'Evaluacions'=>array('index'),
	'Administrar',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#evaluacion-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
$('#ulEval').show();
$('.liEval').addClass('active');
");

$contador = 0;
// cuando el usuario ingresado es empresa
if (Yii::app()->controller->usertype() == 1) {
    # code...
    $contador  = Yii::app()->db->createCommand("SELECT COUNT(*) FROM min_evaluacion WHERE eess_rut = ".Yii::app()->user->id)->queryScalar();
}

// Cuando el usuario ingresado es un evaluador
if (Yii::app()->controller->usertype() == 3) {
    # code...
    $contador  = Yii::app()->db->createCommand("SELECT COUNT(*) FROM min_evaluacion WHERE eess_rut = (SELECT eess_rut FROM min_trabajador WHERE tra_rut = ".Yii::app()->user->id.") and eva_evaluador = ".Yii::app()->user->id)->queryScalar();
}

// Cuando el usuario ingresado es admin
if (Yii::app()->controller->usertype() == 2) {
    # code...
    $contador  = Yii::app()->db->createCommand("SELECT COUNT(*) as trab FROM min_evaluacion as E JOIN min_eess as EE ON(E.eess_rut = EE.eess_rut) WHERE EE.eess_estado = 1")->queryScalar();
}
?>

<div style="height:25px"></div>
<span style='float:right;'>
<!--?php echo CHtml::link('<i class="i i-plus2"></i>',array('create'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?-->
<!--?php echo CHtml::link('<i class="i i-list2"></i>',array('index'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?-->
<?php echo CHtml::link('<img src="img/busqueda.png" width="40px;">','#',array('title'=>'Buscar','class'=>'search-button')); ?>

<?php echo CHtml::link('<img src="img/descarga.png" width="40px;">',array('excel'),array('title'=>'Exportar XLS')); ?>
</span> 
<span class="h1" style="margin-top: 20px;">Evaluaciones de trabajadores</span> <span class="text-muted">(<?php echo $contador; ?> en total)</span>
<style>
	.items{
		font-size:9pt;
	}
</style>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php
$modificar_visible = 'false';
$eliminar_visible = 'false';
/*
$es_evaluador = Yii::app()->db->createCommand("SELECT tra_evaluador FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
if($es_evaluador == 1 || Yii::app()->user->id == 'admin') 
*/

if(Yii::app()->controller->usertype() == 1){
	$modificar_visible = 'true';
	$eliminar_visible = 'true';
}
if(Yii::app()->controller->usertype() == 2){
	$modificar_visible = 'true';
	$eliminar_visible = 'true';
}
if(Yii::app()->controller->usertype() == 3){
	$modificar_visible = 'false';
}

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'evaluacion-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'eva_id',
		array(
			'name'=>'eva_id',
			'type'=>'raw',
			'value'=>function($data){
				return Yii::app()->controller->identificador($data->eva_evaluador,$data->eva_fecha_evaluacion,$data->eva_evaluador_correlativo);
			},
		),
		array(
			'name'=>'eva_id',
			'header'=>'Evaluador',
			'type'=>'raw',
			'value'=>function($data){
				return Yii::app()->db->createCommand("SELECT UPPER(CONCAT(tra_nombres,' ',tra_apellidos)) FROM min_trabajador WHERE tra_rut = '".$data->eva_evaluador."'")->queryScalar();
			},
		),
		'eva_fecha_evaluacion',
		// 'eva_tipo',
		array(
			'name'=>'eva_tipo',
			'type'=>'raw',
			'value'=>function($data){
				return strtoupper($data['eva_tipo']);
			},
		),
		array(
			'name'=>'eess_rut',
			'type'=>'raw',
			'value'=>function($data){
				return Yii::app()->db->createCommand("SELECT UPPER(eess_nombre_corto) FROM min_eess WHERE eess_rut = '".$data->eess_rut."'")->queryScalar();
			},
		),
		'tra_rut',
		'eva_apellidos',
		'eva_nombres',
		array(
			'name'=>'eva_cache_porcentaje',
			'type'=>'raw',
			'value'=>function($data){
				// Calcular nota
				$limit1 = Yii::app()->params['riesgoalto'];
          		$limit2 = Yii::app()->params['riesgomedio'];

          		$MalNotaBaja = Yii::app()->params['MalNotaBaja'];
          		$RalLimBajo = Yii::app()->params['RalLimBajo'];

          		$MalNotaMedia = Yii::app()->params['MalNotaMedia'];
          		$RalLimMedio = Yii::app()->params['RalLimMedio'];

          		$MalNotaAlta = Yii::app()->params['MalNotaAlta'];
				$RalLimAlto = Yii::app()->params['RalLimAlto'];
   		
				$nota = '';
				if($data->eva_cache_porcentaje>=0 && $data->eva_cache_porcentaje<=$limit1) $nota = (($MalNotaBaja*$data->eva_cache_porcentaje)+$RalLimBajo);
				if($data->eva_cache_porcentaje>$limit1 && $data->eva_cache_porcentaje<=$limit2) $nota = (($MalNotaMedia*$data->eva_cache_porcentaje)-$RalLimMedio);
				if($data->eva_cache_porcentaje>$limit2 && $data->eva_cache_porcentaje<=100) $nota = (($MalNotaAlta*$data->eva_cache_porcentaje)-$RalLimAlto);
				$nota = number_format(floor($nota*10)/10,1,",",".");
				
				// Mostrar porcentaje y nota
				return '<div style="text-align:right;"><b>'.floor($data->eva_cache_porcentaje).' % - '.$nota.'</b></div>';
			},
		),
		
		/*
		'eva_fecha_evaluacion',
		'eva_fundo',
		'eva_comuna',
		'eva_jefe_faena',
		'eva_geo_x',
		'eva_geo_y',
		'eva_linea',
		'eva_vencimiento_corma',
		'eva_tipo_cosecha',
		array(
			'class'=>'CButtonColumn',
		),
		 */
		array(
			'name'=>'eva_semaforo',
			'header'=>'Seguimiento',
			'type'=>'raw',
			'value'=>function($data){
				// Verificar si existe cache de semáforo
				/*
				$s = Yii::app()->db->createCommand("SELECT eva_semaforo FROM min_evaluacion WHERE eva_id = '".$data->eva_id."'")->queryScalar();
				if(strlen($s)>0){
					if($s == '0') $semaforo = '<img src="images/semaforo_rojo.png" style="width:50px;">';
					if($s == '1') $semaforo = '<img src="images/semaforo_amarillo.png" style="width:50px;">';
					if($s == '2') $semaforo = '<img src="images/semaforo_verde.png" style="width:50px;">';
					return '<center>'.$semaforo.'</center>';
				}*/
				// Obtener respuestas no de esta evaluacion si no se ha calculado
				$nos = Yii::app()->db->createCommand("SELECT COUNT(res_id) FROM min_respuesta WHERE eva_id = '".$data->eva_id."' AND res_respuesta = 'no' AND res_seguimiento = 0")->queryScalar();
				$ven = Yii::app()->db->createCommand("SELECT COUNT(res_id) FROM min_respuesta WHERE eva_id = '".$data->eva_id."' AND res_plazo < NOW() AND res_seguimiento = 0")->queryScalar();
				$s='';
				if($nos > 0){
					if($ven > 0){
						$semaforo = '<img src="images/semaforo_rojo.png" style="width:50px;">';
						$s='0';
					}
					else{
						$semaforo = '<img src="images/semaforo_amarillo.png" style="width:50px;">';
						$s='1';
					}
				}
				else{
					$semaforo = '<img src="images/semaforo_verde.png" style="width:50px;">';
					$s='2';
				}
				// Actualizar caché de semáforo
				//Yii::app()->db->createCommand("UPDATE min_evaluacion SET eva_semaforo = '".$s."' WHERE eva_id = '".$data->eva_id."'")->execute();
				// Retornar
				return '<center>'.$semaforo.'</center>';
			},
		),
		array(
			'class'=>'CButtonColumn',
			'buttons'=>array(
				'view' => array(
    				'options'=>array('title'=>'Ver'),
				),
				'update' => array(
					'visible'=>$modificar_visible,
    				'options'=>array('title'=>'Modificar'),
				),
				'trash' => array(
					'visible'=>$eliminar_visible
				),
			)
		)
	)
)); ?>