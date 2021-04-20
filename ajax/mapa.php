<?php 
	include("../conexion.php");
	$tipoEvaluacion=$_REQUEST['tipoEvaluacion'];
	$eess=$_REQUEST['eess'];
	$lista2Val=$_REQUEST['lista2Val'];
	$lista3Val=$_REQUEST['lista3Val'];
	$lista4Val=$_REQUEST['lista4Val'];
	
	/*$lista2Val='0';
	$lista3Val='0';
	$lista4Val='0';
	$eess='76386500';
	$tipoEvaluacion='trabajador';*/
	
	$where.= $lista2Val == '0' ? '':'AND E.eva_evaluador="'.$lista2Val.'" ';
	$where.= $lista3Val == '0' ? '':'AND YEAR(eva_fecha_evaluacion)="'.$lista3Val.'" ';
	$where.= $lista4Val == '0' ? '':'AND MONTH(eva_fecha_evaluacion)="'.$lista4Val.'" ';
	$lista1 =array();
	$lista2 =array();
	$lista3 =array();
	$lista4 =array();
	$lista5 =array();
	$tabla='';
	$campoTabla='';
	switch ($tipoEvaluacion) {
		case 'trabajador':	
			$tabla='min_evaluacion';
			$campoTabla='CONCAT(tra_nombres," ",tra_apellidos)';
			$sql1 = "SELECT E.eva_geo_x, E.eva_geo_y, E.eva_id, E.eva_nombres, E.eva_apellidos, E.eva_fecha_evaluacion, E.eess_rut, L.tra_rut, L.tra_color
			FROM min_evaluacion as E
			left join min_trabajador as L on(E.eva_evaluador = L.tra_rut)
			WHERE E.eess_rut='".$eess."' AND E.eva_geo_x !='' AND E.eva_geo_y !='' ".$where." ";
			
			$resultado1 = $mysqli->query($sql1);
			
			while($fila = $resultado1 ->fetch_assoc()){
				$lista1[] = array("eva_geo_x" => $fila['eva_geo_x']
									,"eva_geo_y" => $fila['eva_geo_y']
									,"eva_id" => $fila['eva_id']
									,"eva_nombres" => utf8_encode($fila['eva_nombres'])
									,"eva_apellidos" => utf8_encode($fila['eva_apellidos'])
									,"eva_fecha_evaluacion" => $fila['eva_fecha_evaluacion']
									,"eess_rut" => $fila['eess_rut']
									,"tra_rut" => $fila['tra_rut']
									,"tra_color" => $fila['tra_color']);
			}
			
			break;
		case 'equipo':	
			$tabla='min_evaluacion_equipos';
			$campoTabla='E.eq_codigo';
			$sql1 = "SELECT E.eva_geo_x, E.eva_geo_y, E.eva_id, E.eq_codigo, IFNULL(E.eq_maquina,''), E.eva_fecha_evaluacion, E.eess_rut, L.tra_rut, L.tra_color
			FROM min_evaluacion_equipos as E
			left join min_trabajador as L on(E.eva_evaluador = L.tra_rut)
			WHERE E.eess_rut='".$eess."' AND E.eva_geo_x !='' AND E.eva_geo_y !='' ".$where." ";
			
			$resultado1 = $mysqli->query($sql1);
			
			while($fila = $resultado1 ->fetch_assoc()){
				$lista1[] = array("eva_geo_x" => $fila['eva_geo_x']
									,"eva_geo_y" => $fila['eva_geo_y']
									,"eva_id" => $fila['eva_id']
									,"eq_codigo" => utf8_encode($fila['eq_codigo'])
									,"eq_maquina" => utf8_encode($fila['eq_maquina'])
									,"eva_fecha_evaluacion" => $fila['eva_fecha_evaluacion']
									,"eess_rut" => $fila['eess_rut']
									,"tra_color" => 'ff0000');
			}			
			break;
		case 'instalacion':	
			$tabla='min_evaluacion_instalaciones';
			$campoTabla='E.eva_faena';
			$sql1 = "SELECT E.eva_geo_x, E.eva_geo_y, E.eva_id, E.eva_faena, E.eva_fecha_evaluacion, E.eess_rut, L.tra_rut, L.tra_color
			FROM min_evaluacion_instalaciones as E
			left join min_trabajador as L on(E.eva_evaluador = L.tra_rut)
			WHERE E.eess_rut='".$eess."' AND E.eva_geo_x !='' AND E.eva_geo_y !='' ".$where." ";
			
			$resultado1 = $mysqli->query($sql1);
			
			while($fila = $resultado1 ->fetch_assoc()){
				$lista1[] = array("eva_geo_x" => $fila['eva_geo_x']
									,"eva_geo_y" => $fila['eva_geo_y']
									,"eva_id" => $fila['eva_id']
									,"eva_faena" => utf8_encode($fila['eva_faena'])
									,"eva_fecha_evaluacion" => $fila['eva_fecha_evaluacion']
									,"eess_rut" => $fila['eess_rut']
									,"tra_color" => 'ff0000');
			}
			break;

	}
	
			
			
	$sql2 = "SELECT DISTINCT 
					eva_evaluador
					,CONCAT(tra_nombres,' ',tra_apellidos) as nombre_evaluador 
					FROM ".$tabla." e 
					JOIN min_trabajador t on t.tra_rut=e.eva_evaluador 
					WHERE e.eess_rut='".$eess."' 
					AND TRIM(eva_evaluador) != '' 
					AND TRIM(eva_geo_x) != '0' 
					AND TRIM(eva_geo_y) != '0' 
					AND TRIM(eva_evaluador) IS NOT NULL";		
	$sql3 = "SELECT DISTINCT YEAR(eva_fecha_evaluacion) as ano FROM ".$tabla." WHERE eess_rut='".$eess."'  ORDER BY YEAR(eva_fecha_evaluacion)";
	$sql4 = "SELECT DISTINCT MONTH(eva_fecha_evaluacion) as mes FROM ".$tabla." WHERE eess_rut='".$eess."' ORDER BY MONTH(eva_fecha_evaluacion)";
	$sql5= "SELECT ".$campoTabla." as nombre,COUNT(E.eva_id) as cantidad
			FROM ".$tabla." as E
			left join min_trabajador as L on(E.eva_evaluador = L.tra_rut)
			WHERE E.eess_rut='".$eess."' AND E.eva_geo_x !='' AND E.eva_geo_y !='' ".$where."
            GROUP BY ".$campoTabla."";
  	/*echo $sql1.'<br>';
    echo $sql2.'<br>';
	echo $sql3.'<br>';
	echo $sql4.'<br>';
	echo $sql5.'<br>';*/
	$resultado2 = $mysqli->query($sql2);
	$resultado3 = $mysqli->query($sql3);
	$resultado4 = $mysqli->query($sql4);
	$resultado5 = $mysqli->query($sql5);
	
	while($fila2 = $resultado2 ->fetch_assoc()){
		$lista2[] = array("nombre" => utf8_encode($fila2['nombre_evaluador'])
							,"valor" => utf8_encode($fila2['eva_evaluador']));
	}
	while($fila3 = $resultado3 ->fetch_assoc()){
		$lista3[] = array("nombre" => $fila3['ano']
							,"valor" => $fila3['ano']);
	}
	while($fila4 = $resultado4 ->fetch_assoc()){
		$lista4[] = array("nombre" => $fila4['mes']
							,"valor" => $fila4['mes']);
	}
	while($fila5 = $resultado5 ->fetch_assoc()){
		$lista5[] = array("nombre" => utf8_encode($fila5['nombre'])
							,"cantidad" => $fila5['cantidad']);
	}
	

	$valores=array();
	$valores[]=array("lista1" => $lista1, "lista2" => $lista2, "lista3" => $lista3, "lista4" => $lista4, "lista5" => $lista5);
	//var_dump($sql5);
	print json_encode($valores);
?>