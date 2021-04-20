<?php
/* @var $this EvaluacionController */
/* @var $model Evaluacion */

$this->breadcrumbs=array(
	'Evaluacions'=>array('index'),
	'Nuevo',
);
?>


<span style='float:right;'>
<?php echo CHtml::link('<i class="i i-list"></i>',array('index'),array('title'=>'Volver al listado','class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<!--?php echo CHtml::link('<i class="i i-list2"></i>',array('admin'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?-->
</span>
<h1>Nueva evaluación</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>