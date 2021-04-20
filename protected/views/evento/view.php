<?php
/* @var $this EventoController */
/* @var $model Evento */

$this->breadcrumbs=array(
	'Eventos'=>array('index'),
	$model->eve_id,
);
?>

<style type="text/css">
	.detail-view th{ width:200px !important;}
</style>
<span style='float:right;'>
<?php echo CHtml::link('<img src="img/list.png" width="40px;">',array('index'),array('title'=>'Volver al listado')); ?>
<?php if(Yii::app()->controller->usertype() != 3) echo CHtml::link('<img src="img/agregar.png" width="40px;">',array('create'),array('title'=>'Nuevo')); ?>
<?php echo CHtml::link('<img src="img/edit.png" width="40px;">',array('update','id'=>$model->tra_id),array('title'=>'Modificar')); ?>
<?php if(Yii::app()->controller->usertype() != 3) echo CHtml::link('<img src="img/borrar.png" width="40px;">',array('trash','id'=>$model->tra_id),array('title'=>'Eliminar','onclick'=>'return confirm(\'¿Realmente desea eliminar?\');'));?>
<!--?php echo CHtml::link('<i class="i i-list2"></i>',array('admin'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?-->
</span> 
<h1>Detalle accidente/incidente</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'eve_id',
		'eve_tiempo',
		'tra_rut',
		'eess_rut',
		'eve_tipo',
		'eve_descripcion',
	),
)); ?>
