<?php
/* @var $this AccidenteController */
/* @var $model Accidente */

$this->breadcrumbs=array(
	'Accidentes'=>array('index'),
	$model->id_accidente,
);
?>


<span style='float:right;'>
<?php echo CHtml::link('<i class="i i-list"></i>',array('index'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-plus2"></i>',array('create'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-pencil2"></i>',array('update','id'=>$model->id_accidente),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
<?php echo CHtml::link('<i class="i i-cross2"></i>',array('trash','id'=>$model->id_accidente),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default','onclick'=>'return confirm(\'¿Realmente desea eliminar?\');'));?>
<?php //echo CHtml::link('<i class="i i-list2"></i>',array('admin'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?>
</span> 
<h1>Detalle Accidente</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
					'name'=>'eess_rut',
					'label'=>'Empresa',
					'type'=>'raw',
					'value'=>function($data){
						$eess = Yii::app()->db->createCommand("SELECT eess_nombre_corto FROM min_eess where eess_rut='".$data->eess_rut."' ")->queryScalar();	
						if($eess == '') return '<i>(sin rut ee.ss registrado)</i>'; else return strtoupper($eess);
					},
				),
		array(
					'name'=>'rut_trabajador',
					'label'=>'Trabajador',
					'type'=>'raw',
					'value'=>function($data){
						$trabajador = Yii::app()->db->createCommand("SELECT concat(tra_nombres,' ',tra_apellidos) as id FROM min_trabajador where tra_rut='".$data->rut_trabajador."' ")->queryScalar();	
						if($trabajador == '') return '<i>(sin trabajador registrado)</i>'; else return strtoupper($trabajador);
					},
				),
		/*array(
					'name'=>'tra_cargo',
					'label'=>'Cargo',
					'type'=>'raw',
					'value'=>function($data){
						$cargo = Yii::app()->db->createCommand("SELECT car_descripcion as id FROM min_cargo where car_id=".$data->tra_cargo." ")->queryScalar();	
						if($cargo == '') return '<i>(sin cargo registrado)</i>'; else return strtoupper($cargo);
					},
				)*/'tra_cargo',
		'tra_depto',
		'acc_tipo_accidnte',
		'fecha_accidente',
		'fecha_alta',
		'Descripcion',
	),
)); ?>
<style type="text/css">
	.dd-nodrag {
    display: block;
    height: auto;
    margin: 5px 0;
    padding: 5px 10px;
    color: #333;
    text-decoration: none;
    font-weight: 700;
    border: 1px solid #ccc;
    background: #fafafa;
    border-radius: 3px;
    box-sizing: border-box;
}
.borde{
	outline: 1px solid orange;
	padding:0px;
}

.col-container {
    display: flex; /* equal height of the children */
}
.col {
    flex: 1; /* additionally, equal width */
   padding:0px;
  
}

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<!--<link rel="stylesheet" href="css/nestable/nestable.css" type="text/css">-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.css" type="text/css">
<link rel="stylesheet" href="css/file-explore.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.js"></script>
<script src="js/file-explore.js"></script> 
<!--<script src="js/nestable/jquery.nestable.js"></script>
<script src="js/nestable/demo.js"></script>-->
<div class="col-sm-12"> 
	<div class="row" style="margin-top: 30px;">


