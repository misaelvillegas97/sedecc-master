<?php

/**
 * This is the model class for table "min_variable_evaluacion".
 *
 * The followings are the available columns in table 'min_variable_evaluacion':
 * @property integer $var_id
 * @property string $var_nombre
 * @property string $var_descripcion
 * @property integer $var_activa
 * @property string $eess_rut
 * @property integer $var_ponderacion
 * @property string $var_tipo
 * @property integer $var_tolerancia
 * @property string $var_periodo
 * @property integer $var_periodo_cantidad
 * @property integer $tmv_id
 */
class VariableEvaluacion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'min_variable_evaluacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('var_nombre, var_activa, eess_rut, var_ponderacion', 'required'),
			array('var_activa, var_ponderacion, var_tolerancia,var_periodo_cantidad,tmv_id', 'numerical', 'integerOnly'=>true),
			array('var_nombre', 'length', 'max'=>100),
			array('eess_rut', 'length', 'max'=>255),
			array('var_tipo', 'length', 'max'=>255),
			array('var_periodo', 'length', 'max'=>255),
			array('var_ponderacion', 'length', 'max'=>3),
			array('var_descripcion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('var_id, var_nombre, var_descripcion, var_activa, eess_rut, var_ponderacion', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'var_id' => 'Id',
			'var_nombre' => 'Nombre',
			'var_descripcion' => 'Descripción',
			'var_activa' => 'Estado',
			'eess_rut' => 'Eess Rut',
			'var_ponderacion' => 'Ponderacion %',
			'var_tipo' => 'Tipo de Variable',
			'var_tolerancia' => 'Tolerancia',
			'var_periodo' => 'Periodo de evaluación',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('var_id',$this->var_id);
		$criteria->compare('var_nombre',$this->var_nombre,true);
		$criteria->compare('var_descripcion',$this->var_descripcion,true);
		$criteria->compare('var_activa',$this->var_activa);
		$criteria->compare('eess_rut',$this->eess_rut,true);
		$criteria->compare('var_ponderacion',$this->var_ponderacion);
		$criteria->compare('var_tipo',$this->var_tipo);
		
		if(Yii::app()->controller->usertype() == 1) $criteria->addSearchCondition('eess_rut',Yii::app()->user->id,true);
		
		if(Yii::app()->controller->usertype() == 3 || Yii::app()->controller->usertype() == 4){
			$eess = Yii::app()->db->createCommand("SELECT eess_rut FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
			//$criteria->compare('eess_rut',$eess);
			$criteria->addSearchCondition('eess_rut',$eess,true);
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VariableEvaluacion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
