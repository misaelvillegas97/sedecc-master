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
			/* @var $this EvalInstalacionesController */
			/* @var $model EvalInstalaciones */
			/* @var $form CActiveForm */
			?>

			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'eval-instalaciones-form',
				'htmlOptions'=>array('enctype'=>'multipart/form-data'),
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// There is a call to performAjaxValidation() commented in generated controller code.
				// See class documentation of CActiveForm for details on this.
				'enableAjaxValidation'=>false,
			)); ?>
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
				<div class="col-md-6 marg">
					<div class="col-lg-12">
							<?php echo $form->labelEx($model,'eva_tipo'); ?>
						</div>
						<div class="col-lg-12">
							<?php $disabled = false; if(!$model->isNewRecord) $disabled = true;?>
							<?php echo $form->dropDownList($model,'eva_tipo',CHtml::listData(Yii::app()->db->createCommand("SELECT * FROM min_pregunta WHERE tipo_checklist='instalaciones'")->query()->readAll(), 'car_id', 'car_id'),array('class'=>'form-control bord','disabled'=>$disabled));?>
							<!--?php echo $form->textField($model,'eva_tipo',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?-->
							<?php echo $form->error($model,'eva_tipo'); ?>
						</div>
					</div>

					<div class="col-md-6 marg">
							<div class="col-lg-12">
						    	<?php echo $form->labelEx($model,'eva_gerente_general'); ?>
						    </div>
						    <div class="col-lg-12">
						    	<?php echo $form->textField($model,'eva_gerente_general',array('size'=>60,'maxlength'=>255, 'class'=>'form-control bord')); ?>
						    	<?php echo $form->error($model,'eva_gerente_general'); ?>
						    </div>
					</div>
					<div class="col-md-6 marg">
						<div class="col-md-6 marg">
							<div class="col-lg-12">
								<?php echo $form->labelEx($model,'eva_cod_faena'); ?>
							</div>
							<div class="col-lg-12">
								<?php $disabled = false; if(!$model->isNewRecord) $disabled = true;?>
								<?php echo $form->dropDownList($model,'eva_cod_faena',CHtml::listData(Yii::app()->db->createCommand("SELECT * FROM min_codigos_faenas ")->query()->readAll(), 'cod_faenas', 'nombre_faenas'),array('class'=>'form-control bord','disabled'=>$disabled));?>
								<!--?php echo $form->textField($model,'eva_tipo',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?-->
								<?php echo $form->error($model,'eva_cod_faena'); ?>
							</div>
						</div>
							<div class="col-md-6 marg">
		 					 <div class="col-lg-12">
							    	<?php echo $form->labelEx($model,'eva_num_trabajadores'); ?>
							    </div>
							    <div class="col-lg-12">
							    	<?php echo $form->numberField($model,'eva_num_trabajadores',array('size'=>60,'maxlength'=>255, 'class'=>'form-control bord')); ?>
							    	<?php echo $form->error($model,'eva_num_trabajadores'); ?>
							    </div>
							</div>

					</div>

					<div class="col-md-6 marg">
						<div class="col-lg-12">
					    	<?php echo $form->labelEx($model,'eva_gerente_operacion'); ?>
					    </div>
					     <div class="col-lg-12">
					    	<?php echo $form->textField($model,'eva_gerente_operacion',array('size'=>60,'maxlength'=>255, 'class'=>'form-control bord')); ?>
					    	<?php echo $form->error($model,'eva_gerente_operacion'); ?>
					    </div>
					</div>
					<div class="col-md-6 marg">
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
									<?php echo $form->labelEx($model,'eva_num_personas'); ?>
								</div>
								 <div class="col-lg-12">
									<?php echo $form->numberField($model,'eva_num_personas',array('size'=>60,'maxlength'=>255, 'class'=>'form-control bord')); ?>
									<?php echo $form->error($model,'eva_num_personas'); ?>
								</div>
						</div>
					</div>
			<div class="col-md-6 marg">
				<div class="col-lg-12">
			    	<?php echo $form->labelEx($model,'eva_administrador'); ?>
			    </div>
			   <div class="col-lg-12">
			    	<?php echo $form->textField($model,'eva_administrador',array('size'=>60,'maxlength'=>255, 'class'=>'form-control bord')); ?>
			    	<?php echo $form->error($model,'eva_administrador'); ?>
			    </div>
			</div>


			<div class="col-md-6 marg">
				<div class="col-lg-12">
			    	<?php echo $form->labelEx($model,'eva_fundo'); ?>
			    </div>
			     <div class="col-lg-12">
			    	<?php echo $form->textField($model,'eva_fundo',array('size'=>60,'maxlength'=>255, 'class'=>'form-control bord')); ?>
			    	<?php echo $form->error($model,'eva_fundo'); ?>
			    </div>
			</div>
			<!--<div class="col-md-6 marg">
				<div class="col-lg-12">
			    	<?php echo $form->labelEx($model,'eva_faena'); ?>
			    </div>
			     <div class="col-lg-12">
			    	<?php echo $form->textField($model,'eva_faena',array('size'=>60,'maxlength'=>255, 'class'=>'form-control bord')); ?>
			    	<?php echo $form->error($model,'eva_faena'); ?>
			    </div>
			</div>
		-->
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
			    	<?php echo $form->labelEx($model,'eva_apr'); ?>
			    </div>
			    <div class="col-lg-12">
			    	<?php echo $form->textField($model,'eva_apr',array('size'=>60,'maxlength'=>255, 'class'=>'form-control bord')); ?>
			    	<?php echo $form->error($model,'eva_apr'); ?>
			    </div>
			</div>
			<div class="col-lg-12">
			    <?php echo $form->labelEx($model,'eva_general_observacion'); ?>
			</div>
			<div class="col-lg-12">
			    <?php echo $form->textArea($model,'eva_general_observacion',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
			    <?php echo $form->error($model,'eva_general_observacion'); ?>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<script type="text/javascript">
					<?php
					if($model->isNewRecord){
						$rows = Yii::app()->db->createCommand("SELECT * FROM min_pregunta WHERE tipo_checklist='instalaciones'")->query()->readAll();
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
							$rows = Yii::app()->db->createCommand("SELECT * FROM min_respuesta_instalaciones WHERE eva_id = '".$model->eva_id."'")->query()->readAll();
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
				<div class="col-lg-offset-2 col-lg-10">
					<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', array('class'=>'btn btn-sm btn-default')); ?>
				</div>
			</div>
			<?php $this->endWidget(); ?>
    	</div>
	</div>
</section>
