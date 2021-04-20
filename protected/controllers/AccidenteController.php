<?php

class AccidenteController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','trash'),
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Accidente;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		

		if(isset($_POST['Accidente']))
		{
			$model->attributes=$_POST['Accidente'];
			if($model->save()){
				$count=1;
				foreach($_POST['causaBasica'] as $key => $value)
				{
					$guardarCausaBasica= "INSERT INTO min_causas_basicas(
										acc_id,
										cbl_id
										) VALUES (
												".$model->id_accidente.",
												'".$value."'
											);";
											//return;
					Yii::app()->db->createCommand($guardarCausaBasica)->execute();
					$correlativo=$count.$value;
					$lastCausaBasica = Yii::app()->db->createCommand("SELECT max(cb_id) as id FROM min_causas_basicas")->query()->readAll();
					$lastId = $lastCausaBasica[0]['id'];
					if(isset($_POST['causaInmediata'])){
						foreach($_POST['causaInmediata'] as $key2 => $value2)
						{
							if(strpos($key2, $key.'_')!==false)
							{
								$guardarCausaInmediata= "INSERT INTO min_causas_inmediatas(
										cb_id,
										cil_id
										) VALUES (
												". $lastId .",
												'".$value2."'
											);";
											//return;
								//echo 'causaInmediata : ';
								//echo ' '.$key2.'/'.$key.'* ';
								Yii::app()->db->createCommand($guardarCausaInmediata)->execute();
								$lastCausaInmediata = Yii::app()->db->createCommand("SELECT max(ci_id) as id FROM min_causas_inmediatas")->queryScalar();
								foreach($_POST['medidaControl'] as $key3 => $value3)
								{
									if( strpos(substr($key3, 0, -2), $key2)!==false)
									{
										$guardarMedidaControl= "INSERT INTO min_medidas_control(
											ci_id,
											mcl_id,
											mc_plazo,
											mc_semaforo,
											tra_responsable
											) VALUES (
													". $lastCausaInmediata .",
													'".$value3."',
													'".$_POST['plazo'][$key3]."',
													'0',
													'".$_POST['responsable'][$key3]."'
												);";
												//return;
										Yii::app()->db->createCommand($guardarMedidaControl)->execute();
										//echo 'medidaControl : ';
										//echo ' '.$key3.'/'.$key2.'* ';
										
									}
								}
								
							}												
						}
										
					}
					
								
				}

				//luego de grabar, subo las imágenes o archivos correspondientes al accidentes
				$images = CUploadedFile::getInstancesByName('photos');
				// proceed if the images have been set
		        if (isset($images) && count($images) > 0) {
		
		            // go through each uploaded image
		            //creo el directorio con el id del accidente si es que no existe
		            if (!file_exists(Yii::getPathOfAlias('webroot').'/images/accidentes/'.$model->id_accidente.'/')) {
					    mkdir(Yii::getPathOfAlias('webroot').'/images/accidentes/'.$model->id_accidente, 0777, true);
					}
					
		            foreach ($images as $image => $pic) {
		                if ($pic->saveAs(Yii::getPathOfAlias('webroot').'/images/accidentes/'.$model->id_accidente.'/'.$pic->name)) {
		                    echo 'done';
		                }
		                else{
		                	echo 'error';
		                }
		                    // handle the errors here, if you want
		            }
		
		        }
			}
				if($model->save())
					$this->redirect(array('view','id'=>$model->id_accidente));
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
		
						

		if(isset($_POST['Accidente']))
		{
			//print_r($_POST);
			//return;
			$borrar = "DELETE mcb,mci,mmc
					      FROM min_causas_basicas mcb
					     	JOIN min_causas_inmediatas mci on mci.cb_id=mcb.cb_id
					     	JOIN min_medidas_control mmc on mmc.ci_id=mci.ci_id
					      WHERE
					      	mcb.acc_id=".$id." ";
											//return;
			Yii::app()->db->createCommand($borrar)->execute();
			/*var_dump($_POST['causaBasica']) ;
			return;*/
			$count=1;
			foreach($_POST['causaBasica'] as $key => $value)
			{
				$guardarCausaBasica= "INSERT INTO min_causas_basicas(
									acc_id,
									cbl_id
									) VALUES (
											".$id.",
											'".$value."'
										);";
										//return;
				Yii::app()->db->createCommand($guardarCausaBasica)->execute();
				$correlativo=$count.$value;
				$lastCausaBasica = Yii::app()->db->createCommand("SELECT max(cb_id) as id FROM min_causas_basicas")->query()->readAll();
				$lastId = $lastCausaBasica[0]['id'];
				if(isset($_POST['causaInmediata'])){
					foreach($_POST['causaInmediata'] as $key2 => $value2)
					{
						if(strpos($key2, $key.'_')!==false)
						{
							$guardarCausaInmediata= "INSERT INTO min_causas_inmediatas(
									cb_id,
									cil_id
									) VALUES (
											". $lastId .",
											'".$value2."'
										);";
										//return;
							//echo 'causaInmediata : ';
							//echo ' '.$key2.'/'.$key.'* ';
							Yii::app()->db->createCommand($guardarCausaInmediata)->execute();
							$lastCausaInmediata = Yii::app()->db->createCommand("SELECT max(ci_id) as id FROM min_causas_inmediatas")->queryScalar();
							foreach($_POST['medidaControl'] as $key3 => $value3)
							{
								if( strpos(substr($key3, 0, -2), $key2)!==false)
								{
									$guardarMedidaControl= "INSERT INTO min_medidas_control(
										ci_id,
										mcl_id,
										mc_plazo,
										mc_semaforo,
										tra_responsable
										) VALUES (
												". $lastCausaInmediata .",
												'".$value3."',
												'".$_POST['plazo'][$key3]."',
												'0',
												'".$_POST['responsable'][$key3]."'
											);";
											//return;
									Yii::app()->db->createCommand($guardarMedidaControl)->execute();
									//echo 'medidaControl : ';
									//echo ' '.$key3.'/'.$key2.'* ';
									
								}
							}
							
						}												
					}
									
				}
				
							
			}
			$model->attributes=$_POST['Accidente'];
			//luego de grabar, subo las imágenes o archivos correspondientes al accidentes
			$images = CUploadedFile::getInstancesByName('photos');
			// proceed if the images have been set
	        if (isset($images) && count($images) > 0) {
	
	            // go through each uploaded image
	            //creo el directorio con el id del accidente si es que no existe
	            if (!file_exists(Yii::getPathOfAlias('webroot').'/images/accidentes/'.$model->id_accidente.'/')) {
				    mkdir(Yii::getPathOfAlias('webroot').'/images/accidentes/'.$model->id_accidente, 0777, true);
				}
				
	            foreach ($images as $image => $pic) {
	                if ($pic->saveAs(Yii::getPathOfAlias('webroot').'/images/accidentes/'.$model->id_accidente.'/'.$pic->name)) {
	                    echo 'done';
	                }
	                else{
	                	echo 'error';
	                }
	                    // handle the errors here, if you want
	            }
	
	        }
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_accidente));
			
			
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
		
		$files = glob(Yii::getPathOfAlias('webroot').'/images/accidentes/'.$id.'/*'); // get all file names
		 //var_dump($files);
		
		foreach($files as $file){ // iterate files
		  if(is_file($file))
		    unlink($file); // delete file
		}
		//removeDirectory(Yii::getPathOfAlias('webroot').'/images/accidentes/'.$id);
		if(is_dir(Yii::getPathOfAlias('webroot').'/images/accidentes/'.$id)){
			rmdir(Yii::getPathOfAlias('webroot').'/images/accidentes/'.$id);
		}
		
		//echo 'exito';
		//return;
		
		$borrar = "DELETE mcb,mci,mmc
					      FROM min_causas_basicas mcb
					     	JOIN min_causas_inmediatas mci on mci.cb_id=mcb.cb_id
					     	JOIN min_medidas_control mmc on mmc.ci_id=mci.ci_id
					      WHERE
					      	mcb.acc_id=".$id." ";
											//return;
		Yii::app()->db->createCommand($borrar)->execute();
		$this->loadModel($id)->delete();
		$this->redirect(array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Accidente('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Accidente']))
		$model->attributes=$_GET['Accidente'];
		$this->render('admin',array(
			'model'=>$model,
		));
		/*$dataProvider=new CActiveDataProvider('Accidente');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));*/
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Accidente('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Accidente']))
			$model->attributes=$_GET['Accidente'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Accidente the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Accidente::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Accidente $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='accidente-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
