<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	$model->usu_id=>array('view','id'=>$model->usu_id),
	'Update',
);
?>


<span style='float:right;'>
<?php echo CHtml::link('<img src="img/list.png" width="40px;">',array('index'),array('title'=>'Volver al listado')); ?>
<?php echo CHtml::link('<img src="img/agregar.png" width="40px;">',array('create'),array('title'=>'Nuevo')); ?>

<?php echo CHtml::link('<img src="img/eyes.png" width="40px;">',array('view','id'=>$model->usu_id),array('title'=>'Visualizar')); ?>
<?php
$usuarios = Yii::app()->db->createCommand("SELECT COUNT(*) FROM min_usuario")->queryScalar();
if($usuarios > 1) echo CHtml::link('<img src="img/borrar.png" width="40px;">',array('trash','id'=>$model->usu_id),array('title'=>'Eliminar','onclick'=>'return confirm(\'¿Realmente desea eliminar?\');'));
?>
<!--?php echo CHtml::link('<i class="i i-list2"></i>',array('admin'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?-->
</span> 
<h1>Modificar usuario <!--?php echo $model->usu_id; ?--></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>