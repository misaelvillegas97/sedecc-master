<section class="panel panel-default">
	<header class="panel-heading font-bold">Buscar</header>
	<div class="panel-body">
		<div class="bs-example form-horizontal">
						<?php
			/* @var $this ExcesosVelocidadController */
			/* @var $model ExcesosVelocidad */
			/* @var $form CActiveForm */
			?>
			
			<div class="wide form">
			
			<?php $form=$this->beginWidget('CActiveForm', array(
				'action'=>Yii::app()->createUrl($this->route),
				'method'=>'get',
			)); ?>
			
										
				<!--<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'exc_id'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'exc_id',array('class'=>'form-control')); ?>
					</div>
				</div>-->
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'tra_rut'); ?>
					</div>
					<div class="col-lg-10">
						<?php 
							$eess= '';
							if(Yii::app()->controller->usertype() == 1){
								$eess = Yii::app()->user->id;
								
							}
							else if(Yii::app()->controller->usertype() == 3){
								$eess = Yii::app()->db->createCommand("SELECT eess_rut FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
							}
							
							echo $form->dropDownList($model,'tra_rut',CHtml::listData(Yii::app()->db->createCommand("SELECT tra_rut,CONCAT(tra_nombres,' ',tra_apellidos) as nombre FROM min_trabajador where eess_rut ='".$eess."'  ")->query()->readAll(), 'tra_rut', 'nombre'),array('prompt'=>' ','class'=>'form-control'));?>
						<?php //echo $form->textField($model,'tra_rut',array('size'=>50,'maxlength'=>50, 'class'=>'form-control')); ?>
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-lg-2 control-label">
						Tipo de Exceso
					</div>
					<div class="col-lg-10">
						<?php 
							$eess= '';
							if(Yii::app()->controller->usertype() == 1){
								$eess = Yii::app()->user->id;
								
							}
							else if(Yii::app()->controller->usertype() == 3){
								$eess = Yii::app()->db->createCommand("SELECT eess_rut FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
							}
							
							echo $form->dropDownList($model,'var_nombre',CHtml::listData(Yii::app()->db->createCommand("SELECT * FROM min_modulo_variable mv
																				join min_modulo_variable_detalle mvd on mvd.mv_id= mv.mv_id
																				join min_variable_evaluacion ve on ve.var_id= mvd.var_id
																				WHERE mv.eess_rut = '".$eess."' 
																				and mv.mv_descripcion='Excesos de velocidad'")->query()->readAll(), 'var_nombre', 'var_nombre'),array('prompt'=>' ','class'=>'form-control'));?>
						<?php //echo $form->textField($model,'tra_rut',array('size'=>50,'maxlength'=>50, 'class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'exc_fecha'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'exc_fecha',array('class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'exc_zona'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'exc_zona',array('class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'veh_patente'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'veh_patente',array('size'=>50,'maxlength'=>50, 'class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<!--<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'exc_velocidad'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'exc_velocidad',array('class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<!--<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'exc_limite'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'exc_limite',array('class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'veh_codigoCamion'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'veh_codigoCamion',array('class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'exc_turno'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'exc_turno',array('size'=>50,'maxlength'=>50, 'class'=>'form-control')); ?>
					</div>
				</div>-->
			
						
				<div class="form-group">
					<!--<div class="col-lg-offset-2 col-lg-10">
						<?php echo CHtml::submitButton('Buscar', array('class'=>'btn btn-sm btn-default')); ?>
					</div>-->
					<div class="col-lg-12" style="margin-top: 10px; text-align: right;">
						<?php echo CHtml::submitButton('Buscar', array('class'=>'btn btn-sm btn-default','style'=>'background-color: #f8b53d; color: white !important; padding-top: 10px; padding-bottom: 10px; padding-left: 60px; padding-right: 60px; border-radius: 5px;')); ?>
					</div>
				</div>
				
			<?php $this->endWidget(); ?>
			
			</div><!-- search-form -->

		</div>
	</div>
</section>
