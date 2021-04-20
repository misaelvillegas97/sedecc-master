<?php

class JsonController extends Controller
{
	public function actionIndex()
	{
		header('Content-type:application/json;charset=utf-8');
		// Descargar evaluaciones
		//echo (DateTime::createFromFormat('Y-m-d', '12-12-2000'))->format('d-m-Y');
		
		echo DateTime::createFromFormat('d-m-Y', '12-12-2000')->format('Y-m-d');
		
		echo json_encode('Test');
	}
	
	public function actionCargo(){
		header('Content-type:application/json;charset=utf-8');
		$model=new Evaluacion('search');
		$global['check_json'] = "json_valido_sedecc";
		$global['campos'] = $model->attributeLabels();
		$global['rules'] = $model->rules();
		$global['categorias'] = Yii::app()->db->createCommand("SELECT DISTINCT car_id FROM min_pregunta")->query()->readAll();
		$global['trabajador'] = Yii::app()->db->createCommand("SELECT eess_rut, tra_rut, tra_evaluador FROM min_trabajador")->query()->readAll();
		foreach ($global['categorias'] as $key => $value){
			$global['items'][$value['car_id']] = Yii::app()->db->createCommand("SELECT * FROM min_pregunta WHERE car_id = '".$value['car_id']."' ORDER BY tem_id")->query()->readAll();
		}
		$tmp = Yii::app()->db->createCommand("SELECT DISTINCT act_eess FROM min_check_activo")->query()->readAll();
		for($i=0;$i<count($tmp);$i++){
			$activos[$tmp[$i]['act_eess']] = Yii::app()->db->createCommand("SELECT DISTINCT act_car FROM min_check_activo WHERE act_eess = '".$tmp[$i]['act_eess']."'")->query()->readAll();
		}
		$activos[''] = Yii::app()->db->createCommand("SELECT DISTINCT act_car FROM min_check_activo")->query()->readAll();
		$global['activos'] = $activos;
		echo json_encode($global);
	}
	
