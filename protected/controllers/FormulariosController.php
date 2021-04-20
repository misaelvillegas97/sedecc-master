<?php

class FormulariosController extends Controller
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
				'actions'=>array('create','update'),
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
		$model=new Formularios;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Formularios']))
		{
			$model->attributes=$_POST['Formularios'];
			
			$campos_index = '';
			$campos_nombr = '';
			$campos_valor = '';
			$campos_reque = '';
			
			for($i=0;$i<100;$i++){
				if(isset($_POST['campos_index_'.$i])){
					if(strlen($_POST['campos_index_'.$i])>0){
						$campos_index.= $_POST['campos_index_'.$i].',';
						$campos_nombr.= $_POST['campos_nombr_'.$i].',';
						$campos_valor.= $_POST['campos_valor_'.$i].',';
						$campos_reque.= $_POST['campos_reque_'.$i].',';
					}
				}
			}

			$model->campo = trim($campos_index,',');
			$model->nombre_campos = trim($campos_nombr,',');
			$model->campos_values = trim($campos_valor,',');
			$model->campos_requeridos = trim($campos_reque,',');
			
			if($model->save())
				$this->redirect(array('view','id'=>$model->correlativo_chk_eess));
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

		if(isset($_POST['Formularios']))
		{
			$model->attributes=$_POST['Formularios'];
			
			$campos_index = '';
			$campos_nombr = '';
			$campos_valor = '';
			$campos_reque = '';
			
			for($i=0;$i<100;$i++){
				if(isset($_POST['campos_index_'.$i])){
					if(strlen($_POST['campos_index_'.$i])>0){
						$campos_index.= $_POST['campos_index_'.$i].',';
						$campos_nombr.= $_POST['campos_nombr_'.$i].',';
						$campos_valor.= $_POST['campos_valor_'.$i].',';
						$campos_reque.= $_POST['campos_reque_'.$i].',';
					}
				}
			}

			$model->campo = trim($campos_index,',');
			$model->nombre_campos = trim($campos_nombr,',');
			$model->campos_values = trim($campos_valor,',');
			$model->campos_requeridos = trim($campos_reque,',');
			
			print_r($model);

			if($model->save())
				$this->redirect(array('view','id'=>$model->correlativo_chk_eess));
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
		$model=new Formularios('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Formularios']))
			$model->attributes=$_GET['Formularios'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Formularios('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Formularios']))
			$model->attributes=$_GET['Formularios'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Formularios the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Formularios::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Formularios $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='formularios-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
