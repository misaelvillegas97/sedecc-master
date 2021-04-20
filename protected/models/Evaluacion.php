<?php

/**
 * This is the model class for table "min_evaluacion".
 *
 * The followings are the available columns in table 'min_evaluacion':
 * @property double $eva_id
 * @property string $eva_creado
 * @property string $eva_tipo
 * @property string $eva_evaluador
 * @property string $eess_rut
 * @property string $tra_rut
 * @property string $eva_apellidos
 * @property string $eva_nombres
 * @property string $eva_fecha_evaluacion
 * @property string $eva_fundo
 * @property string $eva_comuna
 * @property string $eva_jefe_faena
 * @property double $eva_geo_x
 * @property double $eva_geo_y
 * @property integer $eva_linea
 * @property string $eva_vencimiento_corma
 * @property string $eva_tipo_cosecha
 * @property string $eva_general_observacion
 * @property string $eva_general_foto
 * @property string $eva_general_fecha
 * @property double $eva_cache_porcentaje
 */
class Evaluacion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'min_evaluacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('eva_creado', 'required'),
			array('eva_linea, eva_evaluador', 'numerical', 'integerOnly'=>true),
			array('eva_geo_x, eva_geo_y, eva_cache_porcentaje', 'numerical'),
			array('eva_tipo, eess_rut, tra_rut, eva_apellidos, eva_nombres, eva_fundo, eva_comuna, eva_supervisor, eva_faena, eva_jefe_faena, eva_tipo_cosecha, eva_apr, eva_licencia_conducir_clase, eva_cargo,eva_patente,eva_fecha,eva_hora,eva_lugar', 'length', 'max'=>255),
			array('eva_vencimiento_corma, eva_licencia_conducir_vencimiento', 'length', 'max'=>12),
			array('eva_fecha_evaluacion, eva_general_observacion, eva_general_foto, eva_general_fecha,eva_fecha', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('eva_id, eva_creado, eva_tipo, eess_rut, tra_rut, eva_apellidos, eva_nombres, eva_supervisor, eva_faena, eva_fecha_evaluacion, eva_fundo, eva_comuna, eva_jefe_faena, eva_geo_x, eva_geo_y, eva_linea, eva_vencimiento_corma, eva_tipo_cosecha, eva_cache_porcentaje, eva_evaluador, eva_apr, eva_licencia_conducir_clase, eva_licencia_conducir_vencimiento, eva_cargo,eva_patente,eva_fecha,eva_hora,eva_lugar', 'safe', 'on'=>'search'),
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
			'eva_id' => 'Id',
			'eva_creado' => 'Fecha de Creación',
			'eva_tipo' => 'Checklist',
			'eva_evaluador' => 'Evaluador',
			'eess_rut' => 'Empresa',
			'tra_rut' => 'Rut Trabajador',
			'eva_apellidos' => 'Apellidos',
			'eva_nombres' => 'Nombres',
			'eva_fecha_evaluacion' => 'Fecha Evaluación',
			'eva_fundo' => 'Fundo',
			'eva_comuna' => 'Comuna',
			'eva_jefe_faena' => 'Jefe Faena',
			'eva_faena' => 'Faena',
			'eva_supervisor' => 'Supervisor',
			'eva_apr' => 'APR',
			'eva_geo_x' => 'GEO X',
			'eva_geo_y' => 'GEO Y',
			'eva_linea' => 'Línea',
			'eva_vencimiento_corma' => 'Vencimiento Corma',
			'eva_licencia_conducir_clase' => 'Clase licencia de conducir',
			'eva_licencia_conducir_vencimiento' => 'Vencimiento licencia de conducir',
			'eva_tipo_cosecha' => 'Tipo Cosecha',
			'eva_patente' => 'Patente/Numero UT',
			'eva_fecha' => 'Fecha',
			'eva_hora' => 'Hora',
			'eva_lugar' => 'Lugar',
			'eva_general_observacion' => 'Observación',
			'eva_general_foto' => 'Foto',
			'eva_general_fecha' => 'Fecha',
			'eva_cache_porcentaje' => 'Cumplimiento',
			'eva_cargo' => 'Cargo',
			
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

		$criteria->compare('eva_id',$this->eva_id);
		$criteria->compare('eva_creado',$this->eva_creado,true);
		$criteria->compare('eva_tipo',$this->eva_tipo,true);
		$criteria->compare('eva_evaluador',$this->eva_evaluador,true);
		$criteria->compare('eess_rut',$this->eess_rut,true);
		$criteria->compare('tra_rut',$this->tra_rut,true);
		$criteria->compare('eva_apellidos',$this->eva_apellidos,true);
		$criteria->compare('eva_nombres',$this->eva_nombres,true);
		$criteria->compare('eva_fecha_evaluacion',$this->eva_fecha_evaluacion,true);
		$criteria->compare('eva_fundo',$this->eva_fundo,true);
		$criteria->compare('eva_faena',$this->eva_faena,true);
		$criteria->compare('eva_supervisor',$this->eva_supervisor,true);
		$criteria->compare('eva_apr',$this->eva_apr,true);
		$criteria->compare('eva_comuna',$this->eva_comuna,true);
		$criteria->compare('eva_jefe_faena',$this->eva_jefe_faena,true);
		$criteria->compare('eva_geo_x',$this->eva_geo_x);
		$criteria->compare('eva_geo_y',$this->eva_geo_y);
		$criteria->compare('eva_linea',$this->eva_linea);
		$criteria->compare('eva_vencimiento_corma',$this->eva_vencimiento_corma,true);
		$criteria->compare('eva_tipo_cosecha',$this->eva_tipo_cosecha,true);
		$criteria->compare('eva_patente',$this->eva_patente,true);
		$criteria->compare('eva_fecha',$this->eva_fecha,true);
		$criteria->compare('eva_hora',$this->eva_hora,true);
		$criteria->compare('eva_lugar',$this->eva_lugar,true);
		$criteria->compare('eva_cache_porcentaje',$this->eva_cache_porcentaje);
		$criteria->compare('eva_cargo',$this->eva_cargo);

		if(Yii::app()->controller->usertype() == 1) $criteria->addSearchCondition('eess_rut',Yii::app()->user->id,true);//$criteria->compare('eess_rut',Yii::app()->user->id);
		if(Yii::app()->controller->usertype() == 3 ){
			$eess = Yii::app()->db->createCommand("SELECT eess_rut FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
			//$criteria->compare('eess_rut',$eess);
			$criteria->addSearchCondition('eess_rut',$eess,true);
			$criteria->compare('eva_evaluador',Yii::app()->user->id);
		}
		
		if( Yii::app()->controller->usertype() == 4){
			$eess = Yii::app()->db->createCommand("SELECT eess_rut FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
			$jefeFaena = Yii::app()->db->createCommand("SELECT CONCAT(tra_nombres,' ',tra_apellidos) FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
			//$criteria->compare('eess_rut',$eess);
			$criteria->addSearchCondition('eess_rut',$eess,true);
			$criteria->compare('eva_jefe_faena',$jefeFaena);
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'Pagination' => array (
            	//'PageSize' => Yii::app()->params['pagesize'],
            	'PageSize' => 20,
            ),
            'sort'=>array(
			    'defaultOrder'=>'eva_id DESC',
			),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Evaluacion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
