<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	$model->usu_id,
);
?>


<span style='float:right;'>
<?php echo CHtml::link('<img src="img/list.png" width="40px;">',array('index'),array('title'=>'Volver al listado')); ?>
<?php echo CHtml::link('<img src="img/agregar.png" width="40px;">',array('create'),array('title'=>'Nuevo')); ?>

<?php echo CHtml::link('<img src="img/edit.png" width="40px;">',array('update','id'=>$model->usu_id),array('title'=>'Modificar')); ?>
<?php
$usuarios = Yii::app()->db->createCommand("SELECT COUNT(*) FROM min_usuario")->queryScalar();
if($usuarios > 1) echo CHtml::link('<img src="img/borrar.png" width="40px;">',array('trash','id'=>$model->usu_id),array('title'=>'Eliminar','onclick'=>'return confirm(\'¿Realmente desea eliminar?\');'));
?>
<!--?php echo CHtml::link('<i class="i i-list2"></i>',array('admin'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?-->
</span> 
<h1>Detalle usuario <!--?php echo $model->usu_id; ?--></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'usu_id',
		'usu_creado',
		'usu_acceso_nombre',
		'usu_acceso_contrasena',
		//'usu_tipo',
		'usu_nombre',
		'usu_apellido',
		'usu_email',
		'usu_telefono',
		'usu_direccion',
		'usu_ultimo_acceso',
	),
)); ?>
