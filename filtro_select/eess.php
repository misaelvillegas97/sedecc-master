<?php 
require('conexion.php');

$result = mysqli_query($con,"SELECT * FROM et_eess ");

echo "<option value=''>Seleccione una eess...</option>";
while ($row=mysqli_fetch_array($result)){
echo utf8_encode('<option value="'.$row['rut_eess'].'">'.$row['nombre_corto'].'</option>');

}
?> 