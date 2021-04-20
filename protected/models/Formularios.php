<?php

/**
 * This is the model class for table "min_formularios".
 *
 * The followings are the available columns in table 'min_formularios':
 * @property string $correlativo_chk_eess
 * @property string $checklist
 * @property string $tipo_checklist
 * @property string $eess_rut
 * @property integer $n_campos
 * @property string $campo
 * @property string $nombre_campos
 * @property string $campos_values
 * @property string $campos_requeridos
 */
class Formularios extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'min_formularios';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('correlativo_chk_eess, checklist, eess_rut, campo', 'required'),
			array('n_campos', 'numerical', 'integerOnly'=>true),
			array('correlativo_chk_eess', 'length', 'max'=>50),
			array('checklist, tipo_checklist, eess_rut, campo, nombre_campos, campos_values, campos_requeridos', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('correlativo_chk_eess, checklist, tipo_checklist, eess_rut, n_campos, campo, nombre_campos, campos_values, campos_requeridos', 'safe', 'on'=>'search'),
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
			'correlativo_chk_eess' => 'Correlativo Chk Eess',
			'checklist' => 'Checklist',
			'tipo_checklist' => 'Tipo Checklist',
			'eess_rut' => 'Eess Rut',
			'n_campos' => 'N Campos',
			'campo' => 'Campo',
			'nombre_campos' => 'Nombre Campos',
			'campos_values' => 'Campos Values',
			'campos_requeridos' => 'Campos Requeridos',
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

		$criteria->compare('correlativo_chk_eess',$this->correlativo_chk_eess,true);
		$criteria->compare('checklist',$this->checklist,true);
		$criteria->compare('tipo_checklist',$this->tipo_checklist,true);
		$criteria->compare('eess_rut',$this->eess_rut,true);
		$criteria->compare('n_campos',$this->n_campos);
		$criteria->compare('campo',$this->campo,true);
		$criteria->compare('nombre_campos',$this->nombre_campos,true);
		$criteria->compare('campos_values',$this->campos_values,true);
		$criteria->compare('campos_requeridos',$this->campos_requeridos,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Formularios the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
