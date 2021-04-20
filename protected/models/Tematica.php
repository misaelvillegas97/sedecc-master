<?php

/**
 * This is the model class for table "min_tematica".
 *
 * The followings are the available columns in table 'min_tematica':
 * @property integer $tem_id
 * @property string $tem_creado
 * @property integer $eess_rut
 * @property string $tem_descripcion
 */
class Tematica extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'min_tematica';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('eess_rut, tem_descripcion', 'required'),
			array('eess_rut', 'numerical', 'integerOnly'=>true),
			array('tem_descripcion', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('tem_id, tem_creado, eess_rut, tem_descripcion', 'safe', 'on'=>'search'),
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
			'tem_id' => 'ID',
			'tem_creado' => 'Fecha de creación',
			'eess_rut' => 'Empresa',
			'tem_descripcion' => 'Descripción',
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

		$criteria->compare('tem_id',$this->tem_id);
		$criteria->compare('tem_creado',$this->tem_creado,true);
		$criteria->compare('eess_rut',$this->eess_rut);
		$criteria->compare('tem_descripcion',$this->tem_descripcion,true);

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
	 * @return Tematica the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
