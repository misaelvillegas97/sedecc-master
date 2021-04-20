<?php
/* @var $this MensajeController */
/* @var $model Mensaje */

$this->breadcrumbs=array(
	'Mensajes'=>array('index'),
	'Nuevo',
);
?>


<span style='float:right;'>
<?php echo CHtml::link('<i class="i i-list"></i>',array('index'),array('title'=>'Volver al listado','class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
</span>
<h1>Nuevo Mensaje</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>