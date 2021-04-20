<?php
 
/**
 * This is the model class for table "min_cargo".
 *
 * The followings are the available columns in table 'min_cargo':
 * @property integer $car_id
 * @property string $car_creado
 * @property integer $eess_rut
 * @property string $car_descripcion
 */
class Cargo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'min_cargo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('car_descripcion', 'required'),
			array('eess_rut', 'numerical', 'integerOnly'=>true),
			array('car_descripcion', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('car_id, car_creado, eess_rut, car_descripcion', 'safe', 'on'=>'search'),
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
			'car_id' => 'ID',
			'car_creado' => 'Fecha de creación',
			'eess_rut' => 'Empresa',
			'car_descripcion' => 'Cargo',
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

		$criteria->compare('car_id',$this->car_id);
		$criteria->compare('car_creado',$this->car_creado,true);
		$criteria->compare('eess_rut',$this->eess_rut);
        $criteria->compare('car_descripcion',strtoupper($this->car_descripcion),true);
		if(Yii::app()->controller->usertype() == 1) $criteria->compare('eess_rut',Yii::app()->user->id);
		if(Yii::app()->controller->usertype() == 3){
			$eess = Yii::app()->db->createCommand("SELECT eess_rut FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
			$criteria->compare('eess_rut',$eess);
		}

		return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort' => array(
                'defaultOrder' => 'car_descripcion ASC',
            ),
			'Pagination' => array (
            	'PageSize' => Yii::app()->params['pagesize'],
            ),
		));
	}
 
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cargo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
