<style type="text/css">

	.marg{
					padding-left: 0px !important;
					padding-right: 0px !important;
				}
</style>
<section class="panel panel-default">
	<!--header class="panel-heading font-bold">Horizontal form</header-->
	<div class="panel-body">
		<div class="bs-example form-horizontal">
						<?php
			/* @var $this EvaluacionController */
			/* @var $model Evaluacion */
			/* @var $form CActiveForm */
			?>
			
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'evaluacion-form',
				'htmlOptions'=>array('enctype'=>'multipart/form-data'),
				'enableAjaxValidation'=>false,
			)); ?>
	<div class="row">
		<div class="col-md-12">		
			<div class="col-md-6">
			<p class="note">Los campos que contienen<span class="required">*</span>son obligatorios.</p>
			</div>
			<div class="col-md-6 marg" style="display: none;">
				<div class="col-lg-4" align="middle" style="text-align: right;">
				    	<?php echo $form->labelEx($model,'eess_rut'); ?>
				    </div>
				    <div class="col-lg-8">
				    	<?php $disabled = false; if(Yii::app()->controller->usertype() == 1) $disabled = true;?>
				    	<?php echo $form->dropDownList($model,'eess_rut',CHtml::listData(Eess::model()->findAll('eess_estado=1'), 'eess_rut', 'eess_nombre_corto'),array('prompt'=>' ','class'=>'form-control bord','disabled'=>$disabled));?>
				    	<!--?php echo $form->textField($model,'eess_rut',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?-->
				    	<?php echo $form->error($model,'eess_rut'); ?>
				</div>
			</div>
		</div>
			<?php echo $form->errorSummary($model); ?>

			
		<div class="col-md-12" style="margin-top:10px;">		
			<div class="col-md-6">
				<div class="col-lg-12">
			    	<?php echo $form->labelEx($model,'eva_tipo'); ?>
			    </div>
			    <div class="col-lg-12">
			    	<?php $disabled = false; if(!$model->isNewRecord) $disabled = true;?>
				    <?php echo $form->dropDownList($model,'eva_tipo',CHtml::listData(Yii::app()->db->createCommand("SELECT * FROM min_pregunta")->query()->readAll(), 'car_id', 'car_id'),array('class'=>'form-control bord','disabled'=>$disabled));?>
			    	<!--?php echo $form->textField($model,'eva_tipo',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?-->
			    	<?php echo $form->error($model,'eva_tipo'); ?>
			    </div>

			    <div class="col-md-6 marg">
				    <div class="col-lg-12">
				    	<?php echo $form->labelEx($model,'tra_rut'); ?>
				    </div>
				    <div class="col-lg-12">
				    	<?php echo $form->numberField($model,'tra_rut',array('size'=>60,'maxlength'=>255, 'class'=>'form-control bord')); ?>
				    	<?php echo $form->error($model,'tra_rut'); ?>
				    </div>
			    </div>
			    <div class="col-md-6 marg">
				    <div class="col-lg-12">
				    	<?php echo $form->labelEx($model,'eva_fecha_evaluacion'); ?>
				    </div>
				    <div class="col-lg-12">
				    	<?php echo $form->dateField($model,'eva_fecha_evaluacion',array('class'=>'form-control bord')); ?>
				    	<?php echo $form->error($model,'eva_fecha_evaluacion'); ?>
				    </div>
				</div>
				<div class="col-md-6 marg">
				    <div class="col-lg-12">
				    	<?php echo $form->labelEx($model,'eva_nombres'); ?>
				    </div>
				    <div class="col-lg-12">
				    	<?php echo $form->textField($model,'eva_nombres',array('size'=>60,'maxlength'=>255, 'class'=>'form-control bord')); ?>
				    	<?php echo $form->error($model,'eva_nombres'); ?>
				    </div>
			    </div>
			    <div class="col-md-6 marg">
				    <div class="col-lg-12">
				    	<?php echo $form->labelEx($model,'eva_apellidos'); ?>
				    </div>
				    <div class="col-lg-12">
				    	<?php echo $form->textField($model,'eva_apellidos',array('size'=>60,'maxlength'=>255, 'class'=>'form-control bord')); ?>
				    	<?php echo $form->error($model,'eva_apellidos'); ?>
				    </div>
				</div>
				<div class="col-md-6 marg">
				    <div class="col-lg-12">
				    	<?php echo $form->labelEx($model,'eva_comuna'); ?>
				    </div>
				    <div class="col-lg-12">
				    	<?php echo $form->textField($model,'eva_comuna',array('size'=>60,'maxlength'=>255, 'class'=>'form-control bord')); ?>
				    	<?php echo $form->error($model,'eva_comuna'); ?>
				    </div>
			    </div>
			    <div class="col-md-6 marg">
					<div class="col-lg-12">
				    	<?php echo $form->labelEx($model,'eva_fundo'); ?>
				    </div>
				    <div class="col-lg-12">
				    	<?php echo $form->dropDownList($model,'eva_fundo',CHtml::listData(Fundo::model()->findAll("fun_eess = '".$model->eess_rut."'"), 'fun_nombre', 'fun_nombre'),array('prompt'=>' ','class'=>'form-control bord')); ?>
				    	<!--?php echo $form->textField($model,'eva_fundo',array('size'=>60,'maxlength'=>255, 'class'=>'form-control bord')); ?-->
				    	<?php echo $form->error($model,'eva_fundo'); ?>
				    </div>
				</div>
				
				
				
				
				<div class="col-md-6 marg">
					<div class="col-lg-12">
				    	<?php echo $form->labelEx($model,'eva_licencia_conducir_clase'); ?>
				    </div>
				    <div class="col-lg-12">
				    	<?php echo $form->textField($model,'eva_licencia_conducir_clase',array('size'=>60,'maxlength'=>255, 'class'=>'form-control bord')); ?>
				    	<?php echo $form->error($model,'eva_licencia_conducir_clase'); ?>
				    </div>
				</div>
				<div class="col-md-6 marg">
					<div class="col-lg-12">
				    	<?php echo $form->labelEx($model,'eva_licencia_conducir_vencimiento'); ?>
				    </div>
				    <div class="col-lg-12">
				    	<?php echo $form->dateField($model,'eva_licencia_conducir_vencimiento',array('size'=>60,'maxlength'=>255, 'class'=>'form-control bord')); ?>
				    	<?php echo $form->error($model,'eva_licencia_conducir_vencimiento'); ?>
				    </div>
				</div>
			</div>



			<div class="col-lg-6">
				<div class="col-md-6 marg">
					<div class="col-lg-12">
				    	<?php echo $form->labelEx($model,'eva_faena'); ?>
				    </div>
				    <div class="col-lg-12">
				    	<?php echo $form->dropDownList($model,'eva_faena',CHtml::listData(Faena::model()->findAll("eess_rut = '".$model->eess_rut."'"), 'fae_nombre', 'fae_nombre'),array('prompt'=>' ','class'=>'form-control bord'));?>
				    	<!--?php echo $form->textField($model,'eva_faena',array('size'=>60,'maxlength'=>255, 'class'=>'form-control bord')); ?-->
				    	<?php echo $form->error($model,'eva_faena'); ?>
				    </div>
			    </div>
			    <div class="col-md-6 marg">
					<div class="col-lg-12">
				    	<?php echo $form->labelEx($model,'eva_jefe_faena'); ?>
				    </div>
				    <div class="col-lg-12">
				    	<?php echo $form->textField($model,'eva_jefe_faena',array('size'=>60,'maxlength'=>255, 'class'=>'form-control bord')); ?>
				    	<?php echo $form->error($model,'eva_jefe_faena'); ?>
				    </div>
				</div>
				<div class="col-md-6 marg">
				    <div class="col-lg-12">
				    	<?php echo $form->labelEx($model,'eva_supervisor'); ?>
				    </div>
				    <div class="col-lg-12">
				    	<?php echo $form->textField($model,'eva_supervisor',array('size'=>60,'maxlength'=>255, 'class'=>'form-control bord')); ?>
				    	<?php echo $form->error($model,'eva_supervisor'); ?>
				    </div>
				</div>
				<div class="col-md-6 marg">
				    <div class="col-lg-12">
				    	<?php echo $form->labelEx($model,'eva_linea'); ?>
				    </div>
				    <div class="col-lg-12">
				    	<?php echo $form->textField($model,'eva_linea',array('class'=>'form-control bord')); ?>
				    	<?php echo $form->error($model,'eva_linea'); ?>
				    </div>
				</div>
			    
			    <div class="col-lg-12">
			    	<?php echo $form->labelEx($model,'eva_tipo_cosecha'); ?>
			    </div>
			    <div class="col-lg-12">
			    	<?php echo $form->textField($model,'eva_tipo_cosecha',array('size'=>60,'maxlength'=>255, 'class'=>'form-control bord')); ?>
			    	<?php echo $form->error($model,'eva_tipo_cosecha'); ?>
			    </div>
			    <div class="col-md-6 marg">
				    <div class="col-lg-12">
				    	<?php echo $form->labelEx($model,'eva_vencimiento_corma'); ?>
				    </div>
				    <div class="col-lg-12">
				    	<?php echo $form->dateField($model,'eva_vencimiento_corma',array('size'=>12,'maxlength'=>12, 'class'=>'form-control bord')); ?>
				    	<?php echo $form->error($model,'eva_vencimiento_corma'); ?>
				    </div>
				</div>
			    
				
			
			
			<!--div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'eva_evaluador'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'eva_evaluador',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'eva_evaluador'); ?>
			    </div>
			</div-->	
			
			<!--div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'eva_geo_x'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'eva_geo_x',array('class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'eva_geo_x'); ?>
			    </div>
			</div-->
			
			<!--div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'eva_geo_y'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'eva_geo_y',array('class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'eva_geo_y'); ?>
			    </div>
			</div-->
			
			
				
			
				
			</div>
		</div>
	</div>
			
			<!--div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'eva_cache_porcentaje'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'eva_cache_porcentaje',array('class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'eva_cache_porcentaje'); ?>
			    </div>
			</div-->
			
			<div class="row">
				<div class="col-sm-12">
					<script type="text/javascript">
					<?php
					if($model->isNewRecord){
						$rows = Yii::app()->db->createCommand("SELECT * FROM min_pregunta")->query()->readAll();
						echo "var items = ".json_encode($rows).";";
						?>
						var inputs = [];
						function updateitems(){
							document.getElementById('items').innerHTML = '';
							for(i=0;i<items.length;i++){
								if(document.getElementById('Evaluacion_eva_tipo').value == items[i]['car_id'])
								document.getElementById('items').innerHTML += '<tr onclick="mostraredicion('+items[i]['pre_id']+')"><td><small>'+items[i]['pre_enunciado']+'</small></td><td><input required name="p_'+items[i]['pre_id']+'" type="radio" value="si"> <small>si</small></td><td><input required name="p_'+items[i]['pre_id']+'" type="radio" value="no"> <small>no</small></td><td><input required name="p_'+items[i]['pre_id']+'" type="radio" value="n/a"> <small>n/a</small></td></tr>';
							}
						}
						setTimeout(updateitems,1000);
					<?php
					}
					?>
					</script>
					<table id="items" class="table table-collapse">
						<?php
						if(!$model->isNewRecord){
							$rows = Yii::app()->db->createCommand("SELECT * FROM min_respuesta WHERE eva_id = '".$model->eva_id."'")->query()->readAll();
							//print_r($rows);
							for($i=0;$i<count($rows);$i++){
								$checked_si = '';
								$checked_no = '';
								$checked_na = '';
								if($rows[$i]['res_respuesta'] == 'si'){$checked_si = 'checked';}
								if($rows[$i]['res_respuesta'] == 'no'){$checked_no = 'checked';}
								if($rows[$i]['res_respuesta'] == 'n/a'){$checked_na = 'checked';}
								echo '
								<tr onclick="mostraredicion('.$rows[$i]['res_id'].')">
									<td>
										<small>'.$rows[$i]['res_enunciado'].'</small>
										<div class="ediciones" id="edicion'.$rows[$i]['res_id'].'" style="background:#f3f3f3; border-radius:3px; display:none;">
											<table style="width:100%;">
												<tr>
													<td valign="top"><small>Imagen</small><input name="a_'.$rows[$i]['res_id'].'" type="file" class="input-sm"></td>
													<td valign="top"><small>Plazo</small><input name="f_'.$rows[$i]['res_id'].'" class="form-control input-sm" type="date" value="'.$rows[$i]['res_plazo'].'"></td>
												</tr>
												<tr>
													<td colspan="2"><small>Observación</small><textarea name="o_'.$rows[$i]['res_id'].'" class="form-control input-sm">'.$rows[$i]['res_observacion'].'</textarea></td>
												</tr>
											</table>
										</div>
									</td>
									<td><input required name="p_'.$rows[$i]['res_id'].'" '.$checked_si.' type="radio" value="si"> <small>si</small></td>
									<td><input required name="p_'.$rows[$i]['res_id'].'" '.$checked_no.' type="radio" value="no"> <small>no</small></td>
									<td><input required name="p_'.$rows[$i]['res_id'].'" '.$checked_na.' type="radio" value="n/a"> <small>n/a</small></td>
								</tr>';
							}
						}
						?>
					</table>
					<script>
					function mostraredicion(id){
						cerrar();
						document.getElementById('edicion'+id).style.display = 'block';
					}
					function cerrar(){
						elems = document.getElementsByClassName('ediciones');
						for(i=0;i<elems.length;i++){
							elems[i].style.display = 'none';
						}
					}
					</script>
				</div>
			</div>
			
						<div class="form-group">
							
				
				<div class="col-md-12 marg">
					<div class="col-lg-12">
				    	<?php echo $form->labelEx($model,'eva_general_observacion'); ?>
				    </div>
				    <div class="col-lg-12">
				    	<?php echo $form->textArea($model,'eva_general_observacion',array('size'=>60,'maxlength'=>255, 'class'=>'form-control bord')); ?>
				    	<?php echo $form->error($model,'eva_general_observacion'); ?>
				    </div>
			    </div>			
							
							
							
				<div class="col-md-12 marg" >
					<div class="col-lg-12" style="margin-top: 10px; text-align: right; padding-right: 40px;">
					<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', array('class'=>'btn btn-sm btn-default','style'=>'background-color: #f8b53d; color: white !important; padding-top: 10px; padding-bottom: 10px; padding-left: 60px; padding-right: 60px; border-radius: 5px;')); ?>
						
					</div>
				<div class="col-md-6 marg">
				</div>	
			</div>
			</div>
			<?php $this->endWidget(); ?>
    	</div>
	</div>
</section>
