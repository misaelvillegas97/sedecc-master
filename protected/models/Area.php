<?php

/**
 * This is the model class for table "min_area".
 *
 * The followings are the available columns in table 'min_area':
 * @property integer $are_id
 * @property string $are_creado
 * @property integer $eess_rut
 * @property string $are_descripcion
 */
class Area extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'min_area';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('eess_rut, are_descripcion', 'required'),
			array('eess_rut', 'numerical', 'integerOnly'=>true),
			array('are_descripcion', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('are_id, are_creado, eess_rut, are_descripcion', 'safe', 'on'=>'search'),
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
			'are_id' => 'ID',
			'are_creado' => 'Fecha de creación',
			'eess_rut' => 'Empresa',
			'are_descripcion' => 'Descripción',
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

		$criteria->compare('are_id',$this->are_id);
		$criteria->compare('are_creado',$this->are_creado,true);
		$criteria->compare('eess_rut',$this->eess_rut);
		$criteria->compare('are_descripcion',$this->are_descripcion,true);
		
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
	 * @return Area the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
