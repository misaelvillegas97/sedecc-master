<section class="panel panel-default">
	<header class="panel-heading font-bold">Buscar</header>
	<div class="panel-body">
		<div class="bs-example form-horizontal">
						<?php
			/* @var $this RespuestaController */
			/* @var $model Respuesta */
			/* @var $form CActiveForm */
			?>
			
			<div class="wide form">
			
			<?php $form=$this->beginWidget('CActiveForm', array(
				'action'=>Yii::app()->createUrl($this->route),
				'method'=>'get',
			)); ?>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'res_id'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'res_id',array('class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'res_tiempo'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'res_tiempo',array('class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'res_enunciado'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'res_enunciado',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'res_respuesta'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'res_respuesta',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'res_ponderacion'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'res_ponderacion',array('class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'pre_id'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'pre_id',array('class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'car_id'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'car_id',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'tem_id'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'tem_id',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'res_observacion'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'res_observacion',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'res_foto'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textArea($model,'res_foto',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'eva_id'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'eva_id',array('class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'res_seguimiento'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'res_seguimiento',array('class'=>'form-control')); ?>
					</div>
				</div>
			
						
				<div class="form-group">
					<div class="col-lg-offset-2 col-lg-10">
						<?php echo CHtml::submitButton('Buscar', array('class'=>'btn btn-sm btn-default')); ?>
					</div>
				</div>
				
			<?php $this->endWidget(); ?>
			
			</div><!-- search-form -->

		</div>
	</div>
</section>
