<?php
/* @var $this EessController */
/* @var $model Eess */

$this->breadcrumbs=array(
	'Eesses'=>array('index'),
	'Nuevo',
);
?>


<span style='float:right;'>
<?php echo CHtml::link('<img src="img/list.png" width="40px;">',array('index'),array('title'=>'Volver al listado')); ?>
<!--?php echo CHtml::link('<i class="i i-list2"></i>',array('admin'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?-->
</span>
<h1>Nueva empresa de servicio</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>