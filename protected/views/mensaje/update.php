<?php
/* @var $this MensajeController */
/* @var $model Mensaje */

$this->breadcrumbs=array(
	'Mensajes'=>array('index'),
	$model->men_id=>array('view','id'=>$model->men_id),
	'Update',
);
?>


<span style='float:right;'>
<?php echo CHtml::link('<i class="i i-list"></i>',array('index'),array('title'=>'Volver al listado','class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-plus2"></i>',array('create'),array('title'=>'Nuevo','class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-eye"></i>',array('view','id'=>$model->men_id),array('title'=>'Visualizar','class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-cross2"></i>',array('trash','id'=>$model->men_id),array('title'=>'Eliminar','class'=>'btn btn-rounded btn-sm btn-icon btn-default','onclick'=>'return confirm(\'¿Realmente desea eliminar?\');'));?>
</span> 
<h1>Modificar Mensaje <?php echo $model->men_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>