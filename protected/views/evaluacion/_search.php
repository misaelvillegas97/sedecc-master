<section class="panel panel-default">
	<header class="panel-heading font-bold">Buscar</header>
	<div class="panel-body">
		<div class="bs-example form-horizontal">
						<?php
			/* @var $this EvaluacionController */
			/* @var $model Evaluacion */
			/* @var $form CActiveForm */
			?>
			
			<div class="wide form">
			
			<?php $form=$this->beginWidget('CActiveForm', array(
				'action'=>Yii::app()->createUrl($this->route),
				'method'=>'get',
			)); ?>
			
			<style type="text/css">
				.marg{
					padding-left: 0px !important;
					padding-right: 0px !important;
				}
			</style>

			<div class="col-lg-12">		
				<div class="col-lg-6">

					<div class="col-lg-12">
						<?php echo $form->labelEx($model,'eva_id'); ?>
					</div>
					<div class="col-lg-12">
						<?php echo $form->numberField($model,'eva_id',array('class'=>'form-control')); ?>
					</div>

					<div class="col-lg-12">
						<?php echo $form->labelEx($model,'eva_tipo'); ?>
					</div>
					<div class="col-lg-12">
						<?php echo $form->dropDownList($model,'eva_tipo',CHtml::listData(Yii::app()->db->createCommand("SELECT * FROM min_pregunta")->query()->readAll(), 'car_id', 'car_id'),array('prompt'=>' ','class'=>'form-control'));?>
			    		<!--?php echo $form->textField($model,'eva_tipo',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?-->
					</div>

					<?php $style = ''; if(Yii::app()->controller->usertype() == 1) $style = 'display:none;';?>				
					<div class="col-lg-12" style="<?php echo $style;?>">
						<?php echo $form->labelEx($model,'eess_rut'); ?>
					</div>
					<div class="col-lg-12" style="<?php echo $style;?>">
						<!--?php echo $form->textField($model,'eess_rut',array('class'=>'form-control')); ?-->
				    	<?php $disabled = false; if(Yii::app()->controller->usertype() == 1) $disabled = true;?>
				    	<?php echo $form->dropDownList($model,'eess_rut',CHtml::listData(Eess::model()->findAll(array('order'=>'eess_nombre_corto','condition'=>'eess_estado=1')), 'eess_rut', 'eess_nombre_corto'),array('prompt'=>' ','class'=>'form-control'));?>
				    </div>
					<div class="col-md-6 marg">
						<div class="col-lg-12">
							<?php echo $form->labelEx($model,'tra_rut'); ?>
						</div>
						<div class="col-lg-12">
							<?php echo $form->numberField($model,'tra_rut',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
						</div>
					</div>

					<div class="col-md-6 marg">
						<div class="col-lg-12">
							<?php echo $form->labelEx($model,'eva_fecha_evaluacion'); ?>
						</div>
						<div class="col-lg-12">
							<?php echo $form->dateField($model,'eva_fecha_evaluacion',array('class'=>'form-control')); ?>
						</div>
					</div>
					<div class="col-lg-6 marg">
						<div class="col-lg-12">
							<?php echo $form->labelEx($model,'eva_nombres'); ?>
						</div>
						<div class="col-lg-12">
							<?php echo $form->textField($model,'eva_nombres',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
						</div>
					</div>
					<div class="col-lg-6 marg">
						<div class="col-lg-12">
							<?php echo $form->labelEx($model,'eva_apellidos'); ?>
						</div>
						<div class="col-lg-12">
							<?php echo $form->textField($model,'eva_apellidos',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
						</div>
					</div>

					
					<!--<div class="col-lg-12">
						<?php echo $form->labelEx($model,'eva_cache_porcentaje'); ?>
					</div>
					<div class="col-lg-12">
						<?php echo $form->numberField($model,'eva_cache_porcentaje',array('class'=>'form-control')); ?>
					</div>-->
				</div>



				<div class="col-lg-6">
					<div class="col-lg-6 marg">
						<!--<div class="col-lg-12">
							<?php echo $form->labelEx($model,'eva_creado'); ?>
						</div>
						<div class="col-lg-12">
							<?php echo $form->dateField($model,'eva_creado',array('class'=>'form-control')); ?>
						</div>-->
					</div>
					<div class="col-lg-12 marg">					
						<div class="col-lg-12 ">
							<?php echo $form->labelEx($model,'eva_evaluador'); ?>
						</div>
						<div class="col-lg-12">
							<?php echo $form->textField($model,'eva_evaluador',array('size'=>60,'maxlength'=>255, 'class'=>'form-control','placeholder'=>'Rut de evaluador(a)')); ?>
						</div>
					</div>
					
				<div class="col-lg-12">
						<?php echo $form->labelEx($model,'eva_faena'); ?>
					</div>
					<div class="col-lg-12">
						<?php echo $form->textField($model,'eva_faena',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
					</div>

					<div class="col-lg-12">
						<?php echo $form->labelEx($model,'eva_linea'); ?>
					</div>
					<div class="col-lg-12">
						<?php echo $form->numberField($model,'eva_linea',array('class'=>'form-control')); ?>
					</div>
					<div class="col-lg-6 marg">
						<div class="col-lg-12">
							<?php echo $form->labelEx($model,'eva_comuna'); ?>
						</div>
						<div class="col-lg-12">
							<?php echo $form->textField($model,'eva_comuna',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
						</div>
					</div>

					<div class="col-lg-6 marg">
						<div class="col-lg-12">
							<?php echo $form->labelEx($model,'eva_fundo'); ?>
						</div>
						<div class="col-lg-12">
							<?php echo $form->textField($model,'eva_fundo',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
						</div>
					</div>			
					<div class="col-lg-12">
						<?php echo $form->labelEx($model,'eva_jefe_faena'); ?>
					</div>
					<div class="col-lg-12">
						<?php echo $form->textField($model,'eva_jefe_faena',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
					</div>
					<div class="col-lg-12">
						<?php echo $form->labelEx($model,'eva_supervisor'); ?>
					</div>
					<div class="col-lg-12">
						<?php echo $form->textField($model,'eva_supervisor',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
					</div>


					<div class="col-lg-12">
						<?php echo $form->labelEx($model,'eva_tipo_cosecha'); ?>
					</div>
					<div class="col-lg-12">
						<?php echo $form->textField($model,'eva_tipo_cosecha',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
					</div>


					<div class="col-lg-12">
						<?php echo $form->labelEx($model,'eva_vencimiento_corma'); ?>
					</div>
					<div class="col-lg-12">
						<?php echo $form->dateField($model,'eva_vencimiento_corma',array('size'=>12,'maxlength'=>12, 'class'=>'form-control')); ?>
					</div>

					
					<!--<?php $style = ''; if(Yii::app()->controller->usertype() == 1) $style = 'display:none;';?>				
					<div class="col-lg-12" style="<?php echo $style;?>">
						<?php echo $form->labelEx($model,'eess_rut'); ?>
					</div>
					<div class="col-lg-12" style="<?php echo $style;?>">
						<!--?php echo $form->textField($model,'eess_rut',array('class'=>'form-control')); ?-->
				    	<!--<?php $disabled = false; if(Yii::app()->controller->usertype() == 1) $disabled = true;?>
				    	<?php echo $form->dropDownList($model,'eess_rut',CHtml::listData(Eess::model()->findAll(array('order'=>'eess_nombre_corto','condition'=>'eess_estado=1')), 'eess_rut', 'eess_nombre_corto'),array('prompt'=>' ','class'=>'form-control'));?>
				    </div>-->
					
				
												
			
					
					
					
				
					
					
					

					
					

			
										
				<!--div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'eva_geo_x'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'eva_geo_x',array('class'=>'form-control')); ?>
					</div>
				</div-->
			
										
				<!--div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'eva_geo_y'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'eva_geo_y',array('class'=>'form-control')); ?>
					</div>
				</div-->
			
										

					
					
					

					<!--<div class="col-lg-offset-2 col-lg-10" style="margin-top:30px;">
						
					</div>-->
					<div class="col-lg-12" style="margin-top: 10px; text-align:right;">
						<?php echo CHtml::submitButton('Buscar', array('class'=>'btn btn-sm btn-default','style'=>'background-color: #f8b53d; color: white !important; padding-top: 10px; padding-bottom: 10px; padding-left: 60px; padding-right: 60px; border-radius: 5px;')); ?>
					</div>
				</div>
				
			<?php $this->endWidget(); ?>
			
			</div><!-- search-form -->

		</div>
		</div>
	</div>
</section>
