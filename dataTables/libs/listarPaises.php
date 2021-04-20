 <?php
 extract($_GET);
    include("../../conexion.php");
    mysqli_set_charset( $mysqli, 'utf8');
$sql = "SELECT p.*, COUNT(*) AS trabajadores FROM min_trabajador as t
JOIN (SELECT s.eess_rut, s.eess_nombre_corto, COUNT(*) AS checklist
FROM min_eess as s 
JOIN min_check_activo AS c ON(s.eess_rut = c.act_eess)
WHERE eess_estado =1 
GROUP BY s.eess_rut)AS p
on (t.eess_rut = p.eess_rut)
GROUP BY t.eess_rut";


                

  

    $result = mysqli_query($mysqli, $sql)or die (mysqli_error());  

    //$empresa = '';

?>
<script type="text/javascript">
	$.getJSON('https://mindicador.cl/api', function(data) {
    var dailyIndicators = data;
    $("<p/>", {
        html: 'El valor actual de la UF es $' + dailyIndicators.uf.valor
    }).appendTo("body");
}).fail(function() {
    console.log('Error al consumir la API!');
});
</script>
<?php
$apiUrl = 'https://mindicador.cl/api';
//Es necesario tener habilitada la directiva allow_url_fopen para usar file_get_contents
if ( ini_get('allow_url_fopen') ) {
    $json = file_get_contents($apiUrl);
} else {
    //De otra forma utilizamos cURL
    $curl = curl_init($apiUrl);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($curl);
    curl_close($curl);
}
 
$dailyIndicators = json_decode($json);
echo 'UF  $' . $dailyIndicators->uf->valor;
$valor_uf= $dailyIndicators->uf->valor;

