<?php 
	include("../conexion.php");
	$tipoVariable=$_REQUEST['tipoVariable'];
	$eess=$_REQUEST['eess'];
	$idVariable=$_REQUEST['idVariable'];

	$data =array();	
	// Obtengo todas las notas correspondientes al id de la variable de evaluación
	$sql= "SELECT * FROM min_variable_notas WHERE var_id =".$idVariable." order by var_not_nota_superior desc";
	$resultado = $mysqli->query($sql);

	// Añado los resultados obtenidos a un array para posteriormente serializarlo mediante json y devolverlo
	while($fila = $resultado ->fetch_assoc()){
		$data[] = array("id" => utf8_encode($fila['var_not_id'])
						,"idVariableEvaluacion" => utf8_encode($fila['var_id'])
						,"nota" => utf8_encode($fila['var_not_nota'])
						,"notaInferior" => utf8_encode($fila['var_not_nota_inferior'])
						,"notaSuperior" => utf8_encode($fila['var_not_nota_superior'])
						,"rangoInferior" => utf8_encode($fila['var_not_rango_inferior'])
						,"rangoSuperior" => utf8_encode($fila['var_not_rango_superior'])
						,"cantidad" => utf8_encode($fila['var_not_cantidad'])
						,"descripcion" => utf8_encode($fila['var_not_descripcion'])
						);
	}


	//var_dump($sql5);
	print json_encode($data);
?>