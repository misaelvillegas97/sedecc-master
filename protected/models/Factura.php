<?php

/**
 * This is the model class for table "factura".
 *
 * The followings are the available columns in table 'factura':
 * @property string $id_rango
 * @property string $rango_trabajador
 * @property string $fijo_uf
 * @property string $variableuf_tra
 * @property string $checklist
 */
class Factura extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'factura';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_rango, rango_trabajador, fijo_uf, variableuf_tra, checklist', 'required'),
			array('id_rango', 'length', 'max'=>7),
			array('rango_trabajador', 'length', 'max'=>8),
			array('fijo_uf, variableuf_tra', 'length', 'max'=>5),
			array('checklist', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_rango, rango_trabajador, fijo_uf, variableuf_tra, checklist', 'safe', 'on'=>'search'),
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
			'id_rango' => 'Id Rango',
			'rango_trabajador' => 'Rango Trabajador',
			'fijo_uf' => 'Fijo Uf',
			'variableuf_tra' => 'Variableuf Tra',
			'checklist' => 'Checklist',
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

		$criteria->compare('id_rango',$this->id_rango,true);
		$criteria->compare('rango_trabajador',$this->rango_trabajador,true);
		$criteria->compare('fijo_uf',$this->fijo_uf,true);
		$criteria->compare('variableuf_tra',$this->variableuf_tra,true);
		$criteria->compare('checklist',$this->checklist,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Factura the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
