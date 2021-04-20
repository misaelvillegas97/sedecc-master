<?php 

// Uso/sintax: 
// genera_password (longitud password en caracteres o digitos, [tipo=alfanumerico|numerico]) 
// Si no indicas $tipo se asume como por defecto alfanumerico. 

function genera_password($longitud,$tipo="alfanumerico"){ 

    if ($tipo=="alfanumerico"){ 
        $exp_reg="[^A-Z0-9]"; 
    } elseif ($tipo=="numerico"){ 
        $exp_reg="[^0-9]"; 
    } 
     
    return substr(eregi_replace($exp_reg, "", md5(rand())) . 
       eregi_replace($exp_reg, "", md5(rand())) . 
       eregi_replace($exp_reg, "", md5(rand())), 
       0, $longitud); 
} 

	//Ejemplo: 
	extract($_GET);
    include("conexion.php");
    mysqli_set_charset( $mysqli, 'utf8');
  	$sql = "SELECT * FROM min_eess";
    $result = mysqli_query($mysqli, $sql)or die (mysqli_error());  
    while($fila = $result ->fetch_assoc()){

    	$sql2 = "UPDATE min_eess SET eess_clave = '".genera_password(8)."' WHERE eess_rut = '".$fila['eess_rut']."' ";
    	$result2 = mysqli_query($mysqli, $sql2)or die (mysqli_error()); 

		//echo "Password: ".$fila['eess_rut']." ".genera_password(8)."<br>"; 
	}

?>