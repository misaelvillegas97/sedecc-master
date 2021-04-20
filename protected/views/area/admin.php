<?php
/* @var $this AreaController */
/* @var $model Area */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#area-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<span style='float:right;'>
<?php echo CHtml::link('<i class="i i-plus2"></i>',array('create'),array('title'=>'Nueva','class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<!--?php echo CHtml::link('<i class="i i-list2"></i>',array('index'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?-->
<?php echo CHtml::link('<i class="i i-search"></i>','#',array('title'=>'Buscar','class'=>'search-button btn btn-rounded btn-sm btn-icon btn-default')); ?>

<?php echo CHtml::link('XLS',array('excel'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default','style'=>'background:#1F7244; color:#ffffff !important;')); ?>
</span> 
<h1>Áreas</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'area-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'are_id',
		'are_creado',
		array(
			'name'=>'eess_rut',
			'type'=>'raw',
			'value'=>function($data){
				return Yii::app()->db->createCommand("SELECT eess_nombre_corto FROM min_eess WHERE eess_rut = '".$data->eess_rut."'")->queryScalar();
			},
		),
		'are_descripcion',
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
