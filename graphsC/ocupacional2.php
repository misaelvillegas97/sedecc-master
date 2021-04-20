<?php
header('Content-Type: application/json');
extract($_GET);
include("../conexion.php");
mysqli_set_charset( $mysqli, 'utf8');

if ($eess != 'admin') {
	$where = "and T.eess_rut = '$eess'";
}else{
	$where = "";
}

if ($empresa != '') {
	$where2 = "and T.eess_rut = '$empresa'";
}else{
	$where2 = '';
}

$myquery = "
SELECT
SUM(CASE WHEN (tra_vencimiento_examen is NOT null and tra_vencimiento_examen != '0000-00-00' AND tra_vencimiento_examen > curdate()) THEN 1 ELSE 0 END) as vigenteO,
SUM(CASE WHEN (tra_vencimiento_examen is NOT null and tra_vencimiento_examen != '0000-00-00' AND tra_vencimiento_examen <= curdate()) THEN 1 ELSE 0 END) as novigenteO,
SUM(CASE WHEN (tra_vencimiento_examen is null or tra_vencimiento_examen = '0000-00-00') THEN 1 ELSE 0 END) as SinInfoO
FROM min_trabajador as T JOIN min_eess as EE ON(T.eess_rut = EE.eess_rut) WHERE EE.eess_estado = 1 $where2 $where
    ";

$resultado = $mysqli->query($myquery);

$row = $resultado ->fetch_assoc();
?>

[
{
"category": "Vencidos",
"column": "<?php echo $row['novigenteO']; ?>",
"color": "#e14d57"
},
{
"category": "Vigentes",
"column": "<?php echo $row['vigenteO']; ?>",
"color": "#4fbd5b"
},
{
"category": "S/I",
"column": "<?php echo $row['SinInfoO']; ?>",
"color": "#eeecee"
}
]