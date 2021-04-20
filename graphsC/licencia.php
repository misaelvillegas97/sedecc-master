<?php
header('Content-Type: application/json');
extract($_GET);
include("../conexion.php");
mysqli_set_charset( $mysqli, 'utf8');


$myquery = "SELECT 
SUM(CASE WHEN (tra_vencimiento_licencia_conducir is NOT null and tra_vencimiento_licencia_conducir != '0000-00-00' AND tra_vencimiento_licencia_conducir > curdate()) THEN 1 ELSE 0 END) as vigenteL,
SUM(CASE WHEN (tra_vencimiento_licencia_conducir is NOT null and tra_vencimiento_licencia_conducir != '0000-00-00' AND tra_vencimiento_licencia_conducir <= curdate()) THEN 1 ELSE 0 END) as novigenteL,
SUM(CASE WHEN (tra_vencimiento_licencia_conducir is null or tra_vencimiento_licencia_conducir = '0000-00-00') THEN 1 ELSE 0 END) as SinInfoL
FROM `min_trabajador` WHERE eess_rut = '$eess' AND car_id = 4
    ";

$resultado = $mysqli->query($myquery);

$row = $resultado ->fetch_assoc();
?>

[
{
"category": "Vencidos",
"column": "<?php echo $row['novigenteL']; ?>",
"color": "#ff0000"
},
{
"category": "Vigentes",
"column": "<?php echo $row['vigenteL']; ?>",
"color": "#00cc00"
},
{
"category": "S/I",
"column": "<?php echo $row['SinInfoL']; ?>",
"color": "#eeecee"
}
]