<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	public function usertype(){
		if(!isset(Yii::app()->user->id)) return 0; // Invitado
		else{
			$rows = Yii::app()->db->createCommand("SELECT * FROM min_eess WHERE eess_rut = '".Yii::app()->user->id."'")->query()->readAll();
			if(count($rows)>0){
				return 1; // Usuario empresa
			}
			else{
				$rows = Yii::app()->db->createCommand("SELECT * FROM min_usuario WHERE usu_acceso_nombre = '".Yii::app()->user->id."'")->query()->readAll();
				if(count($rows)>0){
					return 2; // Admin
				}
				else{
					$rows = Yii::app()->db->createCommand("SELECT * FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."' AND tra_evaluador = 1")->query()->readAll();
					if(count($rows) > 0) return 3; // Evaluador
					$rows = Yii::app()->db->createCommand("SELECT * FROM min_trabajador t LEFT JOIN min_cargo c ON(t.car_id = c.car_id) WHERE tra_rut = '".Yii::app()->user->id."' AND car_respuesta = 1")->query()->readAll();
					if(count($rows) > 0) return 4; // Usuario respuesta
				}
			}
		}
		return -1; // Error ¿?
	}
	
	public function identificador($evaluador,$fecha,$correlativo){
		// Para que el largo del correlativo sea siempre el mismo
		$ceros = '';
		if($correlativo/10 < 1000) $ceros = '0';
		if($correlativo/10 < 100) $ceros = '00';
		if($correlativo/10 < 10) $ceros = '000';
		if($correlativo/10 < 1) $ceros = '0000';
		// Obtener identificador del evaluador
		$ev = Yii::app()->db->createCommand("SELECT UPPER(CONCAT(SUBSTRING(tra_nombres,1,3),SUBSTRING(tra_apellidos,1,3))) FROM min_trabajador WHERE tra_rut = '".$evaluador."'")->queryScalar();
		// Armar el código final
		return $ev.substr($fecha,0,4).$ceros.$correlativo;
	}
}