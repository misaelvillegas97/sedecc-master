<?php
/* @var $this FormulariosController */
/* @var $model Formularios */

$this->breadcrumbs=array(
	'Formularioses'=>array('index'),
	$model->correlativo_chk_eess=>array('view','id'=>$model->correlativo_chk_eess),
	'Update',
);
?>


<span style='float:right;'>
<?php echo CHtml::link('<i class="i i-list"></i>',array('index'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-plus2"></i>',array('create'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-eye"></i>',array('view','id'=>$model->correlativo_chk_eess),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-cross2"></i>',array('trash','id'=>$model->correlativo_chk_eess),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default','onclick'=>'return confirm(\'¿Realmente desea eliminar?\');'));?>
<?php echo CHtml::link('<i class="i i-list2"></i>',array('admin'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
</span> 
<h1>Modificar Formulario para Checklist <!--?php echo $model->correlativo_chk_eess; ?--></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>