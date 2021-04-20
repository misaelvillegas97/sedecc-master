<?php
/* @var $this EventoController */
/* @var $model Evento */

$this->breadcrumbs=array(
	'Eventos'=>array('index'),
	$model->eve_id=>array('view','id'=>$model->eve_id),
	'Update',
);
?>


<span style='float:right;'>
<?php echo CHtml::link('<img src="img/list.png" width="40px;">',array('index'),array('title'=>'Volver al listado')); ?>
<?php if(Yii::app()->controller->usertype() != 3) echo CHtml::link('<img src="img/agregar.png" width="40px;">',array('create'),array('title'=>'Nuevo')); ?>

<?php echo CHtml::link('<img src="img/eyes.png" width="40px;">',array('view','id'=>$model->tra_id),array('title'=>'Visualizar')); ?>
<?php if(Yii::app()->controller->usertype() != 3) echo CHtml::link('<img src="img/borrar.png" width="40px;">',array('trash','id'=>$model->tra_id),array('title'=>'Eliminar','onclick'=>'return confirm(\'¿Realmente desea eliminar?\');'));?>
<!--?php echo CHtml::link('<i class="i i-list2"></i>',array('admin'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?-->
</span> 
<h1>Modificar accidente/incidente</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>