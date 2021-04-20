	<?php


	//extract($_GET);
  	include("conexion.php");
	mysqli_set_charset( $mysqli, 'utf8');
	$test=array();

	foreach($_POST as $name => $value) {
		$test[]=array("nombre"=>$name,"valor"=>$value);
		//print "$name : $value<br>";
	}
	$idBitacora=$test[1]['valor'];

	$operacion=0;
	//0 --> nada
	//1 -->	éxito
	//2 --> error
	for ($i=1; $i <= 20; $i++) { 

		$myquery1 = "SELECT campo_".$i."_valor as valor,campo_".$i."_nombre as nombre 
					FROM min_bitacora_dinamica as bd
					JOIN min_formulario_bitacora as fb
					ON(bd.bit_formulario = fb.bit_nombre)
					WHERE bd.bit_id = '$idBitacora'";
		$resultado1 = $mysqli->query($myquery1);
		$row1 = $resultado1 ->fetch_assoc();
		if ($row1['nombre'] != NULL) {
			if ($i == 1) {

				$sql = "UPDATE min_bitacora_dinamica
						SET 
							bit_tiempo='".$test[0]['valor'][$i-1]."'
						WHERE 
							bit_id = ".$idBitacora." ";

				$result = mysqli_query($mysqli, $sql)or die (mysqli_error());

			}else{
				$sql = "UPDATE min_bitacora_dinamica
					SET 
						campo_".(($i)-1)."_valor='".$test[0]['valor'][$i-1]."'
					WHERE 
						bit_id = ".$idBitacora."";
							
				$result = mysqli_query($mysqli, $sql)or die (mysqli_error());
			}						
			
		}
		$operacion=1;
	}

	// $mensaje = $_POST['mensaje'];
	// $acu_id = $_POST['acu_id'];
	// $id_ar = $_POST['id_ar'];



	// $sql = "INSERT INTO min_reunion_mensaje(ms_id, ms_mensaje, acu_id, ms_tipo, ms_fecha)
	// VALUES  ( NULL, '$mensaje', '$acu_id', '1', now())";
	// $result = mysqli_query($mysqli, $sql)or die (mysqli_error());

	// $sql11 = "UPDATE min_reunion_acuerdo SET acu_seguimiento  = '0' WHERE acu_id = '$acu_id'";
	// 	$result11 = mysqli_query($mysqli, $sql11)or die (mysqli_error());


	// $sql2 = "SELECT MAX(ms_id) as id FROM min_reunion_mensaje";
	// 	$result2 = mysqli_query($mysqli, $sql2)or die (mysqli_error());
	// 	$fila2 = $result2 ->fetch_assoc();
	// 	$id = $fila2['id'];







	//mysqli_close($mysqli);
	//echo json_encode($test[0]['valor']);
	echo json_encode($operacion);



?>
