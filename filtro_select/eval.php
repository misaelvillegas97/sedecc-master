<?php 
require('conexion.php');

$result = mysqli_query($con,"SELECT * FROM et_evaluador where rut_evaluador != '1111111' and rut_evaluador != '8423337'");

echo "<option value='todos'>Mostrar todos los Evaluadores</option>";
while ($row=mysqli_fetch_array($result)){
echo utf8_encode('<option value="'.$row['rut_evaluador'].'">'.$row['nombre_evaluador'].'</option>');

}
?> 