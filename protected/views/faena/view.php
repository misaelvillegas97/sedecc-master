<?php 

if(!isset(Yii::app()->user->id)){
  header('Location: index.php?r=site/login');
}
?>
<?php
/* @var $this FaenaController */
/* @var $model Faena */

$this->breadcrumbs=array(
	'Faenas'=>array('index'),
	$model->fae_id,
);
?>


<span style='float:right;'>

<?php echo CHtml::link('<img src="img/list.png" width="40px;">',array('index'),array('title'=>'Volver al listado')); ?>
<?php echo CHtml::link('<img src="img/agregar.png" width="40px;">',array('create'),array('title'=>'Nuevo')); ?>

<?php echo CHtml::link('<img src="img/edit.png" width="40px;">',array('update','id'=>$model->fae_id),array('title'=>'Modificar')); ?>
<?php echo CHtml::link('<img src="img/borrar.png" width="40px;">',array('trash','id'=>$model->fae_id),array('title'=>'Eliminar','onclick'=>'return confirm(\'¿Realmente desea eliminar?\');'));?>
<!--?php echo CHtml::link('<i class="i i-list2"></i>',array('admin'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?-->
</span> 
<h1>Detalle faena</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'fae_id',
		'fae_creado',
		'fae_nombre',
		//'eess_rut',
		//'fae_activo',
		array(
			'name'=>'fae_activo',
			'type'=>'raw',
			'value'=>function($data){
				if($data->fae_activo == 1) return 'Activo'; else return 'Inactivo';
			}
		),
		'tipo',
	),
)); ?>
