<?php

/**
 * This is the model class for table "min_formulario_bitacora".
 *
 * The followings are the available columns in table 'min_formulario_bitacora':
 * @property integer $id
 * @property string $bit_tiempo
 * @property string $eess_rut
 * @property string $bit_nombre
 * @property integer $bit_n_campos
 * @property string $bit_campos
 * @property string $bit_nombre_campos
 * @property string $bit_campos_values
 * @property string $bit_campos_requeridos
 */
class Formulariobitacora extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'min_formulario_bitacora';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bit_tiempo', 'required'),
			array('bit_n_campos', 'numerical', 'integerOnly'=>true),
			array('eess_rut, bit_nombre, bit_campos, bit_nombre_campos, bit_campos_values, bit_campos_requeridos', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, bit_tiempo, eess_rut, bit_nombre, bit_n_campos, bit_campos, bit_nombre_campos, bit_campos_values, bit_campos_requeridos', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'bit_tiempo' => 'Tiempo',
			'eess_rut' => 'RUT EESS',
			'bit_nombre' => 'Nombre',
			'bit_n_campos' => 'N Campos',
			'bit_campos' => 'Campos',
			'bit_nombre_campos' => 'Nombre Campos',
			'bit_campos_values' => 'Valores Campos',
			'bit_campos_requeridos' => 'Campos Requeridos',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('bit_tiempo',$this->bit_tiempo,true);
		$criteria->compare('eess_rut',$this->eess_rut,true);
		$criteria->compare('bit_nombre',$this->bit_nombre,true);
		$criteria->compare('bit_n_campos',$this->bit_n_campos);
		$criteria->compare('bit_campos',$this->bit_campos,true);
		$criteria->compare('bit_nombre_campos',$this->bit_nombre_campos,true);
		$criteria->compare('bit_campos_values',$this->bit_campos_values,true);
		$criteria->compare('bit_campos_requeridos',$this->bit_campos_requeridos,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Formulariobitacora the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
