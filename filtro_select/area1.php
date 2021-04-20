<?php 
include("../conexion.php");
$mysqli->set_charset("utf8");

$result = "SELECT * FROM et_area";
	$resultado = $mysqli->query($result);
	

echo "<option value='todos'>Mostrar todas las áreas</option>";
while($row = $resultado ->fetch_assoc()){
echo '<option value="'.$row['id_area'].'">'.$row['nombre_area'].'</option>';

}
?> 
