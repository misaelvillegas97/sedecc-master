<?php
/* @var $this VehiculoController */
/* @var $model Vehiculo */

$this->breadcrumbs=array(
	'Vehiculos'=>array('index'),
	'Administrar',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#vehiculo-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

$contador = 0;
// cuando el usuario ingresado es empresa
if (Yii::app()->controller->usertype() == 3) {
    # code...
    $contador  = Yii::app()->db->createCommand("SELECT COUNT(*) FROM min_vehiculo WHERE eess_rut = ".Yii::app()->user->id)->queryScalar();
}

// Cuando el usuario ingresado es un evaluador
if (Yii::app()->controller->usertype() == 1) {
    # code...
    $contador  = Yii::app()->db->createCommand("SELECT COUNT(*) FROM min_vehiculo WHERE eess_rut = (SELECT eess_rut FROM min_trabajador WHERE tra_rut = ".Yii::app()->user->id.")")->queryScalar();
}

// Cuando el usuario ingresado es admin
if (Yii::app()->controller->usertype() == 2) {
    # code...
    $contador  = Yii::app()->db->createCommand("SELECT COUNT(*) FROM min_vehiculo")->queryScalar();
}
?>

<div style="height:25px"></div>
<span style='float:right;'>
<!--<?php echo CHtml::link('<i class="i i-plus2"></i>',array('create'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-search"></i>','#',array('class'=>'search-button btn btn-rounded btn-sm btn-icon btn-default')); ?>-->
<?php echo CHtml::link('<img src="img/agregar.png" width="40px;">',array('create'),array('title'=>'Nuevo')); ?>
<!--?php echo CHtml::link('<i class="i i-list2"></i>',array('index'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?-->
<?php echo CHtml::link('<img src="img/busqueda.png" width="40px;">','#',array('title'=>'Buscar','class'=>'search-button')); ?>
<a href="excel/FORMATOVEHICULOS.xlsx" download style="margin-left: 5px"> <img src="images/excel-icon.png" class="excel-tooltip" data-toggle="tra_excel_format" title="Descargar Formato Carga Masiva" width="40px;"></a>
</span> 
<span class="h1" style="margin-top: 10px;">Vehículos</span> <span class="text-muted">(<?php echo $contador; ?> en total)</span>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'vehiculo-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'veh_patente',
		'veh_marca',
		'veh_ano',
		'veh_modelo',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
