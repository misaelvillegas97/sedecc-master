<a href=""></a>
<?php 
//----------------- INICIO NOTIFICACION RESPUESTA --------------------------

	extract($_GET);
	include("conexion.php");
	mysqli_set_charset( $mysqli, 'utf8');
	$sql='';
	
	// Reviso el tipo, si es un cron diario o de aviso semanal de vencidas
	switch ($tipo) {
		// En caso de ser diario, genero la correspondiente sql para identificar todos los registros próximas
		// a vencer dentro de 2 días
		// También identifico las ya vencidas del día anterior para notificar
		case 'diario':
			$sql = "SELECT 
					eess.eess_nombre_corto,
					mc.mc_plazo,
					mcl.mcl_descripcion
					FROM min_medidas_control mc
					JOIN min_medidas_control_list mcl on mcl.mcl_id=mc.mcl_id
					JOIN min_causas_inmediatas ci on ci.ci_id=mc.ci_id
					JOIN min_causas_basicas cb on cb.cb_id=ci.cb_id
					JOIN min_accidente acc on acc.id_accidente=cb.acc_id
					JOIN min_eess eess on eess.eess_rut=acc.eess_rut
					WHERE 
					mc.mc_plazo = DATE(DATE_ADD(NOW(), INTERVAL +2 DAY))AND
					(mc.mc_semaforo=0 or mc.mc_semaforo=1)";
					
					
			$sql2= "SELECT eess.eess_nombre_corto,mc.mc_plazo,mcl.mcl_descripcion
					FROM min_medidas_control mc
					JOIN min_medidas_control_list mcl on mcl.mcl_id=mc.mcl_id
					JOIN min_causas_inmediatas ci on ci.ci_id=mc.ci_id
					JOIN min_causas_basicas cb on cb.cb_id=ci.cb_id
					JOIN min_accidente acc on acc.id_accidente=cb.acc_id
					JOIN min_eess eess on eess.eess_rut=acc.eess_rut
					WHERE 
					mc.mc_plazo = DATE(NOW() - INTERVAL 1 DAY) AND
					(mc.mc_semaforo=0 or mc.mc_semaforo=1)";
					
			// Recorremos la primera query, para posteriormente enviar correos de alerta por 
			// vencimiento próximo en 2 días
			$result = mysqli_query($mysqli, $sql)or die (mysqli_error());  
		    //$empresa = '';
		    while($fila = $result ->fetch_assoc()){
		
		         // Varios destinatarios
				$para = 'gustavoogueda@innoapsion.cl';
		
				// título
				$título = 'Vencimiento próximo de medida de control ';
				
				// mensaje
				$mensaje = '
				<html>
				<head>
				  
				</head>
				<body>
				
				<tr>
				<table>
				
				<tr>
				<td>Señores '.$fila['eess_nombre_corto'].'</td>
				</tr>
				<tr>
				<td></td>
				</tr>
				
				<br>
				
				<tr>
				<td>Informamos a usted que el '.$fila['mc_plazo'].' vencerá el plazo de control de la siguiente medida de control:</td>
				</tr>
				
				<br>
				
				<tr>
				<td>'.$fila['mcl_descripcion'].'</td>
				</tr>
				
				<br>
				
				 <tr>
				<td>Con el objetivo de evitar incumplimientos, le recomendamos dar solución en el plazo establecido.</td>
				</tr>
				
				<br>
				
				<tr>
				<td>Atte.</td>
				</tr>
				 <tr>
				<td>Innoapsion</td>
				</tr>
				
				  </table>
				  </tr>
				</body>
				</html>
				';
				
				// Para enviar un correo HTML, debe establecerse la cabecera Content-type
				$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
				$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				
				// Cabeceras adicionales
				//$cabeceras .= 'To: Sebastian <sebastiancarcamo@innoapsion.cl>' . "\r\n";
				$cabeceras .= 'From: Sedecc <sedecc@innoapsion.cl>' . "\r\n";
				//$cabeceras .= 'Cc:  sebastiancarcamo@innoapsion.cl' . "\r\n";
				$cabeceras .= 'Bcc:eduardoacevedo@innoapsion.cl, gustavoogueda@innoapsion.cl' . "\r\n";
				$cabeceras .= "Content-Type: text/html; charset=UTF-8". "\r\n";
				
				
				// Enviarlo
				mail(utf8_decode($para), utf8_decode($título), utf8_decode($mensaje), utf8_decode($cabeceras));
		
			}

			// Recorremos la segunda query, para posteriormente enviar correos de alerta por 
			// vencimiento de plazos del día anterior
			$result = mysqli_query($mysqli, $sql2)or die (mysqli_error());  
		    //$empresa = '';
		    while($fila = $result ->fetch_assoc()){
		
		         // Varios destinatarios
				$para = 'gustavoogueda@innoapsion.cl';
		
				// título
				$título = 'Vencimiento de plazo de medida de control ';
				
				// mensaje
				$mensaje = '
				<html>
				<head>
				  
				</head>
				<body>
				
				<tr>
				<table>
				
				<tr>
				<td>Señores '.$fila['eess_nombre_corto'].'</td>
				</tr>
				<tr>
				<td></td>
				</tr>
				
				<br>
				
				<tr>
				<td>Informamos a usted que el '.$fila['mc_plazo'].' venció el plazo de control de la siguiente medida de control:</td>
				</tr>
				
				<br>
				
				<tr>
				<td>'.$fila['mcl_descripcion'].'</td>
				</tr>
				
				<br>
				
				 <tr>
				<td>Con el objetivo de informar, le recomendamos regularizar esta situación.</td>
				</tr>
				
				<br>
				
				<tr>
				<td>Atte.</td>
				</tr>
				 <tr>
				<td>Innoapsion</td>
				</tr>
				
				  </table>
				  </tr>
				</body>
				</html>
				';
				
				// Para enviar un correo HTML, debe establecerse la cabecera Content-type
				$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
				$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				
				// Cabeceras adicionales
				//$cabeceras .= 'To: Sebastian <sebastiancarcamo@innoapsion.cl>' . "\r\n";
				$cabeceras .= 'From: Sedecc <sedecc@innoapsion.cl>' . "\r\n";
				//$cabeceras .= 'Cc:  sebastiancarcamo@innoapsion.cl' . "\r\n";
				$cabeceras .= 'Bcc:eduardoacevedo@innoapsion.cl, gustavoogueda@innoapsion.cl' . "\r\n";
				$cabeceras .= "Content-Type: text/html; charset=UTF-8". "\r\n";
				
				
				// Enviarlo
				mail(utf8_decode($para), utf8_decode($título), utf8_decode($mensaje), utf8_decode($cabeceras));
		
			}
			break;
		case 'semanal':
		
			// En caso de ser semanal, revisamos todas las posibles medidas de control vencidas y alertamos
			// mediante envío de correo a las EE.SS involucradas
			$sql='SELECT eess.eess_nombre_corto,mc.mc_plazo,mcl.mcl_descripcion
					FROM min_medidas_control mc
					JOIN min_medidas_control_list mcl on mcl.mcl_id=mc.mcl_id
					JOIN min_causas_inmediatas ci on ci.ci_id=mc.ci_id
					JOIN min_causas_basicas cb on cb.cb_id=ci.cb_id
					JOIN min_accidente acc on acc.id_accidente=cb.acc_id
					JOIN min_eess eess on eess.eess_rut=acc.eess_rut
					WHERE 
					mc.mc_plazo < CURRENT_DATE() AND
					(mc.mc_semaforo=0 or mc.mc_semaforo=1)';
					
			// Recorremos la query, para posteriormente enviar correos de alerta por 
			// vencimiento de plazos 
			$result = mysqli_query($mysqli, $sql2)or die (mysqli_error());  
		    //$empresa = '';
		    while($fila = $result ->fetch_assoc()){
		
		         // Varios destinatarios
				$para = 'gustavoogueda@innoapsion.cl';
		
				// título
				$título = 'Vencimiento de plazo de medida de control ';
				
				// mensaje
				$mensaje = '
				<html>
				<head>
				  
				</head>
				<body>
				
				<tr>
				<table>
				
				<tr>
				<td>Señores '.$fila['eess_nombre_corto'].'</td>
				</tr>
				<tr>
				<td></td>
				</tr>
				
				<br>
				
				<tr>
				<td>Informamos a usted que el '.$fila['mc_plazo'].' venció el plazo de control de la siguiente medida de control:</td>
				</tr>
				
				<br>
				
				<tr>
				<td>'.$fila['mcl_descripcion'].'</td>
				</tr>
				
				<br>
				
				 <tr>
				<td>Con el objetivo de informar, le recomendamos regularizar esta situación.</td>
				</tr>
				
				<br>
				
				<tr>
				<td>Atte.</td>
				</tr>
				 <tr>
				<td>Innoapsion</td>
				</tr>
				
				  </table>
				  </tr>
				</body>
				</html>
				';
				
				// Para enviar un correo HTML, debe establecerse la cabecera Content-type
				$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
				$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				
				// Cabeceras adicionales
				//$cabeceras .= 'To: Sebastian <sebastiancarcamo@innoapsion.cl>' . "\r\n";
				$cabeceras .= 'From: Sedecc <sedecc@innoapsion.cl>' . "\r\n";
				//$cabeceras .= 'Cc:  sebastiancarcamo@innoapsion.cl' . "\r\n";
				$cabeceras .= 'Bcc:eduardoacevedo@innoapsion.cl, gustavoogueda@innoapsion.cl' . "\r\n";
				$cabeceras .= "Content-Type: text/html; charset=UTF-8". "\r\n";
				
				
				// Enviarlo
				mail(utf8_decode($para), utf8_decode($título), utf8_decode($mensaje), utf8_decode($cabeceras));
		
			}
			
			break;

	}
 	   
  ?>