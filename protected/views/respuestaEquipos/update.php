<?php
/* @var $this RespuestaEquiposController */
/* @var $model RespuestaEquipos */

$this->breadcrumbs=array(
	'Respuesta Equiposes'=>array('index'),
	$model->res_id=>array('view','id'=>$model->res_id),
	'Update',
);
?>


<span style='float:right;'>
<?php echo CHtml::link('<i class="i i-list"></i>',array('index'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-plus2"></i>',array('create'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-eye"></i>',array('view','id'=>$model->res_id),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-cross2"></i>',array('trash','id'=>$model->res_id),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default','onclick'=>'return confirm(\'¿Realmente desea eliminar?\');'));?>
<?php echo CHtml::link('<i class="i i-list2"></i>',array('admin'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
</span> 
<h1>Modificar RespuestaEquipos <?php echo $model->res_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>