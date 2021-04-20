<?php

/**
 * This is the model class for table "min_evaluacion_instalaciones".
 *
 * The followings are the available columns in table 'min_evaluacion_instalaciones':
 * @property double $eva_id
 * @property string $eva_creado
 * @property string $eva_tipo
 * @property string $eess_rut
 * @property string $eva_gerente_general
 * @property string $eva_num_trabajadores
 * @property string $eva_gerente_operacion
 * @property string $eva_administrador
 * @property string $eva_num_personas
 * @property string $eva_fecha_evaluacion
 * @property string $eva_fundo
 * @property string $eva_faena
 * @property string $eva_jefe_faena
 * @property string $eva_supervisor
 * @property string $eva_apr
 * @property double $eva_geo_x
 * @property double $eva_geo_y
 * @property string $eva_general_observacion
 * @property string $eva_general_foto
 * @property string $eva_general_fecha
 * @property string $eva_evaluador
 * @property double $eva_cache_porcentaje
 * @property integer $eva_evaluador_correlativo
 * @property string $eva_fecha
 * @property string $eva_hora
 * @property string $eva_lugar
 * @property string $eva_semaforo
 * @property string $eva_item_nombre_0
 * @property double $eva_item_nota_0
 * @property string $eva_item_nombre_1
 * @property double $eva_item_nota_1
 * @property string $eva_item_nombre_2
 * @property double $eva_item_nota_2
 * @property string $eva_item_nombre_3
 * @property double $eva_item_nota_3
 * @property string $eva_item_nombre_4
 * @property double $eva_item_nota_4
 * @property string $eva_item_nombre_5
 * @property double $eva_item_nota_5
 * @property string $eva_item_nombre_6
 * @property double $eva_item_nota_6
 * @property string $eva_item_nombre_7
 * @property double $eva_item_nota_7
 * @property string $eva_item_nombre_8
 * @property double $eva_item_nota_8
 * @property string $eva_item_nombre_9
 * @property double $eva_item_nota_9
 * @property string $eva_item_nombre_10
 * @property double $eva_item_nota_10
 */
