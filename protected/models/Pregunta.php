<?php

/**
 * This is the model class for table "min_pregunta".
 *
 * The followings are the available columns in table 'min_pregunta':
 * @property integer $pre_id
 * @property integer $eess_rut
 * @property string $pre_enunciado
 * @property double $pre_ponderacion
 * @property string $tem_id
 * @property string $car_id
 */
class Pregunta extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'min_pregunta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pre_enunciado', 'required'),
			array('eess_rut', 'numerical', 'integerOnly'=>true),
			array('pre_ponderacion', 'numerical'),
			array('pre_enunciado, tem_id, car_id,tipo_checklist', 'length', 'max'=>255),
			array('critico','length','max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pre_id, eess_rut, pre_enunciado, pre_ponderacion, tem_id, car_id,critico,tipo_checklist', 'safe', 'on'=>'search'),
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
			'pre_id' => 'ID',
			'eess_rut' => 'Empresa',
			'pre_enunciado' => 'Enunciado',
			'pre_ponderacion' => 'Ponderación',
			'tem_id' => 'Temática',
			'car_id' => 'Cargo',
			'critico' => 'Critico',
			'tipo_checklist' => 'Tipo Checklist',
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

		$criteria->compare('pre_id',$this->pre_id);
		$criteria->compare('eess_rut',$this->eess_rut);
		$criteria->compare('pre_enunciado',$this->pre_enunciado,true);
		$criteria->compare('pre_ponderacion',$this->pre_ponderacion);
		$criteria->compare('tem_id',$this->tem_id,true);
		$criteria->compare('car_id',$this->car_id,true);
		$criteria->compare('tipo_checklist',$this->tipo_checklist,true);
		$criteria->compare('critico',$this->critico);

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
	 * @return Pregunta the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
