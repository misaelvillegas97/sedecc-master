<?php
/* @var $this VariableEvaluacionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Variable Evaluacions',
);
?>


<span style='float:right;'>
<?php echo CHtml::link('<i class="i i-plus2"></i>',array('create'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-list2"></i>',array('admin'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
</span>
<h1>Variable Evaluacion</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
