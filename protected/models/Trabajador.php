<?php 

/**
 * This is the model class for table "min_trabajador".
 *
 * The followings are the available columns in table 'min_trabajador':
 * @property integer $tra_id
 * @property string $tra_creado
 * @property integer $eess_rut
 * @property integer $tra_rut
 * @property string $tra_dv
 * @property string $tra_nombres
 * @property string $tra_apellidos
 * @property string $tra_fecha_nacimiento
 * @property string $tra_vencimiento_corma
 * @property string $tra_vencimiento_examen
 * @property string $tra_licencia_conducir
 * @property string $tra_vencimiento_licencia_conducir
 * @property string $tra_responder_todo
 * @property integer $car_id
 * @property integer $tra_origen
 */
class Trabajador extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'min_trabajador';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('eess_rut, tra_rut, tra_nombres, tra_apellidos, car_id, tra_color, tra_recibir_todo', 'required'),
			array('eess_rut, tra_rut, car_id, tra_evaluador, tra_responder_todo, tra_recibir_todo', 'numerical', 'integerOnly'=>true),
			array('tra_dv', 'length', 'max'=>2),
			array('tra_nombres, tra_apellidos, tra_licencia_conducir, tra_email, tra_color, tra_contrasena, tra_centro_trabajo,are_id', 'length', 'max'=>255,),
			array('tra_fecha_nacimiento, tra_vencimiento_corma, tra_vencimiento_examen, tra_vencimiento_licencia_conducir', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('tra_id, tra_creado, eess_rut, tra_rut, tra_dv, tra_nombres, tra_apellidos, tra_fecha_nacimiento, tra_vencimiento_corma, tra_vencimiento_examen, tra_licencia_conducir, tra_vencimiento_licencia_conducir, car_id, are_id, tra_evaluador, tra_email, tra_contrasena, tra_responder_todo, tra_centro_trabajo', 'safe', 'on'=>'search'),
			
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
			'tra_id' => 'ID',
			'tra_creado' => 'Fecha de creación',
			'eess_rut' => 'Empresa',
			'tra_rut' => 'Rut',
			'tra_dv' => 'DV',
			'tra_nombres' => 'Nombres',
			'tra_apellidos' => 'Apellidos',
			'tra_fecha_nacimiento' => 'Fecha de Nacimiento',
			'tra_vencimiento_corma' => 'Vencimiento Corma',
			'tra_vencimiento_examen' => 'Vencimiento Examen Ocupacional',
			'tra_licencia_conducir' => 'Clase de Licencia',
			'tra_vencimiento_licencia_conducir' => 'Vencimiento Licencia Conducir',
			'car_id' => 'Cargo',
			'are_id' => 'Área',
			'tra_email' => 'Email',
			'tra_evaluador' => 'Habilitado para Evaluar',
			'tra_color' => 'Color en el Mapa',
			'tra_contrasena' => 'Contraseña',
			'tra_responder_todo' => 'Puede responder otras evaluaciones',
			'tra_recibir_todo' => 'Recibe todas las evaluaciones',
			'tra_centro_trabajo' => 'Centro de trabajo',
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

		$criteria->compare('tra_id',$this->tra_id);
		$criteria->compare('tra_creado',$this->tra_creado,true);
		$criteria->compare('eess_rut',$this->eess_rut);
		$criteria->compare('tra_rut',$this->tra_rut);
		$criteria->compare('tra_dv',$this->tra_dv,true);
		$criteria->compare('tra_nombres',strtoupper($this->tra_nombres),true);
		$criteria->compare('tra_apellidos',strtoupper($this->tra_apellidos),true);
		$criteria->compare('tra_fecha_nacimiento',$this->tra_fecha_nacimiento,true);
		$criteria->compare('tra_vencimiento_corma',$this->tra_vencimiento_corma,true);
		$criteria->compare('tra_vencimiento_examen',$this->tra_vencimiento_examen,true);
		$criteria->compare('tra_licencia_conducir',$this->tra_licencia_conducir,true);
		$criteria->compare('tra_vencimiento_licencia_conducir',$this->tra_vencimiento_licencia_conducir,true);
		$criteria->compare('car_id',strtoupper($this->car_id));
		$criteria->compare('are_id',strtoupper($this->are_id),true);
		$criteria->compare('tra_email',strtoupper($this->tra_email));
		$criteria->compare('tra_evaluador',$this->tra_evaluador);
		$criteria->compare('tra_responder_todo',$this->tra_responder_todo);
        $criteria->compare('tra_centro_trabajo',strtoupper($this->tra_centro_trabajo));
		if(Yii::app()->controller->usertype() == 1) $criteria->compare('eess_rut',Yii::app()->user->id);
		if(Yii::app()->controller->usertype() == 3){
			$eess = Yii::app()->db->createCommand("SELECT eess_rut FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
			$criteria->compare('eess_rut',$eess);
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort' => array(
                'defaultOrder' => 'tra_apellidos ASC',
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
	 * @return Trabajador the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	

	
	public function getFullName(){
                return $this->tra_nombres.' '.$this->tra_apellidos;
        }
}