class EvalInstalaciones extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'min_evaluacion_instalaciones';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('eva_creado', 'required'),
			array('eva_evaluador_correlativo', 'numerical', 'integerOnly'=>true),
			array('eva_geo_x, eva_geo_y, eva_cache_porcentaje, eva_item_nota_0, eva_item_nota_1, eva_item_nota_2, eva_item_nota_3, eva_item_nota_4, eva_item_nota_5, eva_item_nota_6, eva_item_nota_7, eva_item_nota_8, eva_item_nota_9, eva_item_nota_10', 'numerical'),
			array('eva_tipo,eva_cod_faena, eess_rut, eva_gerente_general, eva_num_trabajadores, eva_gerente_operacion, eva_administrador, eva_num_personas, eva_fundo, eva_faena, eva_jefe_faena, eva_supervisor, eva_apr, eva_evaluador, eva_lugar, eva_item_nombre_0, eva_item_nombre_1, eva_item_nombre_2, eva_item_nombre_3, eva_item_nombre_4, eva_item_nombre_5, eva_item_nombre_6, eva_item_nombre_7, eva_item_nombre_8, eva_item_nombre_9, eva_item_nombre_10', 'length', 'max'=>255),
			array('eva_semaforo', 'length', 'max'=>1),
			array('eva_fecha_evaluacion, eva_general_observacion, eva_general_foto, eva_general_fecha, eva_fecha, eva_hora', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('eva_id, eva_cod_faena, eva_creado, eva_tipo, eess_rut, eva_gerente_general, eva_num_trabajadores, eva_gerente_operacion, eva_administrador, eva_num_personas, eva_fecha_evaluacion, eva_fundo, eva_faena, eva_jefe_faena, eva_supervisor, eva_apr, eva_geo_x, eva_geo_y, eva_general_observacion, eva_general_foto, eva_general_fecha, eva_evaluador, eva_cache_porcentaje, eva_evaluador_correlativo, eva_fecha, eva_hora, eva_lugar, eva_semaforo, eva_item_nombre_0, eva_item_nota_0, eva_item_nombre_1, eva_item_nota_1, eva_item_nombre_2, eva_item_nota_2, eva_item_nombre_3, eva_item_nota_3, eva_item_nombre_4, eva_item_nota_4, eva_item_nombre_5, eva_item_nota_5, eva_item_nombre_6, eva_item_nota_6, eva_item_nombre_7, eva_item_nota_7, eva_item_nombre_8, eva_item_nota_8, eva_item_nombre_9, eva_item_nota_9, eva_item_nombre_10, eva_item_nota_10', 'safe', 'on'=>'search'),
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
			'eva_id' => 'Correlativo',
			'eva_creado' => 'Creado',
			'eva_tipo' => 'Tipo',
			'eess_rut' => 'Eess Rut',
			'eva_cod_faena' => 'Codigo Faena',
			'eva_gerente_general' => 'Gerente General',
			'eva_num_trabajadores' => 'NºTrabajadores',
			'eva_gerente_operacion' => 'Gerente Operacion',
			'eva_administrador' => 'Administrador',
			'eva_num_personas' => 'nº Personas',
			'eva_fecha_evaluacion' => 'Fecha Evaluacion',
			'eva_fundo' => 'Fundo',
			'eva_faena' => 'Código Faena',
			'eva_jefe_faena' => 'Jefe Faena',
			'eva_supervisor' => 'Supervisor',
			'eva_apr' => 'Apr',
			'eva_geo_x' => 'Geo X',
			'eva_geo_y' => 'Geo Y',
			'eva_general_observacion' => 'General Observacion',
			'eva_general_foto' => 'General Foto',
			'eva_general_fecha' => 'General Fecha',
			'eva_evaluador' => 'Evaluador',
			'eva_cache_porcentaje' => 'Cache Porcentaje',
			'eva_evaluador_correlativo' => 'Evaluador Correlativo',
			'eva_fecha' => 'Fecha',
			'eva_hora' => 'Hora',
			'eva_lugar' => 'Lugar',
			'eva_semaforo' => 'Semaforo',
			'eva_item_nombre_0' => 'Item Nombre 0',
			'eva_item_nota_0' => 'Item Nota 0',
			'eva_item_nombre_1' => 'Item Nombre 1',
			'eva_item_nota_1' => 'Item Nota 1',
			'eva_item_nombre_2' => 'Item Nombre 2',
			'eva_item_nota_2' => 'Item Nota 2',
			'eva_item_nombre_3' => 'Item Nombre 3',
			'eva_item_nota_3' => 'Item Nota 3',
			'eva_item_nombre_4' => 'Item Nombre 4',
			'eva_item_nota_4' => 'Item Nota 4',
			'eva_item_nombre_5' => 'Item Nombre 5',
			'eva_item_nota_5' => 'Item Nota 5',
			'eva_item_nombre_6' => 'Item Nombre 6',
			'eva_item_nota_6' => 'Item Nota 6',
			'eva_item_nombre_7' => 'Item Nombre 7',
			'eva_item_nota_7' => 'Item Nota 7',
			'eva_item_nombre_8' => 'Item Nombre 8',
			'eva_item_nota_8' => 'Item Nota 8',
			'eva_item_nombre_9' => 'Item Nombre 9',
			'eva_item_nota_9' => 'Item Nota 9',
			'eva_item_nombre_10' => 'Item Nombre 10',
			'eva_item_nota_10' => 'Item Nota 10',
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
		$criteria->compare('eess_rut',$this->eess_rut,true);
		$criteria->compare('eva_cod_faena',$this->eva_cod_faena,true);
		$criteria->compare('eva_gerente_general',$this->eva_gerente_general,true);
		$criteria->compare('eva_num_trabajadores',$this->eva_num_trabajadores,true);
		$criteria->compare('eva_gerente_operacion',$this->eva_gerente_operacion,true);
		$criteria->compare('eva_administrador',$this->eva_administrador,true);
		$criteria->compare('eva_num_personas',$this->eva_num_personas,true);
		$criteria->compare('eva_fecha_evaluacion',$this->eva_fecha_evaluacion,true);
		$criteria->compare('eva_fundo',$this->eva_fundo,true);
		$criteria->compare('eva_faena',$this->eva_faena,true);
		$criteria->compare('eva_jefe_faena',$this->eva_jefe_faena,true);
		$criteria->compare('eva_supervisor',$this->eva_supervisor,true);
		$criteria->compare('eva_apr',$this->eva_apr,true);
		$criteria->compare('eva_geo_x',$this->eva_geo_x);
		$criteria->compare('eva_geo_y',$this->eva_geo_y);
		$criteria->compare('eva_general_observacion',$this->eva_general_observacion,true);
		$criteria->compare('eva_general_foto',$this->eva_general_foto,true);
		$criteria->compare('eva_general_fecha',$this->eva_general_fecha,true);
		$criteria->compare('eva_evaluador',$this->eva_evaluador,true);
		$criteria->compare('eva_cache_porcentaje',$this->eva_cache_porcentaje);
		$criteria->compare('eva_evaluador_correlativo',$this->eva_evaluador_correlativo);
		$criteria->compare('eva_fecha',$this->eva_fecha,true);
		$criteria->compare('eva_hora',$this->eva_hora,true);
		$criteria->compare('eva_lugar',$this->eva_lugar,true);
		$criteria->compare('eva_semaforo',$this->eva_semaforo,true);
		$criteria->compare('eva_item_nombre_0',$this->eva_item_nombre_0,true);
		$criteria->compare('eva_item_nota_0',$this->eva_item_nota_0);
		$criteria->compare('eva_item_nombre_1',$this->eva_item_nombre_1,true);
		$criteria->compare('eva_item_nota_1',$this->eva_item_nota_1);
		$criteria->compare('eva_item_nombre_2',$this->eva_item_nombre_2,true);
		$criteria->compare('eva_item_nota_2',$this->eva_item_nota_2);
		$criteria->compare('eva_item_nombre_3',$this->eva_item_nombre_3,true);
		$criteria->compare('eva_item_nota_3',$this->eva_item_nota_3);
		$criteria->compare('eva_item_nombre_4',$this->eva_item_nombre_4,true);
		$criteria->compare('eva_item_nota_4',$this->eva_item_nota_4);
		$criteria->compare('eva_item_nombre_5',$this->eva_item_nombre_5,true);
		$criteria->compare('eva_item_nota_5',$this->eva_item_nota_5);
		$criteria->compare('eva_item_nombre_6',$this->eva_item_nombre_6,true);
		$criteria->compare('eva_item_nota_6',$this->eva_item_nota_6);
		$criteria->compare('eva_item_nombre_7',$this->eva_item_nombre_7,true);
		$criteria->compare('eva_item_nota_7',$this->eva_item_nota_7);
		$criteria->compare('eva_item_nombre_8',$this->eva_item_nombre_8,true);
		$criteria->compare('eva_item_nota_8',$this->eva_item_nota_8);
		$criteria->compare('eva_item_nombre_9',$this->eva_item_nombre_9,true);
		$criteria->compare('eva_item_nota_9',$this->eva_item_nota_9);
		$criteria->compare('eva_item_nombre_10',$this->eva_item_nombre_10,true);
		$criteria->compare('eva_item_nota_10',$this->eva_item_nota_10);


		if(Yii::app()->controller->usertype() == 1) $criteria->compare('eess_rut',Yii::app()->user->id);
		if(Yii::app()->controller->usertype() == 3 || Yii::app()->controller->usertype() == 4){
			$eess = Yii::app()->db->createCommand("SELECT eess_rut FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
			$criteria->compare('eess_rut',$eess);
			$criteria->compare('eva_evaluador',Yii::app()->user->id);
		}
		
		return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort' => array(
                'defaultOrder' => 'eva_creado DESC',
            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EvalInstalaciones the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
