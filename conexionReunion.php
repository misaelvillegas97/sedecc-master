<?php
include("conexion.php");
mysqli_set_charset( $mysqli, 'utf8');
//$rreess = json_decode(file_get_contents('http://innoapsion.cl/mininco/index.php?r=site/jsoneess'));

if($mysqli ->connect_errno){
	echo "Fallo al conectar".$mysqli->connect_errno;

}else{

	$mysqli->set_charset("utf8");
	
	//$buscar = $_GET['buscar'];
	
	if(!isset($_GET['limit'])) $_GET['limit'] = 0;
	if(!isset($_GET['offset'])) $_GET['offset'] = 0;

	$jsondata = array();
	$jsondataList = array();
	
	if($_GET['param1']=="cuantos"){

		$myquery = "SELECT COUNT(*) total from( 
				SELECT * FROM min_reunion where eess_rut='96960670'
				
		 )as cons
				";

		$resultado = $mysqli->query($myquery);

		$fila = $resultado ->fetch_assoc();

		$jsondata['total'] = $fila['total'];
	}else{
		if($_GET["param1"]=="dame")	{

				$myquery = "SELECT 
								zxc.*, 
								MAX(sem) AS sema 
							FROM(
								SELECT r.reu_id, DATE_FORMAT(r.reu_tiempo, '%d-%m-%Y') AS fechaE, r.reu_android, r.reu_tipo, r.eess_rut, r.eess_razon_social, r.eess_representante, r.eess_apr, r.reu_lugar, r.reu_descripcion, r.reu_geo_x, r.reu_geo_y,CONCAT(tra.tra_nombres,' ',tra.tra_apellidos) AS evaluador,
								CASE
								WHEN acu_seguimiento = 1 THEN 1
								WHEN acu_seguimiento = 0 AND acu_plazo >= CURDATE() THEN 2
								WHEN acu_seguimiento = 0 AND acu_plazo < CURDATE() THEN 3
								WHEN acu_seguimiento IS NULL THEN 0
								END AS sem 
								FROM min_reunion r 
								LEFT JOIN min_trabajador tra ON(r.reu_evaluador = tra.tra_rut)
								LEFT JOIN min_reunion_acuerdo ra ON(r.reu_id = ra.reu_id)
							
								WHERE r.eess_rut='96960670'  
							) AS zxc	
							
							GROUP BY reu_id
				/*LIMIT ".$mysqli->real_escape_string($_GET['limit'])." OFFSET ".$mysqli->real_escape_string($_GET["offset"])." */";

				$resultado = $mysqli->query($myquery);
				while($fila = $resultado ->fetch_assoc()){
					$jsondataperson = array();
					$jsondataperson["reu_id"] = $fila["reu_id"];
					$jsondataperson["reu_tiempo"] = $fila["fechaE"];
					$jsondataperson["reu_android"] = $fila["reu_android"];
					$jsondataperson["reu_tipo"] = $fila["reu_tipo"];
					$jsondataperson["eess_rut"] = $fila["eess_rut"];
					$jsondataperson["eess_razon_social"] = $fila["eess_razon_social"];
					$jsondataperson["eess_representante"] = $fila["eess_representante"];					
					$jsondataperson["eess_apr"] = $fila["eess_apr"];
					$jsondataperson["reu_lugar"] = $fila["reu_lugar"];
					$jsondataperson["reu_descripcion"] = $fila["reu_descripcion"];
					$jsondataperson["reu_foto"] = $fila["reu_foto"];
					$jsondataperson["sema"] = $fila["sema"];
					$jsondataperson["geo"] = $fila["reu_geo_x"].' , '.$fila["reu_geo_y"];
					$jsondataperson["evaluador"] = $fila["evaluador"];
					


					$jsondataList[]=$jsondataperson;
				}

				$jsondata["lista"] = array_values($jsondataList);
				
			
		}
	}

header("Content-type:application/json; charset = utf-8");
ini_set('memory_limit', '-1');
echo json_encode($jsondata);

exit();
}

?>