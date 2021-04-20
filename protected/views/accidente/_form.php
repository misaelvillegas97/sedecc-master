

<link rel="stylesheet" href="css/bootstrap-select/bootstrap-select.min.css">
<link rel="stylesheet" href="css/bootstrap-drilldown-select.css">
<link rel="stylesheet" href="css/multilevel-select/transition.min.css">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<section class="panel panel-default">
	<!--header class="panel-heading font-bold">Horizontal form</header-->
	<div class="panel-body">
		<div class="bs-example form-horizontal">
						<?php
			/* @var $this AccidenteController */
			/* @var $model Accidente */
			/* @var $form CActiveForm */
			?>
			<style>
			.swal2-popup {
  font-size: 1.6rem !important;
}
		</style>
			
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'accidente-form',
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// There is a call to performAjaxValidation() commented in generated controller code.
				// See class documentation of CActiveForm for details on this.
				'enableAjaxValidation'=>false,
				'htmlOptions' => array('enctype' => 'multipart/form-data'),
			)); ?>
		
			<p class="note">Los campos que contienen <span class="required">*</span> son obligatorios.</p>
			
			<!--?php echo $form->errorSummary($model); ?-->
			<div class="col-md-5">
			
				<div class="form-group">
			<div class="col-lg-4 control-label">
						<!-- <?php echo $form->labelEx($model,'eess_rut'); ?> -->
						<label for="Accidente_eess_rut">Nombre EESS</label>
					</div>
			<div class="col-lg-8">				
				<?php 
					if(Yii::app()->controller->usertype() == 1){
						$model->eess_rut=Yii::app()->user->id;
					}else if(Yii::app()->controller->usertype() == 3){
						$model->eess_rut=Yii::app()->db->createCommand("SELECT eess_rut FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
					}	
					$eess= Yii::app()->db->createCommand("SELECT eess_nombre_corto FROM min_eess WHERE eess_rut = '".$model->eess_rut."'")->queryScalar();									
				?>
				<?php echo $form->textField($model,'eess_rut2',array('size'=>60,'maxlength'=>255, 'class'=>'form-control ','value' => $eess,'readonly' => 'readonly')); ?>
				<?php echo $form->textField($model,'eess_rut',array('size'=>60,'maxlength'=>255, 'class'=>'form-control hidden','value' => $model->eess_rut,'readonly' => 'readonly')); ?>
				<?php echo $form->error($model,'eess_rut'); ?>
			</div>
			</div>
			
				<div class="form-group">
					<div class="col-lg-4 control-label">
				    	<!-- <?php echo $form->labelEx($model,'rut_trabajador'); ?> -->
						<label for="Accidente_rut_trabajador">Trabajador *</label>
				    </div>
				    <div class="col-lg-8">
				    	<?php 
				    		echo $form->dropDownList($model,'rut_trabajador',CHtml::listData(Trabajador::model()->findAll(array("condition"=>"eess_rut =".$model->eess_rut)), 'tra_rut', 'fullName'),array('prompt'=>'Seleccione Uno ','class'=>'form-control bord'))
						;?>
						<?php echo $form->error($model,'rut_trabajador'); ?>

				    </div>
				</div>
				<div class="form-group">
					<div class="col-lg-4 control-label">
				    	<?php echo $form->labelEx($model,'tra_cargo'); ?>
				    </div>
				    <div class="col-lg-8">
				    	<select class="form-control" name="Accidente[tra_cargo]" id="Accidente_tra_cargo">
							<?php
								if(Yii::app()->controller->usertype() == 1){
									$rows = Yii::app()->db->createCommand("SELECT DISTINCT c.car_descripcion FROM min_trabajador as t JOIN min_cargo as c ON(t.car_id = c.car_id) WHERE t.eess_rut = '".Yii::app()->user->id."'")->query()->readAll();
								}
								else if(Yii::app()->controller->usertype() == 3){
									$eess = Yii::app()->db->createCommand("SELECT eess_rut FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
									$rows = Yii::app()->db->createCommand("SELECT DISTINCT c.car_descripcion FROM min_trabajador as t JOIN min_cargo as c ON(t.car_id = c.car_id) WHERE t.eess_rut = '".$eess."'")->query()->readAll();
								}

								$selected='';
								if(!isset($model->id_accidente)){
									$selected = 'selected';
								}	
								
								
								echo '<option value="0" '.$selected.'>Seleccionar</option>';
								//var_dump($model->tra_cargo);
								for($i=0;$i<count($rows);$i++){
									if($model->tra_cargo == $rows[$i]['car_descripcion']){
										$selected ='selected';
									}else{
										$selected='';
									}

									echo '<option '.$selected.' value="'.$rows[$i]['car_descripcion'].'">'.$rows[$i]['car_descripcion'].'</option>';
								}
							?>
						</select>
				    
				    </div>
				</div>
				<div class="form-group">
					<div class="col-lg-4 control-label">
				    	<?php echo $form->labelEx($model,'tra_depto'); ?>
				    </div>
				    <div class="col-lg-8">
				    	<?php echo $form->textField($model,'tra_depto',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
				    	<?php echo $form->error($model,'tra_depto'); ?>
				    </div>
				</div>
			</div>
			<div class="col-md-6 marge">
				<div class="form-group">
					<div class="col-lg-4 control-label">
				    	<?php echo $form->labelEx($model,'acc_tipo_accidnte'); ?>
				    </div>
				    <div class="col-lg-8">
				    	<select class="form-control" name="Accidente[acc_tipo_accidnte]" id="Accidente_acc_tipo_accidnte">
							<?php
								if(Yii::app()->controller->usertype() == 1){
									$rows = Yii::app()->db->createCommand("SELECT * FROM min_modulo_variable mv
																			join min_modulo_variable_detalle mvd on mvd.mv_id= mv.mv_id
																			join min_variable_evaluacion ve on ve.var_id= mvd.var_id
																			WHERE 
																			mv.mv_descripcion='Accidentes'
																			and mv.eess_rut = '".Yii::app()->user->id."'")->query()->readAll();
								}
								else if(Yii::app()->controller->usertype() == 3){
									$eess = Yii::app()->db->createCommand("SELECT eess_rut FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
									$rows = Yii::app()->db->createCommand("SELECT * FROM min_modulo_variable mv
																			join min_modulo_variable_detalle mvd on mvd.mv_id= mv.mv_id
																			join min_variable_evaluacion ve on ve.var_id= mvd.var_id
																			WHERE 
																			mv.mv_descripcion='Accidentes'
																			and mv.eess_rut = '".$eess."'")->query()->readAll();
								}	
								
								$selected='';
								if(!isset($model->id_accidente)){
									$selected = 'selected';
								}	
								
								echo '<option value="0" '.$selected.'>Seleccionar</option>';
								for($i=0;$i<count($rows);$i++){
									if($model->acc_tipo_accidnte == $rows[$i]['var_nombre']){
										$selected ='selected';
									}else{
										$selected='';
									}
										
									
									

									echo '<option '.$selected.' value="'.$rows[$i]['var_nombre'].'">'.$rows[$i]['var_nombre'].'</option>';
								}
							?>
						</select>
				    	<?php  //echo $form->dropDownList($model,'acc_tipo_accidnte',array('CTP'=>'CTP','STP'=>'STP','Daño Material'=>'Daño Material','Incidente'=>'Incidente'), array('options' => array('0'=>array('selected'=>true)),'placeholder'=>'0=CTP - 1=STP', 'class' =>'form-control')); ?>
				    	<?php //echo $form->error($model,'acc_tipo_accidnte'); ?>
				    </div>
				</div>
				<div class="form-group">
					<div class="col-lg-4 control-label">
				    	<?php echo $form->labelEx($model,'fecha_accidente'); ?>
				    </div>
				    <div class="col-lg-8">
				    	<?php echo $form->dateField($model,'fecha_accidente',array('class'=>'form-control')); ?>
				    	<?php echo $form->error($model,'fecha_accidente'); ?>
				    </div>
				</div>
				<?php
					$display = 'none';
					$diasPerdidos = 0;
					if($model->acc_tipo_accidnte == 'Accidentes CTP'){
						$display = 'block';
						$now = date("Y-m-d "); // or your date as well
						
						
						if(isset($model->fecha_alta)){
							$diasPerdidos =  date_diff( date_create($model->fecha_accidente),date_create($model->fecha_alta) );
						}else{
							$diasPerdidos =  date_diff( date_create($model->fecha_accidente),date_create($now) );
						}
						
						//$diasPerdidos = round($datediff / (60 * 60 * 24));
						
						//var_dump($diasPerdidos);
					
				?>
				<div class="form-group" id="divDiasPerdidos" style="display:<?php echo $display; ?>;">
					<div class="col-lg-4 control-label">
				    	Días Perdidos
				    </div>
				    <div class="col-lg-8">
				    	<input type="text" name="" value="<?php echo $diasPerdidos->d + 1; ?>" id=""/ disabled>
						
				    </div>
				</div>
				<?php 
					}
				?>
				<div class="form-group" id="divFechaAlta" style="display:<?php echo $display; ?>;">
					<div class="col-lg-4 control-label">
				    	<?php echo $form->labelEx($model,'fecha_alta'); ?>
				    </div>
				    <div class="col-lg-8">
				    	<?php echo $form->dateField($model,'fecha_alta',array('class'=>'form-control')); ?>
				    	<?php echo $form->error($model,'fecha_alta'); ?>
				    </div>
				</div>
				<?php
					$display = 'none';
					if($model->acc_tipo_accidnte == 'Accidentes Daño Material'){
						$display = 'block';
					}
				?>
				<div class="form-group" id="divCostoPerdida" style="display:<?php echo $display; ?>;">
					<div class="col-lg-4 control-label">
				    	<?php echo $form->labelEx($model,'acc_costo_perdida'); ?>
				    </div>
				    <div class="col-lg-8">
				    	<?php echo $form->textField($model,'acc_costo_perdida',array('class'=>'form-control soloNumeros')); ?>
				    	<?php echo $form->error($model,'acc_costo_perdida'); ?>
				    </div>
				</div>
				<div class="form-group">
					<div class="col-lg-4 control-label">
				    	<?php echo $form->labelEx($model,'Descripcion'); ?>
				    </div>
				    <div class="col-lg-8">
				    	<?php echo $form->textField($model,'Descripcion',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
				    	<?php echo $form->error($model,'Descripcion'); ?>
				    </div>
				</div>
				<div class="form-group">
					<div class="col-lg-4 control-label">
				    	<label  >Archivos</label>
				    </div>
				    <div class="col-lg-8" id="divFile">
				    	<div class="input-group col-lg-9" >
				    		<input id="my-file-selector" name="photos[]" type="file">
				    		<span class="input-group-btn">
								<button class="btn  btn-default addFile" type="button"> 
					    			<i class="fa fa-plus text"></i> 
					    		</button>
							</span>
						</div>												
				    	<!--<input type="file" name="photos[]" multiple="multiple">-->
				    </div>
				</div>
			</div>

<div class="form-group">
				<div class="col-lg-offset-2 col-lg-10">
					<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', array('class'=>'btn btn-sm btn-default')); ?>
				</div>
			</div>
			
			<!--ejemplo de select multilevel
				<div class="multilevel-dropdown-container" data-multilevel-dropdown data-dropdown-name="values" data-dropdown-value="val2" data-dropdown-placeholder="Seleccione un valor" data-parent="test">
			    <ul class="multilevel-dropdown">
			        <li data-value="val1">Val1</li>
			
			        <ul data-label="Group1">
			            <li data-value="val2">Val2</li>
			            <li data-value="val3">Val3</li>
			        </ul>
			
			        <li data-value="val4">Val4</li>
			
			        <ul data-label="Group2">
			            <li data-value="val5">Val5</li>
			
			            <ul data-label="Group3">
			                <li data-value="val6">Value with a very long name :o</li>
			                <li data-value="val7">Val7</li>
			            </ul>
			        </ul>
			
			        <li data-value="val8">Val8</li>
			    </ul>
			</div>-->
		
			
			
		<div class="col-lg-12 col-xs-12 " style="min-height:300px!important;height:auto;overflow-x: scroll;">
			<table id="tablee" class="table table-condensed">
				<thead>
					<tr>
						<th>Causa Básica</th>
						<th>Causa Inmediata</th>
						<th>Medida Control</th>
						<th>Responsable</th>
						<th>Plazo</th>
						<th>Semáforo</th>					
						<th></th>
					</tr>		
				</thead>
				<tbody>
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
						$rows = Yii::app()->db->createCommand("SELECT tra_rut as rut,tra_nombres as nombres,tra_apellidos as apellidos FROM min_trabajador WHERE 1".$where." ")->query()->readAll();
						$causasBasicas = Yii::app()->db->createCommand("SELECT cl_categoria as categoria,cl_sub_categoria as subcategoria,cl_id as id,cl_descripcion as descripcion FROM min_causas_list WHERE cl_tipo='basica' order by cl_categoria")->query()->readAll();
						$causasInmediatas = Yii::app()->db->createCommand("SELECT cl_categoria as categoria,cl_sub_categoria as subcategoria,cl_id as id,cl_descripcion as descripcion FROM min_causas_list WHERE cl_tipo='inmediata' order by cl_categoria")->query()->readAll();
						$medidasControl = Yii::app()->db->createCommand("SELECT mcl_categoria as categoria,mcl_id as id,mcl_descripcion as descripcion FROM min_medidas_control_list  order by mcl_categoria")->query()->readAll();
						if(isset($model->id_accidente)){
							$causasBasicasDetalle = Yii::app()->db->createCommand("SELECT * FROM min_causas_basicas WHERE acc_id=".$model->id_accidente." ORDER BY cb_id ASC")->query()->readAll();
							if(count($causasBasicasDetalle)>0){
								$cuentaCb=0;
								for($cb=0;$cb<count($causasBasicasDetalle);$cb++){
									echo '<tr class="row_1">';
									echo '<td>';
									echo '<div class="input-group" >';
									echo '<div class="multilevel-dropdown-container" data-multilevel-dropdown data-dropdown-name="values" data-dropdown-value="'.$causasBasicasDetalle[$cb]['cbl_id'].'" data-orden="'.$cuentaCb.'" style="background-color:#217FBD !important !important;" >';
									echo '<ul class="multilevel-dropdown">';
									
								
									$categoria='';
									$subCategoria='';
									$selected='';
									
									for($i=0;$i<count($causasBasicas);$i++){
										
										if($categoria !== $causasBasicas[$i]['categoria']){
											if($i !== 0){
												if($causasBasicas[$i]['subcategoria'] !== ''){
													echo '</ul>';
												}
												echo '</ul>';
											}
											
											
											echo '<ul data-label="'.$causasBasicas[$i]['categoria'].'">';
											if($causasBasicas[$i]['subcategoria'] == ''){
												echo '<li data-value="'.$causasBasicas[$i]['id'].'">'.$causasBasicas[$i]['descripcion'].'</li>';
											}else{
												echo '<ul data-label="'.$causasBasicas[$i]['subcategoria'].'">';
												echo '<li data-value="'.$causasBasicas[$i]['id'].'">'.$causasBasicas[$i]['descripcion'].'</li>';
											}
											
											
										}else{
											
											
											if($categoria !== $causasBasicas[$i]['categoria']){
												if($i !== 0){
													echo '</ul>';
												}
												if($cuentaCb !== 0){
													echo '</ul>';
												}
												
												if($causasBasicas[$i]['subcategoria'] == ''){
													echo '<li data-value="'.$causasBasicas[$i]['id'].'">'.$causasBasicas[$i]['descripcion'].'</li>';
												}else{
													echo '<ul data-label="'.$causasBasicas[$i]['subcategoria'].'">';
													echo '<li data-value="'.$causasBasicas[$i]['id'].'">'.$causasBasicas[$i]['descripcion'].'</li>';
												}
												
												$cuentaCb++;
											}else{
												echo '<li class="'.$selected.'" data-value="'.$causasBasicas[$i]['id'].'">'.$causasBasicas[$i]['descripcion'].'</li>';
											}
											
										}
										
										
										$categoria=$causasBasicas[$i]['categoria'];
										$subCategoria=$causasBasicas[$i]['subcategoria'];
									}
									echo '</ul>';									
									echo '</div>';

								
								
									echo '<select class="hidden form-control selectpicker ddlCausaBasica"  id="ddlCausaBasica" name="causaBasica['.$cuentaCb.']" title="Causa Básica"  data-orden="'.$cuentaCb.'" style="display:none;">';
									 $categoria='';
									$selected='';
									echo '<option selected value="'.$causasBasicasDetalle[$cb]['cbl_id'].'" ></option>';
									/*for($i=0;$i<count($causasBasicas);$i++){
										if($causasBasicasDetalle[$cb]['cbl_id'] == $causasBasicas[$i]['id']){
											$selected='selected';
										}else{
											$selected='';
										}
										if($categoria !== $causasBasicas[$i]['categoria']){
											if($i !== 0){
												echo '</optgroup>';
											}
											echo '<optgroup label="'.$causasBasicas[$i]['categoria'].'">';
										}
										echo '<option '.$selected.' value="'.$causasBasicas[$i]['id'].'" data-tokens="'.$causasBasicas[$i]['categoria'].' '.$causasBasicas[$i]['descripcion'].'">'.$causasBasicas[$i]['descripcion'].'</option>';
										$categoria=$causasBasicas[$i]['categoria'];
									}*/
									echo '</select>';
									echo '<span class="input-group-btn"> <button class="btn btn-default cBasica" type="button" data-orden="'.$cuentaCb.'" >+</button> </span>';
									echo '</td>';
									
									$causasInmediatasDetalle = Yii::app()->db->createCommand("SELECT * FROM min_causas_inmediatas WHERE cb_id=".$causasBasicasDetalle[$cb]['cb_id'] ." ")->query()->readAll();
									$cuentaCi=0;
									for($ci=0;$ci<count($causasInmediatasDetalle);$ci++){
										if($ci > 0){
											echo '</tr>';
											echo '<tr>';
											echo '<td>';
											echo '</td>';
										}
										
										echo '<td>';
										echo '<div class="input-group">';
										
										echo '<div class="multilevel-dropdown-container" data-multilevel-dropdown data-dropdown-name="values" data-dropdown-value="'.$causasInmediatasDetalle[$ci]['cil_id'].'" data-orden="'.$cuentaCb.'">';
										echo '<ul class="multilevel-dropdown">';
										
									
										$categoria='';
										$subCategoria='';
										$selected='';
										
										for($i=0;$i<count($causasInmediatas);$i++){
											
											if($categoria !== $causasInmediatas[$i]['categoria']){
												if($i !== 0){
													
													echo '</ul>';
													if($causasInmediatas[$i]['subcategoria'] !== ''){
														echo '</ul>';
													}
													
												}
												echo '<ul data-label="'.$causasInmediatas[$i]['categoria'].'">';
												if($causasInmediatas[$i]['subcategoria'] == ''){
													echo '<li data-value="'.$causasInmediatas[$i]['id'].'">'.$causasInmediatas[$i]['descripcion'].'</li>';
												}else{
													echo '<ul data-label="'.$causasInmediatas[$i]['subcategoria'].'">';
													echo '<li data-value="'.$causasInmediatas[$i]['id'].'">'.$causasInmediatas[$i]['descripcion'].'</li>';
												}
												
												
											}else{
												
												
												if($categoria !== $causasInmediatas[$i]['categoria']){
													if($i !== 0){
														echo '</ul>';
													}
													if($cuentaCb !== 0){
														echo '</ul>';
													}
													if($causasInmediatas[$i]['subcategoria'] == ''){
														echo '<li class="'.$selected.'" data-value="'.$causasInmediatas[$i]['id'].'">'.$causasInmediatas[$i]['descripcion'].'</li>';
													}else{
														echo '<ul data-label="'.$causasInmediatas[$i]['subcategoria'].'">';
														echo '<li class="'.$selected.'" data-value="'.$causasInmediatas[$i]['id'].'">'.$causasInmediatas[$i]['descripcion'].'</li>';
													}
													
													$cuentaCb++;
												}else{
													echo '<li class="'.$selected.'" data-value="'.$causasInmediatas[$i]['id'].'">'.$causasInmediatas[$i]['descripcion'].'</li>';
												}
												
											}
											
											
											$categoria=$causasInmediatas[$i]['categoria'];
											$subCategoria=$causasInmediatas[$i]['subcategoria'];
										}
										echo '</ul>';									
										echo '</div>';
										
										
										echo '<select class="hidden form-control selectpicker ddlCausaInmediata" data-live-search="true" id="ddlCausaInmediata" name="causaInmediata['.$cuentaCb.'_'.$cuentaCi.']" title="Causa Inmediata"  data-orden="'.$cuentaCb.'_'.$cuentaCi.'" data-parent="'.$cuentaCb.'">';
										echo '<option selected value="'.$causasInmediatasDetalle[$ci]['cil_id'].'" ></option>';
										/*$categoria='';
										for($i=0;$i<count($causasInmediatas);$i++){
											if($causasInmediatasDetalle[$ci]['cil_id'] == $causasInmediatas[$i]['id']){
												$selected='selected';
											}else{
												$selected='';
											}
											if($categoria !== $causasInmediatas[$i]['categoria']){
												if($i !== 0){
													echo '</optgroup>';
												}
												echo '<optgroup label="'.$causasInmediatas[$i]['categoria'].'">';
											}
											echo '<option '.$selected.' value="'.$causasInmediatas[$i]['id'].'" data-tokens="'.$causasInmediatas[$i]['categoria'].' '.$causasInmediatas[$i]['descripcion'].'">'.$causasInmediatas[$i]['descripcion'].'</option>';
											$categoria=$causasInmediatas[$i]['categoria'];
										}*/
										echo '</select>';
										echo '<span class="input-group-btn"> <button class="btn btn-default cInmediata" type="button" data-orden="'.$cuentaCb.'_'.$cuentaCi.'" data-parent="'.$cuentaCb.'" >+</button> </span>';
										echo '</div>';
										echo '</td>';
										
										$medidasControlDetalle = Yii::app()->db->createCommand("SELECT * FROM min_medidas_control WHERE ci_id=".$causasInmediatasDetalle[$ci]['ci_id'] ." ")->query()->readAll();
										$cuentaMc=0;
										for($mc=0;$mc<count($medidasControlDetalle);$mc++){
											if($mc>0){
												echo '</tr>';
												echo '<tr>';
												echo '<td></td>';
												echo '<td></td>';
											}
											echo '<td>';
											echo '<div class="input-group">';																						
											
											echo '<select class="form-control selectpicker ddlMedidaControl" data-live-search="true" id="ddlMedidaControl" name="medidaControl['.$cuentaCb.'_'.$cuentaCi.'_'.$cuentaMc.']" title="Medida Control"  data-orden="'.$cuentaCb.'_'.$cuentaCi.'_'.$cuentaMc.'" data-parent="'.$cuentaCb.'_'.$cuentaCi.'">';
											$categoria='';
											$seguimiento='';
											for($i=0;$i<count($medidasControl);$i++){
												
												switch($medidasControlDetalle[$mc]['mc_semaforo']){
													case 0:
														$seguimiento='<img  src="images/semaforo_rojo.png" style="width:50px;">';
														break;
													case 1:
														$seguimiento='<img  src="images/semaforo_amarillo.png" style="width:50px;">';
														break;
													case 2:
														$seguimiento='<img  src="images/semaforo_verde.png" style="width:50px;">';
														break;
												}
												
												if($medidasControlDetalle[$mc]['mcl_id'] == $medidasControl[$i]['id']){
													$selected='selected';
												}else{
													$selected='';
												}
												if($categoria !== $medidasControl[$i]['categoria']){
													if($i !== 0){
														echo '</optgroup>';
													}
													echo '<optgroup label="'.$medidasControl[$i]['categoria'].'">';
												}
												echo '<option '.$selected.' value="'.$medidasControl[$i]['id'].'" data-tokens="'.$medidasControl[$i]['categoria'].' '.$medidasControl[$i]['descripcion'].'">'.$medidasControl[$i]['descripcion'].'</option>';
												$categoria=$medidasControl[$i]['categoria'];
											}
											echo '</select>';
											echo '<span class="input-group-btn"> <button class="btn btn-default mControl" type="button" data-orden="'.$cuentaCb.'_'.$cuentaCi.'_'.$cuentaMc.'" data-parent="'.$cuentaCb.'_'.$cuentaCi.'">+</button> </span>';
											echo '</div>';
											echo '</td>';
											echo '<td>';
											echo '<select class="form-control selectpicker ddlResponsable" data-live-search="true" id="ddlResponsable" name="responsable['.$cuentaCb.'_'.$cuentaCi.'_'.$cuentaMc.']" title="Responsable"  data-orden="'.$cuentaCb.'_'.$cuentaCi.'_'.$cuentaMc.'" data-parent="'.$cuentaCb.'_'.$cuentaCi.'">';
												for($i=0;$i<count($rows);$i++){										
													if($medidasControlDetalle[$mc]['tra_responsable'] == $rows[$i]['rut']){
														$selected='selected';
													}else{
														$selected='';
													}	
													echo '<option '.$selected.' value="'.$rows[$i]['rut'].'">'.$rows[$i]['nombres'].' '.$rows[$i]['apellidos'].'</option>';
												}
											echo '</select>';										
											echo '</td>';
											echo '<td>';
											echo '<input name="plazo['.$cuentaCb.'_'.$cuentaCi.'_'.$cuentaMc.']" required class="form-control txtPlazo" type="date" placeholder="Plazo" data-orden="'.$cuentaCb.'_'.$cuentaCi.'_'.$cuentaMc.'" data-parent="'.$cuentaCb.'_'.$cuentaCi.'" value="'.$medidasControlDetalle[$mc]['mc_plazo'].'">';							
											echo '</td>';
											echo '<td>';
											echo $seguimiento;
											echo '</td>';
											echo '<td>';
											echo '<a class="btn btn-xs btn-danger btnEliminar" >x</a>';	
											echo '</td>';
											$cuentaMc++;
										}
										
										$cuentaCi++;
									}
									$cuentaCb++;
									echo '</tr>';
								}
								
								
								echo '</tbody>';
							}else{
								?>
								<tr class="row_1">
									<td>
										<!--<div class="input-group"> <input name="causaBasica[0]" type="text" class="form-control" placeholder="Causa Básica"> <span class="input-group-btn"> <button class="btn btn-success cBasica" type="button" >+</button> </span> </div>-->
										<div class="input-group">
											<?php 
												echo '<div class="multilevel-dropdown-container" data-multilevel-dropdown data-dropdown-name="values" data-dropdown-value="'.$causasBasicasDetalle[$cb]['cbl_id'].'" data-orden="0">';
												echo '<ul class="multilevel-dropdown">';
												
											
												$categoria='';
												$subCategoria='';
												$selected='';

												for($i=0;$i<count($causasBasicas);$i++){
													
													if($categoria !== $causasBasicas[$i]['categoria']){
														if($i !== 0){
															if($causasBasicas[$i]['subcategoria'] !== ''){
																echo '</ul>';
															}
															echo '</ul>';
														}
														
														
														echo '<ul data-label="'.$causasBasicas[$i]['categoria'].'">';
														if($causasBasicas[$i]['subcategoria'] == ''){
															echo '<li data-value="'.$causasBasicas[$i]['id'].'">'.$causasBasicas[$i]['descripcion'].'</li>';
														}else{
															echo '<ul data-label="'.$causasBasicas[$i]['subcategoria'].'">';
															echo '<li data-value="'.$causasBasicas[$i]['id'].'">'.$causasBasicas[$i]['descripcion'].'</li>';
														}
														
														
													}else{
														
														
														if($categoria !== $causasBasicas[$i]['categoria']){
															if($i !== 0){
																echo '</ul>';
															}
															if($cuentaCb !== 0){
																echo '</ul>';
															}
															
															if($causasBasicas[$i]['subcategoria'] == ''){
																echo '<li data-value="'.$causasBasicas[$i]['id'].'">'.$causasBasicas[$i]['descripcion'].'</li>';
															}else{
																echo '<ul data-label="'.$causasBasicas[$i]['subcategoria'].'">';
																echo '<li data-value="'.$causasBasicas[$i]['id'].'">'.$causasBasicas[$i]['descripcion'].'</li>';
															}
															
															$cuentaCb++;
														}else{
															echo '<li class="'.$selected.'" data-value="'.$causasBasicas[$i]['id'].'">'.$causasBasicas[$i]['descripcion'].'</li>';
														}
														
													}
													
													
													$categoria=$causasBasicas[$i]['categoria'];
													$subCategoria=$causasBasicas[$i]['subcategoria'];
													$cuentaCb++;
												}
												echo '</ul>';									
												echo '</div>';
											?>
											<select class="hidden form-control selectpicker ddlCausaBasica" data-live-search="true" id="ddlCausaBasica" name="causaBasica[0]" title="Causa Básica"  data-orden="0">
												<?php 
													
													
													$categoria='';
													for($i=0;$i<count($causasBasicas);$i++){
														if($categoria !== $causasBasicas[$i]['categoria']){
															if($i !== 0){
																echo '</optgroup>';
															}
															echo '<optgroup label="'.$causasBasicas[$i]['categoria'].'">';
														}
														echo '<option value="'.$causasBasicas[$i]['id'].'" data-tokens="'.$causasBasicas[$i]['categoria'].' '.$causasBasicas[$i]['descripcion'].'">'.$causasBasicas[$i]['descripcion'].'</option>';
														$categoria=$causasBasicas[$i]['categoria'];
													}
												?>
											</select>
											<span class="input-group-btn"> <button class="btn btn-default cBasica" type="button" data-orden="0">+</button> </span>
											</div>
									</td>
									<td>
										<!--<div class="input-group"> <input name="causaInmediata[0]" required class="form-control" type="text" placeholder="Causa Inmediata"> <span class="input-group-btn"> <button class="btn btn-success cInmediata" type="button">+</button> </span> </div>-->					
										<div class="input-group">
											<?php
												echo '<div class="multilevel-dropdown-container" data-multilevel-dropdown data-dropdown-name="values"  data-orden="0_0">';
												echo '<ul class="multilevel-dropdown">';
												
											
												$categoria='';
												$subCategoria='';
												$selected='';
												
												for($i=0;$i<count($causasInmediatas);$i++){
													
													if($categoria !== $causasInmediatas[$i]['categoria']){
														if($i !== 0){
															
															echo '</ul>';
															if($causasInmediatas[$i]['subcategoria'] !== ''){
																echo '</ul>';
															}
															
														}
														echo '<ul data-label="'.$causasInmediatas[$i]['categoria'].'">';
														if($causasInmediatas[$i]['subcategoria'] == ''){
															echo '<li data-value="'.$causasInmediatas[$i]['id'].'">'.$causasInmediatas[$i]['descripcion'].'</li>';
														}else{
															echo '<ul data-label="'.$causasInmediatas[$i]['subcategoria'].'">';
															echo '<li data-value="'.$causasInmediatas[$i]['id'].'">'.$causasInmediatas[$i]['descripcion'].'</li>';
														}
														
														
													}else{
														
														
														if($categoria !== $causasInmediatas[$i]['categoria']){
															if($i !== 0){
																echo '</ul>';
															}
															if($cuentaCb !== 0){
																echo '</ul>';
															}
															if($causasInmediatas[$i]['subcategoria'] == ''){
																echo '<li class="'.$selected.'" data-value="'.$causasInmediatas[$i]['id'].'">'.$causasInmediatas[$i]['descripcion'].'</li>';
															}else{
																echo '<ul data-label="'.$causasInmediatas[$i]['subcategoria'].'">';
																echo '<li class="'.$selected.'" data-value="'.$causasInmediatas[$i]['id'].'">'.$causasInmediatas[$i]['descripcion'].'</li>';
															}
															
															$cuentaCb++;
														}else{
															echo '<li class="'.$selected.'" data-value="'.$causasInmediatas[$i]['id'].'">'.$causasInmediatas[$i]['descripcion'].'</li>';
														}
														
													}
													
													
													$categoria=$causasInmediatas[$i]['categoria'];
													$subCategoria=$causasInmediatas[$i]['subcategoria'];
												}
												echo '</ul>';									
												echo '</div>';
											?>
											<select class="form-control selectpicker ddlCausaInmediata" data-live-search="true" id="ddlCausaInmediata" name="causaInmediata[0_0]" title="Causa Inmediata"  data-orden="0_0" data-parent="0">
												<?php 
													
													$categoria='';
													for($i=0;$i<count($causasInmediatas);$i++){
														if($categoria !== $causasInmediatas[$i]['categoria']){
															if($i !== 0){
																echo '</optgroup>';
															}
															echo '<optgroup label="'.$causasInmediatas[$i]['categoria'].'">';
														}
														echo '<option value="'.$causasInmediatas[$i]['id'].'" data-tokens="'.$causasInmediatas[$i]['categoria'].' '.$causasInmediatas[$i]['descripcion'].'">'.$causasInmediatas[$i]['descripcion'].'</option>';
														$categoria=$causasInmediatas[$i]['categoria'];
													}
												?>
											</select>
											<span class="input-group-btn"> <button class="btn btn-default cInmediata" type="button" data-orden="0_0" data-parent="0">+</button> </span>
											</div>
									</td>
									<td>
										<!--<div class="input-group"> <input name="medidaControl[0]" required class="form-control" type="text" placeholder="Medida Control"> <span class="input-group-btn"> <button class="btn btn-success mControl" type="button">+</button> </span> </div>	-->			
										<div class="input-group">
											<select class="form-control selectpicker ddlMedidaControl" data-live-search="true" id="ddlMedidaControl" name="medidaControl[0_0_0]" title="Medida Control"  data-orden="0_0_0" data-parent="0_0">
												<?php 
													
													$categoria='';
													for($i=0;$i<count($medidasControl);$i++){
														if($categoria !== $medidasControl[$i]['categoria']){
															if($i !== 0){
																echo '</optgroup>';
															}
															echo '<optgroup label="'.$medidasControl[$i]['categoria'].'">';
														}
														echo '<option value="'.$medidasControl[$i]['id'].'" data-tokens="'.$medidasControl[$i]['categoria'].' '.$medidasControl[$i]['descripcion'].'">'.$medidasControl[$i]['descripcion'].'</option>';
														$categoria=$medidasControl[$i]['categoria'];
													}
												?>
											</select>
											<span class="input-group-btn"> <button class="btn btn-default mControl" type="button" data-orden="0_0_0" data-parent="0_0">+</button> </span>
											</div>
									</td>
									<td>
										<select class="form-control selectpicker ddlResponsable" data-live-search="true" id="ddlResponsable" name="responsable[0_0_0]" title="Responsable"  data-orden="0_0_0" data-parent="0_0">
											<?php 
												for($i=0;$i<count($rows);$i++){										
													
													echo '<option  value="'.$rows[$i]['rut'].'">'.$rows[$i]['nombres'].' '.$rows[$i]['apellidos'].'</option>';
												}
											?>
										</select>
										
									</td>
									<td>
										<input name="plazo[0_0_0]" required class="form-control txtPlazo" type="date" placeholder="Plazo" data-orden="0_0_0" data-parent="0_0">
										
									</td>
									<td>
										<img src="images/semaforo_rojo.png" name="txt_semaforo_0" class="txt_semaforo" style="width: 50px; ">
									</td>
									<td>
										<a class="btn btn-xs btn-danger btnEliminar" >x</a>
									</td>
								</tr>
							</tbody>
								<?php
							}
							
						}else{
						?>
							<tr class="row_1">
								<td>
									<!--<div class="input-group"> <input name="causaBasica[0]" type="text" class="form-control" placeholder="Causa Básica"> <span class="input-group-btn"> <button class="btn btn-success cBasica" type="button" >+</button> </span> </div>-->
									<div class="input-group">
										<?php 
												echo '<div class="multilevel-dropdown-container" data-multilevel-dropdown data-dropdown-name="values"  data-orden="0" data-dropdown-placeholder="Causas Básicas">';
												echo '<ul class="multilevel-dropdown">';
												
												$categoria='';
												$subCategoria='';
												$selected='';
												
												for($i=0;$i<count($causasBasicas);$i++){
													
													if($categoria !== $causasBasicas[$i]['categoria']){
														if($i !== 0){
															if($causasBasicas[$i]['subcategoria'] !== ''){
																echo '</ul>';
															}
															echo '</ul>';
														}
														
														
														echo '<ul data-label="'.$causasBasicas[$i]['categoria'].'">';
														if($causasBasicas[$i]['subcategoria'] == ''){
															echo '<li data-value="'.$causasBasicas[$i]['id'].'">'.$causasBasicas[$i]['descripcion'].'</li>';
														}else{
															echo '<ul data-label="'.$causasBasicas[$i]['subcategoria'].'">';
															echo '<li data-value="'.$causasBasicas[$i]['id'].'">'.$causasBasicas[$i]['descripcion'].'</li>';
														}
														
														
													}else{
														
														
														if($categoria !== $causasBasicas[$i]['categoria']){
															if($i !== 0){
																echo '</ul>';
															}
															if($cuentaCb !== 0){
																echo '</ul>';
															}
															
															if($causasBasicas[$i]['subcategoria'] == ''){
																echo '<li data-value="'.$causasBasicas[$i]['id'].'">'.$causasBasicas[$i]['descripcion'].'</li>';
															}else{
																echo '<ul data-label="'.$causasBasicas[$i]['subcategoria'].'">';
																echo '<li data-value="'.$causasBasicas[$i]['id'].'">'.$causasBasicas[$i]['descripcion'].'</li>';
															}
															
															$cuentaCb++;
														}else{
															echo '<li class="'.$selected.'" data-value="'.$causasBasicas[$i]['id'].'">'.$causasBasicas[$i]['descripcion'].'</li>';
														}
														
													}
													
													
													$categoria=$causasBasicas[$i]['categoria'];
													$subCategoria=$causasBasicas[$i]['subcategoria'];
												}
												echo '</ul>';									
												echo '</div>';
											?>
										<select class="hidden form-control selectpicker" data-live-search="true" id="ddlCausaBasica" name="causaBasica[0]" title="Causa Básica"  data-orden="0">
											<?php 
												
												$categoria='';
												for($i=0;$i<count($causasBasicas);$i++){
													if($categoria !== $causasBasicas[$i]['categoria']){
														if($i !== 0){
															echo '</optgroup>';
														}
														echo '<optgroup label="'.$causasBasicas[$i]['categoria'].'">';
													}
													echo '<option value="'.$causasBasicas[$i]['id'].'" data-tokens="'.$causasBasicas[$i]['categoria'].' '.$causasBasicas[$i]['descripcion'].'">'.$causasBasicas[$i]['descripcion'].'</option>';
													$categoria=$causasBasicas[$i]['categoria'];
												}
											?>
										</select>
										<span class="input-group-btn"> <button class="btn btn-default cBasica" type="button" data-orden="0">+</button> </span>
										</div>
								</td>
								<td>
									<!--<div class="input-group"> <input name="causaInmediata[0]" required class="form-control" type="text" placeholder="Causa Inmediata"> <span class="input-group-btn"> <button class="btn btn-success cInmediata" type="button">+</button> </span> </div>-->					
									<div class="input-group">
										<?php
											echo '<div class="multilevel-dropdown-container" data-multilevel-dropdown data-dropdown-name="values"  data-orden="0_0" data-dropdown-placeholder="Causas Inmediatas">';
											echo '<ul class="multilevel-dropdown">';
											
										
											$categoria='';
											$subCategoria='';
											$selected='';
											
											for($i=0;$i<count($causasInmediatas);$i++){
												
												if($categoria !== $causasInmediatas[$i]['categoria']){
													if($i !== 0){
														
														echo '</ul>';
														if($causasInmediatas[$i]['subcategoria'] !== ''){
															echo '</ul>';
														}
														
													}
													echo '<ul data-label="'.$causasInmediatas[$i]['categoria'].'">';
													if($causasInmediatas[$i]['subcategoria'] == ''){
														echo '<li data-value="'.$causasInmediatas[$i]['id'].'">'.$causasInmediatas[$i]['descripcion'].'</li>';
													}else{
														echo '<ul data-label="'.$causasInmediatas[$i]['subcategoria'].'">';
														echo '<li data-value="'.$causasInmediatas[$i]['id'].'">'.$causasInmediatas[$i]['descripcion'].'</li>';
													}
													
													
												}else{
													
													
													if($categoria !== $causasInmediatas[$i]['categoria']){
														if($i !== 0){
															echo '</ul>';
														}
														if($cuentaCb !== 0){
															echo '</ul>';
														}
														if($causasInmediatas[$i]['subcategoria'] == ''){
															echo '<li class="'.$selected.'" data-value="'.$causasInmediatas[$i]['id'].'">'.$causasInmediatas[$i]['descripcion'].'</li>';
														}else{
															echo '<ul data-label="'.$causasInmediatas[$i]['subcategoria'].'">';
															echo '<li class="'.$selected.'" data-value="'.$causasInmediatas[$i]['id'].'">'.$causasInmediatas[$i]['descripcion'].'</li>';
														}
														
														$cuentaCb++;
													}else{
														echo '<li class="'.$selected.'" data-value="'.$causasInmediatas[$i]['id'].'">'.$causasInmediatas[$i]['descripcion'].'</li>';
													}
													
												}
												
												
												$categoria=$causasInmediatas[$i]['categoria'];
												$subCategoria=$causasInmediatas[$i]['subcategoria'];
											}
											echo '</ul>';									
											echo '</div>';
										?>
										<select class="hidden form-control selectpicker" data-live-search="true" id="ddlCausaInmediata" name="causaInmediata[0_0]" title="Causa Inmediata"  data-orden="0_0" data-parent="0">
											<?php 
												
												$categoria='';
												for($i=0;$i<count($causasInmediatas);$i++){
													if($categoria !== $causasInmediatas[$i]['categoria']){
														if($i !== 0){
															echo '</optgroup>';
														}
														echo '<optgroup label="'.$causasInmediatas[$i]['categoria'].'">';
													}
													echo '<option value="'.$causasInmediatas[$i]['id'].'" data-tokens="'.$causasInmediatas[$i]['categoria'].' '.$causasInmediatas[$i]['descripcion'].'">'.$causasInmediatas[$i]['descripcion'].'</option>';
													$categoria=$causasInmediatas[$i]['categoria'];
												}
											?>
										</select>
										<span class="input-group-btn"> <button class="btn btn-default cInmediata" type="button" data-orden="0_0" data-parent="0">+</button> </span>
										</div>
								</td>
								<td>
									<!--<div class="input-group"> <input name="medidaControl[0]" required class="form-control" type="text" placeholder="Medida Control"> <span class="input-group-btn"> <button class="btn btn-success mControl" type="button">+</button> </span> </div>	-->			
									<div class="input-group">
										<select class="form-control selectpicker" data-live-search="true" id="ddlMedidaControl" name="medidaControl[0_0_0]" title="Medida Control"  data-orden="0_0_0" data-parent="0_0">
											<?php 
												
												$categoria='';
												for($i=0;$i<count($medidasControl);$i++){
													if($categoria !== $medidasControl[$i]['categoria']){
														if($i !== 0){
															echo '</optgroup>';
														}
														echo '<optgroup label="'.$medidasControl[$i]['categoria'].'">';
													}
													echo '<option value="'.$medidasControl[$i]['id'].'" data-tokens="'.$medidasControl[$i]['categoria'].' '.$medidasControl[$i]['descripcion'].'">'.$medidasControl[$i]['descripcion'].'</option>';
													$categoria=$medidasControl[$i]['categoria'];
												}
											?>
										</select>
										<span class="input-group-btn"> <button class="btn btn-default mControl" type="button" data-orden="0_0_0" data-parent="0_0">+</button> </span>
										</div>
								</td>
								<td>
									<select class="form-control selectpicker ddlResponsable" data-live-search="true" id="ddlResponsable" name="responsable[0_0_0]" title="Responsable" data-orden="0_0_0" data-parent="0_0">
										<?php 
											for($i=0;$i<count($rows);$i++){										
												
												echo '<option  value="'.$rows[$i]['rut'].'">'.$rows[$i]['nombres'].' '.$rows[$i]['apellidos'].'</option>';
											}
										?>
									</select>
									
								</td>
								<td>
									<input name="plazo[0_0_0]" required class="form-control txtPlazo" type="date" placeholder="Plazo" data-orden="0_0_0" data-parent="0_0">
								</td>
								<td>
									<img src="images/semaforo_rojo.png" name="txt_semaforo_0" class="txt_semaforo" style="width: 50px; ">
									
								</td>
								<td>
									<a class="btn btn-xs btn-danger btnEliminar" >x</a>
								</td>
							</tr>
						</tbody>

						<?php
							
						}
						
					?>
					</table>
					</div>


			
				<?php 
					$this->endWidget(); 
					
				?>
	    </div>
	</div>
	
</section>


<script src="js/bootstrap-select/bootstrap-select.min.js"></script>
<script src="js/sweetalert2.all.min.js"></script>  
<script src="js/bootstrap-drilldown-select.js"></script> 
<script src="js/multilevel-select/transition.min.js"></script> 
<script>

	//función para añadir nuevo input file al apretar el botón "+"
	$(document).on('click', '.addFile', function (event) {
		var file='<div class="input-group col-lg-9" >';
		file+='<input id="my-file-selector" name="photos[]" type="file">';
		file+='<span class="input-group-btn">';
		file+='<button class="btn  btn-default deleteFile" type="button">';
		file+='<i class="fa  fa-trash-o text"></i> ';    		
		file+='</button>';
		file+='</span>';	 
		file+='</div>';			    			
					    									
		$('#divFile').append(file);
	});
	
	//función para eliminar input file agregado dinámicamente 
	$(document).on('click', '.deleteFile', function (event) {
		    								    									
		$(this).parent().parent().remove();
	});
	
	 $(document).on('change', '[data-multilevel-dropdown]', function (event) {
        console.log($(this).attr('data-orden'));
        console.log($(this).val());
        console.log($(this).parent().find('select.ddlCausaBasica').val());
        $(this).parent().find('select.selectpicker').find('option').remove().end().append('<option selected value="'+$(this).val()+'"></option>');
    });
    
    $('.placeholder').multilevelDropdown({
        name: 'placeholder',
        value: 'val2',
        data: []
    });
    
    $(document).ready(function(){
    	
    	// Sólo números
		$(document).on('keypress', '.soloNumeros', function (e) {

			  if (((event.which != 46 || (event.which == 46 && $(this).val() == '')) ||
			            $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
			        event.preventDefault();
			    }
		});
    	
    	$(".multilevel-dropdown-display").css("background-color", "red!important");
    	
    	function revisarFechas(){
    		var startDt=$("#Accidente_fecha_accidente").val();
			var endDt=$("#Accidente_fecha_alta").val();
			//console.log(startDt);
			//console.log(endDt);
			
			if( (new Date(startDt).getTime() > new Date(endDt).getTime()))
			{
				swal({
				  title: 'Fechas inválidas!',
				  width: 600,
				  height: 600,
				  text: 'La fecha del accidente no puede ser mayor que la fecha de alta ',
				  type: 'warning',
				  confirmButtonText: 'OK, entendido'
				});
			    console.log('fecha mayor que alta');
			}else{
				console.log('alta mayor que fecha');
			}
    	}
    	
    	$(document).on('change', '#Accidente_fecha_alta,#Accidente_fecha_accidente', function() {
		  	revisarFechas();
		});
    	
    	
    });
    
   

	var trabajadores=<?php echo json_encode($rows); ?>;
	var causasBasicas=<?php echo json_encode($causasBasicas); ?>;
	var causasInmediatas=<?php echo json_encode($causasInmediatas); ?>;
	var medidasControl=<?php echo json_encode($medidasControl); ?>;


	$('#Accidente_acc_tipo_accidnte').change(function () {

		switch($(this).val()){
			case 'Accidentes CTP':
		
				$('#divFechaAlta').show();
				$('#divCostoPerdida').hide();
				break;
			case 'Accidentes Daño Material':
				$('#divFechaAlta').hide();
				$('#divCostoPerdida').show();
				break;
			default:
				$('#divFechaAlta').hide();
				$('#divCostoPerdida').hide();
		}
		
		
		
	});
	
	/*$(document).on('change', 'select.ddlCausaBasica', function (event) {
		var clase=$(this).parent().parent().parent().parent().attr('class');
		var value=$(this).val();
		var contadorValue=0;
		var count = $(this).parent().parent().parent().parent().attr('class').replace('row_','');
		$('select.ddlCausaBasica').each(function() {
			if($(this).val() == value && $('select.ddlCausaBasica').length > 1){
				contadorValue++;
			}
		});
		if(contadorValue < 2){
			$('#tablee tbody tr.'+clase).each(function() {
					
				if ($(this).find('select.ddlCausaInmediata').val().length > 0) {
					if ($(this).find('select.ddlMedidaControl').val().length > 0) {
						var medidaControlVal=$(this).find('select.ddlMedidaControl').val();
						$(this).find('input.txtPlazo').attr('name', 'plazo['+ count +value + medidaControlVal+'][]');
						$(this).find('select.ddlResponsable').attr('name', 'responsable['+ count +value + medidaControlVal+'][]');
						$(this).find('select.ddlMedidaControl').attr('name', 'medidaControl['+ count +value +medidaControlVal+'][]');
					}
					var causaInmediataVal=$(this).find('select.ddlCausaInmediata').val();				
					$(this).find('select.ddlCausaInmediata').attr('name', 'causaInmediata['+ count +value + '][]');
					
					
				}
			});
		}else{
			$(this).val('');
			$('.selectpicker').selectpicker('refresh');
		}
		
			
	});
	
	$(document).on('change', 'select.ddlCausaInmediata', function (event) {
		
		var clase=$(this).parent().parent().parent().parent().attr('class');
		var value=$(this).val();
		var causaBasicataVal=0;
		var contadorValue=0;
		var count = $(this).parent().parent().parent().parent().attr('class').replace('row_','');
		$('select.ddlCausaInmediata').each(function() {
			if($(this).val() == value && $('select.ddlCausaBasica').length > 1){
				contadorValue++;
			}
		});
		$('#tablee tbody tr.'+clase).each(function() {
					
			if ($(this).find('select.ddlCausaBasica').val() !== undefined) {
				
				causaBasicataVal=$(this).find('select.ddlCausaBasica').val();
			}
			if(causaBasicataVal !== 0){
				
				$(this).find('input.txtPlazo').attr('name', 'plazo['+ count +causaBasicataVal + value+'][]');
				$(this).find('select.ddlResponsable').attr('name', 'responsable['+ count +causaBasicataVal + value+'][]');
				$(this).find('select.ddlMedidaControl').attr('name', 'medidaControl['+ count +causaBasicataVal +value+'][]');
				$(this).find('select.ddlCausaInmediata').attr('name', 'causaInmediata['+ count +causaBasicataVal +'][]');
			}
			
				
		});

	});
	
	$(document).on('change', 'select.ddlMedidaControl', function (event) {
		
		var clase=$(this).parent().parent().parent().parent().attr('class');
		var value=$(this).val();
		var causaBasicataVal=0;
		var causaInmediataVal=0;
		var count = $(this).parent().parent().parent().parent().attr('class').replace('row_','');
		$('#tablee tbody tr.'+clase).each(function() {
					
			if ($(this).find('select.ddlCausaBasica').val() !== undefined) {
				
				causaBasicataVal=$(this).find('select.ddlCausaBasica').val();
			}
			if(causaBasicataVal !== 0){
				if ($(this).find('select.ddlCausaInmediata').val() !== undefined) {
				
					causaInmediataVal=$(this).find('select.ddlCausaInmediata').val();
				}
				if(causaInmediataVal !== 0){
					$(this).find('input.txtPlazo').attr('name', 'plazo['+ count +causaBasicataVal + causaInmediataVal+'][]');
					$(this).find('select.ddlResponsable').attr('name', 'responsable['+ count +causaBasicataVal + causaInmediataVal+'][]');
					$(this).find('select.ddlMedidaControl').attr('name', 'medidaControl['+ count +causaBasicataVal +causaInmediataVal+'][]');
				}
				
				$(this).find('select.ddlCausaInmediata').attr('name', 'causaInmediata['+ count +causaBasicataVal +'][]');
			}
			
				
		});

	});*/
	
	function generarSelect(nombre,title,data,orden,parent){
		var select='<select class="form-control  ddlMedidaControl" data-live-search="true"  name="'+nombre+'['+orden+']" title="'+title+'"  data-orden="'+orden+'" data-parent="'+parent+'">';
		var categoria='';
		select+='<option value="'+data[i].id+'" selected>'+data[i].descripcion+'</option>';

		select+='</select>';
		return select;	
	}
	
	function generarSelectMedidaControl(nombre,title,data,orden,parent){
		var select='<select class="form-control selectpicker ddlMedidaControl" data-live-search="true"  name="'+nombre+'['+orden+']" title="'+title+'"  data-orden="'+orden+'" data-parent="'+parent+'">';
		var categoria='';
		for(i=0;i<data.length;i++){
			if(categoria !== data[i].categoria){
				if(i !== 0){
					select+='</optgroup>';
				}
				select+='<optgroup label="'+data[i].categoria+'">';
			}
			select+='<option value="'+data[i].id+'" data-tokens="'+data[i].categoria+' '+data[i].descripcion+'">'+data[i].descripcion+'</option>';
			categoria=data[i].categoria;
		}
		select+='</select>';
		return select;	
	}
	
	function generarSelectMultiNivel(data,orden,title){
		
		var categoria='';
		var subCategoria='';
		var select='<div class="multilevel-dropdown-container" data-multilevel-dropdown data-dropdown-name="values"  data-orden="'+orden+'" data-dropdown-placeholder="'+title+'">';
		select+='<ul class="multilevel-dropdown">';
		for(i=0;i<data.length;i++){
			if(categoria !==  data[i].categoria){
				
				if(i !== 0){
					if(data[i].subcategoria !== ''){
						select+='</ul>';
					}
					select+= '</ul>';
				}
				
				select+= '<ul data-label="'+data[i].categoria+'">';
				if(data[i].subcategoria == ''){
					select+='<li data-value="'+data[i].id+'">'+data[i].descripcion+'</li>';
				}else{
					select+='<ul data-label="'+data[i].subcategoria+'">';
					select+='<li data-value="'+data[i].id+'">'+data[i].descripcion+'</li>';
				}
				
			}else{
				
				if(categoria !== data[i].categoria){
					if(i !== 0){
						select+='</ul>';
					}
					if(i  !== 0){
						select+='</ul>';
					}
					
					if(data[i].subcategoria == ''){
						select+='<li data-value="'+data[i].id+'">'+data[i].descripcion+'</li>';
					}else{
						select+='<ul data-label="'+data[i].subcategoria+'">';
						select+='<li data-value="'+data[i].id+'">'+data[i].descripcion+'</li>';
					}
					
				}else{
					select+='<li data-value="'+data[i].id+'">'+data[i].descripcion+'</li>';
				}
			}
			
			categoria=data[i].categoria;
			subCategoria=data[i].subcategoria;
		}
		select+='</ul>';									
		select+='</div>';
		
		return select;
	}
	
	function generarSelectCausaBasica(nombre,title,data,orden){
																	
		var categoria='';
		var subCategoria='';
		var select='';
		
		
		select+='<select class="hidden form-control selectpicker ddlCausaBasica" data-live-search="true"  name="'+nombre+'['+orden+']" title="'+title+'"  data-orden="'+orden+'" >';		
		categoria='';
		subCategoria='';
		for(i=0;i<data.length;i++){
			if(categoria !== data[i].categoria){
				if(i !== 0){
					select+='</optgroup>';
				}
				select+='<optgroup label="'+data[i].categoria+'">';
			}
			select+='<option value="'+data[i].id+'" data-tokens="'+data[i].categoria+' '+data[i].descripcion+'">'+data[i].descripcion+'</option>';
			categoria=data[i].categoria;
		}
		select+='</select>';
		return select;	
	}
	
	function generarSelectCausaInmediata(nombre,title,data,orden,parent){

		var select='<select class="hidden form-control selectpicker ddlCausaInmediata" data-live-search="true"  name="'+nombre+'['+orden+']" title="'+title+'"  data-orden="'+orden+'" data-parent="'+parent+'" >';
		var categoria='';
		for(i=0;i<data.length;i++){
			if(categoria !== data[i].categoria){
				if(i !== 0){
					select+='</optgroup>';
				}
				select+='<optgroup label="'+data[i].categoria+'">';
			}
			select+='<option value="'+data[i].id+'" data-tokens="'+data[i].categoria+' '+data[i].descripcion+'">'+data[i].descripcion+'</option>';
			categoria=data[i].categoria;
		}
		select+='</select>';
		return select;	
	}
	
	function generarSelectResponsable(nombre,title,data,orden){
		var select='<select class="form-control selectpicker ddlResponsable" data-live-search="true"  name="'+nombre+'['+orden+']" title="'+title+'"  >';
		var categoria='';
		for(i=0;i<data.length;i++){

			select+='<option value="'+data[i].rut+'" >'+data[i].nombres+' '+data[i].apellidos+'</option>';
			categoria=data[i].categoria;
		}
		select+='</select>';
		return select;	
	}
	
	$(document).on('click', '.btnEliminar', function (event) {
		if($(this).parent().parent().find('select.ddlCausaInmediata').attr('data-parent') == undefined){
			$(this).parent().parent().remove();

		}else if($(this).parent().parent().find('select.ddlCausaBasica').attr('id') == undefined){
			
			var dataParent=$(this).parent().parent().find('select.ddlMedidaControl').attr('data-parent');
			console.log(dataParent);
			 $('select.ddlMedidaControl[data-parent="'+ dataParent +'"]').each(function(){
	            $(this).parent().parent().parent().parent().remove();
	         });
		}else{
			var dataParent=$(this).parent().parent().find('select.ddlMedidaControl').attr('data-parent');
			var ordenCausaBasica=dataParent.split('_')[0];
			console.log(dataParent);
			 $('select.ddlMedidaControl[data-parent^="'+ ordenCausaBasica +'"]').each(function(){
	            $(this).parent().parent().parent().parent().remove();
	         });
		}
		//console.log($(this).parent().parent().find('select.ddlCausaInmediata').attr('data-parent').split('_')[0]);
	});
	
	var count=$('#tablee tbody tr').length;
	$(document).on('click', 'button.btn', function (event) {
		var causaBasicaLen=$(this).parent().parent().parent().parent().attr('class');
		if($(this).hasClass('mControl')){
			//var select=generarSelect('medidaControl',medidasControl);
			var orden=$(this).attr("data-parent");
			var len = $("button.mControl[data-orden^="+orden+"]").length;
			var nuevoOrden=orden+"_"+len;
			console.log(orden);
			console.log(len);
			console.log(nuevoOrden);
			var medidaControl=generarSelectMedidaControl('medidaControl','Medida Control',medidasControl,nuevoOrden,orden);
			var responsable=generarSelectResponsable('responsable','Responsable',trabajadores,nuevoOrden);
			var row='<tr class="'+ causaBasicaLen +'">';
			row+='<td></td>';
			row+='<td></td>';
			row+='<td><div class="input-group">'+ medidaControl +'<span class="input-group-btn"> <button class="btn btn-default mControl" type="button" data-orden="'+nuevoOrden+'" data-parent="'+orden+'">+</button> </span> </div></td>';
			row+='<td>'+ responsable +'</td>';
			row+='<td><input name="plazo['+nuevoOrden+']" required class="form-control txtPlazo" type="date" placeholder="Plazo"></td>';
			row+='<td><img src="images/semaforo_rojo.png" name="txt_semaforo_0" class="txt_semaforo" style="width: 50px;"></td>';			
			row+='<td><a class="btn btn-xs btn-danger btnEliminar" >x</a></td>';
			row+='</tr>';
			//$('#tablee tbody').append(row);
			$(row).insertAfter($(this).parent().parent().parent().parent());
			$('.selectpicker').selectpicker('refresh');
			
		}
		
		if($(this).hasClass('cBasica')){
			var orden=$(this).attr("data-orden");
			var len = $("button.cBasica").length;
			var nuevoOrden=parseInt(orden)+1;
			console.log(orden);
			console.log(len);
			console.log(nuevoOrden);
			causaBasicaLen=$('select.ddlCausaBasica').length+1;
			var medidaControl=generarSelectMedidaControl('medidaControl','Medida Control',medidasControl,nuevoOrden+'_0_0',nuevoOrden+'_0');			
			var causaBasicaMultiNivel=generarSelectMultiNivel(causasBasicas,nuevoOrden,'Causa Básica');
			var causaBasica=generarSelectCausaBasica('causaBasica','Causa Básica',causasBasicas,nuevoOrden);
			var causaInmediataMultiNivel=generarSelectMultiNivel(causasInmediatas,nuevoOrden+'_0','Causa Inmediata');
			var causaInmediata=generarSelectCausaInmediata('causaInmediata','Causa Inmediata',causasInmediatas,nuevoOrden+'_0',nuevoOrden);
			var responsable=generarSelectResponsable('responsable','Responsable',trabajadores,nuevoOrden+'_0_0');
			var row='<tr class="row_'+ causaBasicaLen +'">';
			row+='<td><div class="input-group"> '+ causaBasicaMultiNivel + causaBasica +' <span class="input-group-btn"> <button class="btn btn-default cBasica" type="button" data-orden="'+nuevoOrden+'">+</button> </span> </div></td>';
			row+='<td><div class="input-group"> '+ causaInmediataMultiNivel + causaInmediata +' <span class="input-group-btn"> <button class="btn btn-default cInmediata" type="button" data-orden="'+nuevoOrden+'_0" data-parent="'+nuevoOrden+'">+</button> </span> </div></td>';
			row+='<td><div class="input-group"> '+ medidaControl +' <span class="input-group-btn"> <button class="btn btn-default mControl" type="button" data-orden="'+nuevoOrden+'_0_0" data-parent="'+nuevoOrden+'_0">+</button> </span> </div></td>';
			row+='<td>'+ responsable +'</td>';
			row+='<td><input name="plazo['+nuevoOrden+'_0_0]" required class="form-control txtPlazo" type="date" placeholder="Plazo"></td>';
			row+='<td><img src="images/semaforo_rojo.png" name="txt_semaforo_0" class="txt_semaforo" style="width: 50px;"></td>';
			
			row+='<td><a class="btn btn-xs btn-danger btnEliminar" >x</a></td>';
			row+='</tr>';
			$('#tablee tbody').append(row);
			$('.selectpicker').selectpicker('refresh');
			$('.multilevel-dropdown-container').multilevelDropdown();
			count++;
		}
		
		if($(this).hasClass('cInmediata')){
			var orden=$(this).attr("data-parent");
			var len = $("button.cInmediata[data-orden^="+orden+"]").length;
			var nuevoOrden=orden+"_"+len;
			console.log(orden);
			console.log(len);
			console.log(nuevoOrden);

			var parent=$(this).parent().parent().parent().prev().find('select.ddlCausaBasica').val();
			var causaInmediataMultiNivel=generarSelectMultiNivel(causasInmediatas,nuevoOrden,'Causa Inmediata');
			var causaInmediata=generarSelectCausaInmediata('causaInmediata','Causa Inmediata',causasInmediatas,nuevoOrden,orden);
			var medidaControl=generarSelectMedidaControl('medidaControl','Medida Control',medidasControl,nuevoOrden+'_0',nuevoOrden);
			var responsable=generarSelectResponsable('responsable','Responsable',trabajadores,nuevoOrden+'_0');
			var row='<tr class="'+ causaBasicaLen +'" >';
			row+='<td></td>';
			row+='<td><div class="input-group"> '+ causaInmediataMultiNivel + causaInmediata +' <span class="input-group-btn"> <button class="btn btn-default cInmediata" type="button" data-orden="'+(nuevoOrden)+'" data-parent="'+orden+'">+</button> </span> </div></td>';
			row+='<td><div class="input-group"> '+ medidaControl +' <span class="input-group-btn"> <button class="btn btn-default mControl" type="button" data-orden="'+(nuevoOrden+'_0')+'" data-parent="'+nuevoOrden+'" >+</button> </span> </div></td>';
			row+='<td>'+ responsable +'</td>';
			row+='<td><input name="plazo['+nuevoOrden+'_0'+']" required class="form-control txtPlazo" type="date" placeholder="Plazo"></td>';
			row+='<td><img src="images/semaforo_rojo.png" name="txt_semaforo_0" class="txt_semaforo" style="width: 50px;"></td>';			
			row+='<td><a class="btn btn-xs btn-danger btnEliminar" >x</a></td>';
			row+='</tr>';
			//$('#tablee tbody').append(row);
			var $links = $('#tablee .cInmediata');

			
			var slideIndex = $(this).index('.cInmediata');
  			if($('.cInmediata').length == 1){
  				$('#tablee tbody').append(row);  				
  			}else{
  				if(($(this).index('.cInmediata')+1) == $('.cInmediata').length){
  					$('#tablee tbody').append(row);  
  				}else{
  					$(row).insertBefore($links.eq($(this).index('.cInmediata')+1).parent().parent().parent().parent());
  				}
  				
  			}
			
			$('.selectpicker').selectpicker('refresh');
			$('.multilevel-dropdown-container').multilevelDropdown();
		}
		
	});
	
	
		

</script>



