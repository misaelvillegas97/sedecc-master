<?php
/* @var $this EquiposController */
/* @var $model Equipos */

$this->breadcrumbs=array(
	'Equiposes'=>array('index'),
	'Nuevo',
);
?>


<span style='float:right;'>
<?php echo CHtml::link('<i class="i i-list"></i>',array('index'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-list2"></i>',array('admin'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
</span>
<h1>Nuevo Equipos</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>