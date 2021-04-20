<?php

class VariableEvaluacionController extends Controller
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
		$model=new VariableEvaluacion;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['VariableEvaluacion']))
		{
			
			$model->attributes=$_POST['VariableEvaluacion'];
			if($model->save()){
				if(isset($_POST['notaInferior']))
				{
					
					// Reviso el tipo de variable y dependiendo de eso, inserto los respectivos valores
				
					//echo $model->var_id.'</br>';
					//var_dump($_POST['VariableEvaluacion']['var_tipo']);
					//var_dump($model->var_tipo);
					//return;
					//return;
					if($_POST['VariableEvaluacion']['var_tipo'] == 'rango'){
						$count=0;
						foreach($_POST['notaInferior'] as $key => $value)
						{
							$guardarNota = "INSERT INTO min_variable_notas(
												var_id,
												var_not_nota,
												var_not_nota_inferior,
												var_not_nota_superior,
												var_not_rango_inferior,
												var_not_rango_superior,
												var_not_cantidad,
												var_not_descripcion
												) VALUES (
													'".$model->var_id."',
													'".$value."',
													'".$_POST['notaInferior'][$count]."',
													'".$_POST['notaSuperior'][$count]."',
													'".$_POST['rangoInferior'][$count]."',
													'".$_POST['rangoSuperior'][$count]."',
													'NULL',
													'".$_POST['descripcion'][$count]."'
												);";
													//return;
							Yii::app()->db->createCommand($guardarNota)->execute();
							$count++;									
						}
					}
					if($_POST['VariableEvaluacion']['var_tipo'] == 'rangoDefinida'){
						$count=0;
						foreach($_POST['nota'] as $key => $value)
						{
							$guardarNota = "INSERT INTO min_variable_notas(
												var_id,
												var_not_nota,
												var_not_nota_inferior,
												var_not_nota_superior,
												var_not_rango_inferior,
												var_not_rango_superior,
												var_not_cantidad,
												var_not_descripcion
												) VALUES (
													'".$model->var_id."',
													'".$value."',
													'NULL',
													'NULL',
													'".$_POST['rangoInferior'][$count]."',
													'".$_POST['rangoSuperior'][$count]."',
													'NULL',
													'".$_POST['descripcion'][$count]."'
												);";
													//return;
							Yii::app()->db->createCommand($guardarNota)->execute();
							$count++;									
						}
					}
					if($_POST['VariableEvaluacion']['var_tipo'] == 'definida'){
						
						$count=0;
						foreach($_POST['nota'] as $key => $value)
						{
							$guardarNota = "INSERT INTO min_variable_notas(
												var_id,
												var_not_nota,
												var_not_nota_inferior,
												var_not_nota_superior,
												var_not_rango_inferior,
												var_not_rango_superior,
												var_not_cantidad,
												var_not_descripcion
												) VALUES (
													'".$model->var_id."',
													'".$value."',
													'NULL',
													'NULL',
													'NULL',
													'NULL',
													'".$_POST['cantidad'][$count]."',
													'".$_POST['descripcion'][$count]."'
												);";
													//return;
							Yii::app()->db->createCommand($guardarNota)->execute();
							$count++;									
						}
					}
				}
				$this->redirect(array('view','id'=>$model->var_id));
			}
				
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

		
		
		

		if(isset($_POST['VariableEvaluacion']))
		{
			

			
			/*if($_POST['VariableEvaluacion']['var_nombre'] !== 'Evaluaciones'){
				$borrar = "DELETE FROM min_variable_notas where var_id=".$id." ";
											//return;
				Yii::app()->db->createCommand($borrar)->execute();
			}*/	
			
			$borrar = "DELETE FROM min_variable_notas where var_id=".$id." ";
											//return;
			Yii::app()->db->createCommand($borrar)->execute();
			
			//echo var_dump($_POST);
			//return;
			if(isset($_POST['notaInferior']))
			{
				//echo var_dump($_POST);
				//return;
				// Reviso el tipo de variable y dependiendo de eso, inserto los respectivos valores
				$tolerancia='NULL';
				if(isset($_POST["toggleTolerancia"])){
					$tolerancia=$_POST["VariableEvaluacion"]["var_tolerancia"];
				}
				
				if($model->var_tipo == 'rango'){
					
					$count=0;
					foreach($_POST['notaInferior'] as $key => $value)
					{
						$guardarNota = "INSERT INTO min_variable_notas(
											var_id,
											var_not_nota,
											var_not_nota_inferior,
											var_not_nota_superior,
											var_not_rango_inferior,
											var_not_rango_superior,
											var_not_cantidad,
											var_not_descripcion
											) VALUES (
												'".$id."',
												'".$value."',
												'".$_POST['notaInferior'][$count]."',
												'".$_POST['notaSuperior'][$count]."',
												'".$_POST['rangoInferior'][$count]."',
												'".$_POST['rangoSuperior'][$count]."',
												'NULL',
												'".$_POST['descripcion'][$count]."'
											);";

												//return;
								
						Yii::app()->db->createCommand($guardarNota)->execute();
						$count++;									
					}
				}
				if($model->var_tipo == 'rangoDefinida'){
					$count=0;
					foreach($_POST['nota'] as $key => $value)
					{
						$guardarNota = "INSERT INTO min_variable_notas(
											var_id,
											var_not_nota,
											var_not_nota_inferior,
											var_not_nota_superior,
											var_not_rango_inferior,
											var_not_rango_superior,
											var_not_cantidad,
											var_not_descripcion
											) VALUES (
												'".$id."',
												'".$value."',
												'NULL',
												'NULL',
												'".$_POST['rangoInferior'][$count]."',
												'".$_POST['rangoSuperior'][$count]."',
												'NULL',
												'".$_POST['descripcion'][$count]."'
											);";
												//return;
						Yii::app()->db->createCommand($guardarNota)->execute();
						$count++;									
					}
				}
				if($model->var_tipo == 'definida'){
					$count=0;
					foreach($_POST['nota'] as $key => $value)
					{
						$guardarNota = "INSERT INTO min_variable_notas(
											var_id,
											var_not_nota,
											var_not_nota_inferior,
											var_not_nota_superior,
											var_not_rango_inferior,
											var_not_rango_superior,
											var_not_cantidad,
											var_not_descripcion
											) VALUES (
												'".$id."',
												'".$value."',
												'NULL',
												'NULL',
												'NULL',
												'NULL',
												'".$_POST['cantidad'][$count]."',
												'".$_POST['descripcion'][$count]."'
											);";
												//return;
						Yii::app()->db->createCommand($guardarNota)->execute();
						$count++;									
					}
				}
				
			}
			$model->attributes=$_POST['VariableEvaluacion'];

			

			if($model->save())
				$this->redirect(array('view','id'=>$model->var_id));
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
		$borrar = "DELETE FROM min_variable_notas WHERE var_id=".$id." ";
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
		$model=new VariableEvaluacion('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['VariableEvaluacion']))
		$model->attributes=$_GET['VariableEvaluacion'];
		$this->render('admin',array(
			'model'=>$model,
		));
		/*$dataProvider=new CActiveDataProvider('VariableEvaluacion');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));*/
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new VariableEvaluacion('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['VariableEvaluacion']))
			$model->attributes=$_GET['VariableEvaluacion'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return VariableEvaluacion the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=VariableEvaluacion::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param VariableEvaluacion $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='variable-evaluacion-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
