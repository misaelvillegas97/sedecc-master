<?php
/* @var $this TematicaController */
/* @var $model Tematica */

$this->breadcrumbs=array(
	'Tematicas'=>array('index'),
	$model->tem_id,
);
?>


<span style='float:right;'>
<?php echo CHtml::link('<img src="img/list.png" width="40px;">',array('index'),array('title'=>'Volver al listado')); ?>
<?php echo CHtml::link('<img src="img/agregar.png" width="40px;">',array('create'),array('title'=>'Nuevo')); ?>

<?php echo CHtml::link('<img src="img/edit.png" width="40px;">',array('update','id'=>$model->tem_id),array('title'=>'Modificar')); ?>
<?php echo CHtml::link('<img src="img/borrar.png" width="40px;">',array('trash','id'=>$model->tem_id),array('title'=>'Eliminar','onclick'=>'return confirm(\'¿Realmente desea eliminar?\');'));?>
<!--?php echo CHtml::link('<i class="i i-list2"></i>',array('admin'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?-->
</span> 
<h1>Detalle temática <!--?php echo $model->tem_id; ?--></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'tem_id',
		'tem_creado',
		array(
			'name'=>'eess_rut',
			'type'=>'raw',
			'value'=>function($data){
				return Yii::app()->db->createCommand("SELECT eess_nombre_corto FROM min_eess WHERE eess_rut = '".$data->eess_rut."'")->queryScalar();
			},
		),
		'tem_descripcion',
	),
)); ?>
