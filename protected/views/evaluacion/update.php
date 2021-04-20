<?php
/* @var $this EvaluacionController */
/* @var $model Evaluacion */

$this->breadcrumbs=array(
	'Evaluacions'=>array('index'),
	$model->eva_id=>array('view','id'=>$model->eva_id),
	'Update',
);
?>


<span style='float:right;'>
<?php echo CHtml::link('<img src="img/list.png" width="40px;">',array('index'),array('title'=>'Volver al listado')); ?>
<!--?php echo CHtml::link('<i class="i i-plus2"></i>',array('create'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?-->
<?php echo CHtml::link('<img src="img/eyes.png" width="40px;">',array('view','id'=>$model->eva_id),array('title'=>'Visualizar')); ?>
<!--?php echo CHtml::link('<i class="i i-cross2"></i>',array('trash','id'=>$model->eva_id),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default','onclick'=>'return confirm(\'¿Realmente desea eliminar?\');'));?-->
<!--?php echo CHtml::link('<i class="i i-list2"></i>',array('admin'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?-->
</span> 
<h1>Modificar Evaluación <!--?php echo $model->eva_id; ?--></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>