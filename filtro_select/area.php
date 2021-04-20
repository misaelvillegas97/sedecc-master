<?php 
include("../conexion.php");
$mysqli->set_charset("utf8");

$result = "SELECT * FROM et_area";
	$resultado = $mysqli->query($result);
	

echo "<option value=''>Seleccione un area...</option>";
while($row = $resultado ->fetch_assoc()){
echo utf8_encode('<option value="'.$row['id_area'].'">'.$row['nombre_area'].'</option>');

}
?> 