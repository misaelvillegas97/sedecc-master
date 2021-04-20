<section class="panel panel-default">
	<header class="panel-heading font-bold">Buscar</header>
	<div class="panel-body">
		<div class="bs-example form-horizontal">
						<?php
			/* @var $this FundoController */
			/* @var $model Fundo */
			/* @var $form CActiveForm */
			?>
			
			<div class="wide form">
			
			<?php $form=$this->beginWidget('CActiveForm', array(
				'action'=>Yii::app()->createUrl($this->route),
				'method'=>'get',
			)); ?>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'fun_id'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'fun_id',array('class'=>'form-control')); ?>
					</div>
				</div>
			
								<!--		
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'fun_creado'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'fun_creado',array('class'=>'form-control')); ?>
					</div>
				</div>
				-->
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'fun_nombre'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'fun_nombre',array('size'=>60,'maxlength'=>100, 'class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'fun_comuna'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'fun_comuna',array('size'=>60,'maxlength'=>100, 'class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'fun_sector'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'fun_sector',array('size'=>60,'maxlength'=>100, 'class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'fun_region'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'fun_region',array('size'=>60,'maxlength'=>100, 'class'=>'form-control')); ?>
					</div>
				</div>
			
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'fun_admin'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'fun_admin',array('size'=>60,'maxlength'=>100, 'class'=>'form-control')); ?>
					</div>
				</div>
								
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'fun_activo'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'fun_activo',array('class'=>'form-control')); ?>
					</div>
				</div>
				
				
						
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
