<?php 
  //tomamos los datos del archivo conexion.php  
include("../conexion.php");
mysqli_set_charset( $mysqli, 'utf8');
//se envia la consulta  
extract($_GET);

$myquery = "SELECT *, date_format(reu_tiempo, '%d-%m-%Y') as fechaE 
FROM min_reunion as r 
join min_eess es on(r.eess_rut = es.eess_rut)
JOIN min_trabajador as t ON(r.reu_evaluador = t.tra_rut)
WHERE r.reu_id = '$id'";
            $resultado = $mysqli->query($myquery);
            $row = $resultado ->fetch_assoc();
?>
  
  <style type="text/css">
  table.page_header {width: 100%; border: none; padding: 0mm}
    td {
    color: #222222;
  }
   
  </style>
   <page backtop="31mm" backbottom="12mm" backleft="15mm" backright="15mm" style="font-size: 12pt;">
     <page_header>
		<table class="page_header" style="padding-top: 10px; border-bottom: 7px solid #176897; background-color: #f7931d;">
		<tr>
			<td style="width: 30%; text-align: left; border-left-width:30;">
			<img src="../img/logopdf.png" width="125px;"> 
			</td>
			<td style="width: 45%; text-align: center; font-size: 20px; color: white; height: 90px;">
				 INFORME DE BITACORA
			</td>
			<td style="width: 20%; text-align: right; border-left-width:30;">
				
			</td>
			<td style="width: 5%;">
			</td>

		</tr>
		</table>
		</page_header>

    <page_footer>
        <table class="page_footer">
            <tr>
                <td style="width: 33%; text-align: left;">
                    
                </td>
                <td style="width: 34%; text-align: center; font-size: 10px;">
                    pagina [[page_cu]]/[[page_nb]]
                </td>
                
            </tr>
        </table>
    </page_footer>
    
   


    <table  style="font-size:11px;">
               
    

<?php  
            echo "<tr>";   
            echo "<td>";
            echo "<table >";

   echo "<tr>                                                       
           <td class='th-sortable' data-toggle='class' style='text-align: left; width:115;'>Rut EESS</td>
           <td width='228'>: ".$row['eess_rut']."</td> 

           <td class='th-sortable' data-toggle='class' style='text-align: left; width:115;'>ID</td>
           <td width='228'>: ".strtoupper($row['reu_correlativo'])."</td> 

        </tr>
         <tr>  
           <td class='th-sortable' data-toggle='class' style='text-align: left; width:115;'>Nombre EESS</td>
           <td width='228'>: ".strtoupper($row['eess_razon_social'])."</td> 

           <td class='th-sortable' data-toggle='class' style='text-align: left; width:115;'>Fecha</td>
           <td width='228'>: ".$row['fechaE']."</td> 

        </tr>
         <tr>         
           <td class='th-sortable' data-toggle='class' style='text-align: left; width:115;'>Representante Legal</td>
           <td width='228'>: ".strtoupper($row['eess_representante'])."</td> 

          <td class='th-sortable' data-toggle='class' style='text-align: left; width:115;'>Ubicación</td>
           <td width='228'>: ".strtoupper($row['reu_lugar'])."</td>

        </tr>
        <tr>         
           <td class='th-sortable' data-toggle='class' style='text-align: left; width:115;'>APR</td>
           <td width='228'>: ".strtoupper($row['eess_apr'])."</td> 

           <td class='th-sortable' data-toggle='class' style='text-align: left; width:115;'>Area</td>
           <td width='228'>: ".$row['reu_area']."</td> 
        </tr>
         <tr>         
           <td class='th-sortable' data-toggle='class' style='text-align: left; width:115;'>Jefe de Area</td>
           <td width='228'>: ".strtoupper($row['reu_jefe_area'])."</td> 

           <td class='th-sortable' data-toggle='class' style='text-align: left; width:115;'>Georeferencia</td>
           <td width='228'>: ".$row['reu_geo_x']." , ".$row['reu_geo_y']."</td> 
        </tr>
         <tr>         
           <td class='th-sortable' data-toggle='class' style='text-align: left; width:115;'>Gerente Operaciones</td>
           <td width='228'>: ".strtoupper($row['reu_gerente_operaciones'])."</td> 

           <td class='th-sortable' data-toggle='class' style='text-align: left; width:115;'>Ejecutor de la Actividad</td>
           <td width='228'>: ".strtoupper($row['tra_nombres'].' '.$row['tra_apellidos'])."</td> 
        </tr>
        <tr>
        <td style='height: 10px;'>

        </td>
        </tr>
        <tr>         
           <td class='th-sortable' valign='top' data-toggle='class' style='text-align: left; width:115;'>Participantes</td>
           <td colspan='3' width='571'>: ".strtoupper($row['reu_participantes'])."</td>            
        </tr>";
