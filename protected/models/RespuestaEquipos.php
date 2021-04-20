<?php

/**
 * This is the model class for table "min_respuesta_equipos".
 *
 * The followings are the available columns in table 'min_respuesta_equipos':
 * @property integer $res_id
 * @property string $res_tiempo
 * @property string $res_enunciado
 * @property string $res_respuesta
 * @property string $res_critico
 * @property double $res_ponderacion
 * @property integer $pre_id
 * @property string $car_id
 * @property string $tem_id
 * @property string $res_observacion
 * @property string $res_foto
 * @property double $eva_id
 * @property integer $res_seguimiento
 * @property string $res_plazo
 */
class RespuestaEquipos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'min_respuesta_equipos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('res_tiempo', 'required'),
			array('pre_id, res_seguimiento', 'numerical', 'integerOnly'=>true),
			array('res_ponderacion, eva_id', 'numerical'),
			array('res_enunciado, res_respuesta, res_critico, car_id, tem_id, res_observacion', 'length', 'max'=>255),
			array('res_foto, res_plazo', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('res_id, res_tiempo, res_enunciado, res_respuesta, res_critico, res_ponderacion, pre_id, car_id, tem_id, res_observacion, res_foto, eva_id, res_seguimiento, res_plazo', 'safe', 'on'=>'search'),
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
			'res_id' => 'Res',
			'res_tiempo' => 'Res Tiempo',
			'res_enunciado' => 'Res Enunciado',
			'res_respuesta' => 'Res Respuesta',
			'res_critico' => 'Res Critico',
			'res_ponderacion' => 'Res Ponderacion',
			'pre_id' => 'Pre',
			'car_id' => 'Car',
			'tem_id' => 'Tem',
			'res_observacion' => 'Res Observacion',
			'res_foto' => 'Res Foto',
			'eva_id' => 'Eva',
			'res_seguimiento' => 'Res Seguimiento',
			'res_plazo' => 'Res Plazo',
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

		$criteria->compare('res_id',$this->res_id);
		$criteria->compare('res_tiempo',$this->res_tiempo,true);
		$criteria->compare('res_enunciado',$this->res_enunciado,true);
		$criteria->compare('res_respuesta',$this->res_respuesta,true);
		$criteria->compare('res_critico',$this->res_critico,true);
		$criteria->compare('res_ponderacion',$this->res_ponderacion);
		$criteria->compare('pre_id',$this->pre_id);
		$criteria->compare('car_id',$this->car_id,true);
		$criteria->compare('tem_id',$this->tem_id,true);
		$criteria->compare('res_observacion',$this->res_observacion,true);
		$criteria->compare('res_foto',$this->res_foto,true);
		$criteria->compare('eva_id',$this->eva_id);
		$criteria->compare('res_seguimiento',$this->res_seguimiento);
		$criteria->compare('res_plazo',$this->res_plazo,true);

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
	 * @return RespuestaEquipos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
