<?php
if(Yii::app()->controller->usertype() != 2) if(Yii::app()->user->id != $model->eess_rut) return; 

/* @var $this EessController */
/* @var $model Eess */

$this->breadcrumbs=array(
	'Eesses'=>array('index'),
	$model->eess_rut=>array('view','id'=>$model->eess_rut),
	'Update',
);
?>


<span style='float:right;'>
<?php if(Yii::app()->controller->usertype() == 2) echo CHtml::link('<img src="img/list.png" width="40px;">',array('index'),array('title'=>'Volver al listado')); ?>
<?php if(Yii::app()->controller->usertype() == 2) echo CHtml::link('<img src="img/agregar.png" width="40px;">',array('create'),array('title'=>'Nuevo')); ?>
<?php echo CHtml::link('<img src="img/eyes.png" width="40px;">',array('view','id'=>$model->eess_rut),array('title'=>'Visualizar')); ?>
<?php if(Yii::app()->controller->usertype() == 2) echo CHtml::link('<img src="img/borrar.png" width="40px;">',array('trash','id'=>$model->eess_rut),array('title'=>'Eliminar','onclick'=>'return confirm(\'¿Realmente desea eliminar?\');'));?>
<!--?php echo CHtml::link('<i class="i i-list2"></i>',array('admin'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?-->
</span>
<?php
if(Yii::app()->controller->usertype() == 1) echo '<h1>Modificar perfil de empresa</h1>';
else echo '<h1>Modificar empresa de servicio</h1>';
?>



<?php $this->renderPartial('_form', array('model'=>$model)); ?>

