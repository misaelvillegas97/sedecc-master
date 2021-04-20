<?php
function Conectarse(){
$servidor="localhost";
$basededatos="innoapsi_axel";
$usuario="innoapsi_axel";
$clave="axel102938";
$cn=mysql_connect($servidor,$usuario,$clave) or die ("Error conectando a la base de datos");
mysql_select_db($basededatos ,$cn) or die("Error seleccionando la Base de datos");
mysql_query ("SET NAMES 'utf8'");
return $cn;
}
?>