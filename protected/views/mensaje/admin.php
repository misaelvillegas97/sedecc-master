<?php
/* @var $this MensajeController */
/* @var $model Mensaje */

$this->breadcrumbs=array(
	'Mensajes'=>array('index'),
	'Administrar',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#mensaje-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<span style='float:right;'>
<?php echo CHtml::link('<i class="i i-plus2"></i>',array('create'),array('title'=>'Nuevo','class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-list2"></i>',array('index'),array('title'=>'Volver al listado','class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-search"></i>','#',array('title'=>'Buscar','class'=>'search-button btn btn-rounded btn-sm btn-icon btn-default')); ?>
</span> 
<h1>Administrar Mensajes</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'mensaje-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'men_id',
		'men_creado',
		'men_emisor',
		'mes_mensaje',
		'men_imagen_1',
		'men_imagen_2',
		/*
		'men_imagen_3',
		'men_imagen_4',
		'men_imagen_5',
		'men_imagen_6',
		*/
		array(
			'class'=>'CButtonColumn',
			'buttons'=>array(
				'view' => array(
    				'options'=>array('title'=>'Ver'),
				),
				'update' => array(
    				'options'=>array('title'=>'Modificar'),
				),
				'trash' => array(
    				'options'=>array('title'=>'Eliminar'),
				),
			),
		),
	),
)); ?>
