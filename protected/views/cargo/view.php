<?php 

if(!isset(Yii::app()->user->id)){
  header('Location: index.php?r=site/login');
}
?>
<?php
/* @var $this CargoController */
/* @var $model Cargo */

$this->breadcrumbs=array(
	'Cargos'=>array('index'),
	$model->car_id,
);
?>


<span style='float:right;'>
<?php echo CHtml::link('<img src="img/list.png" width="40px;">',array('index'),array('title'=>'Volver al listado')); ?>
<?php echo CHtml::link('<img src="img/agregar.png" width="40px;">',array('create'),array('title'=>'Nuevo')); ?>
<?php echo CHtml::link('<img src="img/edit.png" width="40px;">',array('update','id'=>$model->car_id),array('title'=>'Modificar')); ?>
<?php echo CHtml::link('<img src="img/borrar.png" width="40px;">',array('trash','id'=>$model->car_id),array('title'=>'Eliminar','onclick'=>'return confirm(\'¿Realmente desea eliminar?\');'));?>
<!--?php echo CHtml::link('<i class="i i-list2"></i>',array('admin'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?-->
</span> 
<h1>Detalle cargo <!--?php echo $model->car_id; ?--></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'car_id',
		'car_creado',
		/*
		array(
			'name'=>'eess_rut',
			'type'=>'raw',
			'value'=>function($data){
				return Yii::app()->db->createCommand("SELECT eess_nombre_corto FROM min_eess WHERE eess_rut = '".$data->eess_rut."'")->queryScalar();
			},
		),*/
        // 'car_descripcion',
        array(
            'name'=>'car_descripcion',
			'type'=>'raw',
			'value'=>function($data){
                return strtoupper($data->car_descripcion);
			},
        )
	),
)); ?>
