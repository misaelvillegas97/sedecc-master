<?php 
	$eess=$_REQUEST['eess'];
	/*$where_mapa = '';
			
	if(isset($_POST['evaluador'])) if($_POST['evaluador'] != '') $where_mapa.= " AND E.eva_evaluador = '".$_POST['evaluador']."'";
	if(isset($_POST['ano'])) if($_POST['ano'] != '') $where_mapa.= " AND YEAR(eva_fecha_evaluacion) = '".$_POST['ano']."'";
	if(isset($_POST['mes'])) if($_POST['mes'] != '') $where_mapa.= " AND MONTH(eva_fecha_evaluacion) = '".$_POST['mes']."'";
	
	// Lógica para tipos de usuario eess
	if(Yii::app()->controller->usertype() == 1){
		$where2.=" AND E.eess_rut = '".Yii::app()->user->id."' ";
	}
	
	// Lógica para tipos de usuario evaluador
	if(Yii::app()->controller->usertype() == 3){
		$eess = Yii::app()->db->createCommand("SELECT eess_rut FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
		$where2.=" AND E.eess_rut = '".$eess."' ";
	}
	
	$sql = "
	SELECT E.eva_geo_x, E.eva_geo_y, E.eva_id, E.eva_nombres, E.eva_apellidos, E.eva_fecha_evaluacion, E.eess_rut, L.tra_rut, L.tra_color
	FROM min_evaluacion as E
	left join min_trabajador as L on(E.eva_evaluador = L.tra_rut)
	WHERE 1 ".$where_mapa." ".$where2."
	AND E.eva_geo_x != ''
	AND E.eva_geo_y != ''
	";
	$evaluaciones = Yii::app()->db->createCommand($sql)->query()->readAll();*/
	print json_encode($eess);
?>