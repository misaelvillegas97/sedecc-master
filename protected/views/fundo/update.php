<?php
/* @var $this FundoController */
/* @var $model Fundo */

$this->breadcrumbs=array(
	'Fundos'=>array('index'),
	$model->fun_id=>array('view','id'=>$model->fun_id),
	'Update',
);
?>


<span style='float:right;'>

<?php echo CHtml::link('<img src="img/list.png" width="40px;">',array('index'),array('title'=>'Volver al listado')); ?>
<?php echo CHtml::link('<img src="img/agregar.png" width="40px;">',array('create'),array('title'=>'Nuevo')); ?>

<?php echo CHtml::link('<img src="img/eyes.png" width="40px;">',array('view','id'=>$model->fun_cod),array('title'=>'Visualizar')); ?>
<?php echo CHtml::link('<img src="img/borrar.png" width="40px;">',array('trash','id'=>$model->fun_cod),array('title'=>'Eliminar','onclick'=>'return confirm(\'¿Realmente desea eliminar?\');'));?>
<!--?php echo CHtml::link('<i class="i i-list2"></i>',array('admin'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?-->
</span> 
<h1>Modificar fundo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>