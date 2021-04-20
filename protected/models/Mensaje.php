<?php

/**
 * This is the model class for table "min_mensaje".
 *
 * The followings are the available columns in table 'min_mensaje':
 * @property integer $men_id
 * @property string $men_creado
 * @property string $men_emisor
 * @property string $mes_mensaje
 * @property string $men_imagen_1
 * @property string $men_imagen_2
 * @property string $men_imagen_3
 * @property string $men_imagen_4
 * @property string $men_imagen_5
 * @property string $men_imagen_6
 */
class Mensaje extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'min_mensaje';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('men_creado, men_emisor, mes_mensaje', 'required'),
			array('men_emisor', 'length', 'max'=>255),
			array('men_imagen_1, men_imagen_2, men_imagen_3, men_imagen_4, men_imagen_5, men_imagen_6', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('men_id, men_creado, men_emisor, mes_mensaje, men_imagen_1, men_imagen_2, men_imagen_3, men_imagen_4, men_imagen_5, men_imagen_6', 'safe', 'on'=>'search'),
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
			'men_id' => 'Men',
			'men_creado' => 'Men Creado',
			'men_emisor' => 'Men Emisor',
			'mes_mensaje' => 'Mes Mensaje',
			'men_imagen_1' => 'Men Imagen 1',
			'men_imagen_2' => 'Men Imagen 2',
			'men_imagen_3' => 'Men Imagen 3',
			'men_imagen_4' => 'Men Imagen 4',
			'men_imagen_5' => 'Men Imagen 5',
			'men_imagen_6' => 'Men Imagen 6',
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

		$criteria->compare('men_id',$this->men_id);
		$criteria->compare('men_creado',$this->men_creado,true);
		$criteria->compare('men_emisor',$this->men_emisor,true);
		$criteria->compare('mes_mensaje',$this->mes_mensaje,true);
		$criteria->compare('men_imagen_1',$this->men_imagen_1,true);
		$criteria->compare('men_imagen_2',$this->men_imagen_2,true);
		$criteria->compare('men_imagen_3',$this->men_imagen_3,true);
		$criteria->compare('men_imagen_4',$this->men_imagen_4,true);
		$criteria->compare('men_imagen_5',$this->men_imagen_5,true);
		$criteria->compare('men_imagen_6',$this->men_imagen_6,true);

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
	 * @return Mensaje the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
