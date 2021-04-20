<section class="panel panel-default">
	<!--header class="panel-heading font-bold">Horizontal form</header-->
	<div class="panel-body">
		<div class="bs-example form-horizontal">
						<?php
			/* @var $this FacturaController */
			/* @var $model Factura */
			/* @var $form CActiveForm */
			?>
			
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'factura-form',
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
			    	<?php echo $form->labelEx($model,'id_rango'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'id_rango',array('size'=>7,'maxlength'=>7, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'id_rango'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'rango_trabajador'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'rango_trabajador',array('size'=>8,'maxlength'=>8, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'rango_trabajador'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'fijo_uf'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'fijo_uf',array('size'=>5,'maxlength'=>5, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'fijo_uf'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'variableuf_tra'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'variableuf_tra',array('size'=>5,'maxlength'=>5, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'variableuf_tra'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'checklist'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'checklist',array('size'=>2,'maxlength'=>2, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'checklist'); ?>
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
