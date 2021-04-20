<?php
/* @var $this VariableEvaluacionController */
/* @var $model VariableEvaluacion */

$this->breadcrumbs=array(
	'Variable Evaluacions'=>array('index'),
	'Nuevo',
);
?>


<span style='float:right;'>
<?php echo CHtml::link('<i class="i i-list"></i>',array('index'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
</span>
<h1>Nuevo VariableEvaluacion</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>