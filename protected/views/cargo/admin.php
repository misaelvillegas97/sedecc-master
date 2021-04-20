<?php 

if(!isset(Yii::app()->user->id)){
  header('Location: index.php?r=site/login');
}

if (Yii::app()->controller->usertype() == 3) {
    header('Location: index.php');
}
?>
<?php
/* @var $this CargoController */
/* @var $model Cargo */

$this->breadcrumbs=array(
	'Cargos'=>array('index'),
	'Administrar',
);


$contador = 0;
// cuando el usuario ingresado es empresa
if (Yii::app()->controller->usertype() == 1) {
    # code...
    $contador  = Yii::app()->db->createCommand("SELECT COUNT(*) FROM min_cargo WHERE eess_rut = ".Yii::app()->user->id)->queryScalar();
}

// Cuando el usuario ingresado es un evaluador
if (Yii::app()->controller->usertype() == 3) {
    # code...
    $contador  = Yii::app()->db->createCommand("SELECT COUNT(*) FROM min_cargo WHERE eess_rut = (SELECT eess_rut FROM min_trabajador WHERE tra_rut = ".Yii::app()->user->id.")")->queryScalar();    
}

// Cuando el usuario ingresado es admin
if (Yii::app()->controller->usertype() == 2) {
    # code...
    $contador  = Yii::app()->db->createCommand("SELECT COUNT(*) FROM min_cargo")->queryScalar();
}

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#cargo-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div style="height:25px"></div>
<span style='float:right;'>
<?php echo CHtml::link('<img src="img/agregar.png" width="40px;">',array('create'),array('title'=>'Nuevo')); ?>
<!--?php echo CHtml::link('<i class="i i-list2"></i>',array('index'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?-->
<?php echo CHtml::link('<img src="img/busqueda.png" width="40px;">','#',array('title'=>'Buscar','class'=>'search-button')); ?>
<?php echo CHtml::link('<img src="img/descarga.png" width="40px;">',array('excel'),array('title'=>'Exportar XLS')); ?>
</span> 
    
<span class="h1" style="margin-top: 20px;">Cargos</span> <span class="text-muted">(<?php echo $contador; ?> en total)</span>


<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cargo-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'car_id',
		'car_creado',
		/*
		array(
			'name'=>'eess_rut',
			'type'=>'raw',
			'value'=>function($data){
				return Yii::app()->db->createCommand("SELECT eess_nombre_corto FROM min_eess WHERE eess_rut = '".$data->eess_rut."'")->queryScalar();
			},
		),*/
		//'car_descripcion',
		array(
            'name'=>'car_descripcion',
			'type'=>'raw',
			'value'=>function($data){
                return strtoupper($data->car_descripcion);
			},
        ),
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
