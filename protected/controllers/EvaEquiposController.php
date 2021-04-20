<?php

class EvaEquiposController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
	return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','pdf'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','excel','trash'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','trash'),
				'users'=>array('admin'),
			),
			// array('deny',  // deny all users
			// 	'users'=>array('*'),
			// ),
		);
	}
public function actionExcel(){
		// Iniciar modelos


	/*	$model=new Evaluacion;
		$criteria = new CDbCriteria();
		if(Yii::app()->controller->usertype() == 1) $criteria->compare('eess_rut',Yii::app()->user->id);
		$lista=$model->findAll($criteria);

		// Librerías Excel
		Yii::import('application.vendor.*');
		require_once('PHPExcel.php');
		$objPHPExcel = new PHPExcel();

		// Agregar encabezados
		$j=1;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0, $j, $model->attributeLabels()['eva_id']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(1, $j, $model->attributeLabels()['eva_creado']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(2, $j, $model->attributeLabels()['eva_tipo']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(3, $j, $model->attributeLabels()['eess_rut']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(4, $j, $model->attributeLabels()['tra_rut']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(5, $j, $model->attributeLabels()['eva_apellidos']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(6, $j, $model->attributeLabels()['eva_nombres']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(7, $j, $model->attributeLabels()['eva_fecha_evaluacion']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(8, $j, $model->attributeLabels()['eva_comuna']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(9, $j, $model->attributeLabels()['eva_fundo']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(10, $j, $model->attributeLabels()['eva_faena']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(11, $j, $model->attributeLabels()['eva_jefe_faena']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(12, $j, $model->attributeLabels()['eva_supervisor']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(13, $j, $model->attributeLabels()['eva_apr']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(14, $j, $model->attributeLabels()['eva_geo_x']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(15, $j, $model->attributeLabels()['eva_geo_y']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(16, $j, $model->attributeLabels()['eva_linea']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(17, $j, $model->attributeLabels()['eva_vencimiento_corma']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(18, $j, $model->attributeLabels()['eva_tipo_cosecha']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(19, $j, $model->attributeLabels()['eva_general_observacion']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(20, $j, $model->attributeLabels()['eva_general_foto']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(21, $j, $model->attributeLabels()['eva_general_fecha']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(22, $j, $model->attributeLabels()['eva_evaluador']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(23, $j, $model->attributeLabels()['eva_cache_porcentaje']);


		// Agregar datos
		foreach($lista as $key=>$fila){
			$i=0;$j++;
			foreach($fila as $key=>$valor){
				$objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($i, $j, $valor);
				$i++;
			}
		}

		// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="evaluaciones.xlsx"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
		*/
	}
	public function actionPdf2($id)
	{
		header('Content-Type: text/html; charset=utf-8');
		$evaluacion = Yii::app()->db->createCommand("SELECT *, SUBSTRING_INDEX(eva_apr, ' ', 1 ) as nombre_apr,
        SUBSTRING(eva_apr,LOCATE(' ',eva_apr,LOCATE(' ',eva_apr)+1),LENGTH(eva_apr)) as apellido_apr, SUBSTRING_INDEX(eva_supervisor, ' ', 1 ) as nombre_supervisor,
        SUBSTRING(eva_supervisor,LOCATE(' ',eva_supervisor,LOCATE(' ',eva_supervisor)+1),LENGTH(eva_supervisor)) as apellido_supervisor, SUBSTRING_INDEX(eva_jefe_faena, ' ', 1 ) as nombre_jefe_faena,
        SUBSTRING(eva_jefe_faena,LOCATE(' ',eva_jefe_faena,LOCATE(' ',eva_jefe_faena)+1),LENGTH(eva_jefe_faena)) as apellido_jefe_faena FROM min_evaluacion_equipos WHERE eva_id = ".$id)->queryRow();
        $fechaeva =  $evaluacion['eva_fecha_evaluacion'];
		$empresa = Yii::app()->db->createCommand("SELECT * FROM min_eess WHERE eess_rut = ".$evaluacion['eess_rut'])->queryRow();

		$logo = '';
		$ruta = "images/eess/"; // Indicar ruta
		 $filehandle = opendir($ruta); // Abrir archivos
		  while ($file = readdir($filehandle)) {
		   if ($file != "." && $file != "..") {
		    $tamanyo = GetImageSize($ruta . $file);

			 if ($file == $evaluacion['eess_rut'].'.jpg'){
		     	$logo = '<img src="'.$ruta.$file.'" style="width: 100%; height: 80px;">';
		     }
		   }
		  }
		closedir($filehandle); // Fin lectura archivos




		$content = '
		<style type="text/css">
		  table.page_header {
		    width: 100%;
		    border: none;
		    padding: 0mm;
		  }
		  td {
		    color: #222222;
		  }

		</style>
		<page backtop="31mm" backbottom="12mm" backleft="15mm" backright="15mm" style="font-size: 12pt;">
		<page_header>
		<table class="page_header" style="padding-top: 10px; border-bottom: 7px solid #176897; background-color: #f7931d;">
		<tr>
			<td style="width: 30%; text-align: left; border-left-width:30;">
			<img src="img/logopdf.png" width="125px;">
			</td>
			<td style="width: 45%; text-align: center; font-size: 20px; color: white; height: 90px;">
				 INFORME DE MONITOREO<br>EVALUACIÓN DE DESEMPEÑO SSO
			</td>
			<td style="width: 20%; text-align: right; border-left-width:30;">
				'.$logo.'
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
		<table style="font-size:11px;">
		<tr>
			<td>
				<table style="background-color: #f7f5f7; margin-top: 20px;">
				<thead>
				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Rut EESS
					</td>
					<td width="218">
						: '.$evaluacion['eess_rut'].'
					</td>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Código Evaluación
					</td>
					<td width="218">
						: '.Yii::app()->controller->identificador($evaluacion['eva_evaluador'],$evaluacion['eva_fecha_evaluacion'],$evaluacion['eva_evaluador_correlativo']).'
					</td>

				</tr>
				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Nombre EESS
					</td>
					<td width="218">
						: '.Yii::app()->db->createCommand("SELECT eess_nombre_corto FROM min_eess WHERE eess_rut = '".$evaluacion['eess_rut']."'")->queryScalar().'
					</td>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Operador:
					</td>
					<td width="230">
						: '.$evaluacion['eva_operador'].'
					</td>
				</tr>
				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Código Equipo
					</td>
					<td width="218">
						: '.$evaluacion['eq_codigo'].'
					</td>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Supervisor
					</td>
					<td width="230">
						: '.$evaluacion['eva_supervisor'].'
					</td>
				</tr>
				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Tipo de Máquina
					</td>
					<td width="218">
						: '.$evaluacion['eq_tipo'].'
					</td>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Jefe de Faena:
					</td>
					<td width="230">
						: '.$evaluacion['eva_jefe_faena'].'
					</td>
				</tr>
				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Marca
					</td>
					<td width="228">
						: '.$evaluacion['eq_marca'].'
					</td>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						APR
					</td>
					<td width="230">
						: '.$evaluacion['eva_apr'].'
					</td>

				</tr>

				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Modelo
					</td>
					<td width="218">
					: '.$evaluacion['eq_modelo'].'

						</td>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Ejecutador Evaluación
					</td>
					<td width="230">
						: '.strtoupper(Yii::app()->db->createCommand("SELECT CONCAT(tra_nombres, ' ', tra_apellidos) FROM min_trabajador WHERE tra_rut = '".$evaluacion['eva_evaluador']."'")->queryScalar()).'
					</td>
				</tr>

				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Horómetro
					</td>
					<td width="230">
						: '.$evaluacion['eva_horometro'].'
					</td>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Fecha Evaluación
					</td>
					<td width="218">
						: '.$evaluacion['eva_fecha_evaluacion'].'
					</td>
				</tr>
				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Nº OT
					</td>
					<td width="230">
						: '.$evaluacion['eva_ot'].'
					</td>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Georeferencia
					</td>
					<td width="218">
						: '.$evaluacion['eva_geo_x'].', '.$evaluacion['eva_geo_y'].'
					</td>
				</tr>
				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Faena
					</td>
					<td width="218">
						: '.$evaluacion['eva_faena'].'
					</td>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Actividad
					</td>
					<td width="218">
						: '.strtoupper($evaluacion['eva_tipo']).'
					</td>
				</tr>
				
				<tr>



				</tr>
				</thead>
				<tr>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td style="height: 10px;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#176897" style="padding-top: 5px; padding-bottom: 5px; color: white; text-align: center; font-size: 14px; font : black; border-radius: 10px;">
				RESULTADOS DE LA EVALUACIÓN
			</td>
		</tr>
		';
		$tematicas = Yii::app()->db->createCommand("SELECT DISTINCT tem_id FROM min_respuesta_equipos WHERE eva_id = ".$id)->query()->readAll();
		for($i=0;$i<count($tematicas);$i++){
			$content.= '
			<tr>
				<td>
					<table cellspacing="0" cellpadding="0" style="margin-top: 10px;">
					<tr bgcolor="#eeecee" style="margin-top:20px; margin-bottom:20px;">
						<td colspan="2" style="font-size: 14px; padding-top: 5px; padding-bottom: 5px; border-radius: 10px 0px 0px 10px;" width="600">
							'.$tematicas[$i]['tem_id'].'
						</td>
						<td style="padding-top: 5px; padding-bottom: 5px; font-size: 14px; border-radius: 0px 10px 10px 0px; text-align: center;" width="100">
							Resultado
						</td>
					</tr>
					';
					$preguntas = Yii::app()->db->createCommand("SELECT * FROM min_respuesta_equipos WHERE tem_id = '".$tematicas[$i]['tem_id']."' AND eva_id = ".$id)->query()->readAll();
					for($j=0;$j<count($preguntas);$j++){

						$img = '';
						if($preguntas[$j]['res_respuesta'] == 'si') $img = '<img src="img/check2.png" height="17">';
						if($preguntas[$j]['res_respuesta'] == 'no') $img = '<img src="img/mal2.png" height="17">';
						if($preguntas[$j]['res_respuesta'] == 'n/a') $img = '<img src="img/na2.png" height="17">';

						$content.= '
						<tr class="active">
							<td width="25" style="vertical-align: top;">
								'.($i+1).'.'.($j+1).'
							</td>
							<td width="560" style="vertical-align: top;">
								'.($preguntas[$j]['res_enunciado']).'
							</td>
							<td style="text-align: center;" width="100">
								'.$img.'
							</td>
						</tr>
						';
					}
					$content.= '
					</table>
				</td>
			</tr>
			';
		}
		//obtencion de valores de riesgo y actualizacion
			$limit1 = Yii::app()->params['riesgoalto'];
			$limit2 = Yii::app()->params['riesgomedio'];

			$MalNotaBaja = Yii::app()->params['MalNotaBaja'];
          	$RalLimBajo = Yii::app()->params['RalLimBajo'];

          	$MalNotaMedia = Yii::app()->params['MalNotaMedia'];
          	$RalLimMedio = Yii::app()->params['RalLimMedio'];

          	$MalNotaAlta = Yii::app()->params['MalNotaAlta'];
			$RalLimAlto = Yii::app()->params['RalLimAlto'];
		// Calcular nota
		//Nuevo calculo de notas rangos 0<85<95<100
		$nota = '';
		if($evaluacion['eva_cache_porcentaje']>=0 && $evaluacion['eva_cache_porcentaje']<=$limit1) $nota = (($MalNotaBaja*$evaluacion['eva_cache_porcentaje'])+$RalLimBajo);
		if($evaluacion['eva_cache_porcentaje']>$limit1 && $evaluacion['eva_cache_porcentaje']<=$limit2) $nota = (($MalNotaMedia*$evaluacion['eva_cache_porcentaje'])-$RalLimMedio);
		if($evaluacion['eva_cache_porcentaje']>$limit2 && $evaluacion['eva_cache_porcentaje']<=100) $nota = (($MalNotaAlta*$evaluacion['eva_cache_porcentaje'])-$RalLimAlto);
		$nota = number_format(floor($nota*10)/10,1,",",".");


		$ver= Yii::app()->db->createCommand("SELECT res_critico,res_respuesta FROM min_respuesta_equipos WHERE eva_id = ".$id)->query()->readAll();
		for($s=0;$s<count($ver);$s++){

				if($ver[$s]['res_critico'] == 'si'&&$ver[$s]['res_respuesta']=='no'){
					$alerta1 = '¡Precaución!: Maquinaria ha incumplido una pregunta considerada crítica.';//';
					$alerta2 = ' Se recomienda Identificar las desviaciones, implementar las medidas correctivas y un realizar un seguimiento sistemático.';//';
					$tienecriticosi='si';
				}else if($ver[$s]['res_critico'] == 'si'&&$ver[$s]['res_respuesta']=='si'){
					$alerta1 = '';
					$alerta2 = '';
					$tienecriticono = 'no';
				}else{
					$alerta1 = '';
					$alerta2 = '';
					$tienecritico = 'no';
					$tienecriticosi = 'no';
					$tienecriticono = 'no';
				}


		}
		//verificamos si cumple con el porcentaje minimo de respuesta
		$verpromedio = Yii::app()->db->createCommand("SELECT eva_cache_porcentaje From min_evaluacion_equipos WHERE eva_id=".$id)->query()->readAll();
		for($t=0;$t<count($verpromedio);$t++){
			$notapromedio = number_format(floor($verpromedio[$t]['eva_cache_porcentaje']));
			if($notapromedio>85 and $tienecriticosi=='si'){
				$alerta1 = '¡Precaución!: Maquinaria ha incumplido una pregunta considerada crítica.';//';
				$alerta2 = 'Se recomienda Identificar las desviaciones, implementar las medidas correctivas y un realizar un seguimiento sistemático.';//';

			}elseif($notapromedio<=85 or $tienecriticosi=='si'){
				$alerta1 = ' ¡ALERTA! Maquinaria en Nivel de Riesgo ALTO';//';
				$alerta2 = ' Se recomienda detener los trabajos y reparar equipos.';//';
			}elseif($notapromedio>85 and $tienecriticono=='no'){
				$alerta1 = '';
				$alerta2 = '';
			}elseif($tienecriticosi=='si'){
				$alerta1 = ' ¡Precaución!: Maquinaria ha incumplido una pregunta considerada crítica.';//';
				$alerta2 = ' Se recomienda Identificar las desviaciones, implementar las medidas correctivas y un realizar un seguimiento sistemático.';//';
			}elseif($tienecritico=='no'){
				$alerta1 = '';//';
				$alerta2 = '';//';
			}
		}/****/

					/**
					<div>
					<tr><td colspan="30" style="text-align: center; color:red;"><b>'.$alerta1.'</b></td></tr>
			  		<tr><td colspan="30" style="text-align: center;"><b>'.$alerta2.'</b></td><br></tr>
					 <p style="text-align: center; color:red;"><b>'.$alerta1.'</b></td></p>
			  		<p style="text-align: center;"><b>'.$alerta2.'</b></td><br></p>
				</div>
					**/
					/** Prueba de jorge iraira
					<tr><td colspan="30" style="text-align: center; color:red;"><b>'.$alerta1.'</b></td></tr>
			  		<tr><td colspan="30" style="text-align: center;"><b>'.$alerta2.'</b></td><br></tr>

						<tr><td><b></b> '.$alerta1.'<br><br></td></tr>
					**/

		$content.='
		<tr>
			<td>
				<table cellspacing="0" cellpadding="0" style="margin-top: 10px;">
					<tr><td><b>Observaciones generales:</b> '.$evaluacion['eva_general_observacion'].'<br><br></td></tr>


				</table>

			</td>

		</tr>
		<tr><td style="text-align: center;color:red;"><b>'.$alerta1.'</b></td></tr>
		<tr><td style="text-align: center;"><b>'.$alerta2.'</b></td><br></tr>


		<tr>
		<td align="center">
		<img src="img/barra-N1.png" style="width: 350px;">
		<span style="font-size: 45px; color: #176897; margin-left: -140px; margin-top: -10px;">'.floor($evaluacion['eva_cache_porcentaje']).'%</span>
		<span> </span><span> </span><span> </span>
		<img src="img/barra-N2.png" style="width: 350px;">
		<span style="font-size: 45px; color: #176897; margin-left: -120px; margin-top: -10px;">'.$nota.'</span>
		</td>
		</tr>


		</table>
		</page>
		';
		$resp2 = Yii::app()->db->createCommand("SELECT count(*) as contObs FROM min_respuesta_equipos where (res_foto != '' or res_observacion != '') AND eva_id = ".$id)->query()->readAll();
		if ($resp2[0]['contObs'] != '0') {

		$content.= '
		<page backtop="31mm" backbottom="12mm" backleft="15mm" backright="15mm" style="font-size: 12pt;">
		<page_header>
		<table class="page_header" style="padding-top: 10px; border-bottom: 7px solid #176897; background-color: #f7931d;">
		<tr>
			<td style="width: 30%; text-align: left; border-left-width:30;">
			<img src="img/logopdf.png" width="125px;">
			</td>
			<td style="width: 45%; text-align: center; font-size: 20px; color: white; height: 90px;">
				 INFORME DE MONITOREO<br>EVALUACIÓN DE DESEMPEÑO SSO
			</td>
			<td style="width: 20%; text-align: right; border-left-width:30;">
				'.$logo.'
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
		<table style="font-size:11px;">

		<tr><td style="text-align: center; font-size: 14px;">OBSERVACIONES</td></tr>
		<tr><td style="height: 10px;"></td></tr>
		';


	    $resp = Yii::app()->db->createCommand("SELECT * FROM min_respuesta_equipos where (res_foto != '' or res_observacion != '') AND eva_id = ".$id)->query()->readAll();
					for($x=0;$x<count($resp);$x++){

		if($resp[$x]['res_seguimiento'] == 1){
          $semaforo = "<td class='th-sortable' data-toggle='class' style='text-align: center; width:100;'>Cerrada</td>";
        }else{
          $today = date("Y-m-d H:i");
          $date = $resp[$x]['res_plazo']." 00:00:00";
          if($date < $today){
            $semaforo = "<td class='th-sortable' data-toggle='class' style='text-align: center; width:100;'>Pendiente</td>";
          }else{
            $semaforo = "<td class='th-sortable' data-toggle='class' style='text-align: center; width:100;'>En proceso</td>";
          }
        }
          if ($resp[$x]['res_foto'] != "") {
		  	$img ='<tr>
		  		<td rowspan="3" width="420" >Observacion: '.$resp[$x]['res_observacion'].'</td>
		  		<td rowspan="3" width="0" align="center"><img src="data:image/;base64,'.$resp[$x]['res_foto'].'" width="100"></td>
		  		<td height="10" scope="cool" class="th-sortable" data-toggle="class" style="text-align: center; width:0;">Plazo Control</td>
			</tr>
			<tr>
				<td scope="cool" width="0" height="10" align="center">'.$resp[$x]['res_plazo'].'</td>
			</tr>
			 <tr>
				<td height="20" class="th-sortable" data-toggle="class" style="text-align: center; width:0;"></td>
			</tr>  ';
		  }else{
		  	$img= '<tr>
		  		<td rowspan="3" width="420" >Observacion: '.$resp[$x]['res_observacion'].'</td>
		  		<td rowspan="3" width="0" align="center"></td>
		  		<td height="10" scope="cool" class="th-sortable" data-toggle="class" style="text-align: center; width:0;">Plazo Control</td>
			</tr>
			<tr>
				<td scope="cool" width="0" height="10" align="center">'.$resp[$x]['res_plazo'].'</td>
			</tr>
			 <tr>
				<td  class="th-sortable" data-toggle="class" style="text-align: center; width:0;"></td>
			</tr>
		  	';
		  }
		$content.='


		<tr>
		<td>
		<table cellspacing="0" cellpadding="0" style="font-size: 12px;">
		  	<tr bgcolor="#DCDCDC">
			  	<td colspan="2" style="padding-top: 5px; padding-bottom: 5px; font-size: 14px; border-radius: 10px 0px 0px 10px; text-align: left; width:600;">Pregunta</td>
          		<td style="padding-top: 5px; padding-bottom: 5px; font-size: 14px; border-radius: 0px 10px 10px 0px; text-align: center; width:100;">Seguimiento</td>
		  	</tr>
		  	<tr>
			  	<td colspan="2" width="600">'.$resp[$x]['res_enunciado'].'</td>
				'.$semaforo.'
		  	</tr>
		  	'.$img.'
		</table>

		</td>
		</tr>
		';
		}
		 $content.='
		</table>
		</page>
		';
		}
	    // convert to PDF
	    Yii::import('application.vendor.*');
		require_once('html2pdf/html2pdf.class.php');
	    try
	    {
	        $html2pdf = new HTML2PDF('P', 'LETTER', 'fr');
	        $html2pdf->pdf->SetDisplayMode('fullpage');
	        $html2pdf->writeHTML($content, isset($_GET['html']));
	        $html2pdf->Output('detalleQ.pdf');
	    }
	    catch(HTML2PDF_exception $e) {
	        echo $e;
	        exit;
	    }
    }
    
    public function actionPdf($id)
	{
		header('Content-Type: text/html; charset=utf-8');
		$evaluacion = Yii::app()->db->createCommand("CALL evaluacion_equipo(".$id.")")->queryRow();
        $fechaeva =  $evaluacion['eva_fecha_evaluacion'];

		$logo = '';
		$ruta = "images/eess/"; // Indicar ruta
		 $filehandle = opendir($ruta); // Abrir archivos
		  while ($file = readdir($filehandle)) {
		   if ($file != "." && $file != "..") {
		    $tamanyo = GetImageSize($ruta . $file);

                if ($file == $evaluacion['eess_rut'].'.jpg'){
                    $logo = '<img src="'.$ruta.$file.'" style="width: 100%; height: 80px;">';
                }
		    }
		}
		closedir($filehandle); // Fin lectura archivos

		$content = '
		<style type="text/css">
		  table.page_header {
		    width: 100%;
		    border: none;
		    padding: 0mm;
		  }
		  td {
		    color: #222222;
		  }

		</style>
		<page backtop="31mm" backbottom="12mm" backleft="15mm" backright="15mm" style="font-size: 12pt;">
		<page_header>
		<table class="page_header" style="padding-top: 10px; border-bottom: 7px solid #176897; background-color: #f7931d;">
		<tr>
			<td style="width: 30%; text-align: left; border-left-width:30;">
			<img src="img/logopdf.png" width="125px;">
			</td>
			<td style="width: 45%; text-align: center; font-size: 20px; color: white; height: 90px;">
				 INFORME DE MONITOREO<br>EVALUACIÓN DE DESEMPEÑO SSO
			</td>
			<td style="width: 20%; text-align: right; border-left-width:30;">
				'.$logo.'
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
		<table style="font-size:11px;">
		<tr>
			<td>';
                //Inicio primera tabla
				$content .= '<table style="background-color: #f7f5f7;">
                <thead>';
                
                $content .= '
				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						
					</td>
					<td width="218">
						
					</td>';
                $content .= '
                </tr>
				<tr> 
					<td width="115" height="5">
					</td>
                </tr>';
                
                $content .= '
                <tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Código Evaluación
					</td>
					<td width="218">
						: '.Yii::app()->controller->identificador($evaluacion['Nombre evaluador'],$evaluacion['eva_fecha_evaluacion'],$evaluacion['eva_evaluador_correlativo']).'  
                    </td>
                </tr>';

                $content .= '
				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Fecha Evaluación
					</td>
					<td width="218">
						: '.$evaluacion['eva_fecha_evaluacion'].'
                    </td>
                </tr>';

                $content .='
				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Rut Empresa
					</td>
					<td width="218">
						: '.$evaluacion['eess_rut'].'  
					</td>';
					$content .= '
				</tr>

				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Nombre Empresa
					</td>
					<td width="218">
						: '.strtoupper($evaluacion['eess_nombre_corto']).'
					</td>';
				$content .= '
				</tr>
				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Ejecutor Evaluación
					</td>
					<td width="230">
						: '.strtoupper($evaluacion['Nombre evaluador'].' '.$evaluacion['Apellido evaluador']).'
                    </td>
                </tr>';
				if (isset($evaluacion['eva_faena']) && trim($evaluacion['eva_faena']) !== '') {
					$content .= '
					<tr>
						<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
							Faena
						</td>
						<td width="218">
							: '.strtoupper($evaluacion['eva_faena']).'
						</td>
					</tr>';
                }
                if (isset($evaluacion['Jefe faena']) && trim($evaluacion['Jefe faena']) !== '') {
					$content .= '
					<tr>
						<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
							Jefe de faena
						</td>
						<td width="218">
							: '.strtoupper($evaluacion['Jefe faena']).'
						</td>
					</tr>';
				}
				if (isset($evaluacion['Geo referencia']) && trim($evaluacion['Geo referencia']) !== '') {
					$content .= '
					<tr>
						<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
							Geo referencia
						</td>
						<td width="218">
							: '.strtoupper($evaluacion['Geo referencia']).'
						</td>
					</tr>';
				}
				if (isset($evaluacion['eva_comuna']) && trim($evaluacion['eva_comuna']) !== '') {
					$content .= '
					<tr>
						<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
							Comuna
						</td>
						<td width="218">
							: '.strtoupper($evaluacion['eva_comuna']).'
						</td>
					</tr>';
				}
				if (isset($evaluacion['eva_patente']) && trim($evaluacion['eva_patente']) !== '') {
					$content .= '
					<tr>
						<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
							Patente
						</td>
						<td width="218">
							: '.strtoupper($evaluacion['eva_patente']).'
						</td>
					</tr>';
				}
				if (isset($evaluacion['eva_ot']) && trim($evaluacion['eva_ot']) !== '') {
					$content .= '
					<tr>
						<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
							N° Orden de trabajo
						</td>
						<td width="218">
							: '.strtoupper($evaluacion['eva_ot']).'
						</td>
					</tr>';
                }
                $content .= '
				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Actividad
					</td>
					<td width="218">
						: '.strtoupper($evaluacion['eva_tipo']).'
					</td>
				</tr>';
				$content .= '
				</thead>
				<tr>
				</tr>
                </table>';
 
                // Inicio 2da tabla
                $content .= '
                <table style="background-color: #f7f5f7; margin-left: 350">
				<thead>';
                $content .= '
				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:120;">
						
					</td>
					<td width="218">
          
					</td>';
                $content .= '
                </tr>
				<tr> 
					<td width="115" height="5">
					</td>
				</tr>';
     
                $content .= '
				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:120;">
						Rut trabajador
					</td>
					<td width="218">
						: '.$evaluacion['Rut trabajador'].'
					</td>
                </tr>';
                
				$content .= '
				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:120;">
						Nombre trabajador
					</td>
					<td width="218">
						: '.$evaluacion['Nombre Trabajador'].'
					</td>
                </tr>';
				// Consulta para auto completar
				$formulario = Yii::app()->db->createCommand("select campo from min_formularios where checklist = '".$evaluacion['eva_tipo']."'")->queryScalar();
				$formularioNombres = Yii::app()->db->createCommand("select nombre_campos from min_formularios where checklist = '".$evaluacion['eva_tipo']."'")->queryScalar();
				$arrayCampos = explode(',', $formulario);
				$arrayNombreCampos = explode(',', $formularioNombres);
				for ($i=0; $i < count($arrayCampos); $i++) { 
					$valor = Yii::app()->db->createCommand("select ".$arrayCampos[$i]." from min_evaluacion_equipos where eva_id = ".$evaluacion['eva_id'])->queryScalar();
					if ($arrayCampos[$i] == 'eva_comuna' ||  $arrayCampos[$i] == 'eva_fundo' ||  $arrayCampos[$i] == 'eva_ot'||  $arrayCampos[$i] == 'tra_rut' ||  $arrayCampos[$i] == 'eva_apellidos' ||  $arrayCampos[$i] == 'eva_nombres' ||  $arrayCampos[$i] == 'eva_faena' ||  $arrayCampos[$i] == 'eva_tipo_cosecha' ||  $arrayCampos[$i] == 'eva_jefe_faena') {

					} else{
						if (trim($valor) !== '' && isset($valor)) {
							$content .= '
								<tr>
									<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
										'.$arrayNombreCampos[$i].'
									</td>
									<td width="218">
										: '.$valor.'
									</td>
								</tr>
								';
						}
					}
					
				}
				$content .= '
				</thead>
				<tr>
				</tr>
                </table>';
            $content .= '
			</td>
		</tr>
		<tr>
			<td style="height: 10px;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#176897" style="padding-top: 5px; padding-bottom: 5px; color: white; text-align: center; font-size: 14px; font : black; border-radius: 10px;">
				RESULTADOS DE LA EVALUACIÓN
			</td>
		</tr>
		';
		
		$tematicas = Yii::app()->db->createCommand("SELECT DISTINCT tem_id FROM min_respuesta_equipos WHERE eva_id = ".$id)->query()->readAll();
		for($i=0;$i<count($tematicas);$i++){
			$content.= '
			<tr>
				<td>
					<table cellspacing="0" cellpadding="0" style="margin-top: 10px;">
					<tr bgcolor="#eeecee" style="margin-top:20px; margin-bottom:20px;">
						<td colspan="2" style="font-size: 14px; padding-top: 5px; padding-bottom: 5px; border-radius: 10px 0px 0px 10px;" width="600">
							'.$tematicas[$i]['tem_id'].'
						</td>
						<td style="padding-top: 5px; padding-bottom: 5px; font-size: 14px; border-radius: 0px 10px 10px 0px; text-align: center;" width="100">
							Resultado
						</td>
					</tr>
					';
					$preguntas = Yii::app()->db->createCommand("SELECT * FROM min_respuesta_equipos WHERE tem_id = '".$tematicas[$i]['tem_id']."' AND eva_id = ".$id)->query()->readAll();
					for($j=0;$j<count($preguntas);$j++){

						$img = '';
						if($preguntas[$j]['res_respuesta'] == 'si') $img = '<img src="img/check2.png" height="17">';
						if($preguntas[$j]['res_respuesta'] == 'no') $img = '<img src="img/mal2.png" height="17">';
						if($preguntas[$j]['res_respuesta'] == 'n/a') $img = '<img src="img/na2.png" height="17">';

						$content.= '
						<tr class="active">
							<td width="25" style="vertical-align: top;">
								'.($i+1).'.'.($j+1).'
							</td>
							<td width="560" style="vertical-align: top;">
								'.($preguntas[$j]['res_enunciado']).'
							</td>
							<td style="text-align: center;" width="100">
								'.$img.'
							</td>
						</tr>
						';
					}
					$content.= '
					</table>
				</td>
			</tr>
			';
		}
		//obtencion de valores de riesgo y actualizacion
			$limit1 = Yii::app()->params['riesgoalto'];
			$limit2 = Yii::app()->params['riesgomedio'];

			$MalNotaBaja = Yii::app()->params['MalNotaBaja'];
          	$RalLimBajo = Yii::app()->params['RalLimBajo'];

          	$MalNotaMedia = Yii::app()->params['MalNotaMedia'];
          	$RalLimMedio = Yii::app()->params['RalLimMedio'];

          	$MalNotaAlta = Yii::app()->params['MalNotaAlta'];
			$RalLimAlto = Yii::app()->params['RalLimAlto'];
		// Calcular nota
		//Nuevo calculo de notas rangos 0<85<95<100
		$nota = '';
		if($evaluacion['eva_cache_porcentaje']>=0 && $evaluacion['eva_cache_porcentaje']<=$limit1) $nota = (($MalNotaBaja*$evaluacion['eva_cache_porcentaje'])+$RalLimBajo);
		if($evaluacion['eva_cache_porcentaje']>$limit1 && $evaluacion['eva_cache_porcentaje']<=$limit2) $nota = (($MalNotaMedia*$evaluacion['eva_cache_porcentaje'])-$RalLimMedio);
		if($evaluacion['eva_cache_porcentaje']>$limit2 && $evaluacion['eva_cache_porcentaje']<=100) $nota = (($MalNotaAlta*$evaluacion['eva_cache_porcentaje'])-$RalLimAlto);
		$nota = number_format(floor($nota*10)/10,1,",",".");


		$ver= Yii::app()->db->createCommand("SELECT res_critico,res_respuesta FROM min_respuesta_equipos WHERE eva_id = ".$id)->query()->readAll();
		for($s=0;$s<count($ver);$s++){

				if($ver[$s]['res_critico'] == 'si'&&$ver[$s]['res_respuesta']=='no'){
					$alerta1 = '¡Precaución!: Maquinaria ha incumplido una pregunta considerada crítica.';//';
					$alerta2 = ' Se recomienda Identificar las desviaciones, implementar las medidas correctivas y un realizar un seguimiento sistemático.';//';
					$tienecriticosi='si';
				}else if($ver[$s]['res_critico'] == 'si'&&$ver[$s]['res_respuesta']=='si'){
					$alerta1 = '';
					$alerta2 = '';
					$tienecriticono = 'no';
				}else{
					$alerta1 = '';
					$alerta2 = '';
					$tienecritico = 'no';
					$tienecriticosi = 'no';
					$tienecriticono = 'no';
				}


		}
		//verificamos si cumple con el porcentaje minimo de respuesta
		$verpromedio = Yii::app()->db->createCommand("SELECT eva_cache_porcentaje From min_evaluacion_equipos WHERE eva_id=".$id)->query()->readAll();
		for($t=0;$t<count($verpromedio);$t++){
			$notapromedio = number_format(floor($verpromedio[$t]['eva_cache_porcentaje']));
			if($notapromedio>85 and $tienecriticosi=='si'){
				$alerta1 = '¡Precaución!: Maquinaria ha incumplido una pregunta considerada crítica.';//';
				$alerta2 = 'Se recomienda Identificar las desviaciones, implementar las medidas correctivas y un realizar un seguimiento sistemático.';//';

			}elseif($notapromedio<=85 or $tienecriticosi=='si'){
				$alerta1 = ' ¡ALERTA! Maquinaria en Nivel de Riesgo ALTO';//';
				$alerta2 = ' Se recomienda detener los trabajos y reparar equipos.';//';
			}elseif($notapromedio>85 and $tienecriticono=='no'){
				$alerta1 = '';
				$alerta2 = '';
			}elseif($tienecriticosi=='si'){
				$alerta1 = ' ¡Precaución!: Maquinaria ha incumplido una pregunta considerada crítica.';//';
				$alerta2 = ' Se recomienda Identificar las desviaciones, implementar las medidas correctivas y un realizar un seguimiento sistemático.';//';
			}elseif($tienecritico=='no'){
				$alerta1 = '';//';
				$alerta2 = '';//';
			}
		}/****/

					/**
					<div>
					<tr><td colspan="30" style="text-align: center; color:red;"><b>'.$alerta1.'</b></td></tr>
			  		<tr><td colspan="30" style="text-align: center;"><b>'.$alerta2.'</b></td><br></tr>
					 <p style="text-align: center; color:red;"><b>'.$alerta1.'</b></td></p>
			  		<p style="text-align: center;"><b>'.$alerta2.'</b></td><br></p>
				</div>
					**/
					/** Prueba de jorge iraira
					<tr><td colspan="30" style="text-align: center; color:red;"><b>'.$alerta1.'</b></td></tr>
			  		<tr><td colspan="30" style="text-align: center;"><b>'.$alerta2.'</b></td><br></tr>

						<tr><td><b></b> '.$alerta1.'<br><br></td></tr>
					**/

		$content.='
		<tr>
			<td>
				<table cellspacing="0" cellpadding="0" style="margin-top: 10px;">
					<tr><td><b>Observaciones generales:</b> '.$evaluacion['eva_general_observacion'].'<br><br></td></tr>


				</table>

			</td>

		</tr>
		<tr><td style="text-align: center;color:red;"><b>'.$alerta1.'</b></td></tr>
		<tr><td style="text-align: center;"><b>'.$alerta2.'</b></td><br></tr>


		<tr>
		<td align="center">
		<img src="img/barra-N1.png" style="width: 350px;">
		<span style="font-size: 45px; color: #176897; margin-left: -140px; margin-top: -10px;">'.floor($evaluacion['eva_cache_porcentaje']).'%</span>
		<span> </span><span> </span><span> </span>
		<img src="img/barra-N2.png" style="width: 350px;">
		<span style="font-size: 45px; color: #176897; margin-left: -120px; margin-top: -10px;">'.$nota.'</span>
		</td>
		</tr>


		</table>
		</page>
		';
		$resp2 = Yii::app()->db->createCommand("SELECT count(*) as contObs FROM min_respuesta_equipos where (res_foto != '' or res_observacion != '') AND eva_id = ".$id)->query()->readAll();
		if ($resp2[0]['contObs'] != '0') {

		$content.= '
		<page backtop="31mm" backbottom="12mm" backleft="15mm" backright="15mm" style="font-size: 12pt;">
		<page_header>
		<table class="page_header" style="padding-top: 10px; border-bottom: 7px solid #176897; background-color: #f7931d;">
		<tr>
			<td style="width: 30%; text-align: left; border-left-width:30;">
			<img src="img/logopdf.png" width="125px;">
			</td>
			<td style="width: 45%; text-align: center; font-size: 20px; color: white; height: 90px;">
				 INFORME DE MONITOREO<br>EVALUACIÓN DE DESEMPEÑO SSO
			</td>
			<td style="width: 20%; text-align: right; border-left-width:30;">
				'.$logo.'
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
		<table style="font-size:11px;">

		<tr><td style="text-align: center; font-size: 14px;">OBSERVACIONES</td></tr>
		<tr><td style="height: 10px;"></td></tr>
		';


	    $resp = Yii::app()->db->createCommand("SELECT * FROM min_respuesta_equipos where (res_foto != '' or res_observacion != '') AND eva_id = ".$id)->query()->readAll();
					for($x=0;$x<count($resp);$x++){

		if($resp[$x]['res_seguimiento'] == 1){
          $semaforo = "<td class='th-sortable' data-toggle='class' style='text-align: center; width:100;'>Cerrada</td>";
        }else{
          $today = date("Y-m-d H:i");
          $date = $resp[$x]['res_plazo']." 00:00:00";
          if($date < $today){
            $semaforo = "<td class='th-sortable' data-toggle='class' style='text-align: center; width:100;'>Pendiente</td>";
          }else{
            $semaforo = "<td class='th-sortable' data-toggle='class' style='text-align: center; width:100;'>En proceso</td>";
          }
        }
          if ($resp[$x]['res_foto'] != "") {
		  	$img ='<tr>
		  		<td rowspan="3" width="420" >Observacion: '.$resp[$x]['res_observacion'].'</td>
		  		<td rowspan="3" width="0" align="center"><img src="data:image/;base64,'.$resp[$x]['res_foto'].'" width="100"></td>
		  		<td height="10" scope="cool" class="th-sortable" data-toggle="class" style="text-align: center; width:0;">Plazo Control</td>
			</tr>
			<tr>
				<td scope="cool" width="0" height="10" align="center">'.$resp[$x]['res_plazo'].'</td>
			</tr>
			 <tr>
				<td height="20" class="th-sortable" data-toggle="class" style="text-align: center; width:0;"></td>
			</tr>  ';
		  }else{
		  	$img= '<tr>
		  		<td rowspan="3" width="420" >Observacion: '.$resp[$x]['res_observacion'].'</td>
		  		<td rowspan="3" width="0" align="center"></td>
		  		<td height="10" scope="cool" class="th-sortable" data-toggle="class" style="text-align: center; width:0;">Plazo Control</td>
			</tr>
			<tr>
				<td scope="cool" width="0" height="10" align="center">'.$resp[$x]['res_plazo'].'</td>
			</tr>
			 <tr>
				<td  class="th-sortable" data-toggle="class" style="text-align: center; width:0;"></td>
			</tr>
		  	';
		  }
		$content.='


		<tr>
		<td>
		<table cellspacing="0" cellpadding="0" style="font-size: 12px;">
		  	<tr bgcolor="#DCDCDC">
			  	<td colspan="2" style="padding-top: 5px; padding-bottom: 5px; font-size: 14px; border-radius: 10px 0px 0px 10px; text-align: left; width:600;">Pregunta</td>
          		<td style="padding-top: 5px; padding-bottom: 5px; font-size: 14px; border-radius: 0px 10px 10px 0px; text-align: center; width:100;">Seguimiento</td>
		  	</tr>
		  	<tr>
			  	<td colspan="2" width="600">'.$resp[$x]['res_enunciado'].'</td>
				'.$semaforo.'
		  	</tr>
		  	'.$img.'
		</table>

		</td>
		</tr>
		';
		}
		 $content.='
		</table>
		</page>
		';
		}
	    // convert to PDF
	    Yii::import('application.vendor.*');
		require_once('html2pdf/html2pdf.class.php');
	    try
	    {
	        $html2pdf = new HTML2PDF('P', 'LETTER', 'fr');
	        $html2pdf->pdf->SetDisplayMode('fullpage');
	        $html2pdf->writeHTML($content, isset($_GET['html']));
	        $html2pdf->Output('detalleQ.pdf');
	    }
	    catch(HTML2PDF_exception $e) {
	        echo $e;
	        exit;
	    }
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new EvaEquipos;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['EvaEquipos']))
		{
			$model->attributes=$_POST['EvaEquipos'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->eva_id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		/*$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['EvaEquipos']))
		{
			$model->attributes=$_POST['EvaEquipos'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->eva_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
		$model=$this->loadModel($id);
*/
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['EvaEquipos']))
		{
			$model->attributes=$_POST['EvaEquipos'];
			if($model->save()){
				// Extraer preguntas del post
				$preguntas = array();
				$observaciones = array();
				$fechas = array();
				foreach($_POST as $key => $value){
					if(strpos($key,'p_') !== false){
						$k = substr($key, 2, 10);
						$preguntas[$k] = $value;
						$observaciones[$k] = $_POST['o_'.$k];
						$fechas[$k] = $_POST['f_'.$k];
					}
				}
				// Insertar respuestas
				foreach ($preguntas as $key => $value){
					// Subir imagen
					$dir_subida = 'imagenes_respuestas_equipos/';
					$fichero_subido = $dir_subida.basename($key.'.jpg');
					if (move_uploaded_file($_FILES['a_'.$key]['tmp_name'], $fichero_subido)) {
							$imagen=$fichero_subido;
					} else {
							$imagen='';
					}

					// Almacenar registro en la base de datos
					if($value == 'no') $seguimiento = 0; else $seguimiento = 1;
					Yii::app()->db->createCommand("
					UPDATE min_respuesta_equipos
					SET res_respuesta = '".$value."',
						res_seguimiento = '".$seguimiento."',
						res_plazo = '".$fechas[$key]."',
						res_observacion = '".$observaciones[$key]."',
						res_foto = '".$imagen."'
					WHERE res_id = '".$key."'
					")->execute();
				}

					// Actualizar porcentaje cache
				$limit1 = Yii::app()->params['riesgoalto'];
				$limit2 = Yii::app()->params['riesgomedio'];
				//$id = $obj->timestamp;
				$sql = "SELECT eva_id FROM min_respuesta_equipos WHERE eva_id = ".$id." GROUP BY eva_id";
				$categorias = Yii::app()->db->createCommand($sql)->query()->readAll();
				$nota = 0;
				$todosna = 0;

					$si = Yii::app()->db->createCommand("SELECT SUM(res_ponderacion) as n FROM min_respuesta_equipos WHERE eva_id = ".$id."  AND res_respuesta = 'si' GROUP BY res_respuesta")->queryScalar();
					$no = Yii::app()->db->createCommand("SELECT SUM(res_ponderacion) as n FROM min_respuesta_equipos WHERE eva_id = ".$id."  AND res_respuesta = 'no' GROUP BY res_respuesta")->queryScalar();
					$na = Yii::app()->db->createCommand("SELECT SUM(res_ponderacion) as n FROM min_respuesta_equipos WHERE eva_id = ".$id."  AND res_respuesta = 'n/a' GROUP BY res_respuesta")->queryScalar();
					if($si == '') $si = 0;
					if($no == '') $no = 0;
					if($na == '') $na = 0;
					if(($si + $no) > 0) $r = 100*($si / ($si + $no)); else $r = 0;
					$nota=$r;



				// Actualizar porcentaje cache
				$sql="UPDATE min_evaluacion_equipos SET eva_cache_porcentaje = '".$nota."' WHERE eva_id = ".$id;
				Yii::app()->db->createCommand($sql)->execute();

				// Redirigir
				$this->redirect(array('view','id'=>$model->eva_id));
			}

		}

		$this->render('update',array(
			'model'=>$model,
		));

	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionTrash($id)
	{

		
		$this->loadModel($id)->delete();
		$this->redirect(array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new EvaEquipos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['EvaEquipos']))
			$model->attributes=$_GET['EvaEquipos'];

		$this->render('admin',array(
			'model'=>$model,
		));
		/*
		$dataProvider=new CActiveDataProvider('EvaEquipos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
		*/
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new EvaEquipos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['EvaEquipos']))
			$model->attributes=$_GET['EvaEquipos'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return EvaEquipos the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=EvaEquipos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param EvaEquipos $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='eva-equipos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
