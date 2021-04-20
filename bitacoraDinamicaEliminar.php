	<?php


	//extract($_GET);
  	include("conexion.php");
	mysqli_set_charset( $mysqli, 'utf8');
	$test=array();
	$resultado=0;
	$idBitacora=$_POST['idBitacora'];

	foreach($_POST as $name => $value) {
		$test[]=array("nombre"=>$name,"valor"=>$value);
		//print "$name : $value<br>";
	}
	
	$myquery1 = "DELETE FROM min_bitacora_dinamica where bit_id=$idBitacora ";
	$resultado1 = $mysqli->query($myquery1);
	//Yii::app()->db->createCommand("DELETE FROM min_bitacora_dinamica where bit_id=$idBitacora ")->execute();

	echo json_encode($resultado1);



?>
