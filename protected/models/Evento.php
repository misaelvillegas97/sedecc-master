<?php

/**
 * This is the model class for table "min_evento".
 *
 * The followings are the available columns in table 'min_evento':
 * @property integer $eve_id
 * @property string $eve_tiempo
 * @property integer $tra_rut
 * @property integer $eess_rut
 * @property string $eve_tipo
 * @property string $eve_descripcion
 */
class Evento extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'min_evento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('eve_tiempo, tra_rut, eess_rut, eve_tipo, eve_descripcion', 'required'),
			array('tra_rut, eess_rut', 'numerical', 'integerOnly'=>true),
			array('eve_tipo', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('eve_id, eve_tiempo, tra_rut, eess_rut, eve_tipo, eve_descripcion', 'safe', 'on'=>'search'),
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
			'eve_id' => 'ID',
			'eve_tiempo' => 'Fecha',
			'tra_rut' => 'Trabajador',
			'eess_rut' => 'Empresa',
			'eve_tipo' => 'Tipo de evento',
			'eve_descripcion' => 'Descripción',
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

		$criteria->compare('eve_id',$this->eve_id);
		$criteria->compare('eve_tiempo',$this->eve_tiempo,true);
		$criteria->compare('tra_rut',$this->tra_rut);
		$criteria->compare('eess_rut',$this->eess_rut);
		$criteria->compare('eve_tipo',$this->eve_tipo,true);
		$criteria->compare('eve_descripcion',$this->eve_descripcion,true);
		
		if(Yii::app()->controller->usertype() == 1) $criteria->compare('eess_rut',Yii::app()->user->id);
		if(Yii::app()->controller->usertype() == 3){
			$eess = Yii::app()->db->createCommand("SELECT eess_rut FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
			$criteria->compare('eess_rut',$eess);
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'Pagination' => array (
            	'PageSize' => Yii::app()->params['pagesize'],
            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Evento the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
