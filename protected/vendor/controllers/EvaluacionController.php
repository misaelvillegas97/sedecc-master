<?php

class EvaluacionController extends Controller
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
				'actions'=>array('index','view','pdf','pdfsafco','pdfprueba'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('admin','create','update','excel','trash'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','trash'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
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

	public function actionExcel(){
		// Iniciar modelos
		$model=new Evaluacion;
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
	}

	public function actionPdf($id)
	{
		header('Content-Type: text/html; charset=utf-8');
		$evaluacion = Yii::app()->db->createCommand("SELECT *, SUBSTRING_INDEX(eva_nombres, ' ', 1 ) as primer_nombre, SUBSTRING_INDEX(eva_apr, ' ', 1 ) as nombre_apr,
SUBSTRING(eva_apr,LOCATE(' ',eva_apr,LOCATE(' ',eva_apr)+1),LENGTH(eva_apr)) as apellido_apr, SUBSTRING_INDEX(eva_supervisor, ' ', 1 ) as nombre_supervisor,
SUBSTRING(eva_supervisor,LOCATE(' ',eva_supervisor,LOCATE(' ',eva_supervisor)+1),LENGTH(eva_supervisor)) as apellido_supervisor, SUBSTRING_INDEX(eva_jefe_faena, ' ', 1 ) as nombre_jefe_faena,
SUBSTRING(eva_jefe_faena,LOCATE(' ',eva_jefe_faena,LOCATE(' ',eva_jefe_faena)+1),LENGTH(eva_jefe_faena)) as apellido_jefe_faena FROM min_evaluacion WHERE eva_id = ".$id)->queryRow();

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
						Rut Trabajador
					</td>
					<td width="230">
						: '.$evaluacion['tra_rut'].'
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
						Nombre Trabajador
					</td>
					<td width="230">
						: '.$evaluacion['primer_nombre'].' '.$evaluacion['eva_apellidos'].'
					</td>
				</tr>
				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Jefe Faena
					</td>
					<td width="218">
						: '.$evaluacion['eva_jefe_faena'].'
					</td>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Cargo
					</td>
					<td width="230">
						: '.Yii::app()->db->createCommand("SELECT c.car_descripcion FROM min_trabajador as t JOIN min_cargo as c ON(t.car_id = c.car_id) WHERE t.tra_rut =  '".$evaluacion['tra_rut']."'")->queryScalar().'
					</td>
				</tr>
				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Asesor en Prevención
					</td>
					<td width="218">
						: '.$evaluacion['eva_apr'].'
					</td>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Vencimiento Corma
					</td>
					<td width="230">
						: '.$evaluacion['eva_vencimiento_corma'].'
					</td>
				</tr>
				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Supervisor
					</td>
					<td width="228">
						: '.$evaluacion['eva_supervisor'].'
					</td>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Licencia de Conducir
					</td>
					<td width="230">
						: '.$evaluacion['eva_licencia_conducir_clase'].'
					</td>
				</tr>
				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						
					</td>
					<td width="218">
						
					</td>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Vencimiento Licencia de Conducir
					</td>
					<td width="230">
						: '.$evaluacion['eva_licencia_conducir_vencimiento'].'
					</td>
				</tr>
				<tr>
					<td width="115" height="5">
					</td>
				</tr>
				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Codigo Evaluacion
					</td>
					<td width="218">
						: '.Yii::app()->controller->identificador($evaluacion['eva_evaluador'],$evaluacion['eva_fecha_evaluacion'],$evaluacion['eva_evaluador_correlativo']).'  
					</td>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Fundo
					</td>
					<td width="230">
						: '.$evaluacion['eva_fundo'].'
					</td>
				</tr>
				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Fecha Evaluación
					</td>
					<td width="218">
						: '.$evaluacion['eva_fecha_evaluacion'].'
					</td>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Comuna
					</td>
					<td width="230">
						: '.$evaluacion['eva_comuna'].'
					</td>
				</tr>
				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Georeferencia
					</td>
					<td width="218">
						: '.$evaluacion['eva_geo_x'].', '.$evaluacion['eva_geo_y'].'
					</td>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Faena
					</td>
					<td width="218">
						: '.$evaluacion['eva_faena'].'
					</td>
				</tr>
				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Ejecutor Evaluación
					</td>
					<td width="230">
						: '.Yii::app()->db->createCommand("SELECT CONCAT(tra_nombres, ' ', tra_apellidos) FROM min_trabajador WHERE tra_rut = '".$evaluacion['eva_evaluador']."'")->queryScalar().'
					</td>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Tipo Cosecha
					</td>
					<td width="218">
						: '.$evaluacion['eva_tipo_cosecha'].'
					</td>
				</tr>
				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Linea
					</td>
					<td width="218">
						: '.$evaluacion['eva_linea'].'
					</td>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Actividad
					</td>
					<td width="226">
						: '.$evaluacion['eva_tipo'].'
					</td>

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
		$tematicas = Yii::app()->db->createCommand("SELECT DISTINCT tem_id FROM min_respuesta WHERE eva_id = ".$id)->query()->readAll();
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
					$preguntas = Yii::app()->db->createCommand("SELECT * FROM min_respuesta WHERE tem_id = '".$tematicas[$i]['tem_id']."' AND eva_id = ".$id)->query()->readAll();
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
		// Calcular nota
		//Nuevo calculo de notas rangos 0<85<95<100
		$nota = '';
		if($evaluacion['eva_cache_porcentaje']>=0 && $evaluacion['eva_cache_porcentaje']<$limit1) $nota = ((0.029*$evaluacion['eva_cache_porcentaje'])+1);
		if($evaluacion['eva_cache_porcentaje']>=$limit1 && $evaluacion['eva_cache_porcentaje']<$limit2) $nota = ((0.05*$evaluacion['eva_cache_porcentaje'])-0.5);
		if($evaluacion['eva_cache_porcentaje']>=$limit2 && $evaluacion['eva_cache_porcentaje']<=100) $nota = ((0.1*$evaluacion['eva_cache_porcentaje'])-5);
		$nota = number_format(floor($nota*10)/10,1,",",".");


					$ver= Yii::app()->db->createCommand("SELECT * FROM min_respuesta WHERE eva_id = ".$id)->query()->readAll();
					for($s=0;$s<count($ver);$s++){
					$enun = $ver[$s]['res_enunciado'];
					$eval_id = $id;		
					$critico = Yii::app()->db->createCommand("SELECT critico,pre_enunciado,res_enunciado, r.eva_id FROM min_pregunta p inner join min_respuesta r on (pre_enunciado=res_enunciado) where res_enunciado = '".$enun."' AND r.eva_id = '".$eval_id."' ")->query()->readAll();
						for($d=0;$d<count($critico);$d++){
							if($critico[$d]['critico'] == 'no'){
								$alerta1 = '¡Alerta!: Trabajador ha incumplido una pregunta considerada crítica.';
								$alerta2 = ' Adopte las medidas correctivas necesarias.';
							}else{
								$alerta1 = '';
								$alerta2 = '';
							}
						}
					}
					/** Prueba de jorge iraira
						<tr><td><b></b> '.$alerta1.'<br><br></td></tr>
					**/

		$content.='
		<tr>
			<td>
				<table cellspacing="0" cellpadding="0" style="margin-top: 10px;">
					<tr><td><b>Observaciones generales:</b> '.$evaluacion['eva_general_observacion'].'<br><br></td></tr>
					<tr><td><b style="color:red;">'.$alerta1.'</b> <br>'.$alerta2.'<br></td></tr>
				</table>
			</td>
		</tr>



		<tr>
		<td align="center">
		<img src="img/barra-N1.png" style="width: 350px;">
		<span style="font-size: 45px; color: #176897; margin-left: -140px; margin-top: -10px;">'.round($evaluacion['eva_cache_porcentaje']).'%</span>
		<span> </span><span> </span><span> </span>
		<img src="img/barra-N2.png" style="width: 350px;">
		<span style="font-size: 45px; color: #176897; margin-left: -120px; margin-top: -10px;">'.$nota.'</span>
		</td>
		</tr>

		
		</table>
		</page>
		';
		$resp2 = Yii::app()->db->createCommand("SELECT count(*) as contObs FROM min_respuesta where (res_foto != '' or res_observacion != '') AND eva_id = ".$id)->query()->readAll();
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


	    $resp = Yii::app()->db->createCommand("SELECT * FROM min_respuesta where (res_foto != '' or res_observacion != '') AND eva_id = ".$id)->query()->readAll();
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


	public function actionPdfsafco($id)
	{
		header('Content-Type: text/html; charset=utf-8');
		$evaluacion = Yii::app()->db->createCommand("SELECT * FROM min_evaluacion as E JOIN min_trabajador as T ON(E.tra_rut = T.tra_rut) JOIN min_cargo as C ON(T.car_id = C.car_id)	WHERE eva_id = ".$id)->queryRow();

		$empresa = Yii::app()->db->createCommand("SELECT * FROM min_eess WHERE eess_rut = ".$evaluacion['eess_rut'])->queryRow();

		$logo2 = '';
		
		$ruta = "images/eess/"; // Indicar ruta
		 $filehandle = opendir($ruta); // Abrir archivos
		  while ($file = readdir($filehandle)) {
		   if ($file != "." && $file != "..") {
		    $tamanyo = GetImageSize($ruta . $file);

			 if ($file == '76885630.jpg'){
		     	$logo2 = '<img src="'.$ruta.$file.'" style="width: 200px;">';
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
		<table class="page_header" style="padding-top: 10px; border-bottom: 7px solid #176897; background-color: #00902f;">
		<tr>
			<td style="width: 45%; text-align: left; border-left-width:30;">
			'.$logo2.'
			</td>
			<td style="width: 50%; text-align: right; font-size: 20px; color: white; height: 90px;">
				 CONTROL OPERACIONAL <br> EN TAREAS DE '.strtoupper($evaluacion['car_descripcion']).'
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
						Rut Trabajador
					</td>
					<td width="218">
						: '.$evaluacion['tra_rut'].'
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
						Nombre Trabajador
					</td>
					<td width="218">
						: '.$evaluacion['eva_nombres'].' '.$evaluacion['eva_apellidos'].'
					</td>

					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Asesor en Prevención
					</td>
					<td width="230">
						: '.$evaluacion['eva_apr'].'
					</td>
				</tr>
				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Vencimiento Corma
					</td>
					<td width="218">
						: '.$evaluacion['eva_vencimiento_corma'].'
					</td>
					
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Jefe Faena
					</td>
					<td width="230">
						: '.$evaluacion['eva_jefe_faena'].'
					</td>

				</tr>
				
				<!-- 
				<tr>
				<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Clase Licencia de Conducir
					</td>
					<td width="218">
						: '.$evaluacion['eva_licencia_conducir_clase'].'
					</td>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Vencimiento Licencia de Conducir
					</td>
					<td width="230">
						: '.$evaluacion['eva_licencia_conducir_vencimiento'].'
					</td>
				</tr>
				-->
				<tr>
					<td width="115" height="5">
					</td>
				</tr>
				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Codigo Evaluacion
					</td>
					<td width="218">
						: '.Yii::app()->controller->identificador($evaluacion['eva_evaluador'],$evaluacion['eva_fecha_evaluacion'],$evaluacion['eva_evaluador_correlativo']).'  
					</td>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Fundo
					</td>
					<td width="230">
						: '.$evaluacion['eva_fundo'].'
					</td>
				</tr>
				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Fecha Evaluación
					</td>
					<td width="218">
						: '.$evaluacion['eva_fecha_evaluacion'].'
					</td>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Comuna
					</td>
					<td width="230">
						: '.$evaluacion['eva_comuna'].'
					</td>
				</tr>
				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Georeferencia
					</td>
					<td width="218">
						: '.$evaluacion['eva_geo_x'].', '.$evaluacion['eva_geo_y'].'
					</td>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Faena
					</td>
					<td width="218">
						: '.$evaluacion['eva_faena'].'
					</td>
				</tr>
				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Linea
					</td>
					<td width="218">
						: '.$evaluacion['eva_linea'].'
					</td>

					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Tipo Cosecha
					</td>
					<td width="218">
						: '.$evaluacion['eva_tipo_cosecha'].'
					</td>
				</tr>
				<tr>
									<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Ejecutor Evaluación
					</td>
					<td width="230">
						: '.Yii::app()->db->createCommand("SELECT upper(CONCAT(tra_nombres, ' ', tra_apellidos)) FROM min_trabajador WHERE tra_rut = '".$evaluacion['eva_evaluador']."'")->queryScalar().'
					</td>
					

					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Cargo Ejecutor
					</td>
					<td width="218">
						: '.Yii::app()->db->createCommand("SELECT upper(car_descripcion) FROM min_trabajador as T join min_cargo as C on(T.car_id = C.car_id) WHERE tra_rut = '".$evaluacion['eva_evaluador']."'")->queryScalar().'
					</td>
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
		$tematicas = Yii::app()->db->createCommand("SELECT DISTINCT tem_id FROM min_respuesta WHERE eva_id = ".$id)->query()->readAll();
		for($i=0;$i<count($tematicas);$i++){
			$content.= '
			<tr>
				<td>
					<table cellspacing="0" cellpadding="0" style="margin-top: 5px;">
					<tr bgcolor="#eeecee" style="margin-top:10px; margin-bottom:10px;">
						<td colspan="2" style="font-size: 14px; padding-top: 5px; padding-bottom: 5px; border-radius: 10px 0px 0px 10px;" width="600">
							'.$tematicas[$i]['tem_id'].'
						</td>
						<td style="padding-top: 5px; padding-bottom: 5px; font-size: 14px; border-radius: 0px 10px 10px 0px; text-align: center;" width="100">
							Resultado
						</td>
					</tr>
					';
					$preguntas = Yii::app()->db->createCommand("SELECT * FROM min_respuesta WHERE tem_id = '".$tematicas[$i]['tem_id']."' AND eva_id = ".$id)->query()->readAll();
					for($j=0;$j<count($preguntas);$j++){
								
						$img = '';
						if($preguntas[$j]['res_respuesta'] == 'si') $img = '<img src="img/check2.png" height="16">';
						if($preguntas[$j]['res_respuesta'] == 'no') $img = '<img src="img/mal2.png" height="16">';
						if($preguntas[$j]['res_respuesta'] == 'n/a') $img = '<img src="img/na2.png" height="16">';
						
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
		
		// Calcular nota
		$nota = '';
		if($evaluacion['eva_cache_porcentaje']>=0 && $evaluacion['eva_cache_porcentaje']<$limit1) $nota = ((0.029*$evaluacion['eva_cache_porcentaje'])+1);
		if($evaluacion['eva_cache_porcentaje']>=$limit1 && $evaluacion['eva_cache_porcentaje']<$limit2) $nota = ((0.05*$evaluacion['eva_cache_porcentaje'])-0.5);
		if($evaluacion['eva_cache_porcentaje']>=$limit2 && $evaluacion['eva_cache_porcentaje']<=100) $nota = ((0.1*$evaluacion['eva_cache_porcentaje'])-5);
		$nota = number_format(floor($nota*10)/10,1,",",".");
			

		$content.='
		<!--
		<tr>
			<td>
				<table cellspacing="0" cellpadding="0" style="margin-top: 10px;">
					<tr><td><b>Observaciones generales:</b> '.$evaluacion['eva_general_observacion'].'<br><br></td></tr>
				</table>
			</td>
		</tr>
		-->



		<tr>
		<td align="center">
		<img src="img/CUMPLIMIENTO.png" style="width: 350px;">
		<span style="font-size: 50px; color: white; margin-left: -140px; margin-top: -5px;">'.round($evaluacion['eva_cache_porcentaje']).'%</span>
		<span> </span><span> </span><span> </span>
		<img src="img/NOTA.png" style="width: 350px;">
		<span style="font-size: 50px; color: white; margin-left: -120px; margin-top: -5px;">'.$nota.'</span>
		</td>
		</tr>

		
		</table>
		</page>
		';
		$resp2 = Yii::app()->db->createCommand("SELECT count(*) as contObs FROM min_respuesta where (res_foto != '' or res_observacion != '') AND eva_id = ".$id)->query()->readAll();
		if ($resp2[0]['contObs'] != '0') {
			
		$content.= '
		<page backtop="31mm" backbottom="12mm" backleft="15mm" backright="15mm" style="font-size: 12pt;">
		<page_header>
		<table class="page_header" style="padding-top: 10px; border-bottom: 7px solid #176897; background-color: #00902f;">
		<tr>
			<td style="width: 45%; text-align: left; border-left-width:30;">
			'.$logo2.'
			</td>
			<td style="width: 50%; text-align: right; font-size: 20px; color: white; height: 90px;">
				 CONTROL OPERACIONAL <br> EN TAREAS DE '.strtoupper($evaluacion['car_descripcion']).'
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


	    $resp = Yii::app()->db->createCommand("SELECT * FROM min_respuesta where (res_foto != '' or res_observacion != '') AND eva_id = ".$id)->query()->readAll();
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


	public function actionPdfprueba($id)
	{
		header('Content-Type: text/html; charset=utf-8');
		$evaluacion = Yii::app()->db->createCommand("SELECT * FROM min_evaluacion WHERE eva_id = ".$id)->queryRow();

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
						Rut Trabajador
					</td>
					<td width="230">
						: '.$evaluacion['tra_rut'].'
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
						Nombre Trabajador
					</td>
					<td width="230">
						: '.$evaluacion['eva_nombres'].' '.$evaluacion['eva_apellidos'].'
					</td>
				</tr>
				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Jefe Faena
					</td>
					<td width="218">
						: '.$evaluacion['eva_jefe_faena'].'
					</td>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Cargo
					</td>
					<td width="230">
						: '.$evaluacion['eva_tipo'].'
					</td>
				</tr>
				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Asesor en Prevención
					</td>
					<td width="218">
						: '.$evaluacion['eva_apr'].'
					</td>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Vencimiento Corma
					</td>
					<td width="230">
						: '.$evaluacion['eva_vencimiento_corma'].'
					</td>
				</tr>
				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Supervisor
					</td>
					<td width="218">
						: '.$evaluacion['eva_supervisor'].'
					</td>
				</tr>
				<tr>
					<td width="115" height="5">
					</td>
				</tr>
				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Codigo Evaluacion
					</td>
					<td width="218">
						: '.Yii::app()->controller->identificador($evaluacion['eva_evaluador'],$evaluacion['eva_fecha_evaluacion'],$evaluacion['eva_evaluador_correlativo']).'  
					</td>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Fundo
					</td>
					<td width="230">
						: '.$evaluacion['eva_fundo'].'
					</td>
				</tr>
				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Fecha Evaluación
					</td>
					<td width="218">
						: '.$evaluacion['eva_fecha_evaluacion'].'
					</td>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Comuna
					</td>
					<td width="230">
						: '.$evaluacion['eva_comuna'].'
					</td>
				</tr>
				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Georeferencia
					</td>
					<td width="218">
						: '.$evaluacion['eva_geo_x'].', '.$evaluacion['eva_geo_y'].'
					</td>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Faena
					</td>
					<td width="218">
						: '.$evaluacion['eva_faena'].'
					</td>
				</tr>
				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Ejecutor Evaluación
					</td>
					<td width="230">
						: '.Yii::app()->db->createCommand("SELECT CONCAT(tra_nombres, ' ', tra_apellidos) FROM min_trabajador WHERE tra_rut = '".$evaluacion['eva_evaluador']."'")->queryScalar().'
					</td>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Tipo Cosecha
					</td>
					<td width="218">
						: '.$evaluacion['eva_tipo_cosecha'].'
					</td>
				</tr>
				<tr>
					<td class="th-sortable" data-toggle="class" style="text-align: left; width:115;">
						Linea
					</td>
					<td width="218">
						: '.$evaluacion['eva_linea'].'
					</td>
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
		$tematicas = Yii::app()->db->createCommand("SELECT DISTINCT tem_id FROM min_respuesta WHERE eva_id = ".$id)->query()->readAll();

		
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
					$preguntas = Yii::app()->db->createCommand("SELECT * FROM min_respuesta WHERE tem_id = '".$tematicas[$i]['tem_id']."' AND eva_id = ".$id)->query()->readAll();
					
					for($j=0;$j<count($preguntas);$j++){
						
					
						$img = '';
						if($preguntas[$j]['res_respuesta'] == 'si') $img = '<img src="img/check.png" height="17">';
						if($preguntas[$j]['res_respuesta'] == 'no') $img = '<img src="img/mal.png" height="17">';
						if($preguntas[$j]['res_respuesta'] == 'n/a') $img = '<img src="img/na.png" height="17">';
						
						$content.= '
						<tr>
							<td width="25">
								'.($i+1).'.'.($j+1).'
							</td>
						';
						if ($tematicas[$i]['tem_id'] == 'ADMINISTRATIVAS' or $tematicas[$i]['tem_id'] == 'IMPLEMENTACIÓN DE FAENAS (DS 594)' or $tematicas[$i]['tem_id'] == 'LEGALES' or $tematicas[$i]['tem_id'] == 'VEHÍCULO TRANSPORTE PERSONAL') {
							$content.= '
								<td width="560">
									'.($preguntas[$j]['res_enunciado']).'
								</td>
							';
						}

						$content.= '
							<td width="100">
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
		// Calcular nota
		$nota = '';
		if($evaluacion['eva_cache_porcentaje']>=0 && $evaluacion['eva_cache_porcentaje']<$limit1) $nota = ((0.029*$evaluacion['eva_cache_porcentaje'])+1);
		if($evaluacion['eva_cache_porcentaje']>=$limit1 && $evaluacion['eva_cache_porcentaje']<$limit2) $nota = ((0.05*$evaluacion['eva_cache_porcentaje'])-0.5);
		if($evaluacion['eva_cache_porcentaje']>=$limit2 && $evaluacion['eva_cache_porcentaje']<=100) $nota = ((0.1*$evaluacion['eva_cache_porcentaje'])-5);
		$nota = number_format(floor($nota*10)/10,1,",",".");


		$content.='
		<tr>
			<td>
				<table cellspacing="0" cellpadding="0" style="margin-top: 10px;">
					<tr><td><b>Observaciones generales:</b> '.$evaluacion['eva_general_observacion'].'<br><br></td></tr>
				</table>
			</td>
		</tr>



		<tr>
		<td align="center">
		<img src="img/barra-N1.png" style="width: 350px;">
		<span style="font-size: 50px; color: #176897; margin-left: -140px; margin-top: -10px;">'.round($evaluacion['eva_cache_porcentaje']).'%</span>
		<span> </span><span> </span><span> </span>
		<img src="img/barra-N2.png" style="width: 350px;">
		<span style="font-size: 50px; color: #176897; margin-left: -120px; margin-top: -10px;">'.$nota.'</span>
		</td>
		</tr>

		</table>
		</page>
		';
		$resp2 = Yii::app()->db->createCommand("SELECT count(*) as contObs FROM min_respuesta where (res_foto != '' or res_observacion != '') AND eva_id = ".$id)->query()->readAll();
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


	    $resp = Yii::app()->db->createCommand("SELECT * FROM min_respuesta where (res_foto != '' or res_observacion != '') AND eva_id = ".$id)->query()->readAll();
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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Evaluacion;
		if(Yii::app()->controller->usertype() == 1) $model->eess_rut = Yii::app()->user->id;

		if(isset($_POST['Evaluacion']))
		{
			$model->attributes=$_POST['Evaluacion'];
			if(Yii::app()->controller->usertype() == 1) $model->eess_rut = Yii::app()->user->id;
			// Acá falta obtener la contraseña desde el rut.
			
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Evaluacion']))
		{
			$model->attributes=$_POST['Evaluacion'];
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
					$dir_subida = 'imagenes_respuestas/';
					$fichero_subido = $dir_subida.basename($key.'.jpg');
					if (move_uploaded_file($_FILES['a_'.$key]['tmp_name'], $fichero_subido)) {
					    $imagen=$fichero_subido;
					} else {
					    $imagen='';
					}
					
					// Almacenar registro en la base de datos
					if($value == 'no') $seguimiento = 0; else $seguimiento = 1;
					Yii::app()->db->createCommand("
					UPDATE min_respuesta
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
				
				// Actualizar porcentaje cache
				$sql="UPDATE min_evaluacion SET eva_cache_porcentaje = '".$nota."' WHERE eva_id = ".$id;
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
		$model=new Evaluacion('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Evaluacion']))
			$model->attributes=$_GET['Evaluacion'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Evaluacion('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Evaluacion']))
			$model->attributes=$_GET['Evaluacion'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Evaluacion the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Evaluacion::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Evaluacion $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='evaluacion-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
