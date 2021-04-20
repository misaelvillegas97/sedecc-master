<?php
/* @var $this VariableEvaluacionController */
/* @var $model VariableEvaluacion */

$this->breadcrumbs=array(
	'Variable Evaluacions'=>array('index'),
	$model->var_id,
);
?>


<span style='float:right;'>
<?php echo CHtml::link('<img src="img/list.png" width="40px;">',array('index'),array('title'=>'Volver al listado')); ?>
<?php if(Yii::app()->controller->usertype() != 2) echo CHtml::link('<img src="img/agregar.png" width="40px;">',array('create'),array('title'=>'Crear una nueva variable')); ?>
<?php echo CHtml::link('<img src="img/edit.png" width="40px;">',array('update','id'=>$model->var_id),array('title'=>'Modificar')); ?>
<?php echo CHtml::link('<img src="img/borrar.png" width="40px;">',array('trash','id'=>$model->var_id),array('title'=>'Eliminar','onclick'=>'return confirm(\'¿Realmente desea eliminar?\');'));?>
<?php //echo CHtml::link('<i class="i i-list2"></i>',array('admin'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
</span> 
<!-- <h1>Detalle Variable de Evaluación <?php echo $model->var_nombre; ?></h1 -->
<h1>Detalle Variable "<?php echo $model->var_nombre; ?>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'var_nombre',
		'var_descripcion',
		array(
					'name'=>'var_activa',
					'label'=>'Estado',
					'type'=>'raw',
					'value'=>function($data){
						$activa = $data -> var_activa = 0 ? 'Inactiva' : 'Activa';	
						return $activa; 
					},
				),
		array(
					'name'=>'eess_rut',
					'label'=>'Nombre Empresa',
					'type'=>'raw',
					'value'=>function($data){
						$nombre =  Yii::app()->db->createCommand("SELECT eess_nombre_corto FROM min_eess WHERE eess_rut = '".$data->eess_rut."'")->queryScalar();
						
						return ( empty($nombre) ) ? 'NO REGISTRADO' : $nombre ;
					},
				),
		// 'eess_rut',
		'var_ponderacion',
	),
)); ?>
