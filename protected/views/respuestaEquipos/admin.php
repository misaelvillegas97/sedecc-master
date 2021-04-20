<?php
/* @var $this RespuestaEquiposController */
/* @var $model RespuestaEquipos */

$this->breadcrumbs=array(
	'Respuesta Equiposes'=>array('index'),
	'Administrar',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#respuesta-equipos-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<span style='float:right;'>
<?php echo CHtml::link('<i class="i i-plus2"></i>',array('create'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-list2"></i>',array('index'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-search"></i>','#',array('class'=>'search-button btn btn-rounded btn-sm btn-icon btn-default')); ?>
</span> 
<h1>Administrar Respuesta Equiposes</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'respuesta-equipos-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'res_id',
		'res_tiempo',
		'res_enunciado',
		'res_respuesta',
		'res_critico',
		'res_ponderacion',
		/*
		'pre_id',
		'car_id',
		'tem_id',
		'res_observacion',
		'res_foto',
		'eva_id',
		'res_seguimiento',
		'res_plazo',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
