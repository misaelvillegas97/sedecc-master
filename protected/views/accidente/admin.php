<?php
/* @var $this AccidenteController */
/* @var $model Accidente */

$this->breadcrumbs=array(
	'Accidentes'=>array('index'),
	'Administrar',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#accidente-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<span style='float:right;'>
<?php echo CHtml::link('<img src="img/agregar.png" width="40px;">',array('create'),array('title'=>'Nuevo')); ?>
<?php echo CHtml::link('<img src="img/list.png" width="40px;">',array('index'),array('title'=>'Volver al listado')); ?>
<?php echo CHtml::link('<img src="img/busqueda.png" width="40px;">','#',array('title'=>'Buscar','class'=>'search-button')); ?>
</span> 
<h1>Administrar Accidentes</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'accidente-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		// 'id_accidente',
		array(
					'name'=>'eess_rut',
					'header'=>'Empresa',
					'type'=>'raw',
					'value'=>function($data){
						$eess = Yii::app()->db->createCommand("SELECT eess_nombre_corto FROM min_eess where eess_rut='".$data->eess_rut."' ")->queryScalar();	
						if($eess == '') return '<i>(sin rut ee.ss registrado)</i>'; else return strtoupper($eess);
					},
				),
		array(
			'name'=>'rut_trabajador',
			'header'=>'Trabajador',
			'type'=>'raw',
			'value'=>function($data){
				return Yii::app()->db->createCommand("SELECT CONCAT(tra_nombres,' ',tra_apellidos) FROM min_trabajador WHERE tra_rut = '".$data->rut_trabajador."'")->queryScalar();
			},
		),
		/*array(
					'name'=>'tra_cargo',
					'header'=>'Cargo',
					'type'=>'raw',
					'value'=>function($data){
						$cargo = Yii::app()->db->createCommand("SELECT car_descripcion as id FROM min_cargo where car_id=".$data->tra_cargo." ")->queryScalar();	
						if($cargo == '') return '<i>(sin cargo registrado)</i>'; else return strtoupper($cargo);
					},
				)*/'tra_cargo',
		'tra_depto',
		'acc_tipo_accidnte',
		
		'fecha_accidente',
		/*'fecha_alta',
		'Descripcion',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
