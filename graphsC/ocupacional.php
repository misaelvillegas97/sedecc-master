<?php
header('Content-Type: application/json');
extract($_GET);
include("../conexion.php");
mysqli_set_charset( $mysqli, 'utf8');


$myquery = "
SELECT
SUM(CASE WHEN (tra_vencimiento_examen is NOT null and tra_vencimiento_examen != '0000-00-00' AND tra_vencimiento_examen > curdate()) THEN 1 ELSE 0 END) as vigenteO,
SUM(CASE WHEN (tra_vencimiento_examen is NOT null and tra_vencimiento_examen != '0000-00-00' AND tra_vencimiento_examen <= curdate()) THEN 1 ELSE 0 END) as novigenteO,
SUM(CASE WHEN (tra_vencimiento_examen is null or tra_vencimiento_examen = '0000-00-00') THEN 1 ELSE 0 END) as SinInfoO
FROM `min_trabajador` WHERE eess_rut = '$eess'
    ";

$resultado = $mysqli->query($myquery);

$row = $resultado ->fetch_assoc();
?>

[
{
"category": "Vencidos",
"column": "<?php echo $row['novigenteO']; ?>",
"color": "#ff0000"
},
{
"category": "Vigentes",
"column": "<?php echo $row['vigenteO']; ?>",
"color": "#00cc00"
},
{
"category": "S/I",
"column": "<?php echo $row['SinInfoO']; ?>",
"color": "#eeecee"
}
]