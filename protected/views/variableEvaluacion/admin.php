<?php
/* @var $this VariableEvaluacionController */
/* @var $model VariableEvaluacion */

$this->breadcrumbs=array(
	'Variable Evaluacions'=>array('index'),
	'Administrar',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#variable-evaluacion-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<span style='float:right;'>
<?php echo CHtml::link('<i class="i i-plus2"></i>',array('create'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default','id'=>'crear')); ?>
<?php echo CHtml::link('<i class="i i-list2"></i>',array('index'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-search"></i>','#',array('class'=>'search-button btn btn-rounded btn-sm btn-icon btn-default')); ?>
</span> 
<h1>Variables de Evaluación</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'variable-evaluacion-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'var_nombre',
		'var_descripcion',
		array(
			'name'=>'var_activa',
			'header'=>'Estado',
			'type'=>'raw',
			'value'=>function($data){
				return $data->var_activa == 1 ? 'Activa' : 'Inactiva';
			},
		),
		array(
					'name'=>'eess_rut',
					'header'=>'Empresa',
					'type'=>'raw',
					'value'=>function($data){
						$eess = Yii::app()->db->createCommand("SELECT eess_nombre_corto FROM min_eess where eess_rut='".$data->eess_rut."' ")->queryScalar();	
						if($eess == '') return '<i>(sin rut ee.ss registrado)</i>'; else return strtoupper($eess);
					},
				),
		// 'var_ponderacion',
		array(
			'name'=>'var_ponderacion',
			'header'=>'Ponderación',
			'type'=>'raw',
			'htmlOptions' => array('class' => 'text-center'),
			'value'=> function($data) {
				return $data->var_ponderacion;
			}
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); 

$eess_rut;
if(Yii::app()->controller->usertype() == 1){
	$eess_rut=Yii::app()->user->id;
}else if(Yii::app()->controller->usertype() == 3){
	$eess_rut=Yii::app()->db->createCommand("SELECT eess_rut FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
}

// En esta variable almaceno el porcentaje total de ponderación, el cual debiera ser <=100
$porcentajeTotal=Yii::app()->db->createCommand("SELECT sum(var_ponderacion) FROM min_variable_evaluacion WHERE eess_rut = '".$eess_rut."'")->queryScalar();
?>

<script>
	
	$(document).ready(function(){
		
		
		$(document).on('click', '#crear', function (event) {
			
			var porcentajeTotal=<?php echo $porcentajeTotal; ?>;
			console.log(porcentajeTotal);
			if(porcentajeTotal >= 100){
			   alert('No puede crear más variables de evaluación puesto que ya tiene el 100% de porcentaje acumulado, si desea agregar más, edite sus demás variables');
				return false;
			}
			
			

			
		});
	});


</script>
