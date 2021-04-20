<?php
/* @var $this FormulariobitacoraController */
/* @var $model Formulariobitacora */

$this->breadcrumbs=array(
	'Formulariobitacoras'=>array('index'),
	$model->id,
);
?>


<span style='float:right;'>
<?php echo CHtml::link('<i class="i i-list"></i>',array('index'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-plus2"></i>',array('create'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-pencil2"></i>',array('update','id'=>$model->id),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-cross2"></i>',array('trash','id'=>$model->id),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default','onclick'=>'return confirm(\'¿Realmente desea eliminar?\');'));?>
<?php echo CHtml::link('<i class="i i-list2"></i>',array('admin'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
</span> 
<h1>Detalle Formulario para Bitácora <!--?php echo $model->id; ?--></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'bit_tiempo',
		'eess_rut',
		'bit_nombre',
		'bit_n_campos',
		'bit_campos',
		'bit_nombre_campos',
		'bit_campos_values',
		'bit_campos_requeridos',
	),
)); ?>
