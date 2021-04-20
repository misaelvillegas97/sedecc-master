<?php 

if(!isset(Yii::app()->user->id)){
  header('Location: index.php?r=site/login');
}
?>
<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	'Administrar',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#usuario-grid').yiiGridView('update', {
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
<?php echo CHtml::link('<img src="img/descarga.png" width="40px;">',array('excel'),array('title'=>'Exportar XLS')); ?>
</span> 
<h1>Usuarios</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php
// Contar usuarios de BD
$usuarios = Yii::app()->db->createCommand("SELECT COUNT(*) FROM min_usuario")->queryScalar();
if($usuarios == '1'){
	$botones = array(
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
    				'visible'=>'false',
				),
			),
		);
}
else{
	$botones = array(
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
		);	
}



$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'usuario-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'usu_id',
		'usu_creado',
		'usu_acceso_nombre',
		'usu_acceso_contrasena',
		//'usu_tipo',
		'usu_nombre',
		/*
		'usu_apellido',
		'usu_email',
		'usu_telefono',
		'usu_direccion',
		'usu_ultimo_acceso',
		*/
		$botones,
	),
)); ?>
