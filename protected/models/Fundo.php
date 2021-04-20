<?php

/**
 * This is the model class for table "min_fundo".
 *
 * The followings are the available columns in table 'min_fundo':
 * @property integer $fun_id
 * @property string $fun_creado
 * @property string $fun_nombre
 * @property string $fun_comuna
 * @property string $fun_sector
 * @property string $fun_region
 * @property integer $fun_activo
 */
class Fundo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'min_fundo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fun_id, fun_nombre', 'required'),
			array('fun_id, fun_activo, fun_cod, fun_eess', 'numerical', 'integerOnly'=>true),
			array('fun_nombre, fun_comuna, fun_sector, fun_region, fun_admin', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('fun_id, fun_creado, fun_nombre, fun_comuna, fun_sector, fun_region, fun_activo, fun_admin, fun_eess', 'safe', 'on'=>'search'),
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
			'fun_cod' => 'id',
			'fun_id' => 'Código',
			'fun_creado' => 'Fecha de creación',
			'fun_eess' => 'EESS',
			'fun_nombre' => 'Nombre',
			'fun_comuna' => 'Comuna',
			'fun_sector' => 'Sector',
			'fun_region' => 'Región',
			'fun_activo' => 'Activación',
			'fun_admin' => 'Administrador',
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
		$criteria=new CDbCriteria;
		$criteria->compare('fun_cod',$this->fun_cod);
		$criteria->compare('fun_id',$this->fun_id);
		$criteria->compare('fun_creado',$this->fun_creado,true);
		$criteria->compare('fun_nombre',$this->fun_nombre,true);
		$criteria->compare('fun_comuna',$this->fun_comuna,true);
		$criteria->compare('fun_sector',$this->fun_sector,true);
		$criteria->compare('fun_region',$this->fun_region,true);
		$criteria->compare('fun_activo',$this->fun_activo);
		$criteria->compare('fun_admin',$this->fun_admin,true);
		
		if(Yii::app()->controller->usertype() == 1) $criteria->compare('fun_eess',Yii::app()->user->id);
		if(Yii::app()->controller->usertype() == 3){
			$eess = Yii::app()->db->createCommand("SELECT eess_rut FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
			$criteria->compare('fun_eess',$eess);
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Fundo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