/* <td width='228'>: ".strtoupper(ereg_replace(',',', <br> ',$row['reu_participantes']))."</td>  */
echo "</table>";
echo "</td>";
echo "</tr>";

        echo"<tr><td style='height: 10px;'></td></tr>";
        echo"<tr><td bgcolor='#176897' style='padding-top: 5px; padding-bottom: 5px; color: white; text-align: center; font-size: 14px; font : black; border-radius: 10px;'>DESCRIPCIÓN</td></tr>";
        echo"<tr><td style='height: 10px;'></td></tr>";

        echo" <tr>         
                <td align='justify'>".strtoupper($row['reu_descripcion'])."</td> 
              </tr>";


$myquery5 = "SELECT eess_logo FROM min_eess WHERE eess_rut = '".$row['eess_rut']."'";
            $resultado5 = $mysqli->query($myquery5);
            $row5 = $resultado5 ->fetch_assoc();

/*
echo"<tr><td style='text-align: center; font-size: 14px;'>OBSERVACIONES</td></tr>";
echo"<tr><td style='height: 10px;'></td></tr>";
*/

echo"<tr><td style='height: 10px;'></td></tr>";
echo"<tr><td bgcolor='#176897' style='padding-top: 5px; padding-bottom: 5px; color: white; text-align: center; font-size: 14px; font : black; border-radius: 10px;'>ACUERDOS</td></tr>";
echo"<tr><td style='height: 10px;'></td></tr>";

