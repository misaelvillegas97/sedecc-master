<?php
$empresas = Yii::app()->db->createCommand("SELECT * FROM min_eess")->queryAll();
//$empresas = Yii::app()->db->createCommand("SELECT * FROM min_eess")->queryRow();
//$empresas = Yii::app()->db->createCommand("SELECT * FROM min_eess")->queryScalar();
$empresas = Yii::app()->db->createCommand("BLABLABLA")->execute();

echo json_encode($empresas);
?>