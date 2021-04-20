<?php
/* @var $this FacturaController */
/* @var $model Factura */

$this->breadcrumbs=array(
	'Facturas'=>array('index'),
	$model->id_rango,
);
?>


<span style='float:right;'>
<?php echo CHtml::link('<i class="i i-list"></i>',array('index'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-plus2"></i>',array('create'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-pencil2"></i>',array('update','id'=>$model->id_rango),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-cross2"></i>',array('trash','id'=>$model->id_rango),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default','onclick'=>'return confirm(\'¿Realmente desea eliminar?\');'));?>
<?php echo CHtml::link('<i class="i i-list2"></i>',array('admin'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
</span> 
<h1>Detalle Factura #<?php echo $model->id_rango; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_rango',
		'rango_trabajador',
		'fijo_uf',
		'variableuf_tra',
		'checklist',
	),
)); ?>
