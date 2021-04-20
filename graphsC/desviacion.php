<?php
header('Content-Type: application/json');
extract($_GET);
include("../conexion.php");
mysqli_set_charset( $mysqli, 'utf8');

if ($eess != 'admin') {
	$where = "WHERE e.eess_rut = '$eess'";
}else{
	$where = "";
}

if ($empresa != '') {
	$where2 = "WHERE e.eess_rut = '$empresa'";
}else{
	$where2 = '';
}

$myquery = "
SELECT e.eess_rut,
COUNT(CASE WHEN res_seguimiento = 1 and res_respuesta = 'no' THEN 1 END) as verde,
COUNT(CASE WHEN res_seguimiento = 0 and res_plazo >= curdate() and res_respuesta = 'no' THEN 2 END) as amarillo,
COUNT(CASE WHEN res_seguimiento = 0 and res_plazo < curdate() and res_respuesta = 'no' THEN 3 END) AS rojo
FROM min_respuesta as r
JOIN min_evaluacion as e
ON(r.eva_id = e.eva_id)
$where $where2
";

$resultado = $mysqli->query($myquery);

$row = $resultado ->fetch_assoc();
?>

[
{
"category": "Vencidas",
"column": "<?php echo $row['rojo']; ?>",
"color": "#e14d57"
},
{
"category": "En Proceso",
"column": "<?php echo $row['amarillo']; ?>",
"color": "#f7e523"
},
{
"category": "Aprobada",
"column": "<?php echo $row['verde']; ?>",
"color": "#4fbd5b"
}

]