?>

 <script type="text/javascript" language="javascript" src="js/jslistadopaises.js"></script>



            <table cellpadding="0" cellspacing="0" border="0" class="display" id="tabla_lista_paises" style="background-color: orange;color: black;">
                <thead>
                    <tr>
                        <th>rut eess</th><!--Estado-->
                        <th>nombre eess</th>
                        <th>n° trabajadores</th>
                         <th>valor por trabajadores</th>
                        <th>n° CheckList</th>
                        <th>Valor CheckList</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                         <th></th>
                        <th></th>
                     
                    </tr>
                </tfoot>
                  <tbody align="center">
                    <?php

     
                       while($fila = $result ->fetch_assoc())
                       {
                       	if ($fila["trabajadores"]<= 100) {
                       		  $valor_tra= $valor_uf * 0.020;
                       	} else if ($fila["trabajadores"]>100 && $fila["trabajadores"]<=200) {
                       		  $valor_tra= $valor_uf * 0.018;
                       	} else if ($fila["trabajadores"]>200) {
                       		  $valor_tra= $valor_uf * 0.016;
                        }
                        //Ocupamos el switch para contar la cantidad de trabajadores, y dependiendo el caso, es el cobro por trabajador que se efectue
                        switch ($fila["trabajadores"]) {
                        	//se recomienda que todo estos indicadores esten en una tabla aparte, asi al momento de hacer
                        	 	 //el calculo, se modifiquen automaticamente.
    									case ($fila["trabajadores"] <=100):
    											//Hay que ver si tiene el numero checklist, ya que si son mas de 5 se puede cobrar, sino, no
								        		//el valor del total para los 100, se le restan esos 5 al total del checklist y mostramos ese total en UF
				                        	 	 $checkprecio = $fila["checklist"];
				                        	 	 if ($checkprecio > 5) {
				                        	 	 	# code...
				                        	 	 $checkprecio = $checkprecio - 5 ;
				                        	 	 //$checkprecio = 1* $checkprecio;
				                        	 	 $valor_uf = $valor_uf * 1; 
				                        	 	 $checkprecio = $checkprecio * $valor_uf;
				                        	 	 }
				                        	 	 else{
				                        	 	 	//Si es igual a 5 o menor, no se efectua el cobro
				                        	 	 	$checkprecio = 0;

				                        	 	 }
				                        	 	 
				                        	 	 
								        		break;
								   		case ($fila["trabajadores"]>100 && $fila["trabajadores"] <=200):
								        		$checkprecio = $fila["checklist"];
				                        	 	 if ($checkprecio > 5) {
				                        	 	 	# code...
				                        	 	 	$checkprecio = $checkprecio - 5 ;
				                        	 		$valor_uf = $valor_uf * 1; 
				                        	 	 $checkprecio = $checkprecio * $valor_uf;
				                        	 	 }
				                        	 	 else{
				                        	 	 	//Si es igual a 5 o menor, no se efectua el cobro
				                        	 	 	$checkprecio = 0;

				                        	 	 }
								        		break;
								    	case ($fila["trabajadores"]>200 && $fila["trabajadores"] <=300):
								        		$checkprecio = $fila["checklist"];
				                        	 	 if ($checkprecio > 10) {
				                        	 	 	# code...
				                        	 	 $checkprecio = $checkprecio - 10 ;
				                        	 	 $$valor_uf = $valor_uf * 0.5; 
				                        	 	 $checkprecio = $checkprecio * $valor_uf;
				                        	 	 }
				                        	 	 else{
				                        	 	 	//Si es igual a 10 o menor, no se efectua el cobro
				                        	 	 	$checkprecio = 0;

				                        	 	 }
								        		break;
								        case ($fila["trabajadores"]>300 && $fila["trabajadores"] <=400):
								        		$checkprecio = $fila["checklist"];
				                        	 	 if ($checkprecio > 15) {
				                        	 	 	# code...
				                        	 	 	$checkprecio = $checkprecio - 15 ;
					                        	 	$valor_uf = $valor_uf * 0.5; 
					                        	 	$checkprecio = $checkprecio * $valor_uf;
				                        	 	 }
				                        	 	 else{
				                        	 	 	//Si es igual a 15 o menor, no se efectua el cobro
				                        	 	 	$checkprecio = 0;

				                        	 	 }
				                        	 	 break;
								        case ($fila["trabajadores"]>400 && $fila["trabajadores"] <=500):
								        		$checkprecio = $fila["checklist"];
				                        	 	 if ($checkprecio > 20) {
				                        	 	 	# code...
				                        	 	 	$checkprecio = $checkprecio - 20 ;
				                        	 	 /*$valor_uf = $valor_uf * 1; 
				                        	 	 $checkprecio = $checkprecio * $valor_uf;*/
				                        	 	 $checkprecio = "consultar";
				                        	 	 }
				                        	 	 else{
				                        	 	 	//Si es igual a 20 o menor, no se efectua el cobro
				                        	 	 	$checkprecio = 0;

				                        	 	 }
				                        	 	 break;
								         case ($fila["trabajadores"]>500):
								        		$checkprecio = $fila["checklist"];
				                        	 	 if ($checkprecio > 25) {
				                        	 	 	# code...
				                        	 	 	$checkprecio = $checkprecio - 25 ;
				                        	 	 /*$valor_uf = $valor_uf * 1; 
				                        	 	 $checkprecio = $checkprecio * $valor_uf;*/
				                        	 	 $checkprecio = "consultar";
				                        	 	 }
				                        	 	 else{
				                        	 	 	//Si es igual a 20 o menor, no se efectua el cobro
				                        	 	 	$checkprecio = 0;

				                        	 	 }
								        		break;
												}





                        

                        
                        


                               echo '<tr>';
                               echo '<td >'.$fila['eess_rut'].'</td>';
                               echo '<td>'.$fila['eess_nombre_corto'].'</td>';
                                echo '<td>'.$fila['trabajadores'].'</td>';
                                 echo '<td>'.$fila['trabajadores']*$valor_tra.'</td>';
                                 echo '<td>'.$fila['checklist'].'</td>';
                                 echo '<td>'.$checkprecio.'</td>';
                               echo '</tr>';
                     
                        }
                    ?>
                    <?php


                    ?>
                <tbody>
            </table>
