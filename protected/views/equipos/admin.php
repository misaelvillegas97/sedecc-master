<?php
/* @var $this EquiposController */
/* @var $model Equipos */

$this->breadcrumbs=array(
	'Equipos'=>array('index'),
	'Administrar',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#equipos-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

$contador = 0;
// cuando el usuario ingresado es empresa
if (Yii::app()->controller->usertype() == 1) {
    # code...
    $contador  = Yii::app()->db->createCommand("SELECT COUNT(*) FROM min_equipos WHERE eess_rut = ".Yii::app()->user->id)->queryScalar(); 
}

// Cuando el usuario ingresado es un evaluador
if (Yii::app()->controller->usertype() == 3) {
    # code...
    $contador  = Yii::app()->db->createCommand("SELECT COUNT(*) FROM min_equipos WHERE eess_rut = (SELECT eess_rut FROM min_trabajador WHERE tra_rut = ".Yii::app()->user->id.") and eva_evaluador = ".Yii::app()->user->id)->queryScalar();    
}

// Cuando el usuario ingresado es admin
if (Yii::app()->controller->usertype() == 2) {
    # code...
    $contador  = Yii::app()->db->createCommand("SELECT COUNT(*) FROM min_equipos")->queryScalar();
}
?>


<span style='float:right;'>
<?php echo CHtml::link('<i class="i i-plus2"></i>',array('create'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-list2"></i>',array('index'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-search"></i>','#',array('class'=>'search-button btn btn-rounded btn-sm btn-icon btn-default')); ?>
</span> 
<span class="h1" style="margin-top: 20px;">Administrar equipos</span> <span class="text-muted">(<?php echo $contador; ?> en total)</span>


<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'equipos-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'eq_codigo',
		'eq_maquina',
		'eq_marca',
		'eq_modelo',
		'eq_tipo',
		'eq_ano',
		array(
			'name'=>'eess_rut',
			'type'=>'raw',
			'value'=>function($data){
				return Yii::app()->db->createCommand("SELECT eess_nombre_corto FROM min_eess WHERE eess_rut = '".$data->eess_rut."'")->queryScalar();
			}),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