<!-- Creates the bootstrap modal where the image will appear -->
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="z-index: 1008;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Vista Previa</h4>
      </div>
      <div class="modal-body" style="height: 500px;">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
	<?php 
		$path  = 'images/accidentes/'.$model->id_accidente.'/';
		
		if(!is_dir($path)){
			echo '<h3>No hay archivos adjuntos</h3>';
		}else{
			$files = scandir($path);
			$files = array_diff(scandir($path), array('.', '..'));
			echo '<ul class="file-tree" style="position:relative; z-index:1; width:400px;">
					  <li><a href="#">Archivos Adjuntos</a>
					    <ul>	 ';
			foreach ($files as $valor){
				//echo ' <li><a href="images/accidentes/'.$model->id_accidente.'/'.$valor.' " class="showModal">'.$valor.'</a> </li>';
				if (strpos($valor, 'xst') == true || strpos($valor, 'docx') == true || strpos($valor, 'ppt') == true || strpos($valor, 'pdf') == true) {
				    //echo ' <li><a href="images/accidentes/'.$model->id_accidente.'/'.$valor.' " >'.$valor.'</a> </li>';
					echo '<li style="cursor:pointer;" class="showModal" data-url="'.$model->id_accidente.'/'.$valor.'">'.$valor.'</li>';
				}else{
					echo ' <li style="cursor:pointer;" class="showModal" data-url="images/accidentes/'.$model->id_accidente.'/'.$valor.'">'.$valor.'</li>';
				}
				
			}
			echo '   </ul>
					  </li>
					</ul>';
		}
		
	?>

	</div>
	<!-- <div class="row" style="margin-top: 30px;">
		<div class="col-sm-12 borde " style=" padding: 0;background-color: #ffb210;">
			<div class="col-sm-3 borde">
				<h3 class="text-center">Causa Básica</h3> 
			</div>
			<div class="col-sm-3 borde">
				<h3 class="text-center">Causa Inmediata</h3> 
			</div>
			<div class="col-sm-2 borde">
				<h3 class="text-center">Medida Control</h3> 			
			</div>
			<div class="col-sm-2 borde">
				<h3 class="text-center">Responsable</h3> 				
			</div>
			<div class="col-sm-2 borde">
				<h3 class="text-center">Seguimiento</h3> 				
			</div>
		</div>
		
	
		<?php 
			$where="";
			// Cuando el tipo de usuario es empresa
			if(Yii::app()->controller->usertype() == 1){
				$where.= " AND eess_rut LIKE '%".Yii::app()->user->id."%' ";
			}
			if(Yii::app()->controller->usertype() == 2){
				//$where.= "";
				$where.= " AND eess_rut LIKE '%76885630%' ";
			}
			
			
			$causasBasicasDetalle = Yii::app()->db->createCommand("SELECT * FROM min_causas_basicas cb JOIN min_causas_list cl on cl.cl_id=cb.cbl_id WHERE acc_id=".$model->id_accidente." ORDER BY cb_id ASC")->query()->readAll();
			$globalCount=1;
			if(count($causasBasicasDetalle)>0){
				$cuentaCb=0;
				for($cb=0;$cb<count($causasBasicasDetalle);$cb++){
					echo '<div class="col-sm-12  borde" style=" padding: 0; background-color:white;">';	
					echo '<div class="col-sm-3 " style=" padding: 0;" >
								<p class="col-sm-12 text-center" >'.$causasBasicasDetalle[$cb]['cl_descripcion'].'</p>
							</div>	';														
					
					$causasInmediatasDetalle = Yii::app()->db->createCommand("SELECT * FROM min_causas_inmediatas ci JOIN min_causas_list cl on cl.cl_id=ci.cil_id WHERE cb_id=".$causasBasicasDetalle[$cb]['cb_id'] ." ")->query()->readAll();
					if(count($causasInmediatasDetalle)>0){
						
						
						for($ci=0;$ci<count($causasInmediatasDetalle);$ci++){
							$globalCount++;									
							echo '<div class="col-sm-9 borde" style=" float: right; padding: 0;">';
							echo '<div class="col-sm-4 " >
								<p class="col-sm-12 text-center" >'.$causasInmediatasDetalle[$ci]['cl_descripcion'] .'</p>
							</div>';
							$medidasControlDetalle = Yii::app()->db->createCommand("SELECT * FROM min_medidas_control mc 
																					JOIN min_medidas_control_list mcl on mcl.mcl_id=mc.mcl_id  
																					JOIN min_trabajador t on t.tra_rut=mc.tra_responsable
																					WHERE mc.ci_id=".$causasInmediatasDetalle[$ci]['ci_id'] ." ")->query()->readAll();
							echo '<div class="col-sm-8" style=" padding: 0;">';
							if(count($medidasControlDetalle)>0){
								
								for($mc=0;$mc<count($medidasControlDetalle);$mc++){
									
									$globalCount++;
									$seguimiento='';
									$responder='';
									switch($medidasControlDetalle[$mc]['mc_semaforo']){
										case 0:
											$seguimiento='<img  src="images/semaforo_rojo.png" style="width:50px;">';
											$responder='<a style="color:blue;" href="index.php?r=site/page&view=respuestaMedidaControl&id='.$medidasControlDetalle[$mc]['mc_id'].'&accidente='.$model->id_accidente.'">'.$medidasControlDetalle[$mc]['mcl_descripcion'].'</a>';
											break;
										case 1:
											$seguimiento='<img  src="images/semaforo_amarillo.png" style="width:50px;">';
											$responder='<a style="color:blue;" href="index.php?r=site/page&view=respuestaMedidaControl&id='.$medidasControlDetalle[$mc]['mc_id'].'&accidente='.$model->id_accidente.'">'.$medidasControlDetalle[$mc]['mcl_descripcion'].'</a>';
											break;
										case 2:
											$seguimiento='<img  src="images/semaforo_verde.png" style="width:50px;">';
											$responder=$medidasControlDetalle[$mc]['mcl_descripcion'];
											break;
									}
									
									echo '
										<div class="col-sm-12 borde col-container" style=" float: right;">
											<div class="col-sm-4  col">
												<p class="text-center">'.$responder.'</p>	
											</div>					
											<div class="col-sm-4  borde col">
												<p class="text-center" >'. $medidasControlDetalle[$mc]['tra_nombres'] .' '. $medidasControlDetalle[$mc]['tra_apellidos'] .'</p >	
											</div>
											<div class="col-sm-4  col">
												<p class="text-center" >'.$seguimiento.'</p >	
											</div>
										</div>
									';
									
								}
								echo '</div>';	
							}	
							echo '</div>';																		
						}
					}
					echo '</div>';				
				}
			}
		?>

	</div> -->

	<div class="row" style="margin-top: 30px;">
		<!--ENCABEZADO -->
		<style> 
			.tabla-acc {
				border-width: 1px;
				border-style: solid;
				border-color: white;
				border-image: initial;
				padding: 0;
			}
		</style>
		<div class="col-sm-12 tabla-acc" style="padding: 0;background-color: #365FA0; color: #EEE; text-align: center; border-bottom: none;">
			<div class="col-sm-3 tabla-acc" style="border-bottom: none;">
				<h3 class="text-center" style="font-size: 1.1em; text-weight: bold;">Causa Básica</h3> 
			</div>
			<div class="col-sm-3 tabla-acc" style="border-bottom: none;">
				<h3 class="text-center" style="font-size: 1.1em; text-weight: bold;">Causa Inmediata</h3> 
			</div>
			<div class="col-sm-2 tabla-acc" style="border-bottom: none;">
				<h3 class="text-center" style="font-size: 1.1em; text-weight: bold;">Medida Control</h3> 			
			</div>
			<div class="col-sm-2 tabla-acc" style="border-bottom: none;">
				<h3 class="text-center" style="font-size: 1.1em; text-weight: bold;">Responsable</h3> 				
			</div>
			<div class="col-sm-2 tabla-acc" style="border-bottom: none;">
				<h3 class="text-center" style="font-size: 1.1em; text-weight: bold;">Seguimiento</h3> 				
			</div>
		</div>
		
	
		<!--acá comienzo a llenar dinámicamente de acuerdo a causas básicas-->
		<?php 
			$where="";
			// Cuando el tipo de usuario es empresa
			if(Yii::app()->controller->usertype() == 1){
				$where.= " AND eess_rut LIKE '%".Yii::app()->user->id."%' ";
			}
			if(Yii::app()->controller->usertype() == 2){
				//$where.= "";
				$where.= " AND eess_rut LIKE '%76885630%' ";
			}
			
			
			$causasBasicasDetalle = Yii::app()->db->createCommand("SELECT * FROM min_causas_basicas cb JOIN min_causas_list cl on cl.cl_id=cb.cbl_id WHERE acc_id=".$model->id_accidente." ORDER BY cb_id ASC")->query()->readAll();
			$globalCount=1;
			if(count($causasBasicasDetalle)>0){
				$cuentaCb=0;
				for($cb=0;$cb<count($causasBasicasDetalle);$cb++){
					echo '<div class="col-sm-12 tabla-acc" style=" padding: 0; background-color:#E5F1F4;">';	
					echo '<div class="col-sm-3" style=" padding: 0;" >
								<p class="col-sm-12 text-center" style="font-size: 10pt;">'.$causasBasicasDetalle[$cb]['cl_descripcion'].'</p>
							</div>	';														
					
					$causasInmediatasDetalle = Yii::app()->db->createCommand("SELECT * FROM min_causas_inmediatas ci JOIN min_causas_list cl on cl.cl_id=ci.cil_id WHERE cb_id=".$causasBasicasDetalle[$cb]['cb_id'] ." ")->query()->readAll();
					if(count($causasInmediatasDetalle)>0){
						
						
						for($ci=0;$ci<count($causasInmediatasDetalle);$ci++){
							$globalCount++;									
							echo '<div class="col-sm-9 tabla-acc" style="float: right; padding: 0; border-top: none;">';
							echo '<div class="col-sm-4">
								<p class="col-sm-12 text-center" style="font-size: 10pt;">'.$causasInmediatasDetalle[$ci]['cl_descripcion'] .'</p>
							</div>';
							$medidasControlDetalle = Yii::app()->db->createCommand("SELECT * FROM min_medidas_control mc 
																					JOIN min_medidas_control_list mcl on mcl.mcl_id=mc.mcl_id  
																					JOIN min_trabajador t on t.tra_rut=mc.tra_responsable
																					WHERE mc.ci_id=".$causasInmediatasDetalle[$ci]['ci_id'] ." ")->query()->readAll();
							echo '<div class="col-sm-8" style=" padding: 0;">';
							if(count($medidasControlDetalle)>0){
								
								for($mc=0;$mc<count($medidasControlDetalle);$mc++){
									
									$globalCount++;
									$seguimiento='';
									$responder='';
									switch($medidasControlDetalle[$mc]['mc_semaforo']){
										case 0:
											$seguimiento='<img  src="images/semaforo_rojo.png" style="width:50px; margin-top: 16px">';
											$responder='<a style="color:blue;" href="index.php?r=site/page&view=respuestaMedidaControl&id='.$medidasControlDetalle[$mc]['mc_id'].'&accidente='.$model->id_accidente.'">'.$medidasControlDetalle[$mc]['mcl_descripcion'].'</a>';
											break;
										case 1:
											$seguimiento='<img  src="images/semaforo_amarillo.png" style="width:50px; margin-top: 16px">';
											$responder='<a style="color:blue;" href="index.php?r=site/page&view=respuestaMedidaControl&id='.$medidasControlDetalle[$mc]['mc_id'].'&accidente='.$model->id_accidente.'">'.$medidasControlDetalle[$mc]['mcl_descripcion'].'</a>';
											break;
										case 2:
											$seguimiento='<img  src="images/semaforo_verde.png" style="width:50px; margin-top: 16px">';
											$responder=$medidasControlDetalle[$mc]['mcl_descripcion'];
											break;
									}
									
									echo '
										<div class="col-sm-12 tabla-acc col-container" style="float: right; border-top: none;">
											<div class="col-sm-4 col" style="padding-right: 0.2em">
												<p class="text-center">'.$responder.'</p>	
											</div>
											<div class="col-sm-4 tabla-acc col" style="border-top: none; border-bottom: none;">
												<p class="text-center" >'. $medidasControlDetalle[$mc]['tra_nombres'] .' '. $medidasControlDetalle[$mc]['tra_apellidos'] .'</p >	
											</div>
											<div class="col-sm-4 tabla-acc col" style="border-top: none; border-bottom:none">
												<p class="text-center" >'.$seguimiento.'</p >	
											</div>
										</div>
									';
									// echo '
									// 	<div class="col-sm-4 tabla-acc col" style="float:right;>
									// 		<p class="text-center" style="font-size: 10pt;">'.$seguimiento.'</p >
									// 	</div>
									// 	<div class="col-sm-4 tabla-acc col" style="float:right;>
									// 		<p class="text-center" style="font-size: 10pt;">'. $medidasControlDetalle[$mc]['tra_nombres'] .' '. $medidasControlDetalle[$mc]['tra_apellidos'] .'</p>
									// 	</div>
									// 	<div class="col-sm-4 tabla-acc col" style="float:right;>
									// 		<p class="text-center" style="font-size: 10pt;">'.$responder.'</p>
									// 	</div>
									
									// ';
									
								}
								echo '</div>';	
							}	
							echo '</div>';																		
						}
					}
					echo '</div>';				
				}
			}
		?>

	</div>
	
	<!--<div class="dd" id="nestable"> 
		<ol class="dd-list"> -->
			<?php 
						/*$where="";
						// Cuando el tipo de usuario es empresa
						if(Yii::app()->controller->usertype() == 1){
							$where.= " AND eess_rut LIKE '%".Yii::app()->user->id."%' ";
						}
						if(Yii::app()->controller->usertype() == 2){
							//$where.= "";
							$where.= " AND eess_rut LIKE '%76885630%' ";
						}
						
						$causasBasicasDetalle = Yii::app()->db->createCommand("SELECT * FROM min_causas_basicas cb JOIN min_causas_list cl on cl.cl_id=cb.cbl_id WHERE acc_id=".$model->id_accidente." ORDER BY cb_id ASC")->query()->readAll();
						$globalCount=1;
						if(count($causasBasicasDetalle)>0){
							$cuentaCb=0;
							for($cb=0;$cb<count($causasBasicasDetalle);$cb++){
								echo '<li class="dd-item " data-id="'.$globalCount.'"> ';															
								
								$causasInmediatasDetalle = Yii::app()->db->createCommand("SELECT * FROM min_causas_inmediatas ci JOIN min_causas_list cl on cl.cl_id=ci.cil_id WHERE cb_id=".$causasBasicasDetalle[$cb]['cb_id'] ." ")->query()->readAll();
								if(count($causasInmediatasDetalle)>0){
									echo '<button data-action="collapse" type="button" style="display: block;">Collapse</button>';
									echo '<button data-action="expand" type="button" style="display: none;">Expand</button> ';
									echo '<div class="dd-nodrag">'.$causasBasicasDetalle[$cb]['cl_descripcion'].'</div> ';
									echo '<ol class="dd-list" style=""> ';
									for($ci=0;$ci<count($causasInmediatasDetalle);$ci++){
										$globalCount++;									
										echo '<li class="dd-item" data-id="'.$globalCount.'">';
										$medidasControlDetalle = Yii::app()->db->createCommand("SELECT * FROM min_medidas_control mc 
																								JOIN min_medidas_control_list mcl on mcl.mcl_id=mc.mcl_id  
																								JOIN min_trabajador t on t.tra_rut=mc.tra_responsable
																								WHERE mc.ci_id=".$causasInmediatasDetalle[$ci]['ci_id'] ." ")->query()->readAll();
										if(count($medidasControlDetalle)>0){
											echo '<button data-action="collapse" type="button" style="display: none;">Collapse</button>';
											echo '<button data-action="expand" type="button" style="display: block;">Expand</button> ';
											echo '<div class="dd-nodrag">'.$causasInmediatasDetalle[$ci]['cl_descripcion'] .'</div> ';
											echo '<ol class="dd-list" style=""> ';
											for($mc=0;$mc<count($medidasControlDetalle);$mc++){
												$globalCount++;
												$seguimiento='';
												$responder='';
												switch($medidasControlDetalle[$mc]['mc_semaforo']){
													case 0:
														$seguimiento='<img  src="images/semaforo_rojo.png" style="width:50px;">';
														$responder='<a href="index.php?r=site/page&view=respuestaMedidaControl&id='.$medidasControlDetalle[$mc]['mc_id'].'&accidente='.$model->id_accidente.'"><button class="btn btn-default" id="btn-1" href="" > <i class="fa fa-mail-reply "></i> <span class="text">Responder</span> <i class="fa fa-mail-reply text-active"></i> <span class="text-active">Success</span> </button></a>';
														break;
													case 1:
														$seguimiento='<img  src="images/semaforo_amarillo.png" style="width:50px;">';
														$responder='<a href="index.php?r=site/page&view=respuestaMedidaControl&id='.$medidasControlDetalle[$mc]['mc_id'].'&accidente='.$model->id_accidente.'"><button class="btn btn-default" id="btn-1" href="" > <i class="fa fa-mail-reply "></i> <span class="text">Responder</span> <i class="fa fa-mail-reply text-active"></i> <span class="text-active">Success</span> </button></a>';
														break;
													case 2:
														$seguimiento='<img  src="images/semaforo_verde.png" style="width:50px;">';
														break;
												}
												echo '<li class="dd-item " data-id="'.$globalCount.'">';
												echo '<div class="dd-nodrag">';
												echo '<div class="form-group">';
												echo $medidasControlDetalle[$mc]['mcl_descripcion'];
												echo '</div>';
												echo '<div class="form-group">';
												echo '<table class="table table-striped">';
												echo '<thead style="background-color: #365fa0;color: white;">';
												echo '<tr>';
												echo '<th>Seguimiento</th>';
												echo '<th>Responsable</th>';
												echo '<th></th>';
												echo '</tr>';
												echo '</thead>';
												echo '<tbody>';
												echo '<tr>';
												echo '<td>'. $seguimiento .'</td>';
												echo '<td>'. $medidasControlDetalle[$mc]['tra_nombres'] .' '. $medidasControlDetalle[$mc]['tra_apellidos'] .'</td>';
												echo '<td>'.$responder.'</td>';
												echo '</tr>';
												echo '</tbody>';
												echo '</table>';
												echo '</div>';
												echo '</div>';
												echo '</li>';
											}
											echo '</ol> ';
											echo '</li> ';
										}else{
											echo '<div class="dd-nodrag">'.$causasInmediatasDetalle[$ci]['cl_descripcion'] .'</div>';						
										}
										echo '</li> ';																			
									}
									echo '</ol>';
								}else{
									echo '<div class="dd-nodrag">'.$causasBasicasDetalle[$cb]['cl_descripcion'].'</div> ';					
								}
								echo '</li>';
								
								
							}
						}*/
			?>
			<!--<li class="dd-item" data-id="1"> 
				<div class="dd-handle">Item 1</div> 
			</li>
			<li class="dd-item" data-id="2">
				<button data-action="collapse" type="button" style="display: block;">Collapse</button>
				<button data-action="expand" type="button" style="display: none;">Expand</button> 
				<div class="dd-handle">Item 2</div> 
				<ol class="dd-list" style=""> 
					<li class="dd-item" data-id="3">
						<div class="dd-handle">Item 3</div>
					</li> 
					<li class="dd-item" data-id="4">
						<div class="dd-handle">Item 4</div>
					</li> 
					<li class="dd-item dd-collapsed" data-id="5">
						<button data-action="collapse" type="button" style="display: none;">Collapse</button>
						<button data-action="expand" type="button" style="display: block;">Expand</button> 
						<div class="dd-handle">Item 5</div> 
						<ol class="dd-list" style="display: none;"> 
							<li class="dd-item" data-id="6">
								<div class="dd-handle">Item 6</div>									
							</li> 
							<li class="dd-item" data-id="7">
								<div class="dd-handle">Item 7</div>
							</li> 
							<li class="dd-item" data-id="8">
								<div class="dd-handle">Item 8</div>
							</li> 
						</ol> 
					</li> 
					<li class="dd-item" data-id="9">
						<div class="dd-handle">Item 9</div>
					</li> 
				</ol> 
			</li>  -->
		</ol> 
	</div> 
</div>

<script type="text/javascript">
  	  $('.dd').nestable({ /* config options */ });
  	$(document).ready(function() {
		$(".file-tree").filetree();
		$(".showModal").on("click", function() {
			if ($(this).attr("data-url").match(/\.(gif|jpeg|jpg|png|PNG)/)){
				$('.modal-body').html('');
				var img = '<img src="'+$(this).attr("data-url")+'" id="imagepreview" style="width: 400px; height: 264px; display:block; margin:auto;" >';
				$('.modal-body').append(img);
				//$('#imagepreview').attr('src', $(this).attr("data-url")); // here asign the image to the modal when the user click the enlarge link
		   		
		   		$('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
			}else{
				$('.modal-body').html('');
				// console.log("http://innoapsion.cl/sedecc/images/accidentes/"+$(this).attr("data-url"));
				//var iframe="<iframe src='https://view.officeapps.live.com/op/embed.aspx?src=http://innoapsion.cl/sedecc/images/accidentes/"+$(this).attr("data-url")+"' width='100%' height='100%' frameborder='0'>This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Online</a>.</iframe>";
				var iframe ='<iframe src="https://docs.google.com/gview?url=http://innoapsion.cl/sedecc/images/accidentes/'+$(this).attr("data-url")+'&embedded=true" width="100%" height="100%"></iframe>';
				$('.modal-body').append(iframe);
				$('#imagemodal').modal('show');
			}
		   
		});
	});
</script>
