<section class="panel panel-default">
	<header class="panel-heading font-bold">Buscar</header>
	<div class="panel-body">
		<div class="bs-example form-horizontal">
						<?php
			/* @var $this EquiposController */
			/* @var $model Equipos */
			/* @var $form CActiveForm */
			?>
			
			<div class="wide form">
			
			<?php $form=$this->beginWidget('CActiveForm', array(
				'action'=>Yii::app()->createUrl($this->route),
				'method'=>'get',
			)); ?>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'eq_codigo'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'eq_codigo',array('size'=>25,'maxlength'=>25, 'class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'eq_maquina'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'eq_maquina',array('size'=>25,'maxlength'=>25, 'class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'eq_marca'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'eq_marca',array('size'=>25,'maxlength'=>25, 'class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'eq_modelo'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'eq_modelo',array('size'=>25,'maxlength'=>25, 'class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'eq_tipo'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'eq_tipo',array('size'=>25,'maxlength'=>25, 'class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'eq_ano'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'eq_ano',array('class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'eess_rut'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'eess_rut',array('size'=>50,'maxlength'=>50, 'class'=>'form-control')); ?>
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
