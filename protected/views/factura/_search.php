<section class="panel panel-default">
	<header class="panel-heading font-bold">Buscar</header>
	<div class="panel-body">
		<div class="bs-example form-horizontal">
						<?php
			/* @var $this FacturaController */
			/* @var $model Factura */
			/* @var $form CActiveForm */
			?>
			
			<div class="wide form">
			
			<?php $form=$this->beginWidget('CActiveForm', array(
				'action'=>Yii::app()->createUrl($this->route),
				'method'=>'get',
			)); ?>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'id_rango'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'id_rango',array('size'=>7,'maxlength'=>7, 'class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'rango_trabajador'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'rango_trabajador',array('size'=>8,'maxlength'=>8, 'class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'fijo_uf'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'fijo_uf',array('size'=>5,'maxlength'=>5, 'class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'variableuf_tra'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'variableuf_tra',array('size'=>5,'maxlength'=>5, 'class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'checklist'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'checklist',array('size'=>2,'maxlength'=>2, 'class'=>'form-control')); ?>
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
