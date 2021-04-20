<?php 

if(!isset(Yii::app()->user->id)){
  header('Location: index.php?r=site/login');
}
?>
<?php
/* @var $this FundoController */
/* @var $model Fundo */

$this->breadcrumbs=array(
	'Fundos'=>array('index'),
	'Administrar',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#fundo-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<span style='float:right;'>
<?php echo CHtml::link('<img src="img/agregar.png" width="40px;">',array('create'),array('title'=>'Nuevo')); ?>
<!--?php echo CHtml::link('<i class="i i-list2"></i>',array('index'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?-->
<?php echo CHtml::link('<img src="img/busqueda.png" width="40px;">','#',array('title'=>'Buscar','class'=>'search-button')); ?>
</span> 
<h1>Fundos</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'fundo-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'fun_cod',
		'fun_id',
		//'fun_creado',
		'fun_nombre',
		'fun_comuna',
		'fun_sector',
		'fun_region',
		'fun_admin',
		
		array(
			'name'=>'fun_activo',
			'type'=>'raw',
			'value'=>function($data){
				if($data->fun_activo == 1) return 'Activo'; else return 'Inactivo';
			}
		),
		/*
		
		array('name'=>'fun_activo',
      	'header'=>'Type',
      	'type' => 'raw',
      	'value'=> function($data){
 					return '<div id="Div1" class="checkBox margin10 Div1"></div>';
				},
     	),
		if($data->fun_activo == 1) return 'Activado'; else return 'Inactivo';

		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
