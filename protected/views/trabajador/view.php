<?php 

if(!isset(Yii::app()->user->id)){
  header('Location: index.php?r=site/login');
}
?>
<?php
$this->breadcrumbs=array(
	'Trabajadors'=>array('index'),
	$model->tra_id,
);

// Guardar accidente/incidente
if(isset($_POST['eve_descripcion'])){
	Yii::app()->db->createCommand("
	INSERT INTO min_evento(eve_tiempo, tra_rut, eess_rut, eve_descripcion)
	VALUES('".$_POST['eve_fecha']."','".$model->tra_rut."','".$model->eess_rut."','".$_POST['eve_descripcion']."');
	")->execute();
	echo '<hr><div class="alert alert-success">Se agregó el accidente / incidente con éxito.</div>';
}

// Eliminar
if(isset($_POST['del_id'])){
	Yii::app()->db->createCommand("DELETE FROM min_evento WHERE eve_id = '".$_POST['del_id']."'")->execute();
	echo '<hr><div class="alert alert-success">Se eliminó el accidente / incidente con éxito.</div>';
}
?>

<style type="text/css">
	.detail-view th{ width:200px !important;}
</style>
<span style='float:right;'>
<?php echo CHtml::link('<img src="img/list.png" width="40px;">',array('index'),array('title'=>'Volver al listado')); ?>
<?php if(Yii::app()->controller->usertype() != 3) echo CHtml::link('<img src="img/agregar.png" width="40px;">',array('create'),array('title'=>'Nuevo')); ?>
<?php echo CHtml::link('<img src="img/edit.png" width="40px;">',array('update','id'=>$model->tra_id),array('title'=>'Modificar')); ?>
<?php if(Yii::app()->controller->usertype() != 3) echo CHtml::link('<img src="img/borrar.png" width="40px;">',array('trash','id'=>$model->tra_id),array('title'=>'Eliminar','onclick'=>'return confirm(\'¿Realmente desea eliminar? Si eliminas este trabajador, también se eliminarán todas sus evaluaciones.\');'));?>
<!--?php echo CHtml::link('<i class="i i-list2"></i>',array('admin'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?-->
</span> 
<h1>Detalle Trabajador <!--?php echo $model->tra_id; ?--></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		/*'tra_id',
		'tra_creado',
		array(
			'name'=>'eess_rut',
			'type'=>'raw',
			'value'=>function($data){
				return Yii::app()->db->createCommand("SELECT eess_nombre_corto FROM min_eess WHERE eess_rut = '".$data->eess_rut."'")->queryScalar();
			},
		),
		*/

		'tra_rut',
		'tra_dv',
		'tra_nombres',
		'tra_apellidos',
		'tra_fecha_nacimiento',
		//'tra_vencimiento_corma', // esto se reemplazo por la funcion raw de más abajo, hacer lo mismo con las otras fechas.
		array(
			'name'=>'tra_vencimiento_corma',
			'type'=>'raw',
			'value'=>function($data){
				if($data->tra_vencimiento_corma < date("Y-m-d")) return '<span style="color:red;">'.$data->tra_vencimiento_corma.'</span>'; // color rojo
				else return $data->tra_vencimiento_corma; // Sin color
			},
		),
		'tra_vencimiento_examen',
		'tra_licencia_conducir',
		'tra_vencimiento_licencia_conducir',
		//'car_id',
		array(
			'name'=>'car_id',
			'type'=>'raw',
			'value'=>function($data){
				return Yii::app()->db->createCommand("SELECT car_descripcion FROM min_cargo WHERE car_id = '".$data->car_id."'")->queryScalar();
			},
		),
		'tra_centro_trabajo',
		'tra_email',
		array(
			'name'=>'tra_evaluador',
			'type'=>'raw',
			'label'=>'Vehículos Asignados',
			'value'=>function($data){
				$rows = Yii::app()->db->createCommand("SELECT vt.veh_patente as veh_patente, t.tra_id as tra_id, t.tra_rut as tra_rut, CONCAT(t.tra_nombres,' ',t.tra_apellidos) as tra_nombre_completo FROM min_vehiculo_trabajador vt LEFT JOIN min_trabajador t ON (vt.tra_rut = t.tra_rut) WHERE 1 AND vt.tra_rut = '".$data->tra_rut."'")->queryAll();
				if(count($rows)==0) return 'Trabajador sin vehículos asignados';
				$c = '';
				for($i=0;$i<count($rows);$i++){
					$c.= '<a class="label label-success" href="index.php?r=vehiculo/view&id='.$rows[$i]['veh_patente'].'">'.$rows[$i]['veh_patente'].'</a> ';
				}
				return $c;
			},
		),
		//'tra_evaluador',
		//'tra_responder_todo',
		array(
			'name'=>'tra_evaluador',
			'type'=>'raw',
			'value'=>function($data){
				if($data->tra_evaluador == 1) return 'SI'; else return 'NO';
			},
		),
		array(
			'name'=>'tra_responder_todo',
			'type'=>'raw',
			'value'=>function($data){
				if($data->tra_evaluador == 0) return '(No habilitado para evaluar)';
				if($data->tra_responder_todo == 1) return 'SI'; else return 'NO';
			},
		),
		array(
			'name'=>'tra_recibir_todo',
			'type'=>'raw',
			'value'=>function($data){
				if($data->tra_evaluador == 0) return '(No habilitado para evaluar)';
				if($data->tra_recibir_todo == 1) return 'SI'; else return 'NO';
			},
		),
		array(
			'name'=>'tra_color',
			'type'=>'raw',
			'value'=>function($data){
				if($data->tra_evaluador == 0) return '(No habilitado para evaluar)';
				return '<img src="http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|'.$data->tra_color.'">';
			},
		),
	),
)); ?>
<?php /*
<div style="background:#ffffff; padding:10px;">
	<h3 class="page-header">Accidentes/Incidentes de este trabajador</h3>
	<?php
	$rows = Yii::app()->db->createCommand("SELECT * FROM min_evento WHERE tra_rut = '".$model->tra_rut."' AND eess_rut = '".$model->eess_rut."'")->queryAll();
	echo '<table class="table">';
	echo '
	<thead>
		<th>Fecha ocurrencia</th>
		<th>Descripción</th>
		<th></th>
	</thead>
	';
	for($i=0;$i<count($rows);$i++){
		echo '
		<tr>
			<td>'.date("d-m-Y", strtotime($rows[$i]['eve_tiempo'])).'</td>
			<td>'.$rows[$i]['eve_descripcion'].'</td>
			<td class="text-right">
				<form method="post">
					<input name="del_id" type="hidden" value="'.$rows[$i]['eve_id'].'">
					<input class="btn btn-danger btn-xs" type="submit" value="x" onclick="return confirm(\'¿Realmente desea eliminar este registro?\')">
				</form>
			</td>
		</tr>
		';
	}
	echo '</table>';
	?>
	<h3 class="page-header">Agregar Accidente/Incidente para este trabajador</h3>
	<form method="post">
		<small>Descripción del evento</small>
		<textarea name="eve_descripcion" required class="form-control input-sm" ></textarea>
		<hr>
		<div class="row">
			<div class="col-sm-2 text-right">
				<small>Fecha ocurrencia</small><br>
			</div>
			<div class="col-sm-2">
				<input name="eve_fecha" required type="date" class="form-control input-sm" value="<?php echo date("Y-m-d");?>">
			</div>
			<div class="col-sm-3">
				<input type="submit" class="btn btn-primary btn-sm btn-block" value="Guardar">
			</div>
		</div>
		
	</form>
</div>
*/ ?>