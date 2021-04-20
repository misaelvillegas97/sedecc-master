<?php
header('Content-Type: application/json');
extract($_GET);
include("../conexion.php");
mysqli_set_charset( $mysqli, 'utf8');

if ($eess != 'admin') {
	$where = "and E.eess_rut ='$eess'";
}else{
	$where = "";
}

if ($empresa != '') {
	$where2 = "and E.eess_rut = '$empresa'";
}else{
	$where2 = '';
}

$myquery1 = "SELECT date_format(CURDATE(),'%Y-%m') as fechaP, min(eva_fecha_evaluacion) as minFecha FROM min_evaluacion_equipos as E JOIN min_eess as EE ON(E.eess_rut = EE.eess_rut) WHERE EE.eess_estado = 1 $where2 $where";
$resultado1 = $mysqli->query($myquery1);
$row1 = $resultado1 ->fetch_assoc();

$actual = strtotime($row1['minFecha']);

$mesC = 1;
$metaM = 10;

for ($i=0; $i < 12; $i++) { 
	$mesmenos = date("Y-m", strtotime($i." month", $actual));
	$mesmas = date("Y-m", strtotime("11 month", $actual));

	if ($row1['fechaP'] ==  $mesmenos) {
		$totalM = $mesC;
	}

	if ($row1['fechaP'] > $mesmas) {
		$totalM = 12;
	}
	
	$mesC++;

	$metaA = $metaM*$totalM;
}

$myquery = "SELECT SUBSTRING_INDEX(T.tra_nombres, ' ', 1 ) as nombre, SUBSTRING_INDEX(T.tra_apellidos, ' ', 1 ) as apellido,
COUNT(CASE WHEN date_format(eva_fecha_evaluacion, '%Y-%m') = date_format(curdate(), '%Y-%m') THEN 1 END) as mes,
COUNT(CASE WHEN date_format(eva_fecha_evaluacion, '%Y-%m') <= date_format(curdate(), '%Y-%m') and date_format(eva_fecha_evaluacion, '%Y-m') > date_format(DATE_SUB(CURDATE(), INTERVAL 12 MONTH), '%Y-%m') and date_format(eva_fecha_evaluacion, '%Y-m')  > '2017-07' THEN 1 END) as ano

FROM min_trabajador as T
JOIN min_evaluacion_equipos as E
ON(T.tra_rut = E.eva_evaluador)
JOIN min_eess as EE 
ON(E.eess_rut = EE.eess_rut) 
WHERE EE.eess_estado = 1 and tra_evaluador = 1 $where2 $where
GROUP BY T.tra_rut";

$resultado = $mysqli->query($myquery);
?>[<?php 
$cont = 0;

while($row = $resultado ->fetch_assoc()){

	if ($cont != 0) {
		echo ',';
	}
?>

{
    "date": "<?php echo $row['nombre'].' '.$row['apellido']; ?>",
    "market1": <?php echo $row['ano']; ?>,
    "market2": <?php echo $metaA; ?>,
    "sales1": <?php echo $row['mes']; ?>,
    "sales2": <?php echo $metaM; ?>

}
<?php 
$cont++;
} 
?>
]