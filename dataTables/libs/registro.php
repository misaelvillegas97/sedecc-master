<?php

$db_host="localhost";

$db_user="innoapsi_conbd";

$db_password="conbd1029384756";

$db_name="innoapsi_sedecc";

$db_table_name="factura";

   $db_connection = mysql_connect($db_host, $db_user, $db_password);



if (!$db_connection) {

	die('No se ha podido conectar a la base de datos');

}

$subs_id = ($_POST['id_rango']);

$subs_rango = ($_POST['rango_trabajador']);

$subs_fijo =($_POST['fijo_uf']);

$subs_variableuf = ($_POST['variableuf_tra']);

$checklist =($_POST['checklist']);



$resultado=mysql_query("SELECT * FROM ".$db_table_name." WHERE rango_trabajador = '".$subs_rango."'", $db_connection);



if (mysql_num_rows($resultado)>0)

{



header('Location: Fail.html');



} else {

	
//echo $subs_variableuf;
	$insert_value = 'INSERT INTO ' . $db_name . '.'.$db_table_name.' (id_rango, rango_trabajador , fijo_uf, variableuf_tra, checklist) VALUES ("' . $subs_id . '", "' . $subs_rango . '", "' . $subs_fijo . '","'.$subs_variableuf.'","'.$checklist.'")';



mysql_select_db($db_name, $db_connection);

$retry_value = mysql_query($insert_value, $db_connection);



if (!$retry_value) {

   die('Error: ' . mysql_error());

}

	


echo '<script>alert("hola")</script>'; 
  echo "<script ; type='text/javascript'>location.href='man_rangos1.php';</script>";


}



mysql_close($db_connection);



		

?>