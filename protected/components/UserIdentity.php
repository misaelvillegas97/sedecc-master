<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		// Accesos generales
		$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);
		
		// Acceso usuarios
		$rows = Yii::app()->db->createCommand("SELECT * FROM min_usuario")->query()->readAll();
		for($i=0;$i<count($rows);$i++){
			$users[$rows[$i]['usu_acceso_nombre']] = $rows[$i]['usu_acceso_contrasena'];
		}
		
		// Acceso empresas
		$rows = Yii::app()->db->createCommand("SELECT * FROM min_eess where eess_estado =1")->query()->readAll();
		for($i=0;$i<count($rows);$i++){
			$users[$rows[$i]['eess_rut']] = $rows[$i]['eess_clave'];
		}
		
		// Acceso evaluadores
		$rows = Yii::app()->db->createCommand("SELECT * FROM min_trabajador tra join min_eess emp on emp.eess_rut=tra.eess_rut WHERE tra_evaluador = 1 and emp.eess_estado=1")->query()->readAll();
		for($i=0;$i<count($rows);$i++){
			$users[$rows[$i]['tra_rut']] = $rows[$i]['eess_rut'];
		}
		
		// Acceso cargos habilitados para responder
		$rows = Yii::app()->db->createCommand("SELECT t.tra_rut as tra_rut, t.eess_rut as eess_rut FROM min_trabajador t LEFT JOIN min_cargo c ON(t.car_id = c.car_id) WHERE car_respuesta = 1")->query()->readAll();
		for($i=0;$i<count($rows);$i++){
			$users[$rows[$i]['tra_rut']] = $rows[$i]['eess_rut'];
		}
		
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
	}
}