	public function actionHistorico(){
		// Cargar página desde cache
		header('Content-type:application/json;charset=utf-8');
		if(file_exists('sedecc_historico'))
		//if(time()-filemtime('sedecc_historico') < 1){ // Actualizar siempre
		if(time()-filemtime('sedecc_historico') < (1*86400)){ // Actualizar una vez al día
			include('sedecc_historico');
			return;
		}
		header('Content-type:application/json;charset=utf-8');
		$rows = Yii::app()->db->createCommand("SELECT
			eva_id,
			eva_creado,
			eva_tipo,
			eess_rut,
			tra_rut,
			eva_apellidos,
			eva_nombres,
			eva_fecha_evaluacion,
			eva_comuna,
			eva_fundo,
			eva_faena,
			eva_cache_porcentaje
		FROM min_evaluacion")->query()->readAll();
		for($i=0;$i<count($rows);$i++){
			// Obtener resultado
			//$r_total = Yii::app()->db->createCommand("SELECT SUM(res_ponderacion) FROM min_respuesta WHERE eva_id = ".$rows[$i]['eva_id']." ")->queryScalar();
			//$r_bueno = Yii::app()->db->createCommand("SELECT SUM(res_ponderacion) FROM min_respuesta WHERE eva_id = ".$rows[$i]['eva_id']." AND res_respuesta = 'si'")->queryScalar();
			//$r_malo = Yii::app()->db->createCommand("SELECT SUM(res_ponderacion) FROM min_respuesta WHERE eva_id = ".$rows[$i]['eva_id']." AND res_respuesta = 'no'")->queryScalar();
			//$r_na = Yii::app()->db->createCommand("SELECT SUM(res_ponderacion) FROM min_respuesta WHERE eva_id = ".$rows[$i]['eva_id']." AND res_respuesta = 'n/a'")->queryScalar();
			
			//if($r_bueno+$r_malo > 0) $rows[$i]['resultado'] = round((100*($r_bueno / ($r_bueno+$r_malo))),1);
			//else $rows[$i]['resultado'] = 0;
			$rows[$i]['resultado'] = $rows[$i]['eva_cache_porcentaje'];
		}
		$global['rows'] = $rows;
		$global['check_json'] = "json_valido_sedecc";
		echo json_encode($global);
		
		$fp = fopen('sedecc_historico', 'w');
		fwrite($fp, json_encode($global));
		fclose($fp);
	}
	
	public function actionAutocompletar(){
		// Cargar página desde cache
		header('Content-type:application/json;charset=utf-8');
		if(file_exists('sedecc_autocompletar'))
		if(time()-filemtime('sedecc_autocompletar') < 1){ // Actualizar siempre
		//if(time()-filemtime('sedecc_autocompletar') < (1*86400)){ // Actualizar una vez al día
			include('sedecc_autocompletar');
			return;
		}
		$global['check_json'] = "json_valido_sedecc";
		$global['cargo'] = Yii::app()->db->createCommand("SELECT * FROM min_cargo")->query()->readAll();
		$global['trabajador'] = Yii::app()->db->createCommand("SELECT * FROM min_trabajador")->query()->readAll();
		$global['comuna'] = Yii::app()->db->createCommand("SELECT com_nombre FROM min_comuna")->query()->readAll();
		$global['fundo'] = Yii::app()->db->createCommand("SELECT fun_eess as eess_rut, fun_nombre as eva_fundo FROM min_fundo ORDER BY fun_nombre")->query()->readAll();
		$global['faena'] = Yii::app()->db->createCommand("SELECT eess_rut, fae_nombre as eva_faena FROM min_faena WHERE fae_activo = 1 ORDER BY fae_nombre")->query()->readAll();
		$global['tipo_cosecha'] = Yii::app()->db->createCommand("SELECT eva_tipo_cosecha FROM min_evaluacion GROUP BY eva_tipo_cosecha")->query()->readAll();
		echo json_encode($global);
		
		$fp = fopen('sedecc_autocompletar', 'w');
		fwrite($fp, json_encode($global));
		fclose($fp);
	}

	public function actionPendientes(){
		header('Content-type:application/json;charset=utf-8');
		$global["sedecc"] = Yii::app()->db->createCommand("
		SELECT e.tra_rut, p.pre_enunciado, r.res_observacion, r.res_plazo FROM min_respuesta r
			LEFT JOIN min_pregunta p ON (p.pre_id = r.pre_id)
			LEFT JOIN min_evaluacion e ON (e.eva_id = r.eva_id)
		WHERE res_seguimiento = 0")->queryAll();
		$global['check_json'] = "json_valido_sedecc";
		echo json_encode($global);
	}
	
	public function actionRecep(){
		header('Content-type:application/json;charset=utf-8');
		if(isset($_POST['android'])){
			//Parche para variables no definidas, util para actualizaciones
			if(!isset($_POST['android'])) $_POST['android']='';
			if(!isset($_POST['timestamp'])) $_POST['timestamp']='';
			if(!isset($_POST['lat'])) $_POST['lat']='';
			if(!isset($_POST['lon'])) $_POST['lon']='';
			if(!isset($_POST['tim'])) $_POST['tim']='';
			if(!isset($_POST['categoria'])) $_POST['categoria']='';
			if(!isset($_POST['items'])) $_POST['items']='';
			if(!isset($_POST['respuestas'])) $_POST['respuestas']='';
			if(!isset($_POST['observaciones'])) $_POST['observaciones']='';
			if(!isset($_POST['fotos'])) $_POST['fotos']='';
			if(!isset($_POST['fechas'])) $_POST['fechas']='';
			
			if(!isset($_POST['eess_rut'])) $_POST['eess_rut']='';
			if(!isset($_POST['tra_rut'])) $_POST['tra_rut']='';
			if(!isset($_POST['eva_apellidos'])) $_POST['eva_apellidos']='';
			if(!isset($_POST['eva_nombres'])) $_POST['eva_nombres']='';
			if(!isset($_POST['eva_comuna'])) $_POST['eva_comuna']='';
			if(!isset($_POST['eva_fundo'])) $_POST['eva_fundo']='';
			if(!isset($_POST['eva_faena'])) $_POST['eva_faena']='';
			if(!isset($_POST['eva_jefe_faena'])) $_POST['eva_jefe_faena']='';
			if(!isset($_POST['eva_supervisor'])) $_POST['eva_supervisor']='';
			if(!isset($_POST['eva_apr'])) $_POST['eva_apr']='';
			if(!isset($_POST['eva_linea'])) $_POST['eva_linea']='';
			if(!isset($_POST['eva_vencimiento_corma'])) $_POST['eva_vencimiento_corma']='';
			
			if(!isset($_POST['eva_licencia_conducir_clase'])) $_POST['eva_licencia_conducir_clase']='';
			if(!isset($_POST['eva_licencia_conducir_vencimiento'])) $_POST['eva_licencia_conducir_vencimiento']='';
			
			if(!isset($_POST['eva_tipo_cosecha'])) $_POST['eva_tipo_cosecha']='';
			if(!isset($_POST['eva_general_observacion'])) $_POST['eva_general_observacion']='';
			if(!isset($_POST['eva_evaluador'])) $_POST['eva_evaluador']='';
			if(!isset($_POST['eva_cargo'])) $_POST['eva_cargo']='';
			
			// Crear archivo con información recibida
			$myfile = fopen("recep/".$_POST['android'].$_POST['timestamp'], "w") or die("Unable to open file!");
			$content = json_encode(
				array(
					// Variables fijas
					'android'=>$_POST['android'],
					'timestamp'=>$_POST['timestamp'],
					'lat'=>$_POST['lat'],
					'lon'=>$_POST['lon'],
					'tim'=>$_POST['tim'],
					'categoria'=>utf8_encode($_POST['categoria']),
					'items'=>base64_encode($_POST['items']),
					'respuestas'=>base64_encode($_POST['respuestas']),
					'observaciones'=>base64_encode($_POST['observaciones']),
					'fotos'=>base64_encode($_POST['fotos']),
					'fechas'=>base64_encode($_POST['fechas']),
					
					// Campos
					"eess_rut"=>utf8_encode($_POST['eess_rut']),
					"tra_rut"=>utf8_encode($_POST['tra_rut']),
					"eva_apellidos"=>utf8_encode($_POST['eva_apellidos']),
					"eva_nombres"=>utf8_encode($_POST['eva_nombres']),
					"eva_comuna"=>utf8_encode($_POST['eva_comuna']),
					"eva_fundo"=>utf8_encode($_POST['eva_fundo']),
					"eva_faena"=>utf8_encode($_POST['eva_faena']),
					"eva_jefe_faena"=>utf8_encode($_POST['eva_jefe_faena']),
					"eva_supervisor"=>utf8_encode($_POST['eva_supervisor']),
					"eva_apr"=>utf8_encode($_POST['eva_apr']),
					"eva_linea"=>utf8_encode($_POST['eva_linea']),
					"eva_vencimiento_corma"=>utf8_encode($_POST['eva_vencimiento_corma']),
					
					"eva_licencia_conducir_clase"=>utf8_encode($_POST['eva_licencia_conducir_clase']),
					"eva_licencia_conducir_vencimiento"=>utf8_encode($_POST['eva_licencia_conducir_vencimiento']),
					
					"eva_tipo_cosecha"=>utf8_encode($_POST['eva_tipo_cosecha']),
					"eva_general_observacion"=>utf8_encode($_POST['eva_general_observacion']),
					
					// Otros
					"eva_general_foto"=>utf8_encode($_POST['general_foto']),
					"eva_general_fecha"=>utf8_encode($_POST['general_fecha']),
					"eva_evaluador"=>utf8_encode($_POST['eva_evaluador']),
					"eva_cargo"=>utf8_encode($_POST['eva_cargo']),
					
				)
			);
			fwrite($myfile, $content);
			fclose($myfile);
			
			// Una vez guardado el archivo generar inserción SQL
			$myfile = fopen("recep/".$_POST['android'].$_POST['timestamp'], "r") or die("Unable to open file!");
			$content = fread($myfile,filesize("recep/".$_POST['android'].$_POST['timestamp']));
			fclose($myfile);
			
			//echo $content.'<hr>';
			
			$obj = json_decode($content);
						
			// Procesar info
			
			$sql = "INSERT INTO min_evaluacion(
				eva_id,
				eva_creado,
				eva_tipo,
				eess_rut,
				tra_rut,
				eva_apellidos,
				eva_nombres,
				eva_fecha_evaluacion,
				eva_fundo,
				eva_comuna,
				eva_jefe_faena,
				eva_faena,
				eva_supervisor,
				eva_apr,
				eva_geo_x,
				eva_geo_y,
				eva_linea,
				eva_vencimiento_corma,
				eva_licencia_conducir_clase,
				eva_licencia_conducir_vencimiento,
				eva_tipo_cosecha,
				eva_general_observacion,
				eva_general_foto,
				eva_general_fecha,
				eva_evaluador,
				eva_cargo
			) VALUES(
				".$obj->timestamp.",
				null,
				'".$obj->categoria."',
				'".$obj->eess_rut."',
				'".$obj->tra_rut."',
				'".$obj->eva_apellidos."',
				'".$obj->eva_nombres."',
				'".date("Y-m-d H:i:s",($obj->timestamp/1000)+(3600*Yii::app()->params['gmt']))."',
				'".$obj->eva_fundo."',
				'".$obj->eva_comuna."',
				'".$obj->eva_jefe_faena."',
				'".$obj->eva_faena."',
				'".$obj->eva_supervisor."',
				'".$obj->eva_apr."',
				".$obj->lat.",
				".$obj->lon.",
				'".$obj->eva_linea."',
				'".$obj->eva_vencimiento_corma."',
				'".$obj->eva_licencia_conducir_clase."',
				'".$obj->eva_licencia_conducir_vencimiento."',
				'".$obj->eva_tipo_cosecha."',
				'".$obj->eva_general_observacion."',
				'".$obj->eva_general_foto."',
				'".$obj->eva_general_fecha."',
				'".$obj->eva_evaluador."',
				'".$obj->eva_cargo."'
			);";
			
			$myfile = fopen("recep/sql".$_POST['android'].$_POST['timestamp'], "w") or die("Unable to open file!");
			fwrite($myfile, $sql);
			fclose($myfile);
			
			Yii::app()->db->createCommand($sql)->execute();
		
			$items = json_decode(utf8_encode(base64_decode($obj->items)));
			$respuestas = json_decode(base64_decode($obj->respuestas));
			$observaciones = json_decode(base64_decode($obj->observaciones));
			$fotos = json_decode(base64_decode($obj->fotos));
			$fechas = json_decode(base64_decode($obj->fechas));
			
			for($i=0;$i<count($items);$i++){
				$seguimiento = 1;
				if($respuestas[$i] == 'no') $seguimiento = 0;
				$sql = "INSERT INTO min_respuesta(
					res_enunciado,
					res_respuesta,
					res_ponderacion,
					pre_id,
					car_id,
					tem_id,
					res_observacion,
					res_foto,
					eva_id,
					res_seguimiento,
					res_plazo
				) VALUES (
					'".$items[$i]->pre_enunciado."',
					'".$respuestas[$i]."',
					'".$items[$i]->pre_ponderacion."',
					'".$items[$i]->pre_id."',
					'".$obj->categoria."',
					'".$items[$i]->tem_id."',
					'".urldecode($observaciones[$i])."',
					'".$fotos[$i]."',
					".$obj->timestamp.",
					'".$seguimiento."',
					'".$fechas[$i]."'
				);";
				Yii::app()->db->createCommand($sql)->execute();
			}
			
			// Actualizar porcentaje cache
			$limit1 = Yii::app()->params['riesgoalto'];
			$limit2 = Yii::app()->params['riesgomedio'];
			$id = $obj->timestamp;
			$sql = "SELECT tem_id FROM min_respuesta WHERE eva_id = ".$id." GROUP BY tem_id";
			$categorias = Yii::app()->db->createCommand($sql)->query()->readAll();
			$nota = 0;
			$todosna = 0;
			for($i=0;$i<count($categorias);$i++){
				$si = Yii::app()->db->createCommand("SELECT SUM(res_ponderacion) as n FROM min_respuesta WHERE eva_id = ".$id." AND tem_id = '".$categorias[$i]['tem_id']."' AND res_respuesta = 'si' GROUP BY res_respuesta, tem_id")->queryScalar();
				$no = Yii::app()->db->createCommand("SELECT SUM(res_ponderacion) as n FROM min_respuesta WHERE eva_id = ".$id." AND tem_id = '".$categorias[$i]['tem_id']."' AND res_respuesta = 'no' GROUP BY res_respuesta, tem_id")->queryScalar();
				$na = Yii::app()->db->createCommand("SELECT SUM(res_ponderacion) as n FROM min_respuesta WHERE eva_id = ".$id." AND tem_id = '".$categorias[$i]['tem_id']."' AND res_respuesta = 'n/a' GROUP BY res_respuesta, tem_id")->queryScalar();
				if($si == '') $si = 0;
				if($no == '') $no = 0;
				if($na == '') $na = 0;
				if(($si + $no) > 0) $r = 100*($si / ($si + $no)); else $r = 0;
				$nota+=$r;
				
				if($si+$no == 0) $todosna++;
			}
			if(count($categorias) > 0) $nota = $nota / (count($categorias)-$todosna); else $nota = 0;
			
			// Ingresar fundo si no existe
			// Obsoleto, nosotros gestionamos los fundos
			/*
			$c = Yii::app()->db->createCommand("SELECT COUNT(*) FROM min_fundo
			WHERE fun_eess = '".$obj->eess_rut."' AND fun_nombre = '".$obj->eva_fundo."'
			")->queryScalar();
			if($c == 0){
				Yii::app()->db->createCommand("INSERT INTO min_fundo(
					fun_nombre,
					fun_comuna,
					fun_eess
				) VALUES(
					'".$obj->eva_fundo."',
					'".$obj->eva_comuna."',
					'".$obj->eess_rut."'
				)")->execute();
			}
			*/
			
			// Actualizar porcentaje cache y correlativo evaluador
			$corr = Yii::app()->db->createCommand("SELECT MAX(eva_evaluador_correlativo)+1 FROM min_evaluacion WHERE eva_evaluador = '".$obj->eva_evaluador."'")->queryScalar();
			// Obtener cargo desde aplicación, si viene vacío, sacar de mantenedor de trabajadores.
			$evaCargo = $obj->eva_cargo;
			if($evaCargo=='') $evaCargo = Yii::app()->db->createCommand("SELECT car_descripcion FROM min_evaluacion as E JOIN min_trabajador as T ON(E.tra_rut = T.tra_rut) JOIN min_cargo as C ON(T.car_id = C.car_id) where eva_id = '".$obj->timestamp."'")->queryScalar();
			$sql="UPDATE min_evaluacion SET eva_cache_porcentaje = '".$nota."', eva_evaluador_correlativo = '".$corr."' WHERE eva_id = ".$obj->timestamp;
			Yii::app()->db->createCommand($sql)->execute();
			
			// Enviar correos con la evaluación
			$nv = 'Bajo';
			if($nota < Yii::app()->params['riesgomedio']) $nv = 'Medio';
			if($nota < Yii::app()->params['riesgoalto']) $nv = 'Alto';
			
			// Enviar email a medio mundo

			$eess = Yii::app()->db->createCommand("SELECT eess_nombre_corto FROM min_eess WHERE eess_rut = '".$obj->eess_rut."'")->queryScalar();
			$eessR = Yii::app()->db->createCommand("SELECT eess_rut FROM min_eess WHERE eess_rut = '".$obj->eess_rut."'")->queryScalar();
			if ($eessR == '76885630') {
				$asunto = "".json_decode(json_encode($obj->categoria))."";
				$email = "
				<p>Se&ntilde;ores<br><br></p>
				<p>Informamos a usted que con fecha <b>".date("d-m-Y", ($obj->timestamp/1000)+(3600*Yii::app()->params['gmt']))."</b>, a las <b>".date("H:i", ($obj->timestamp/1000)+(3600*Yii::app()->params['gmt']))."</b> se llev&oacute; a cabo un Control Operacional a uno de sus trabajadores que se desempe&ntilde;a como ".$evaCargo.".</p>
				<p>El resultado de esta Evaluaci&oacute;n fue de un <b>".round($nota)." %</b> de cumplimiento, lo que representa un Nivel de Riesgo <b>".$nv."</b></p>
				<p>El respectivo Informe se encuentra disponible en el archivo adjunto a este mensaje. <!--o ingresando a la <a href='http://innoapsion.cl/terreno/login-eess/'>siguiente plataforma</a>, teniendo como credenciales de acceso, tanto para el usuario y contrase&ntilde;a, el Rut de su Empresa, sin puntos, guion ni d&iacute;gito verificador (Rut: 1234567)--></p>
				<p>Atte.<br>SAFCO LTDA.<br></p>
				";
				$headers = "From: SAFCO LTDA <no-reply@safco.cl> \r\n";
			}else{
			$asunto = "Evaluación de Desempeño";
			if($nota < 100) $email = "
			<p>Se&ntilde;ores<br><b>".json_decode(json_encode($eess))."</b><br></p>
			<p>Informamos a usted que con fecha <b>".date("d-m-Y", ($obj->timestamp/1000)+(3600*Yii::app()->params['gmt']))."</b>, a las <b>".date("H:i", ($obj->timestamp/1000)+(3600*Yii::app()->params['gmt']))."</b> se llev&oacute; a cabo una Evaluaci&oacute;n SEDECC a uno de sus trabajadores que se desempe&ntilde;a como ".$evaCargo.".</p>
			<p>El resultado de esta Evaluaci&oacute;n fue de un <b>".round($nota)." %</b> de cumplimiento, lo que representa un Nivel de Riesgo <b>".$nv."</b></p>
			<p>El respectivo Informe se encuentra disponible en el archivo adjunto a este mensaje. <!--o ingresando a la <a href='http://innoapsion.cl/terreno/login-eess/'>siguiente plataforma</a>, teniendo como credenciales de acceso, tanto para el usuario y contrase&ntilde;a, el Rut de su Empresa, sin puntos, guion ni d&iacute;gito verificador (Rut: 1234567)--></p>
			<p>Las consultas referidas a la Evaluaci&oacute;n favor dirigirlas al Ejecutor de la misma y que se encuentra identificado en el Informe.</b>
			<p>Atte.<br>Innoapsion.<br></p>
			";
			else $email = "
			<p>Se&ntilde;ores<br><b>".json_decode(json_encode($eess))."</b><br></p>
			<p>Informamos a usted que con fecha <b>".date("d-m-Y", ($obj->timestamp/1000)+(3600*Yii::app()->params['gmt']))."</b>, a las <b>".date("H:i", ($obj->timestamp/1000)+(3600*Yii::app()->params['gmt']))."</b> se llev&oacute; a cabo una Evaluaci&oacute;n SEDECC a uno de sus trabajadores que se desempe&ntilde;a como ".$evaCargo.".</p>
			<p>El resultado de esta Evaluaci&oacute;n fue de un <b>".round($nota)." %</b> de cumplimiento, lo que representa un Nivel de Riesgo <b>".$nv."</b></p>
			<p>El respectivo Informe se encuentra disponible en el archivo adjunto a este mensaje. <!--o ingresando a la <a href='http://innoapsion.cl/terreno/login-eess/'>siguiente plataforma</a>, teniendo como credenciales de acceso, tanto para el usuario y contrase&ntilde;a, el Rut de su Empresa, sin puntos, guion ni d&iacute;gito verificador (Rut: 1234567)--></p>
			<p>Las consultas referidas a la Evaluaci&oacute;n favor dirigirlas al Ejecutor de la misma y que se encuentra identificado en el Informe.</b>
			<p>Atte.<br>Innoapsion.<br></p>
			";
			$headers = "From: Sedecc <sedecc@innoapsion.cl> \r\n";		
			}
			
			if ($eessR == '76885630') {
				$archivo = chunk_split(base64_encode(file_get_contents("http://innoapsion.cl/sedecc/index.php?r=evaluacion/pdfsafco&id=".$obj->timestamp)));
			}else{
				$archivo = chunk_split(base64_encode(file_get_contents("http://innoapsion.cl/sedecc/index.php?r=evaluacion/pdf&id=".$obj->timestamp)));
			}
			
			$otrosemails = Yii::app()->db->createCommand("SELECT GROUP_CONCAT(ema_email) FROM min_email WHERE eess_rut = '".$obj->eess_rut."'")->queryScalar();
			
			$direccionesem = Yii::app()->db->createCommand("
			SELECT GROUP_CONCAT(tra_email) FROM `min_trabajador` WHERE 
			CONCAT(tra_nombres,' ',tra_apellidos) = '".$obj->eva_nombres." ".$obj->eva_apellidos."' OR
			CONCAT(tra_nombres,' ',tra_apellidos) = '".$obj->eva_supervisor."' OR
			CONCAT(tra_nombres,' ',tra_apellidos) = '".$obj->eva_jefe_faena."' OR
			CONCAT(tra_nombres,' ',tra_apellidos) = '".$obj->eva_apr."' OR
			tra_rut = '".$obj->eva_evaluador."'
			")->queryScalar();
			
			$direccioneses = Yii::app()->db->createCommand("SELECT eess_email FROM `min_eess` WHERE eess_rut = '".$obj->eess_rut."'")->queryScalar();
			
			$headers .= "Cc: ".$direccionesem.", ".$otrosemails." \r\n"; // 
			$headers .= "Bcc: ronnymunoz22@gmail.com, eduardoacevedo@innoapsion.cl, sebastian.carcamo398@gmail.com, jorgeiraira55@gmail.com " . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
		    $headers .= "Content-Type: multipart/mixed; boundary=\"=A=G=R=O=\"\r\n\r\n";
		    $email_message = "--=A=G=R=O=\r\n";
		    $email_message .= "Content-type: text/html; charset=iso-8859-1\r\n";
		    $email_message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
			$email_message .= $email . "\r\n\r\n";  
		    $email_message .= "--=A=G=R=O=\r\n";
		    $email_message .= "Content-Type: application/octet-stream; name=\"Evaluaciones.pdf\"\r\n";
		    $email_message .= "Content-Transfer-Encoding: base64\r\n";
		    $email_message .= "Content-Disposition: attachment; filename=\"Evaluaciones.pdf\"\r\n\r\n";
		    $email_message .= $archivo . "\r\n\r\n";
		    $email_message .= "--=A=G=R=O=\r\n";
		    mail($direccioneses, $asunto, $email_message, $headers); // Quitar email de prueba
			
			// Check de éxito
			echo json_encode("json_valido_sedecc");
			
			
			
			// LO QUE OCURRE DESDE ACÁ NO ES CRÍTICO, POR ESO SE HACE POST EL MENSAJE DE ÉXITO
			
			// Ingresar trabajador si no existe
			$c = Yii::app()->db->createCommand("SELECT COUNT(*) FROM min_trabajador
			WHERE eess_rut = '".$obj->eess_rut."' AND tra_rut = '".$obj->tra_rut."'")->queryScalar();
			if($c == 0){
				Yii::app()->db->createCommand("INSERT INTO min_trabajador(
					eess_rut,
					tra_rut,
					tra_nombres,
					tra_apellidos,
					tra_licencia_conducir
				)VALUES(
					'".$obj->eess_rut."',
					'".$obj->tra_rut."',
					'".$obj->eva_nombres."',
					'".$obj->eva_apellidos."',
					'".$obj->eva_licencia_conducir_clase."'
				)")->execute();
			}
			
			// Si existe actualizar corma y licencia de conducir
			if($obj->eva_vencimiento_corma != ''){
				Yii::app()->db->createCommand("UPDATE min_trabajador SET
					tra_vencimiento_corma = '".DateTime::createFromFormat('d-m-Y', $obj->eva_vencimiento_corma)->format('Y-m-d')."'
				WHERE tra_rut = '".$obj->tra_rut."'
				")->execute();
			}
			if($obj->eva_licencia_conducir_vencimiento != ''){
				Yii::app()->db->createCommand("UPDATE min_trabajador SET
					tra_vencimiento_licencia_conducir = '".DateTime::createFromFormat('d-m-Y', $obj->eva_licencia_conducir_vencimiento)->format('Y-m-d')."'
				WHERE tra_rut = '".$obj->tra_rut."'
				")->execute();
			}
			
			// Ingresar faena si no existe
			$c = Yii::app()->db->createCommand("SELECT COUNT(*) FROM min_faena
			WHERE fae_nombre = '".$obj->eva_faena."' AND eess_rut = '".$obj->eess_rut."'")->queryScalar();
			if($c == 0){
				Yii::app()->db->createCommand("INSERT INTO min_faena(
					fae_nombre,
					eess_rut,
					tipo
				) VALUES(
					'".$obj->eva_faena."',
					'".$obj->eess_rut."',
					'".$obj->eva_tipo_cosecha."'
				)")->execute();
			}
			
			// Cada vez que llegue una evaluación, se actualizarán los caché por ítem pendientes.
			$rows = Yii::app()->db->createCommand("SELECT eva_id, eva_tipo, tra_rut, eva_nombres, eva_apellidos, eva_cache_porcentaje FROM min_evaluacion WHERE eva_item_nombre_0 is NULL")->queryAll();
			for($i=0;$i<count($rows);$i++){
				// Obtener categorías de cada evaluación
				$categorias = Yii::app()->db->createCommand("SELECT DISTINCT tem_id FROM min_respuesta WHERE car_id = '".$rows[$i]['eva_tipo']."' ORDER BY tem_id")->queryAll();
				for($j=0;$j<count($categorias);$j++){
					// Asignar nombre de ítem
					Yii::app()->db->createCommand("UPDATE min_evaluacion SET eva_item_nombre_".$j." = '".$categorias[$j]['tem_id']."' WHERE eva_id = '".$rows[$i]['eva_id']."'")->execute();
					// Asignar nota
					$si = Yii::app()->db->createCommand("SELECT SUM(res_ponderacion) FROM min_evaluacion e LEFT JOIN min_respuesta r ON (e.eva_id = r.eva_id) WHERE r.eva_id = '".$rows[$i]['eva_id']."' AND r.tem_id = '".$categorias[$j]['tem_id']."' AND res_respuesta = 'si'")->queryScalar();
					$no = Yii::app()->db->createCommand("SELECT SUM(res_ponderacion) FROM min_evaluacion e LEFT JOIN min_respuesta r ON (e.eva_id = r.eva_id) WHERE r.eva_id = '".$rows[$i]['eva_id']."' AND r.tem_id = '".$categorias[$j]['tem_id']."' AND res_respuesta = 'no'")->queryScalar();
					if($si+$no>0){
						Yii::app()->db->createCommand("UPDATE min_evaluacion SET eva_item_nota_".$j." = '".round(100*($si/($si+$no)))."' WHERE eva_id = '".$rows[$i]['eva_id']."'")->execute();
					}
				}
			}
		}
		else{
			echo json_encode("ERROR");
		}
	}

	public function actionError(){
		if(!isset($_POST['android'])) $_POST['android'] = 'nada';
		if(!isset($_POST['timestamp'])) $_POST['timestamp'] = 'nada';
		if(!isset($_POST['error'])) $_POST['error'] = 'nada';
		
		$myfile = fopen("errorlog/".$_POST['android'].$_POST['timestamp'], "w") or die("Unable to open file!");
		fwrite($myfile, $_POST['error']);
		fclose($myfile);
	}
}
