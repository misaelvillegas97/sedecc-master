<?php
/* @var $this ExcesosVelocidadController */
/* @var $model ExcesosVelocidad */

$this->breadcrumbs=array(
	'Excesos Velocidads'=>array('index'),
	$model->exc_id,
);
?>


<span style='float:right;'>
<?php echo CHtml::link('<i class="i i-list"></i>',array('index'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-plus2"></i>',array('create'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-pencil2"></i>',array('update','id'=>$model->exc_id),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-cross2"></i>',array('trash','id'=>$model->exc_id),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default','onclick'=>'return confirm(\'¿Realmente desea eliminar?\');'));?>
<?php echo CHtml::link('<i class="i i-list2"></i>',array('admin'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
</span> 
<h1>Detalle ExcesosVelocidad #<?php echo $model->exc_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'exc_id',
		'tra_rut',
		'exc_fecha',
		'exc_zona',
		'veh_patente',
		'exc_velocidad',
		'exc_limite',
		'veh_codigoCamion',
		'exc_turno',
	),
)); ?>
