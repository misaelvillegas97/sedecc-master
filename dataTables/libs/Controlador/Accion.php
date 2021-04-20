<?php

if(isset($_POST["Eliminar_Rango"]))
{
	
	include("/home/innoapsi/public_html/sedecc/conexion.php");
    	mysqli_set_charset( $mysqli, 'utf8');

	$id_rango = $_POST["removeID"];
	$sql = "DELETE FROM grupo_rangos_alejandro WHERE id_rango = '$id_rango'";
	$run_query = mysqli_query($mysqli,$sql);
	if ($run_query) {
			echo "Rango Eliminado !";
		

}
}
else
{
	echo "no hizo nada";
}



?>