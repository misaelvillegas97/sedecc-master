<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

<section class="panel panel-default">
	<!--header class="panel-heading font-bold">Horizontal form</header-->
	<div class="panel-body">
		<div class="bs-example form-horizontal">
						<?php
			/* @var $this VariableEvaluacionController */
			/* @var $model VariableEvaluacion */
			/* @var $form CActiveForm */
			?>
			
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'variable-evaluacion-form',
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// There is a call to performAjaxValidation() commented in generated controller code.
				// See class documentation of CActiveForm for details on this.
				'enableAjaxValidation'=>false,
			)); ?>
		
			<p class="note">Los campos que contienen <span class="required">*</span> son obligatorios.</p>
			
			<!--?php echo $form->errorSummary($model); ?-->
			<div class="form-group">
				<div class="col-lg-2 control-label">
					<?php echo $form->labelEx($model,'eess_rut'); ?>
				</div>
				<div class="col-lg-10">				
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
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'var_nombre'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'var_nombre',array('size'=>60,'maxlength'=>100, 'class'=>'form-control', 'disabled'=>'true')); ?>
			    	<?php echo $form->error($model,'var_nombre'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'var_descripcion'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textArea($model,'var_descripcion',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'var_descripcion'); ?>
			    </div>
			</div>
			
			<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'var_activa'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php 
			    		$selected = false;
			    		if(!isset($model->var_id)){
			    			$selected = true;
			    			echo $form->dropDownList($model,'var_activa',array('1'=>'Activa','0'=>'Inactiva'), array('prompt'=>'Seleccione', 'class' =>'form-control','options' => array('1'=>array('selected'=>$selected)) ) ); 
			    		}else{
			    			echo $form->dropDownList($model,'var_activa',array('1'=>'Activa','0'=>'Inactiva'), array('prompt'=>'Seleccione', 'class' =>'form-control' ) ); 
			    		}
			    	?>
			    		
			    	<?php //echo $form->textField($model,'var_activa',array('class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'var_activa'); ?>
			    </div>
			</div>
			<?php  
				if( isset( $model->var_id ) && ( $model->var_nombre == 'Accidentabilidad' || $model->var_nombre == 'Siniestralidad' ) ){
										
								
			?>
			<div class="form-group">
					<div class="col-lg-2 control-label">
				    	Tipo Medición
				    </div>
				    <div class="col-lg-8">
				    	<select class="form-control" name="VariableEvaluacion[tmv_id]" >
							<?php
								if(Yii::app()->controller->usertype() == 1){
									$rows = Yii::app()->db->createCommand("SELECT * FROM min_tipo_medicion_variable tmv
																			WHERE 
																			tmv.var_id =".$model -> var_id."
																			and tmv.eess_rut = '".Yii::app()->user->id."'")->query()->readAll();
								
								}
								else if(Yii::app()->controller->usertype() == 3){
									$eess = Yii::app()->db->createCommand("SELECT eess_rut FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
									$rows = Yii::app()->db->createCommand("SELECT * FROM min_tipo_medicion_variable tmv
																			WHERE 
																			tmv.var_id =".$model -> var_id."
																			and tmv.eess_rut = '".$eess."'")->query()->readAll();
																			
								}	
								
								$selected='';
								if(!isset($model->var_id)){
									$selected = 'selected';
								}	
								
								echo '<option value="0" '.$selected.'>Seleccionar</option>';
								
								for($i=0;$i<count($rows);$i++){
									
									if( $model->tmv_id === $rows[$i]['tmv_id'] ){
										
										$selected ='selected';
									}else{
										$selected='';
									}
										
									
									

									echo '<option '.$selected.' value="'.$rows[$i]['tmv_id'].'">'.$rows[$i]['tmv_descripcion'].'</option>';
								}
							?>
						</select>
				    	<?php  //echo $form->dropDownList($model,'acc_tipo_accidnte',array('CTP'=>'CTP','STP'=>'STP','Daño Material'=>'Daño Material','Incidente'=>'Incidente'), array('options' => array('0'=>array('selected'=>true)),'placeholder'=>'0=CTP - 1=STP', 'class' =>'form-control')); ?>
				    	<?php //echo $form->error($model,'acc_tipo_accidnte'); ?>
				    </div>
				</div>
			<?php  
				}
										
								
			?>
			<div class="form-group" style="display:none;">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'var_tipo'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->dropDownList($model,'var_tipo',array('definida'=>'Definida','rango'=>'Rango','rangoDefinida'=>'Rango/Definida'), array('prompt'=>'Seleccione', 'class' =>'form-control','options' => array('rango'=>array('selected'=>true)) )); ?>
			    	<?php //echo $form->textField($model,'var_activa',array('class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'var_tipo'); ?>
			    </div>
			</div>
			<!--<div class="form-group">
			<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'eess_rut'); ?>
					</div>
			<div class="col-lg-10">
				<?php echo $form->dropDownList($model,'eess_rut',CHtml::listData(Eess::model()->findAll('eess_estado=1'), 'eess_rut', 'eess_nombre_corto'),array('prompt'=>' ','class'=>'form-control bord'));?>
				<?php echo $form->error($model,'eess_rut'); ?>
			</div>
			</div>-->
						<!--<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'eess_rut'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'eess_rut',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'eess_rut'); ?>
			    </div>
			</div>-->
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'var_ponderacion'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'var_ponderacion',array('class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'var_ponderacion'); ?>
			    </div>
			</div>
			<?php
				if($model->var_nombre == 'Plan Buen Conductor' || $model->var_nombre == 'Matriz De Impacto') {
			?>
			<div class="form-group">
				<div class="col-lg-2 control-label">
			    	Tolerancia
			    </div>
			    <div class="col-lg-10">
			    	<div id="name" class="col-lg-2" style="float;left;">
			    	  <?php 
			    	  	$checked='';
						$style='style="display:none;float:left;"';
			    	  	if(isset($model->var_tolerancia)){
			    	  		$checked='checked';
							$style='';
			    	  	}
						//var_dump($model);
			    	  ?>
					  <input type="checkbox" <?php echo $checked; ?> id="toggleTolerancia" name="toggleTolerancia" data-toggle="toggle" data-on="Aplica" data-off="No Aplica" style="float:left;display:block;">
					</div>
			    	
			  
			  		<div id="divTolerancia" <?php echo $style; ?> class="col-lg-6">
			  			<label for="tolerancia">Tolerancia</label>
			  			<input type="number" name="VariableEvaluacion[var_tolerancia]" value="<?php echo $model->var_tolerancia; ?>" id="tolerancia"/> Km.
						
					</div>
			    	
					
			    </div>
			</div>
			<?php
				}
			?>
			<div class="form-group">
				<div class="col-lg-2 control-label">
			    	Periodo de Evaluación
			    </div>
			    <div class="col-lg-10">
			    	<div id="name" class="col-lg-3" style="float;left;">
			    	  <?php 
			    	  	echo $form->dropDownList($model,'var_periodo',array('mensual'=>'Mensual','semanal'=>'Semanal'), array('prompt'=>'Seleccione', 'class' =>'form-control' ) ); 
			    	  ?>

					</div>
			    	
			  
			  		<div class="col-lg-6">
			  			<input type="number" name="VariableEvaluacion[var_periodo_cantidad]" value="<?php echo $model->var_periodo_cantidad; ?>" id="var_periodo_cantidad"/>
						
					</div>
			    	
					
			    </div>
			</div>
			
			<hr />

			<div id="divRangos"></div>
			<div id="divDefinidas"></div>
			<div id="divRangosDefinidas"></div>
			
			<?php 
						
				
			?>
						 
			<a class="btn btn-block btn-default" id="agregarCampo">AGREGAR CAMPO</a>
			
			<hr>
					
					<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', array('class'=>'btn btn-block btn-lg btn-primary','id'=>'btnGuardar')); ?>
			
			<?php $this->endWidget(); 
			$model->var_tipo = 'rango';


				// En esta variable almaceno el porcentaje total de ponderación, el cual debiera ser <=100
				$porcentajeTotal=Yii::app()->db->createCommand("SELECT ifnull(sum(var_ponderacion),0) FROM min_variable_evaluacion WHERE eess_rut = '".$model->eess_rut."'  ")->queryScalar();


			?>
    	</div>
	</div>
</section>
<script src="js/jquery.min.js"></script> 
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>

	$(document).ready(function(){
		
		var nombreVariable= <?php echo json_encode($model->var_nombre); ?>;
		var tipoVariable=<?php echo json_encode($model->var_tipo); ?>;
		var eess=<?php echo $model->eess_rut; ?>;
		var idVariable=<?php echo $model->var_id == NULL ? 0 : $model->var_id  ?>;
		var porcentajeTotal=<?php echo $porcentajeTotal; ?>;
		var porcentajeVariable = <?php echo $model->var_ponderacion == NULL ? 0 : $model->var_ponderacion; ?>;
		
		
		$('#variable-evaluacion-form').submit(function(){
		    
		    var flagZero = false;
		    $("input[name*='nota']").each(function() {  // first pass, create name mapping
		        if( $(this).val() == 0 ){
		        	flagZero = true;
		        	alert('No puedes ingresar notas con valor 0');
		        	$(this).focus();
		        	return false;
		        	
		        }
		        console.log($(this).val());
		    });
			//$( "input[name*='man']" ).val( "has man in it!" );
			
			if(!flagZero){
				return true;
			}else{
				return false;
			}
		    
		});
		
		

		
		$(document).on('change', '#toggleTolerancia', function (event) {
			
            if($("#toggleTolerancia").prop('checked')){
                $('#divTolerancia').show();
            }else{
            	$('#tolerancia').val('');
                $('#divTolerancia').hide();
            }

        });
		
		

		function calculoPorcentaje(valor){
			return ( ( parseInt(porcentajeTotal) - parseInt(porcentajeVariable) )  + parseInt( valor ) );
		}
		
		
		// Reviso que la suma acumulada de los porcentajes de cada variable de evaluación no supere 100
		$(document).on('keyup', '#VariableEvaluacion_var_ponderacion', function (e) {
			
			if(e.keyCode != 8){
				if( calculoPorcentaje($(this).val()) > 100 ){
					alert('Ingresando este valor, estás superando el 100% de ponderación acumulada entre tus variables. No puedes superar el 100% ');
					$('#btnGuardar').prop('disabled', true);
				}else{
					$('#btnGuardar').prop('disabled', false);
				}
			}else{
				if( calculoPorcentaje($(this).val()) > 100 ){
					//alert('Ingresando este valor, estás superando el 100% de ponderación acumulada entre tus variables. No puedes superar el 100% ');
					$('#btnGuardar').prop('disabled', true);
				}else{
					$('#btnGuardar').prop('disabled', false);
				}
			}

			
		});
		
		
		// Sólo números
		$(document).on('keypress', '#VariableEvaluacion_var_ponderacion,.soloNumeros', function (e) {

			  if (((event.which != 46 || (event.which == 46 && $(this).val() == '')) ||
            $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
        event.preventDefault();
    }
		});

		
		
		 //AJAXCALL
		 function ajaxCall(data, url) {
	        //var returnData;
	        console.log(data);
	        $.ajax({
	            //beforeSend: function () { $('#loader').show(); },
	            //complete: function () { $('#loader').hide(); },
	            type: "POST",
	            url: url,
	            data: data,
	            async: true,
	            dataType: 'json',
	            success: function (res) {
	                //var data = JSON.parse(res.d);
	                //console.log(res);
	                cargarDetalle(res,data.tipoVariable);
	                
	            },
	            error: function (jqXHR, textStatus, errorThrown) {
	                errorFunction(jqXHR, textStatus, errorThrown);
	
	            }
	
	        });
	        //return returnData;
	    }
	    
	      // Función para controlar errores derivados de llamada ajax
		  function errorFunction(jqXHR, textStatus, errorThrown) {
		    if (jqXHR.status === 0) {
		
		        alert('Not connect: Verify Network.');
		
		    } else if (jqXHR.status == 404) {
		
		        alert('Requested page not found [404]');
		
		    } else if (jqXHR.status == 500) {
		        console.log(jqXHR);
		        console.log(textStatus);
		        console.log(errorThrown);
		
		        alert('Internal Server Error [500].');
		
		    } else if (textStatus === 'parsererror') {
		
		        alert('Requested JSON parse failed.');
		        console.log(errorThrown);
		        console.log(textStatus);
		        console.log(jqXHR);
		
		    } else if (textStatus === 'timeout') {
		
		        alert('Time out error.');
		
		    } else if (textStatus === 'abort') {
		
		        alert('Ajax request aborted.');
		
		    } else {
		
		        alert('Uncaught Error: ' + jqXHR.responseText);
		
		    }
		}
		
		// Realizo llamada ajax. Una vez el método reciba datos, llamará  a la función cargarDetalle
		// pasándole los datos recibidos para que ésta posteriormente cargue la tabla con el detalle
		ajaxCall({'tipoVariable':tipoVariable,'eess':eess,'idVariable':idVariable},"ajax/detalleVariableEvaluacion.php");
		
		/*if(nombreVariable != 'Evaluaciones'){
			ajaxCall({'tipoVariable':tipoVariable,'eess':eess,'idVariable':idVariable},"ajax/detalleVariableEvaluacion.php");
		}else{
			$('#agregarCampo').attr('disabled','true');
		}*/
		

		function cargarDetalle(data,tipoVariable){
			<?php
					$disabled = "";

					if($model->var_nombre == 'Evaluaciones' and $model->eess_rut != '76458497') {
						$disabled = 'disabled = "true"';
					}
				?>
			if(tipoVariable == 'definida'){
				//console.log('definida');
		  		// si es definida, oculto el div correspondiente al otro tipo de variable y viceversa
		  		$("#divRangos").hide();	
		  		$("#divRangosDefinidas").hide();			  		
		  		// reviso si es que el div tiene algún elemento dentro
		  		if($("#divDefinidas").children().length == 0){
		  			var tabla = '<table class="table table-condensed">';
		  			tabla += '<thead>';
		  			tabla += '<tr>';
		  			tabla += '<th>Nota</th>';
		  			tabla += '<th>Cantidad</th>';
		  			tabla += '<th>Descripcion</th>';
		  			tabla += '<th></th>';
		  			tabla += '</tr>';
		  			tabla += '</thead>';
		  			tabla += '<tbody>';
		  			if(data == null){
		  				tabla += '<tr>';
			  			tabla += '<td><input name="nota[0]" <?php echo $disabled ?> class="form-control soloNumeros" type="text" ></td>';
			  			tabla += '<td><input name="cantidad[0]" <?php echo $disabled ?> class="form-control soloNumeros" type="text" ></td>';
			  			tabla += '<td><input name="descripcion[0]" <?php echo $disabled ?> class="form-control " type="text" ></td>';
			  			tabla += '<td><a class="btn btn-xs btn-danger btnEliminar" >x</a></td>';
			  			tabla += '</tr>';	
		  			}else{
		  				for(i=0;i<data.length;i++){
		  					tabla += '<tr>';
				  			tabla += '<td><input name="nota['+i+']" <?php echo $disabled ?> class="form-control soloNumeros" type="text" value="'+data[i].nota+'"></td>';
				  			tabla += '<td><input name="cantidad['+i+']" <?php echo $disabled ?> class="form-control soloNumeros" type="text" value="'+data[i].cantidad+'"></td>';
				  			tabla += '<td><input name="descripcion['+i+']" <?php echo $disabled ?> class="form-control" type="text" value="'+data[i].descripcion+'"></td>';
				  			tabla += '<td><a class="btn btn-xs btn-danger btnEliminar" >x</a></td>';
				  			tabla += '</tr>';	
		  				}
		  			}
		  				  			
		  			tabla += '</tbody>';
		  			tabla += '</table>';
		  			$("#divDefinidas").append(tabla);
		  			
		  		}
		  		$("#divDefinidas").show();
		  		
		  	}
		  	
		  	if(tipoVariable == 'rango'){
		  		// si es definida, oculto el div correspondiente al otro tipo de variable y viceversa
		  		$("#divRangosDefinidas").hide();
		  		$("#divDefinidas").hide();	
		  		console.log(data);
				
		  		// reviso si es que el div tiene algún elemento dentro
		  		if($("#divRangos").children().length == 0){
		  			var tabla = '<table class="table table-condensed">';
		  			tabla += '<thead>';
		  			tabla += '<tr>';
					tabla += '<th colspan=2 class="text-center h4"> Notas para el % de cumplimiento </th>';
					tabla += '<th colspan=2 class="text-center h4"> Rangos para el % de cumplimiento </th>';
					tabla += '<th colspan=1 class=""></th>';
					tabla += '</tr>';
		  			tabla += '<thead>';
		  			tabla += '<tr>';
		  			tabla += '<th>Nota Superior</th>';
		  			tabla += '<th>Nota Inferior</th>';
		  			tabla += '<th>Rango Inferior</th>';
		  			tabla += '<th>Rango Superior</th>';
		  			// tabla += '<th>Descripcion</th>';
		  			tabla += '<th></th>';
		  			tabla += '</tr>';
		  			tabla += '</thead>';
		  			tabla += '<tbody>';
		  			if(data == null){
		  				tabla += '<tr>';
			  			tabla += '<td><input name="notaInferior[0]" <?php echo $disabled ?> class="form-control soloNumeros" type="text" ></td>';
			  			tabla += '<td><input name="notaSuperior[0]" <?php echo $disabled ?> class="form-control soloNumeros" type="text" ></td>';
			  			tabla += '<td><input name="rangoInferior[0]" <?php echo $disabled ?> class="form-control soloNumeros" type="text" ></td>';
			  			tabla += '<td><input name="rangoSuperior[0]" <?php echo $disabled ?> class="form-control soloNumeros" type="text" ></td>';
			  			// tabla += '<td><input name="descripcion[0]"  class="form-control" type="text" ></td>';
			  			tabla += '<td><a class="btn btn-xs btn-danger btnEliminar" >x</a></td>';
			  			tabla += '</tr>';	
		  			}else{
		  				for(i=0;i<data.length;i++){
		  					tabla += '<tr>';
				  			tabla += '<td><input name="notaInferior['+i+']" <?php echo $disabled ?> class="form-control soloNumeros" type="text" value="'+data[i].notaInferior+'"></td>';
				  			tabla += '<td><input name="notaSuperior['+i+']" <?php echo $disabled ?> class="form-control soloNumeros" type="text" value="'+data[i].notaSuperior+'"></td>';
				  			tabla += '<td><input name="rangoInferior['+i+']" <?php echo $disabled ?> class="form-control soloNumeros" type="text" value="'+data[i].rangoInferior+'"></td>';
				  			tabla += '<td><input name="rangoSuperior['+i+']" <?php echo $disabled ?> class="form-control soloNumeros" type="text" value="'+data[i].rangoSuperior+'"></td>';
				  			// tabla += '<td><input name="descripcion['+i+']"  class="form-control" type="text" ></td>';
				  			tabla += '<td><a class="btn btn-xs btn-danger btnEliminar" >x</a></td>';
				  			tabla += '</tr>';	
		  				}
		  			}
		  				  			
		  			tabla += '</tbody>';
		  			tabla += '</table>';
		  			$("#divRangos").append(tabla);
		  			
		  		}
		  		$("#divRangos").show();
		  		
		  	}
		  	
		  	if(tipoVariable == 'rangoDefinida'){
		  		// si es definida, oculto el div correspondiente al otro tipo de variable y viceversa
		  		$("#divDefinidas").hide();	
		  		$("#divRangos").hide();			  		
		  		// reviso si es que el div tiene algún elemento dentro
		  		if($("#divRangosDefinidas").children().length == 0){
		  			var tabla = '<table class="table table-condensed">';
		  			tabla += '<thead>';
		  			tabla += '<tr>';
		  			tabla += '<th>Nota</th>';
		  			tabla += '<th>Rango Inferior</th>';
		  			tabla += '<th>Rango Superior</th>';
		  			// tabla += '<th>Descripcion</th>';
		  			tabla += '<th></th>';
		  			tabla += '</tr>';
		  			tabla += '</thead>';
		  			tabla += '<tbody>';
		  			if(data == null){
		  				tabla += '<tr>';
			  			tabla += '<td><input name="nota[0]" <?php echo $disabled ?> class="form-control soloNumeros" type="text" ></td>';
			  			tabla += '<td><input name="rangoInferior[0]" <?php echo $disabled ?> class="form-control soloNumeros" type="text" ></td>';
			  			tabla += '<td><input name="rangoSuperior[0]" <?php echo $disabled ?> class="form-control soloNumeros" type="text" ></td>';
			  			// tabla += '<td><input name="descripcion[0]"  class="form-control" type="text" ></td>';
			  			tabla += '<td><a class="btn btn-xs btn-danger btnEliminar" >x</a></td>';
			  			tabla += '</tr>';	
		  			}else{
		  				for(i=0;i<data.length;i++){
		  					tabla += '<tr>';
				  			tabla += '<td><input name="nota['+i+']" <?php echo $disabled ?> class="form-control soloNumeros" type="text" value="'+data[i].nota+'"></td>';
				  			tabla += '<td><input name="rangoInferior['+i+']" <?php echo $disabled ?> class="form-control soloNumeros" type="text" value="'+data[i].rangoInferior+'"></td>';
				  			tabla += '<td><input name="rangoSuperior['+i+']" <?php echo $disabled ?> class="form-control soloNumeros" type="text" value="'+data[i].rangoSuperior+'"></td>';
				  			// tabla += '<td><input name="descripcion['+i+']"  class="form-control" type="text" value="'+data[i].descripcion+'"></td>';
				  			tabla += '<td><a class="btn btn-xs btn-danger btnEliminar" >x</a></td>';
				  			tabla += '</tr>';	
		  				}
		  			}
		  				  			
		  			tabla += '</tbody>';
		  			tabla += '</table>';
		  			$("#divRangosDefinidas").append(tabla);
		  			
		  		}
		  		$("#divRangosDefinidas").show();
		  		
		  	}
		  	$('.soloNumeros').attr('maxlength', 5);
			
			
		}
		
		
		// detecto el cambio de tipo de variable de rango a definida
		// dependiendo del tipo de variable, debo mostrar tablas distintas
		/*$(document).on('change', '#VariableEvaluacion_var_tipo', function() {
			cargarDetalle(null,$('#VariableEvaluacion_var_tipo').val());
		});*/
		
		
		// Función para agregar tr de tabla de detalle
		$(document).on('click', '.btnEliminar', function (event) {

			$(this).parent().parent().remove();
			
		});
		
		// Función para eliminar tr de tabla de detalle
		$(document).on('click', '#agregarCampo', function (event) {


			switch($('#VariableEvaluacion_var_tipo').val()){
				case 'rango':
					var rowCount = $('#divRangos tbody tr').length;
					console.log(rowCount);
					var tabla = '<tr>';
		  			tabla += '<td><input name="notaInferior['+rowCount+']"  class="form-control soloNumeros" type="text" ></td>';
		  			tabla += '<td><input name="notaSuperior['+rowCount+']"  class="form-control soloNumeros" type="text" ></td>';
		  			tabla += '<td><input name="rangoInferior['+rowCount+']"  class="form-control soloNumeros" type="text" ></td>';
		  			tabla += '<td><input name="rangoSuperior['+rowCount+']"  class="form-control soloNumeros" type="text" ></td>';
		  			// tabla += '<td><input name="descripcion['+rowCount+']"  class="form-control" type="text" ></td>';
		  			tabla += '<td><a class="btn btn-xs btn-danger btnEliminar" >x</a></td>';
		  			tabla += '</tr>';		
		  			$('#divRangos tbody').append(tabla);				
					break;
				case 'rangoDefinida':
					var rowCount = $('#divRangosDefinidas tbody tr').length;
					console.log(rowCount);
					var tabla = '<tr>';
		  			tabla += '<td><input name="nota['+rowCount+']" required class="form-control soloNumeros" type="text" ></td>';
		  			tabla += '<td><input name="rangoInferior['+rowCount+']"  class="form-control soloNumeros" type="text" ></td>';
		  			tabla += '<td><input name="rangoSuperior['+rowCount+']"  class="form-control soloNumeros" type="text" ></td>';
		  			// tabla += '<td><input name="descripcion['+rowCount+']"  class="form-control" type="text" ></td>';
		  			tabla += '<td><a class="btn btn-xs btn-danger btnEliminar" >x</a></td>';
		  			tabla += '</tr>';
		  			$('#divRangosDefinidas tbody').append(tabla);
					break;
				case 'definida':
					var rowCount = $('#divDefinidas tbody tr').length;
					console.log(rowCount);
					var tabla = '<tr>';
		  			tabla += '<td><input name="nota['+rowCount+']"  class="form-control soloNumeros" type="text" ></td>';
		  			tabla += '<td><input name="cantidad['+rowCount+']"  class="form-control soloNumeros" type="text" ></td>';
		  			// tabla += '<td><input name="descripcion['+rowCount+']"  class="form-control" type="text" ></td>';
		  			tabla += '<td><a class="btn btn-xs btn-danger btnEliminar" >x</a></td>';
		  			tabla += '</tr>';
		  			$('#divDefinidas tbody').append(tabla);	
					break;
			}
			
			$('.soloNumeros').attr('maxlength', 5);
			
		});
		
		
		
	});

	
	

</script>

