<?php 
require('conexion.php');

$result = mysqli_query($con,"SELECT P.enunciado_pregunta, P.id_pregunta, C.id_categoria
							 FROM et_respuestaP as R join et_pregunta as P
							 on(R.id_pregunta = P.id_pregunta )
							 join et_categoria as C
							 on(C.id_categoria = P.categoria)
							 where R.id_evaluacion = '5' AND R.respuesta = '0' AND R.seguimiento = '0'");

echo "<option value='todos'>Seleccione la pregunta...</option>";
while ($row=mysqli_fetch_array($result)){
echo utf8_encode('<option value="'.$row['id_pregunta'].'">'.$row['enunciado_pregunta'].'</option>');

}
?> 