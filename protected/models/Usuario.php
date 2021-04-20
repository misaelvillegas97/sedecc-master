<?php

/**
 * This is the model class for table "min_usuario".
 *
 * The followings are the available columns in table 'min_usuario':
 * @property integer $usu_id
 * @property string $usu_creado
 * @property string $usu_acceso_nombre
 * @property string $usu_acceso_contrasena
 * @property integer $usu_tipo
 * @property string $usu_nombre
 * @property string $usu_apellido
 * @property string $usu_email
 * @property string $usu_telefono
 * @property string $usu_direccion
 * @property string $usu_ultimo_acceso
 */
class Usuario extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'min_usuario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('usu_acceso_nombre, usu_acceso_contrasena, usu_nombre, usu_apellido, usu_email, usu_telefono, usu_direccion, usu_ultimo_acceso', 'required'),
			array('usu_tipo', 'numerical', 'integerOnly'=>true),
			array('usu_acceso_nombre, usu_acceso_contrasena, usu_nombre, usu_apellido, usu_email, usu_telefono, usu_direccion', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('usu_id, usu_creado, usu_acceso_nombre, usu_acceso_contrasena, usu_tipo, usu_nombre, usu_apellido, usu_email, usu_telefono, usu_direccion, usu_ultimo_acceso', 'safe', 'on'=>'search'),
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
			'usu_id' => 'ID',
			'usu_creado' => 'Fecha de creación',
			'usu_acceso_nombre' => 'Nombre de usuario',
			'usu_acceso_contrasena' => 'Contraseña',
			'usu_tipo' => 'Tipo de usuario',
			'usu_nombre' => 'Nombres',
			'usu_apellido' => 'Apellidos',
			'usu_email' => 'Email',
			'usu_telefono' => 'Teléfono',
			'usu_direccion' => 'Dirección',
			'usu_ultimo_acceso' => 'Último acceso',
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

		$criteria->compare('usu_id',$this->usu_id);
		$criteria->compare('usu_creado',$this->usu_creado,true);
		$criteria->compare('usu_acceso_nombre',$this->usu_acceso_nombre,true);
		$criteria->compare('usu_acceso_contrasena',$this->usu_acceso_contrasena,true);
		$criteria->compare('usu_tipo',$this->usu_tipo);
		$criteria->compare('usu_nombre',$this->usu_nombre,true);
		$criteria->compare('usu_apellido',$this->usu_apellido,true);
		$criteria->compare('usu_email',$this->usu_email,true);
		$criteria->compare('usu_telefono',$this->usu_telefono,true);
		$criteria->compare('usu_direccion',$this->usu_direccion,true);
		$criteria->compare('usu_ultimo_acceso',$this->usu_ultimo_acceso,true);

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
	 * @return Usuario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
