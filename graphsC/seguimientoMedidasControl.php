<?php
header('Content-Type: application/json');
extract($_GET);
include("../conexion.php");
mysqli_set_charset( $mysqli, 'utf8');

if ($eess != 'admin') {
	$where = "WHERE a.eess_rut = '$eess'";
}else{
	$where = "";
}

if ($empresa != '') {
	$where2 = "WHERE a.eess_rut = '$empresa'";
}else{
	$where2 = '';
}

$myquery = "
SELECT
COUNT(CASE WHEN mc.mc_semaforo = 2 THEN 2 END) as verde,
COUNT(CASE WHEN mc.mc_semaforo = 1 THEN 1 END) as amarillo,
COUNT(CASE WHEN mc.mc_semaforo = 0 THEN 0 END) AS rojo
FROM min_medidas_control as mc
JOIN min_causas_inmediatas ci on ci.ci_id=mc.ci_id
JOIN min_causas_basicas cb on cb.cb_id=ci.cb_id
JOIN min_accidente a on a.id_accidente=cb.acc_id
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