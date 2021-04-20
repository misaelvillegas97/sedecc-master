<?php 

if(!isset(Yii::app()->user->id)){
  header('Location: index.php?r=site/login');
}
?>
<?php
if(Yii::app()->controller->usertype() == 1) if(Yii::app()->user->id != $model->eess_rut) return; 

if(isset($_POST['deleteemail'])){
	Yii::app()->db->createCommand("DELETE FROM min_email WHERE ema_id = '".$_POST['deleteemail']."'")->execute();
	echo '<div class="alert alert-success">El email fue eliminado con éxito</div>';
}

if(isset($_POST['createemail'])){
	Yii::app()->db->createCommand("INSERT INTO min_email(eess_rut,ema_email) VALUES('".$model->eess_rut."','".$_POST['createemail']."')")->execute();
	echo '<div class="alert alert-success">El email fue integrado con éxito</div>';
}
?>


<span style='float:right;'>


<?php if(Yii::app()->controller->usertype() == 2) echo CHtml::link('<img src="img/list.png" width="40px;">',array('index'),array('title'=>'Volver al listado')); ?>
<?php if(Yii::app()->controller->usertype() == 2) echo CHtml::link('<img src="img/agregar.png" width="40px;">',array('create'),array('title'=>'Nuevo')); ?>
<?php echo CHtml::link('<img src="img/edit.png" width="40px;">',array('update','id'=>$model->eess_rut),array('title'=>'Modificar')); ?>
<?php if(Yii::app()->controller->usertype() == 2) echo CHtml::link('<img src="img/borrar.png" width="40px;">',array('trash','id'=>$model->eess_rut),array('title'=>'Eliminar','onclick'=>'return confirm(\'¿Realmente desea eliminar?\');'));?>
<!--?php echo CHtml::link('<i class="i i-list2"></i>',array('admin'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?-->
</span> 
<h1>Detalle empresa de servicio <!--?php echo $model->eess_rut; ?--></h1>

<div class="panel panel-default">
<div class="panel-body">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'eess_rut',
		'eess_creado',
		'eess_nombre_corto',
		'eess_razon_social',
		'eess_ciudad',
		'eess_telefono',
		'eess_email',
		'eess_clave',
		array(
			'name'=>'eess_logo',
			'type'=>'raw',
			'value'=>function($data){
				$content='';
				$dir = 'images/eess/';
				$directorio=opendir($dir);
				$flag = 0;
				while ($archivo = readdir($directorio))
					if($archivo != '.' && $archivo != '..' && strpos($archivo , $_GET['id'].'.jpg') !== false){
						$content.='
					  	<div class="thumbnail">
							<center><a href="'.$dir.$archivo.'" target="_blank"><img src="'.$dir.$archivo.'" style="max-width:100%;"></a></center>
					  	</div>
						';
						$flag = 1;
					}
				closedir($directorio); 
				if($flag == 1) return $content; else return '(sin logo)';
			},
		),
		array(
			'name'=>'eess_estado',
			'type'=>'raw',
			'value'=>function($data){
				if($data->eess_estado == 1) return 'Activo'; else return 'Inactivo';
			},
		),
	),
)); ?>

<h3 class="page-header">Información de representante</h3>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'eess_representante',
		'eess_representante_telefono',
		'eess_representante_email',
	),
)); ?>
<!-- se comenta informacion como restriccion de agregar correos
<h3 class="page-header">Otros emails para recibir evaluaciones</h3>
<small>Ingrese acá otras direcciones de email para incluir en las copias con las evaluaciones realizadas a su empresa.</small>
<?php
/**
$emails = Yii::app()->db->createCommand("SELECT * FROM min_email WHERE eess_rut = '".$model->eess_rut."'")->query()->readAll();
echo '<table class="table table-striped">';
echo '<thead><th>Email</th><th></th></thead>';
for($i=0;$i<count($emails);$i++){
	echo '<tr><td>'.$emails[$i]['ema_email'].'</td><td class="text-right"><form method="post"><input name="deleteemail" type="hidden" value="'.$emails[$i]['ema_id'].'"><button onclick="if(confirm(\'¿Realmente desea quitar este email?\')){ this.form.submit();} return false;" class="btn btn-xs btn-danger" href="#">Eliminar</button></form></td></tr>';
}
echo '<tr><td colspan="2" style="margin:0px; padding:0px;"><form method="post"><input name="createemail" required = "false" class="form-control" placeholder="Ingrese email y presione Enter"><input type="submit" style="display:none;"></form></td></tr>';
echo '</table>';
**/
?>
-->
</div>
</div>
