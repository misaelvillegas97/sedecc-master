<?php

/**
 * This is the model class for table "min_excesos_velocidad".
 *
 * The followings are the available columns in table 'min_excesos_velocidad':
 * @property integer $exc_id
 * @property string $tra_rut
 * @property string $exc_fecha
 * @property integer $exc_zona
 * @property string $veh_patente
 * @property integer $exc_velocidad
 * @property integer $exc_limite
 * @property integer $veh_codigoCamion
 * @property string $exc_turno
 * @property string $var_nombre
 */
class ExcesosVelocidad extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'min_excesos_velocidad';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tra_rut, exc_fecha, exc_zona, veh_patente, exc_velocidad, exc_limite, veh_codigoCamion, exc_turno', 'required'),
			array('exc_zona, exc_velocidad, exc_limite, veh_codigoCamion', 'numerical', 'integerOnly'=>true),
			array('tra_rut, veh_patente, exc_turno', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('exc_id, tra_rut, exc_fecha, exc_zona, veh_patente, exc_velocidad, exc_limite, veh_codigoCamion, exc_turno,var_nombre', 'safe', 'on'=>'search'),
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
			'exc_id' => 'Exc',
			'tra_rut' => 'Rut',
			'exc_fecha' => 'Fecha',
			'exc_zona' => 'Zona',
			'veh_patente' => 'Patente',
			'exc_velocidad' => 'Velocidad',
			'exc_limite' => 'Límite',
			'veh_codigoCamion' => 'Código Camión',
			'exc_turno' => 'Turno',
			'var_nombre' => 'Tipo Exceso'
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

		$criteria->compare('exc_id',$this->exc_id);
		$criteria->compare('tra_rut',$this->tra_rut,true);
		$criteria->compare('exc_fecha',$this->exc_fecha,true);
		$criteria->compare('exc_zona',$this->exc_zona);
		$criteria->compare('veh_patente',$this->veh_patente,true);
		$criteria->compare('exc_velocidad',$this->exc_velocidad);
		$criteria->compare('exc_limite',$this->exc_limite);
		$criteria->compare('veh_codigoCamion',$this->veh_codigoCamion,false);
		$criteria->compare('exc_turno',$this->exc_turno,true);
		$criteria->compare('var_nombre',$this->var_nombre,true);

		if(Yii::app()->controller->usertype() == 3 || Yii::app()->controller->usertype() == 4){
			$eess = Yii::app()->db->createCommand("SELECT eess_rut FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
			//$criteria->compare('eess_rut',$eess);
			$criteria->addSearchCondition('eess_rut',$eess,true);
		}
		if(Yii::app()->controller->usertype() == 1){
			// $eess = Yii::app()->db->createCommand("SELECT eess_rut FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
			//$criteria->compare('eess_rut',$eess);
			$criteria->addSearchCondition('eess_rut',Yii::app()->user->id,true);
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ExcesosVelocidad the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
