<?php 
	 include("../../conexion.php");
	if($_POST['Caso']=="Eliminar"){
		mysql_query("delete from factura where Id=".$_POST['Id']);
		echo 'El rango se ha eliminado';
	}

	if($_POST['Caso']=="Modificar"){
		mysql_query("update factura set id_rango='".$_POST['id_rango']."' where Id=".$_POST['Id']);
		mysql_query("update factura set rango_trabajador='".$_POST['rango_trabajador']."' where Id=".$_POST['Id']);
		mysql_query("update factura set fijo_uf='".$_POST['fijo_uf']."' where Id=".$_POST['Id']);
		mysql_query("update factura set variableuf_tra='".$_POST['variableuf_tra']."' where Id=".$_POST['Id']);
		mysql_query("update factura set checklist='".$_POST['checklist']."' where Id=".$_POST['Id']);
		echo 'El rango se ha modificado';
	}
?>