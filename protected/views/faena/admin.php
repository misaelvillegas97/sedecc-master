<?php 

if(!isset(Yii::app()->user->id)){
  header('Location: index.php?r=site/login');
}
?>
<?php
/* @var $this FaenaController */
/* @var $model Faena */

$this->breadcrumbs=array(
	'Faenas'=>array('index'),
	'Administrar',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#faena-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
$contador = 0;
// cuando el usuario ingresado es empresa
if (Yii::app()->controller->usertype() == 1) {
    # code...
    $contador  = Yii::app()->db->createCommand("SELECT COUNT(*) FROM min_faena WHERE eess_rut = ".Yii::app()->user->id)->queryScalar();
}

// Cuando el usuario ingresado es un evaluador
if (Yii::app()->controller->usertype() == 3) {
    # code...
    $contador  = Yii::app()->db->createCommand("SELECT COUNT(*) FROM min_faena WHERE eess_rut = (SELECT eess_rut FROM min_trabajador WHERE tra_rut = ".Yii::app()->user->id.") and eva_evaluador = ".Yii::app()->user->id)->queryScalar();    
}

// Cuando el usuario ingresado es admin
if (Yii::app()->controller->usertype() == 2) {
    # code...
    $contador  = Yii::app()->db->createCommand("SELECT COUNT(*) FROM min_faena")->queryScalar();
}
?>

<div style="height:25px"></div>
<span style='float:right;'>
<?php echo CHtml::link('<img src="img/agregar.png" width="40px;">',array('create'),array('title'=>'Nuevo')); ?>
<!--?php echo CHtml::link('<i class="i i-list2"></i>',array('index'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?-->
<?php echo CHtml::link('<img src="img/busqueda.png" width="40px;">','#',array('title'=>'Buscar','class'=>'search-button')); ?>
</span> 
<span class="h1" style="margin-top: 20px;">Faenas</span> <span class="text-muted">(<?php echo $contador; ?> en total)</span>


<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'faena-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'fae_nombre',
		//'fae_activo',
		array(
			'name'=>'fae_activo',
			'type'=>'raw',
			'value'=>function($data){
				if($data->fae_activo == 1) return 'Activo'; else return 'Inactivo';
			}
		),
		'tipo',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
