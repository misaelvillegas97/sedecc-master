<?php 
class Apprueba extends CApplicationComponent{
   public $idioma; // configurable en config/main.php 
   public function init(){
    // init es llamado por Yii, debido a que es un componente.
   }
	
	public function escala($a){
		$exigencia = 60;
		$nota_minima = 1;
		$nota_aprobacion = 4;
		$nota_maxima = 7;
		$puntaje_minimo = 0;
		$puntaje_aprobacion = 60;
		$puntaje_maximo = 100;
		$puntaje_alumno = $a;
		
		if($a <= 60){
			$nota_alumno = ((3/60)*($puntaje_alumno - $puntaje_minimo))+$nota_minima;
		}
		else{
			$nota_alumno = ((3/($puntaje_maximo - $puntaje_aprobacion))*($puntaje_alumno - $puntaje_aprobacion))+$nota_aprobacion;			
		}
		return $nota_alumno;
	}
   
   public function hola(){
     if($this->idioma == 'en')
       return "hello";
     if($this->idioma == 'es')
       return "hola";

    return "sin idioma configurado para decir hola";
  }
}