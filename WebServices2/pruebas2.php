<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include ("../conexion.php");


if($mysqli ->connect_errno){
	echo "Fallo al conectar".$mysqli->connect_errno;

}else{
	$mysqli->set_charset("utf8");
	$jsondata = array();
	$jsondataList = array();	
		
	$resultado = $mysqli->query("SELECT * FROM consulta_administracion");
	$resultadoChecklist = $mysqli->query("SELECT * FROM conteo_cheklist");
	
    // $fila = $resultado->fetch_assoc();
    // $filaChecklist = $resultadoChecklist->fetch_assoc();
	// var_dump($resultadoChecklist);
	while($filaChecklist = $resultadoChecklist->fetch_assoc() ){
        $fila = $resultado->fetch_assoc();
        $jsondataeess = array();
		$jsondataeess["eess_rut"] = $fila["eess_rut"];
		$jsondataeess["eess_nombre_corto"] = $fila["eess_nombre_corto"];
		$jsondataeess["eess_razon_social"] = $fila["eess_razon_social"];
		$jsondataeess["eess_email"] = $fila["eess_email"];
		$jsondataeess["eess_representante"] = $fila["eess_representante"];
		// $jsondataeess["eess_representante_telefono"] = $fila["eess_representante_telefono
		// "];
		$jsondataeess["num_tra"] = $fila["num_tra"];
		$jsondataeess["num_eq"] = $fila["num_eq"];
		$jsondataeess["num_fae"] = $fila["num_fae"];
		$jsondataeess["num_bita"] = $fila["num_bita"];
		$jsondataeess["form_tra"] = $filaChecklist["form_tra"];
		$jsondataeess["form_eq"] = $filaChecklist["form_eq"];
		$jsondataeess["form_fae"] = $filaChecklist["form_fae"];
	
		$jsondataList[]=$jsondataeess;
	}
	
	$jsondata = array_values($jsondataList);
	
	header("Content-type:application/json; charset=utf-8");
	echo json_encode($jsondata);
}
?> 