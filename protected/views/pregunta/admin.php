<?php 

if(!isset(Yii::app()->user->id)){
  header('Location: index.php?r=site/login');
}
?>
<?php
$this->breadcrumbs=array(
	'Preguntas'=>array('index'),
	'Administrar',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pregunta-grid').yiiGridView('update', {
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
<h1>Preguntas</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<!--?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pregunta-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'pre_id',
		/*
		array(
			'name'=>'eess_rut',
			'type'=>'raw',
			'value'=>function($data){
				return Yii::app()->db->createCommand("SELECT eess_nombre_corto FROM min_eess WHERE eess_rut = '".$data->eess_rut."'")->queryScalar();
			},
		),*/
		'pre_enunciado',
		'pre_ponderacion',
		'tem_id',
		'car_id',
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
)); ?-->


<?php
/**
$checklists = Yii::app()->db->createCommand("SELECT DISTINCT car_id FROM min_pregunta")->query()->readAll();
for($i=0;$i<count($checklists);$i++){
	echo '<div style="padding:10px; background:#ffffff; margin-bottom:20px;">';
	echo '<h3 class="page-header">'.$checklists[$i]['car_id'].'</h3>';
	$categorias = Yii::app()->db->createCommand("SELECT DISTINCT tem_id FROM min_pregunta WHERE car_id = '".$checklists[$i]['car_id']."'")->query()->readAll();
	for($j=0;$j<count($categorias);$j++){
		echo '<p style="background:#f3f3f3; padding:10px;"><b>'.$categorias[$j]['tem_id'].'</b></p>';
		$preguntas = Yii::app()->db->createCommand("SELECT * FROM min_pregunta WHERE car_id = '".$checklists[$i]['car_id']."' AND tem_id = '".$categorias[$j]['tem_id']."'")->query()->readAll();
		echo '<table style="width:100%;">';
		echo '<thead>
		<th style="width:100px;"><small>Opciones</small></th>
		<th style="width:100px;"><small>Ponderación</small></th>
		<th style="width:120px;"><small>Alertar<br>Incumplimientos</small></th>
		<th style="padding-right:10px;"><small>Pregunta</small></th>
		</thead>';
		for($k=0;$k<count($preguntas);$k++){
			echo '<tr>
				<td><a href="index.php?r=pregunta/view&id='.$preguntas[$k]['pre_id'].'"><img src="assets/94f94605/gridview/view.png" style="width:20px;"></a>
				<a href="index.php?r=pregunta/update&id='.$preguntas[$k]['pre_id'].'"><img src="assets/94f94605/gridview/update.png" style="width:20px;"></a></td>
				<td><input name="ponderacion_'.$preguntas[$k]['pre_id'].'" type="number" value="'.$preguntas[$k]['pre_ponderacion'].'" step="0.1" style="width:80px;"></td>
				<td><input name="alertar_'.$preguntas[$k]['pre_id'].'" type="checkbox" value="'.$preguntas[$k]['pre_ponderacion'].'"></td>
				<td><small>'.$preguntas[$k]['pre_enunciado'].'</small></td>
			</tr>';
		}
		echo '</table>';
	}
	echo '</div>';
}
print_r($checklists);
**/


?>

	
<div id="exTab1">	
	<ul class="nav nav-pills">
		<!--
		<li class="active"><a href="#1a" data-toggle="tab">Preguntas</a></li>
		-->
	</ul>
	<div class="tab-content clearfix">
		<div class="tab-pane active" id="1a"> 
         <?php
          $checklists = Yii::app()->db->createCommand("SELECT DISTINCT car_id FROM min_pregunta")->queryAll();
      
		  for($i=0;$i<count($checklists);$i++){
			//echo '<div style="padding:10px; background:#ffffff; margin-bottom:20px;">';
			///echo '<h3 class="page-header">'.$checklists[$i]['car_id'].'</h3>';
			echo '<a class="btn btn-block" data-toggle="collapse" data-target="#demo'.$i.'" style="margin-top:5px;margin-bottom:15px; color:#ffffff;">'.$checklists[$i]['car_id'].'</a>
			<div id="demo'.$i.'" class="collapse" style="background:#ffffff; padding:10px;">';
			$categorias = Yii::app()->db->createCommand("SELECT DISTINCT tem_id FROM min_pregunta WHERE car_id = '".$checklists[$i]['car_id']."' ORDER BY FIELD(tem_id, 'COMPORTAMIENTO Y/O ACTITUD','APARIENCIA FISICA','OBSERVACION OPERACIONAL','EVENTOS (EXTERNOS E INTERNOS)')")->query()->readAll();
			for($j=0;$j<count($categorias);$j++){
				echo '<p style="background:#f3f3f3; padding:10px;"><b>'.$categorias[$j]['tem_id'].'</b></p>';
				$preguntas = Yii::app()->db->createCommand("SELECT * FROM min_pregunta WHERE car_id = '".$checklists[$i]['car_id']."' AND tem_id = '".$categorias[$j]['tem_id']."'")->query()->readAll();
				echo '<table style="width:100%;">';
				echo '<thead>
				<th style="width:100px;"><small>Opciones</small></th>
				<th style="width:100px;"><small>Ponderación</small></th>
				<th style="width:120px;"><small>Alertar<br>Incumplimientos</small></th>
				<th style="padding-right:10px;"><small>Pregunta</small></th>
				</thead>';
				for($k=0;$k<count($preguntas);$k++){
					$checkeado = Yii::app()->db->createCommand("SELECT critico FROM min_pregunta WHERE car_id = '".$checklists[$i]['car_id']."' AND tem_id = '".$categorias[$j]['tem_id']."' AND pre_enunciado ='".$preguntas[$k]['pre_enunciado']."'")->query()->readAll();
					$respo = $preguntas[$k]['critico'];
					if($respo == "si"){
						$respo = "checked";
					}else if($respo == "no"){
						$respo = "";
					}

					echo '<tr>
						<td><a href="index.php?r=pregunta/view&id='.$preguntas[$k]['pre_id'].'" style="background: none !important"><img src="assets/94f94605/gridview/view.png" style="width:20px;"></a>
						<a href="index.php?r=pregunta/update&id='.$preguntas[$k]['pre_id'].'" style="background: none !important"><img src="assets/94f94605/gridview/update.png" style="width:20px;"></a></td>
						<td><input name="ponderacion_'.$preguntas[$k]['pre_id'].'" type="number" value="'.$preguntas[$k]['pre_ponderacion'].'" step="0.1" style="width:80px;"></td>
						<td><input name="alertar_'.$preguntas[$k]['pre_id'].'" type="checkbox" value="'.$preguntas[$k]['pre_ponderacion'].'" '.$respo.'></td>
						<td><small>'.$preguntas[$k]['pre_enunciado'].'</small></td>

					</tr>';
				}
				echo '</table>';
				echo '<br><br></br></br>';
			}
			
			//echo '<input type="submit" value="Guardar" class="btn btn-primary btn-block" >';
			echo '</div>';

		  }
		  
		  echo '</form>';
					
          ?>
		</div>
		
	</div>
	<?php
		echo '<br><br></br></br>';
	?>
</div>

