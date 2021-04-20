<?php 

if(!isset(Yii::app()->user->id)){
  header('Location: index.php?r=site/login');
}
?>
<?php
if(Yii::app()->controller->usertype() == 1) return; 

/* @var $this EessController */
/* @var $model Eess */

$this->breadcrumbs=array(
	'Eesses'=>array('index'),
	'Administrar',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#eess-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

$contador = 0;

// Cuando el usuario ingresado es admin
if (Yii::app()->controller->usertype() == 2) {
    # code...
    $contador  = Yii::app()->db->createCommand("SELECT COUNT(*) FROM min_eess")->queryScalar();
}

?>

<div style="height:25px; width: 100%"></div>
<span style='float:right;'>
<?php echo CHtml::link('<img src="img/agregar.png" width="40px;">',array('create'),array('title'=>'Nuevo')); ?>
<!--?php echo CHtml::link('<i class="i i-list2"></i>',array('index'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?-->
<?php echo CHtml::link('<img src="img/busqueda.png" width="40px;">','#',array('title'=>'Buscar','class'=>'search-button')); ?>

<?php echo CHtml::link('<img src="img/descarga.png" width="40px;">',array('excel'),array('title'=>'Exportar XLS')); ?>
</span> 

<span class="h1" style="margin-top: 20px;">Empresas de servicio </span> <span class="text-muted">(<?php echo $contador; ?> en total)</span>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'eess-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'eess_rut',
		'eess_creado',
        // 'eess_nombre_corto', // Se configura para mostrar los valores en Uppercase
        array(
            'name'=>'eess_nombre_corto',
			'type'=>'raw',
			'value'=>function($data){
                return strtoupper($data->eess_nombre_corto);
			},
        ),
        // 'eess_razon_social', // Se configura para mostrar los valores en Uppercase
        array(
            'name'=>'eess_razon_social',
			'type'=>'raw',
			'value'=>function($data){
                return strtoupper($data->eess_razon_social);
			},
        ),
		// 'eess_ciudad', // Se configura para mostrar los valores en Uppercase
        array(
            'name'=>'eess_ciudad',
			'type'=>'raw',
			'value'=>function($data){
                return strtoupper($data->eess_ciudad);
			},
        ),
		'eess_telefono',
		/*
		'eess_email',
		'eess_representante',
		'eess_representante_telefono',
		'eess_representante_email',
		'eess_clave',
		'eess_logo',
		'eess_estado',
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
