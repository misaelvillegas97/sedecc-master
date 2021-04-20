<?php

/**
 * This is the model class for table "min_vehiculo".
 *
 * The followings are the available columns in table 'min_vehiculo':
 * @property string $veh_patente
 * @property string $veh_marca
 * @property integer $veh_ano
 * @property string $veh_modelo
 */
class Vehiculo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'min_vehiculo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('veh_patente','unique'),
			array('veh_patente, eess_rut', 'required'),
			array('veh_ano, eess_rut', 'numerical', 'integerOnly'=>true),
			array('veh_patente', 'length', 'max'=>8),
			array('veh_marca, veh_modelo', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('veh_patente, veh_marca, veh_ano, veh_modelo, eess_rut', 'safe', 'on'=>'search'),
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
			'eess_rut' => 'Empresa',
			'veh_patente' => 'Patente',
			'veh_marca' => 'Marca',
			'veh_ano' => 'Año',
			'veh_modelo' => 'Modelo',
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

		$criteria->compare('veh_patente',$this->veh_patente,true);
		$criteria->compare('veh_marca',$this->veh_marca,true);
		$criteria->compare('veh_ano',$this->veh_ano);
		$criteria->compare('veh_modelo',$this->veh_modelo,true);
		
		if(Yii::app()->controller->usertype() == 1) $criteria->compare('eess_rut',Yii::app()->user->id);
		if(Yii::app()->controller->usertype() == 3){
			$eess = Yii::app()->db->createCommand("SELECT eess_rut FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
			$criteria->compare('eess_rut',$eess);
		}
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Vehiculo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
