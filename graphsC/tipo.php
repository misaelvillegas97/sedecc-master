<?php
header('Content-Type: application/json');
extract($_GET);
include("../conexionQ.php");
mysqli_set_charset( $mysqli, 'utf8');
?>

[
{
"valor1": 10,
"valor2": 20
}
]