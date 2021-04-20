<section class="panel panel-default">
	<!--header class="panel-heading font-bold">Horizontal form</header-->
	<div class="panel-body">
		<div class="bs-example form-horizontal">
						<?php
			/* @var $this FormulariobitacoraController */
			/* @var $model Formulariobitacora */
			/* @var $form CActiveForm */
			?>
			
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'formulariobitacora-form',
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
			    	<?php echo $form->labelEx($model,'bit_tiempo'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'bit_tiempo',array('class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'bit_tiempo'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'eess_rut'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'eess_rut',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'eess_rut'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'bit_nombre'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'bit_nombre',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'bit_nombre'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'bit_n_campos'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'bit_n_campos',array('class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'bit_n_campos'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'bit_campos'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'bit_campos',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'bit_campos'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'bit_nombre_campos'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'bit_nombre_campos',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'bit_nombre_campos'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'bit_campos_values'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'bit_campos_values',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'bit_campos_values'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'bit_campos_requeridos'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'bit_campos_requeridos',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'bit_campos_requeridos'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-offset-2 col-lg-10">
					<!--<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', array('class'=>'btn btn-sm btn-default')); ?>-->
						<div class="col-lg-12" style="margin-top: 10px; text-align: right; padding-right: 40px;">
					<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', array('class'=>'btn btn-sm btn-default','style'=>'background-color: #f8b53d; color: white !important; padding-top: 10px; padding-bottom: 10px; padding-left: 60px; padding-right: 60px; border-radius: 5px;')); ?>
				</div>
			</div>
			<?php $this->endWidget(); ?>
    	</div>
	</div>
</section>
