<?php

/**
 * This is the model class for table "min_eess".
 *
 * The followings are the available columns in table 'min_eess':
 * @property string $eess_rut
 * @property string $eess_creado
 * @property string $eess_nombre_corto
 * @property string $eess_razon_social
 * @property string $eess_ciudad
 * @property string $eess_telefono
 * @property string $eess_email
 * @property string $eess_representante
 * @property string $eess_representante_telefono
 * @property string $eess_representante_email
 * @property string $eess_clave
 * @property string $eess_logo
 * @property string $eess_estado
 */
class Eess extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'min_eess';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('eess_rut', 'required'),
			array('eess_rut, eess_estado', 'length', 'max'=>20),
			array('eess_nombre_corto', 'length', 'max'=>150),
			array('eess_razon_social, eess_email', 'length', 'max'=>250),
			array('eess_ciudad, eess_telefono, eess_representante, eess_representante_telefono, eess_clave', 'length', 'max'=>200),
			array('eess_representante_email', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('eess_rut, eess_creado, eess_nombre_corto, eess_razon_social, eess_ciudad, eess_telefono, eess_email, eess_representante, eess_representante_telefono, eess_representante_email, eess_clave, eess_logo, eess_estado', 'safe', 'on'=>'search'),
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
			'eess_rut' => 'RUT',
			'eess_creado' => 'Fecha de creación',
			'eess_nombre_corto' => 'Nombre corto',
			'eess_razon_social' => 'Razon social',
			'eess_ciudad' => 'Ciudad',
			'eess_telefono' => 'Teléfono',
			'eess_email' => 'Email',
			'eess_representante' => 'Representante',
			'eess_representante_telefono' => 'Teléfono representante',
			'eess_representante_email' => 'Email representante',
			'eess_clave' => 'Clave',
			'eess_logo' => 'Logo',
			'eess_estado' => 'Estado',
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

		$criteria->compare('eess_rut',$this->eess_rut,true);
		$criteria->compare('eess_creado',$this->eess_creado,true);
		$criteria->compare('eess_nombre_corto',strtoupper($this->eess_nombre_corto),true);
		$criteria->compare('eess_razon_social',strtoupper($this->eess_razon_social),true);
		$criteria->compare('eess_ciudad',strtoupper($this->eess_ciudad),true);
		$criteria->compare('eess_telefono',$this->eess_telefono,true);
		$criteria->compare('eess_email',strtoupper($this->eess_email),true);
		$criteria->compare('eess_representante',strtoupper($this->eess_representante),true);
		$criteria->compare('eess_representante_telefono',$this->eess_representante_telefono,true);
		$criteria->compare('eess_representante_email',strtoupper($this->eess_representante_email),true);
		$criteria->compare('eess_clave',$this->eess_clave,true);
		$criteria->compare('eess_logo',$this->eess_logo,true);
		$criteria->compare('eess_estado',strtoupper($this->eess_estado),true);

		return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort' => array(
                'defaultOrder' => 'eess_nombre_corto ASC',
            ),
			'Pagination' => array (
            	'PageSize' => Yii::app()->params['pagesize'],
            ),));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Eess the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
