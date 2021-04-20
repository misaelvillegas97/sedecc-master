<?php
$rows = Yii::app()->db->createCommand("SELECT eva_id, eva_tipo, tra_rut, eva_nombres, eva_apellidos, eva_cache_porcentaje FROM min_evaluacion WHERE eva_item_nombre_0 is NULL")->queryAll();
for($i=0;$i<count($rows);$i++){
	// Obtener categorías de cada evaluación
	$categorias = Yii::app()->db->createCommand("SELECT DISTINCT tem_id FROM min_respuesta WHERE car_id = '".$rows[$i]['eva_tipo']."' ORDER BY tem_id")->queryAll();
	for($j=0;$j<count($categorias);$j++){
		// Asignar nombre de ítem
		Yii::app()->db->createCommand("UPDATE min_evaluacion SET eva_item_nombre_".$j." = '".$categorias[$j]['tem_id']."' WHERE eva_id = '".$rows[$i]['eva_id']."'")->execute();
		// Asignar nota
		$si = Yii::app()->db->createCommand("SELECT SUM(res_ponderacion) FROM min_evaluacion e LEFT JOIN min_respuesta r ON (e.eva_id = r.eva_id) WHERE r.eva_id = '".$rows[$i]['eva_id']."' AND r.tem_id = '".$categorias[$j]['tem_id']."' AND res_respuesta = 'si'")->queryScalar();
		$no = Yii::app()->db->createCommand("SELECT SUM(res_ponderacion) FROM min_evaluacion e LEFT JOIN min_respuesta r ON (e.eva_id = r.eva_id) WHERE r.eva_id = '".$rows[$i]['eva_id']."' AND r.tem_id = '".$categorias[$j]['tem_id']."' AND res_respuesta = 'no'")->queryScalar();
		if($si+$no>0){
			Yii::app()->db->createCommand("UPDATE min_evaluacion SET eva_item_nota_".$j." = '".round(100*($si/($si+$no)))."' WHERE eva_id = '".$rows[$i]['eva_id']."'")->execute();
		}
	}
}

print_r($rows);



//$categorias = Yii::app()->db->createCommand("SELECT DISTINCT tem_id FROM min_respuesta WHERE car_id = '".$_POST['filtro_tipo']."'")->queryAll();

?>