<?php
/* @var $this ExcesosVelocidadController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Excesos Velocidads',
);
?>


<span style='float:right;'>
<?php echo CHtml::link('<i class="i i-plus2"></i>',array('create'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-list2"></i>',array('admin'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
</span>
<h1>Excesos Velocidads</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>