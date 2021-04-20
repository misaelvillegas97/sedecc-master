<?php

 include("../../conexion.php");
    mysqli_set_charset( $mysqli, 'utf8');
    $sql = "SELECT * from factura";
    $result = mysqli_query($mysqli, $sql)or die (mysqli_error());  
?>
<script language="JavaScript"> 
<!-- 
var nav4 = window.Event ? true : false; 
function acceptNum(evt){  
// NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57  
var key = nav4 ? evt.which : evt.keyCode;  
return (key <= 13 || (key >= 48 && key <= 57)); 
} 
//--> 
</script>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8"/>
	<title>modificar</title>
	<link rel="stylesheet" type="text/css" href="estilos.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="modificar.js"></script>
</head>
<body>
	<section>
		<nav class="menu2">		
		</nav>
		<h1>MODIFICAR Y/O ELIMINAR</h1>
		<table width="100%">
			<tr>
				<td>id_rango</td>
				<td>rango por trabajador</td>
				<td>fijo UF</td>
				<td>variable UF / trabajador</td>
				<td>checklist<td>
			</tr>
		<?php 
			 while($row = $result ->fetch_assoc()){
				echo '
				<tr>
					<td><input type="number" class="id_rango"  value="'.$row['id_rango'].'"></td>
					<td><input type="number" class="rango_trabajador" value="'.$row['rango_trabajador'].'"></td>
					<td><input type="number" class="fijo_uf" value="'.$row['fijo_uf'].'"></td>
					<td><input type="number" class="variableuf_tra" value="'.$row['variableuf_tra'].'"></td>
					<td><input type="number" class="checklist" value="'.$row['checklist'].'"></td>
					<td><button class="eliminar" data-id="'.$row['id_rango'].'">Eliminar</button></td>
					<td><button class="modificar" data-id="'.$row['id_rango'].'">Modificar</button></td>
				</tr>
				';
			}
		?>
	</table>
	</section>
</body>
</html>