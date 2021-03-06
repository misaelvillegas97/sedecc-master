<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		if(Yii::app()->user->isGuest) $this->redirect(Yii::app()->createUrl('site/login'));
		$this->render('index');
	}
	
	public function actionP($view)
	{
		if(Yii::app()->user->isGuest) $this->redirect(Yii::app()->createUrl('site/login'));
		$this->renderPartial('pages/'.$view);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->renderPartial('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			//var_dump($_POST['LoginForm']);
			//return;
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->renderPartial('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionDesviaciones(){


$tipo = $_GET['tipo'];



   if($tipo ==1){
      $emp = $_GET['eess'];
      $where = "AND e.eess_rut = '".$emp."'";
 	}elseif ($tipo ==2){
 		$emp = $_GET['eess'];
 		if(!isset($_GET['eess'])|| $_GET['eess'] == false){
			$where ="";
 		}else{
 			$where = "AND e.eess_rut = '".$emp."'";
		}
 	}elseif ($tipo ==3){
 		$emp = $_GET['eess'];
		$where = "AND e.eess_rut = '".$emp."'";
 	}

  
   

		$rows = Yii::app()->db->createCommand("
		SELECT
CONCAT(left(tr.tra_nombres,3), left(tr.tra_apellidos,3),DATE_FORMAT(eva_fecha_evaluacion, '%Y%m%d'),eva_evaluador_correlativo) AS 'Id',
		r.car_id AS 'checklist',
		e.tra_rut AS 'Rut Trabajador',
		e.eva_apellidos AS 'Apellidos',
		e.eva_nombres AS 'Nombres',
		m.car_descripcion AS 'Cargo',
		e.eva_fecha_evaluacion AS 'Fecha Evaluacion',
		e.eva_fundo AS 'Fundo',
		e.eva_faena AS 'Faena',
		e.eva_jefe_faena AS 'Jefe Faena',
		e.eva_supervisor AS 'Supervisor',
		tr.tra_vencimiento_corma AS 'Vencimiento Corma',
		e.eva_tipo_cosecha AS 'Tipo de cosecha',
		r.tem_id AS 'Item',
		r.res_enunciado AS 'Pregunta',
		r.res_observacion AS 'Observacion',
CASE 
	WHEN  r.res_seguimiento = 1
    	THEN 'Aprobadas' 
	WHEN r.res_plazo >= curdate() 
    	THEN 'En Proceso' 
	WHEN r.res_plazo < curdate() 
    	THEN 'Vencidas' 
END AS 'Seguimiento',
		r.res_plazo AS 'Plazo'
		
		FROM min_evaluacion e LEFT JOIN min_respuesta r ON (e.eva_id = r.eva_id) LEFT JOIN min_trabajador tr ON (e.eva_evaluador = tr.tra_rut ) LEFT JOIN min_cargo m ON (tr.car_id=m.car_id) WHERE  r.res_respuesta = 'no' ".$where."
		")->queryAll();


//$rows2 = Yii::app()->db->createCommand("SELECT e.eva_evaluador, e.eva_fecha_evaluacion, e.eva_evaluador_correlativo FROM min_evaluacion e")->queryAll();
		
		// Librer??as Excel
		Yii::import('application.vendor.*');
		require_once('PHPExcel.php');
		$objPHPExcel = new PHPExcel();
		
		// Agregar encabezados (no se usa)
		$i=0;$j=1;
		
		// Agregar datos
		foreach($rows as $key=>$fila){
			$i=0;$j++;

			foreach($fila as $key=>$valor){
				if($key=='Id'){
					if($valor=='2'){
				//$valor= ;
				//Yii::app()->controller->identificador($rows2['eva_evaluador'],$rows2['eva_fecha_evaluacion'],$rows2['eva_evaluador_correlativo'])
			}else{}
	}else{}
	$objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($i, 1, $key);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($i, $j, $valor);
				$i++;

			}
		}
		
		// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Seguimiento a incumplimientos.xls"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;
	}
public function actionReporte2(){
//creamos las columnas a crear
	if(!isset($_GET['param2']))
		{
			$filtro_eess = '';
		}else{
			$filtro_eess = $_GET['param2'];
		}
	if(!isset($_GET['param3'])) 
		{
			$filtro_tipo = '';
		}else{
			$filtro_tipo = $_GET['param3'];
		}
	if(isset($_GET['param3']))
		{
			$where= "WHERE car_id = '".$_GET['param3']."'";
		}else{
			$where= '';
		}

	$consulta_temas= Yii::app()->db->createCommand("SELECT DISTINCT(tem_id) FROM min_pregunta ".$where."")->query()->readAll();
		for($i=0;$i<count($consulta_temas);$i++)
		{
			$n_temas[$i] = $consulta_temas[$i]['tem_id'];
		}

	$completo= Yii::app()->db->createCommand("SELECT tra_rut, eva_nombres, eva_fecha_evaluacion ,eva_cache_porcentaje FROM min_evaluacion ")->query()->readAll();
	$tipo = Yii::app()->user->id;
// $_GET['param1'] parametro de actividad
// $_GET['param2'] parametros de empresa
	if($filtro_eess =='')
	{
		$where_eess = '';
		if($filtro_tipo ==''){
			$where_tipo = '';
		}else{
			$where_tipo = 'WHERE eva_tipo = "'.$filtro_tipo.'"';
		}
	}else{
		$where_eess = 'WHERE eess_rut = "'.$filtro_eess.'"';
		if($filtro_tipo ==''){
			$where_tipo = '';
		}else{
			$where_tipo = ' AND eva_tipo = "'.$filtro_tipo.'"';
		}
	}
	$arrayb = array();
	$arrayc = array();
	$consulta_temas= Yii::app()->db->createCommand("SELECT DISTINCT(tem_id) FROM min_pregunta ".$where." ORDER BY min_pregunta.tem_id")->query()->readAll();
		for($a=0;$a<count($consulta_temas);$a++)
			{
				$arrayb[] = 'eva_item_nota_'.$a;
				$arrayc[] = $consulta_temas[$a]['tem_id'];
			}
	$separado_por_comas = implode(",", $arrayb);
	$nombre_tem_comas = implode(",", $arrayc);
	if($a<1){	$separado_por_comas = 'eva_id';}
	$rows = Yii::app()->db->createCommand("
		SELECT eva_id AS 'ID Evaluacion',
		
		tra_rut AS 'Rut',
		CONCAT(eva_nombres,' ',eva_apellidos) AS 'Nombre Completo',
		eva_tipo AS 'Actividad',
		eva_fecha_evaluacion AS 'Fecha Evaluacion',".$separado_por_comas.", eva_cache_porcentaje AS 'Porcentaje Cumplimiento' FROM min_evaluacion e ".$where_eess." ".$where_tipo." ")->queryAll();
	
		// Librer??as Excel
	Yii::import('application.vendor.*');
	require_once('PHPExcel.php');
	$objPHPExcel = new PHPExcel();	
		// Agregar encabezados (no se usa)
	$i=0;$j=1;
		// Agregar datos
	foreach($rows as $key=>$fila){
			$i=0;$j++;
			//$key corresponde a la columna y
			foreach($fila as $key=>$valor){
				if($filtro_tipo=='Motosierristas Cosecha y Raleo'){
					if($key=='eva_item_nota_0')
						{
							$key= 'TOCONES';
						}
					if($key=='eva_item_nota_1'){$key= 'DESRAME';}
					if($key=='eva_item_nota_2'){$key= 'PLANIFICACI??N';}
					if($key=='eva_item_nota_3'){$key= 'TRANSVERSAL';}
					if($key=='eva_item_nota_4'){$key= 'TROZADO';}
					if($key=='eva_item_nota_5'){$key= 'VOLTEO';}
					
				}else{
					
					for($a=0;$a<count($consulta_temas);$a++)
					{
						if($key=='eva_item_nota_'.$a)
						$key = $arrayc[$a];
					}

				}
				$objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($i, 1, $key);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($i, $j, $valor);
				$i++;

			}
		
		}
		
		// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="repo2.xls"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;
	
	}

}