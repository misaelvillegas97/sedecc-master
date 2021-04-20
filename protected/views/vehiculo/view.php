<?php
if(isset($_POST['tra_rut'])){
	Yii::app()->db->createCommand("REPLACE INTO min_vehiculo_trabajador VALUES('".$model->veh_patente."','".$_POST['tra_rut']."')")->execute();
	echo '<div class="alert alert-success">Trabajador vinculado con éxito a este proyecto</div>';
}

if(isset($_POST['del_tra_rut'])){
	Yii::app()->db->createCommand("DELETE FROM min_vehiculo_trabajador WHERE veh_patente = '".$model->veh_patente."' AND tra_rut = '".$_POST['del_tra_rut']."'")->execute();
	echo '<div class="alert alert-success">Trabajador desvinculado con éxito de este proyecto</div>';
}

$this->breadcrumbs=array(
	'Vehiculos'=>array('index'),
	$model->veh_patente,
);
?>


<span style='float:right;'>
<?php echo CHtml::link('<i class="i i-list"></i>',array('index'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-plus2"></i>',array('create'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-pencil2"></i>',array('update','id'=>$model->veh_patente),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-cross2"></i>',array('trash','id'=>$model->veh_patente),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default','onclick'=>'return confirm(\'¿Realmente desea eliminar?\');'));?>
</span> 
<h1>Detalle vehículo</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'veh_patente',
		'veh_marca',
		'veh_ano',
		'veh_modelo',
	),
)); ?>

<div style="background:#ffffff; padding:10px;">
<h3 class="page-header">Trabajadores asignados</h3>
<?php
// Mostrar trabajadores no vinculados



$rows = Yii::app()->db->createCommand("SELECT * FROM min_trabajador ORDER BY tra_nombres")->queryAll();
echo '<form method="post">';
echo '<select name="tra_rut" class="form-control input-sm" style="display:inline; width:200px;">';
for($i=0;$i<count($rows);$i++){
	echo '<option value="'.$rows[$i]['tra_rut'].'">'.$rows[$i]['tra_nombres'].' '.$rows[$i]['tra_apellidos'].'</option>';
}
echo '</select>';
echo '<input type="submit" class="btn btn-sm btn-primary" value="Asignar">';
echo '</form>';


// Mostrar trabajadores vinculados
$where = "";
if(Yii::app()->controller->usertype() == 1) $where.= " AND t.eess_rut = '".Yii::app()->user->id."' ";
if(Yii::app()->controller->usertype() == 3){
	$eess = Yii::app()->db->createCommand("SELECT eess_rut FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
	$where.= " AND t.eess_rut = '".$eess."' ";
}


$rows = Yii::app()->db->createCommand("SELECT t.tra_id as tra_id, t.tra_rut as tra_rut, CONCAT(t.tra_nombres,' ',t.tra_apellidos) as tra_nombre_completo FROM min_vehiculo_trabajador vt LEFT JOIN min_trabajador t ON (vt.tra_rut = t.tra_rut) WHERE 1 ".$where." AND vt.veh_patente = '".$model->veh_patente."'")->queryAll();
echo '<table class="table">';
echo '<thead><th>RUT</th><th>Nombre completo</th><th class="text-right">Opciones</th></thead>';
for($i=0;$i<count($rows);$i++){
	echo '
	<tr>
		<td><a href="index.php?r=trabajador/view&id='.$rows[$i]['tra_id'].'">'.$rows[$i]['tra_rut'].'</a></td>
		<td><a href="index.php?r=trabajador/view&id='.$rows[$i]['tra_id'].'">'.$rows[$i]['tra_nombre_completo'].'</a></td>
		<td class="text-right">
			<form method="post">
				<input name="del_tra_rut" type="hidden" value="'.$rows[$i]['tra_rut'].'">
				<input onclick="return confirm(\'¿Realmente desea no asignar este trabajador del proyecto?\');" class="btn btn-xs btn-danger" type="submit" value="No Asignar">
			</form>
		</td>
	</tr>
	';
}
echo '</table>';
?>
</div>