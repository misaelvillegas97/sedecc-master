
<?php
/* @var $this EvaluacionEquiposController */
/* @var $model EvaluacionEquipos */

$this->breadcrumbs=array(
	'Evaluacion Instalaciones'=>array('index'),
	$model->eva_id=>array('view','id'=>$model->eva_id),
	'Update',
);
?>


<span style='float:right;'>

<?php echo CHtml::link('<img src="img/list.png" width="40px;">',array('index'),array('title'=>'Volver al listado')); ?>
<?php echo CHtml::link('<img src="img/eyes.png" width="40px;">',array('view','id'=>$model->eva_id),array('title'=>'Visualizar')); ?>
</span>
<h1>Modificar Evaluacion Instalaciones</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
