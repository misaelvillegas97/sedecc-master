<?php
/* @var $this ExcesosVelocidadController */
/* @var $model ExcesosVelocidad */

$this->breadcrumbs=array(
	'Excesos Velocidads'=>array('index'),
	'Administrar',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#excesos-velocidad-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<span style='float:right;'>
<!--	<a class="btn btn-rounded btn-sm btn-icon btn-default" href="index.php?r=site/page&view=uploadExcesosVelocidad"><i class="i i-plus2"></i></a>
<?php //echo CHtml::link('<i class="i i-plus2"></i>',array('create'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-list2"></i>',array('index'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-search"></i>','#',array('class'=>'search-button btn btn-rounded btn-sm btn-icon btn-default')); ?>-->
<?php echo CHtml::link('<img src="img/agregar.png" width="40px;">',array('create'),array('title'=>'Nuevo')); ?>
<?php echo CHtml::link('<img src="img/list.png" width="40px;">',array('index'),array('title'=>'Volver al listado')); ?>
<?php echo CHtml::link('<img src="img/busqueda.png" width="40px;">','#',array('title'=>'Buscar','class'=>'search-button')); ?>
</span> 
<h1>Excesos de Velocidad</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'excesos-velocidad-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		/*'exc_id',*/
		/*'tra_rut'*/
		array(
			'name'=>'tra_rut',
			'header'=>'Trabajador',
			'type'=>'raw',
			'value'=>function($data){
				$nombre =  Yii::app()->db->createCommand("SELECT CONCAT(tra_nombres,' ',tra_apellidos) FROM min_trabajador WHERE tra_rut = '".$data->tra_rut."'")->queryScalar();
				
				return ( empty($nombre) ) ? 'NO REGISTRADO' : $nombre ;
			},
		),
		'exc_fecha',
		'exc_zona',
		'veh_patente',
		'exc_velocidad',
		'exc_limite',
		'var_nombre',
		/*'veh_codigoCamion',
		'exc_turno',*/
		array(
			'class'=>'CButtonColumn',

			'template'=>'{update}{view}{trash}',

			'buttons'=>array(

					'update'=>array(

							'visible'=>'false',

						),

					'view'=>array(

							'visible'=>'true',

						),

					'trash'=>array(

							'visible'=>'true',

						),

			),
		),
	),
)); ?>