$myquery2 = "SELECT *, date_format(acu_plazo, '%d-%m-%Y') as fechaP FROM min_reunion_acuerdo where reu_id = '$id'";
            $resultado2 = $mysqli->query($myquery2);
            $cont_acuerdo = 0;
      while($row2 = $resultado2 ->fetch_assoc()){  
        $today = date("Y-m-d"); //$today = date("Y-m-d H:i");
        $cont_acuerdo++;
        if ($row2['acu_seguimiento'] == 0 and $row2['acu_plazo'] < $today) {
          $semaforo = "<img style='height:25px;' src='../images/semaforo_rojo.png'>";
        }else if ($row2['acu_seguimiento'] == 0 and $row2['acu_plazo'] >= $today) {
          $semaforo = "<img style='height:25px;' src='../images/semaforo_amarillo.png'>";
        }else if ($row2['acu_seguimiento'] == 1) {
          $semaforo = "<img style='height:25px;' src='../images/semaforo_verde.png'>";
        }

echo "<tr>";   
echo "<td>";
echo "<table style='font-size: 12px; border-collapse: collapse;'>"; 

  echo "      <tr bgcolor='#DCDCDC'>";                                                       
  echo "        <td class='th-sortable' data-toggle='class' style='text-align: left; width:510;'>Acuerdo ".$cont_acuerdo."</td>  ";   
  echo "        <td class='th-sortable' data-toggle='class' align='center' style='text-align: center; width:100;'>Plazo</td>   ";
  echo "        <td class='th-sortable' data-toggle='class' align='center' style='text-align: center; width:100;'>Seguimiento</td>   ";
  echo "       </tr>";
 
  echo "      <tr> ";
  echo "        <td width='500'>".$row2['acu_descripcion']."</td>";
  echo "        <td width='100' align='center'>".$row2['fechaP']."</td> "; 
  echo "        <td width='100' align='center'>".$semaforo."</td> ";                
  echo "      </tr>";


echo "     <tr  >";    


$myquery3 = "SELECT * FROM min_reunion_mensaje where acu_id = ".$row2['acu_id'];
            $resultado3 = $mysqli->query($myquery3);
            echo "<td colspan='3'>";

while($row3 = $resultado3 ->fetch_assoc()){   

echo "<table style='font-size: 12px; border-collapse: collapse;'>";
/*
  echo "    <tr>";
  echo"     <td colspan='3'  height='6' align='right'>".$row2['fecha']."</td>";
  echo"   </tr>";
*/ 

 $conteo = "SELECT count(*) as cont FROM min_reunion_imagen where ms_id = ".$row3['ms_id'];
            $conteo1 = $mysqli->query($conteo);
            
	$cont = $conteo1 ->fetch_assoc(); 

if ($row3['ms_tipo'] == 1) {
  $color = '#DCDCDC';
  $logo = "<img src='../images/logo2-chat.gif' style='width: 10mm'>";
}else{
  $color = '#edf4f7';
  $logo = "<img src='".$row5['logo']."' style='width: 10mm'>";
}

if ($cont['cont'] != 0) {
	$myquery4 = "SELECT *, LEFT(img_foto,10) as img FROM et_reunion_imagen where ms_id = ".$row3['ms_id'];
    $resultado4 = $mysqli->query($myquery4);  

    echo "    <tr bgcolor='".$color."'>";       
	echo "      <td width='50'>".$logo."</td>";
	echo "      <td width='444'  align='left'>".$row3['ms_mensaje']."</td>";
	echo "      <td width='205'  align='left'>";
	while($row4 = $resultado4 ->fetch_assoc()){   
  
  if ($row4['img'] == 'data:image') {
	echo "			<img src=".$row4['img_foto']." style='width: 10mm'>"; //Se repite la imagen
  }elseif($row4['img'] == 'data:appli'){
  echo "      <img src='../images/pdf-m2.jpg' style='width: 10mm'>"; //Se repite la imagen
  }

	}
	echo " 		</td>";
	echo "    </tr>";	
}else{
	echo "    <tr bgcolor='".$color."'>";       
	echo "      <td width='50'>".$logo."</td>";
	echo "      <td width='653'  align='left'>".$row3['ms_mensaje']."</td>";
	echo "    </tr>";
}

  echo"     </table>"; 

    }

  echo"     </td>"; 
  echo"     </tr>"; 

  echo "</table>"; 
  echo "</td>";
  echo "</tr>";  

echo "      <tr>";
echo "        <td height='15'></td> "; 
echo "      </tr>";
 }

?>  

</table>

</page>
<?php if (strlen($row['reu_foto']) > 30) { ?>
   <page backtop="31mm" backbottom="12mm" backleft="15mm" backright="15mm" style="font-size: 12pt;">
     <page_header>
		<table class="page_header" style="padding-top: 10px; border-bottom: 7px solid #176897; background-color: #f7931d;">
		<tr>
			<td style="width: 30%; text-align: left; border-left-width:30;">
			<img src="../img/logopdf.png" width="125px;"> 
			</td>
			<td style="width: 45%; text-align: center; font-size: 20px; color: white; height: 90px;">
				 INFORME DE BITACORA
			</td>
			<td style="width: 20%; text-align: right; border-left-width:30;">
				
			</td>
			<td style="width: 5%;">
			</td>

		</tr>
		</table>
		</page_header>

    <page_footer>
        <table class="page_footer">
            <tr>
                <td style="width: 33%; text-align: left;">
                    
                </td>
                <td style="width: 34%; text-align: center; font-size: 10px;">
                    pagina [[page_cu]]/[[page_nb]]
                </td>
                
            </tr>
        </table>
    </page_footer>
    
   


	<table  style="font-size:11px;">
   
     <tr><td style='height: 10px;'></td></tr>
     <tr><td bgcolor='#176897' style='width: 700px; padding-top: 5px; padding-bottom: 5px; color: white; text-align: center; font-size: 14px; font : black; border-radius: 10px;'>IMAGEN ADJUNTA</td></tr>
     <tr><td style='height: 10px;'></td></tr>
   <tr align="center">
   	<td>
   		<?php 
   		echo "<img src='".$row['reu_foto']."' style='width: 300px'>";
   		?>
   	</td>
   </tr>

	</table>

	</page>
	<?php } ?>
