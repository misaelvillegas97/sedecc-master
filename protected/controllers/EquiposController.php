<?php

class EquiposController extends Controller
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
			)/*,
			array('deny',  // deny all users
				'users'=>array('*'),
			),*/
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
		$model=new Equipos;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Equipos']))
		{
			$model->attributes=$_POST['Equipos'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->eq_codigo));
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

		if(isset($_POST['Equipos']))
		{
			$model->attributes=$_POST['Equipos'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->eq_codigo));
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
		$eq_maquina = Yii::app()->db->createCommand("SELECT eq_maquina FROM min_equipos where eq_codigo='".$id."' ")->queryScalar();
		$eess_rut = Yii::app()->db->createCommand("SELECT eess_rut FROM min_equipos where eq_codigo='".$id."' ")->queryScalar();
		$borrar = "DELETE FROM min_evaluacion_equipos 
						WHERE 
							eq_codigo='".$id."'
							and eq_maquina='".$eq_maquina."'
							and eess_rut='".$eess_rut."' ";
		//procedo a borrar respuestas de evaluaciones antes de borrar las evaluaciones
		$idEvaluaciones = Yii::app()->db->createCommand("SELECT eva_id FROM min_evaluacion_equipos 
							WHERE eq_codigo='".$id."'
							and eq_maquina='".$eq_maquina."'
							and eess_rut='".$eess_rut."' ")->query()->readAll();
		for($cb=0;$cb<count($idEvaluaciones);$cb++){
			$borrarRespuestas = "DELETE FROM min_respuesta_equipos 
						WHERE 
						eva_id='".$idEvaluaciones[$cb]['eva_id']."' ";
			Yii::app()->db->createCommand($borrarRespuestas)->execute();
		}
		Yii::app()->db->createCommand($borrar)->execute();
		
		$this->loadModel($id)->delete();
		$this->redirect(array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Equipos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Equipos']))
		$model->attributes=$_GET['Equipos'];
		$this->render('admin',array(
			'model'=>$model,
		));
		/*$dataProvider=new CActiveDataProvider('Equipos');
		$this->render('admin',array(
			'dataProvider'=>$dataProvider,
		));*/
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Equipos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Equipos']))
			$model->attributes=$_GET['Equipos'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Equipos the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Equipos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Equipos $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='equipos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
