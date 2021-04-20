<?php
header('Content-Type: application/json');
extract($_GET);
include("../conexion.php");
mysqli_set_charset( $mysqli, 'utf8');


$myquery = "SELECT T.tra_apellidos, date_format(CURDATE(),'%Y-%m') as fechaP,
COUNT(CASE WHEN date_format(eva_fecha_evaluacion, '%Y-%m') = date_format(curdate(), '%Y-%m') THEN 1 END) as mes,
COUNT(CASE WHEN date_format(eva_fecha_evaluacion, '%Y-%m') <= date_format(curdate(), '%Y-%m') and date_format(eva_fecha_evaluacion, '%Y-m') > date_format(DATE_SUB(CURDATE(), INTERVAL 12 MONTH), '%Y-%m') and date_format(eva_fecha_evaluacion, '%Y-m')  > '2017-07' THEN 1 END) as ano,
CASE WHEN T.car_id = 2 THEN 10
   WHEN T.car_id = 12 THEN 15
     WHEN T.car_id = 3 THEN 5
     WHEN T.car_id = 14 THEN 5
    END as metaM
FROM min_trabajador as T
left JOIN min_evaluacion as E
ON(T.tra_rut = E.eva_evaluador)
WHERE tra_evaluador = 1 and T.eess_rut = '76885630'
GROUP BY T.tra_rut";

$resultado = $mysqli->query($myquery);
?> [ <?php 
$cont = 0;
while($row = $resultado ->fetch_assoc()){

	if ($row['fechaP'] == '2017-07') {
		$totalM = 1;
	}else if ($row['fechaP'] == '2017-08') {
		$totalM = 2;
	}else if ($row['fechaP'] == '2017-09') {
		$totalM = 3;
	}else if ($row['fechaP'] == '2017-10') {
		$totalM = 4;
	}else if ($row['fechaP'] == '2017-11') {
		$totalM = 5;
	}else if ($row['fechaP'] == '2017-12') {
		$totalM = 6;
	}else if ($row['fechaP'] == '2018-01') {
		$totalM = 7;
	}else if ($row['fechaP'] == '2018-02') {
		$totalM = 8;
	}else if ($row['fechaP'] == '2018-03') {
		$totalM = 9;
	}else if ($row['fechaP'] == '2018-04') {
		$totalM = 10;
	}else if ($row['fechaP'] == '2018-05') {
		$totalM = 11;
	}else if ($row['fechaP'] >= '2018-06') {
		$totalM = 12;
	}

	$metaA = $row['metaM']*$totalM;

	if ($cont != 0) {
		echo ',';
	}
?>



 {
    "date": "<?php echo $row['tra_apellidos']; ?>",
    "market1": <?php echo $row['ano']; ?>,
    "market2": <?php echo $metaA; ?>,
    "sales1": <?php echo $row['mes']; ?>,
    "sales2": <?php echo $row['metaM']; ?>
  }

<?php 
$cont++;
} 
?>
  ]