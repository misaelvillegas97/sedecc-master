<?php

if(!isset(Yii::app()->user->id)){
  header('Location: index.php?r=site/login');
}
?>
<?php
if(isset($_POST['eesscheck'])){
	//print_r($_POST['eesscheck']);
	Yii::app()->db->createCommand("DELETE FROM min_check_activo")->execute();
	for($i=0;$i<count($_POST['eesscheck']);$i++){
		$tmp = json_decode($_POST['eesscheck'][$i]);
		Yii::app()->db->createCommand("REPLACE INTO min_check_activo (act_id, act_eess, act_car, tipo_checklist) VALUES (NULL,'".$tmp[0]."','".$tmp[1]."','".$tmp[2]."')")->execute();
	}
	echo '<div class="alert alert-success">Se almacenó la configuración con éxito.</div>';
}

?>

<h2 class="page-header">Configuración</h2>

<div id="exTab1">
	<ul class="nav nav-pills">
		<li class="active"><a href="#1a" data-toggle="tab">Checklist activos EESS</a></li>
	</ul>
	<div class="tab-content clearfix">
		<div class="tab-pane active" id="1a">

          <?php
          $eess = Yii::app()->db->createCommand("SELECT * FROM min_eess ORDER BY eess_nombre_corto")->queryAll();
		  //$chec = Yii::app()->db->createCommand("SELECT distinct car_id, eess_rut,tipo_checklist FROM min_pregunta")->queryAll();
		  echo '<form method="post"><table class="table table-striped table-bordered" style="font-size:8pt; background-color: white;">';
		  for($i=0;$i<count($eess);$i++){
		  echo '<a class="btn btn-block" data-toggle="collapse" data-target="#demo'.$i.'" style="margin-top:5px; color:#ffffff;">'.$eess[$i]['eess_nombre_corto'].'</a>
			<div id="demo'.$i.'" class="collapse" style="background:#ffffff; padding:10px;">';
			$chec = Yii::app()->db->createCommand("SELECT distinct checklist, eess_rut,tipo_checklist FROM min_formularios where eess_rut = ".$eess[$i]['eess_rut'])->queryAll();
			for($j=0;$j<count($chec);$j++){
				$c = Yii::app()->db->createCommand("SELECT COUNT(*) FROM min_check_activo WHERE act_eess = '".$eess[$i]['eess_rut']."' AND act_car = '".$chec[$j]['checklist']."'")->queryScalar();
				if($c == 0) $activo = ''; else $activo = 'checked';
				$nombreeess = '';
				if($chec[$j]['checklist'] != '' && $chec[$j]['checklist'] != '0'){
					$nombreeess = Yii::app()->db->createCommand("SELECT eess_nombre_corto FROM min_eess WHERE eess_rut = '".$chec[$j]['eess_rut']."'")->queryScalar();
					$nombreeess = '<span class="label label-info">'.$nombreeess.'</span>';
				}
				echo '<label><input '.$activo.' name="eesscheck[]" value=\''.(json_encode(array($eess[$i]['eess_rut'],$chec[$j]['checklist'],$chec[$j]['tipo_checklist']))).'\' type="checkbox"> '.$nombreeess.' <small>'.$chec[$j]['checklist'].'</small></label><br>';
			}
		  echo '</div>
		  ';
		  }
		echo '<input type="submit" value="Guardar" class="btn btn-primary btn-block">';
		  echo '</form>';
          ?>
		  
		</div>
	</div>
</div>
