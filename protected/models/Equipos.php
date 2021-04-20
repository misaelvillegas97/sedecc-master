<?php

/**
 * This is the model class for table "min_equipos".
 *
 * The followings are the available columns in table 'min_equipos':
 * @property string $eq_codigo
 * @property string $eq_maquina
 * @property string $eq_marca
 * @property string $eq_modelo
 * @property string $eq_tipo
 * @property integer $eq_ano
 * @property string $eess_rut
 */
class Equipos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'min_equipos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('eq_codigo, eq_maquina, eq_marca, eq_modelo, eq_tipo, eq_ano, eess_rut', 'required'),
			array('eq_ano', 'numerical', 'integerOnly'=>true),
			array('eq_codigo, eq_maquina, eq_marca, eq_modelo, eq_tipo', 'length', 'max'=>25),
			array('eess_rut', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('eq_codigo, eq_maquina, eq_marca, eq_modelo, eq_tipo, eq_ano, eess_rut', 'safe', 'on'=>'search'),
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
			'eq_codigo' => 'Código',
			'eq_maquina' => 'Máquina',
			'eq_marca' => 'Marca',
			'eq_modelo' => 'Modelo',
			'eq_tipo' => 'Tipo',
			'eq_ano' => 'Año',
			'eess_rut' => 'Eess Rut',
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

		$criteria->compare('eq_codigo',$this->eq_codigo,true);
		$criteria->compare('eq_maquina',$this->eq_maquina,true);
		$criteria->compare('eq_marca',$this->eq_marca,true);
		$criteria->compare('eq_modelo',$this->eq_modelo,true);
		$criteria->compare('eq_tipo',$this->eq_tipo,true);
		$criteria->compare('eq_ano',$this->eq_ano);
		$criteria->compare('eess_rut',$this->eess_rut,true);
		
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
	 * @return Equipos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
