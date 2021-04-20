<section class="panel panel-default">
	<!--header class="panel-heading font-bold">Horizontal form</header-->
	<div class="panel-body">
		<div class="bs-example form-horizontal">
						<?php
			/* @var $this EquiposController */
			/* @var $model Equipos */
			/* @var $form CActiveForm */
			?>
			
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'equipos-form',
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
			    	<?php echo $form->labelEx($model,'eq_codigo'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'eq_codigo',array('size'=>25,'maxlength'=>25, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'eq_codigo'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'eq_maquina'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'eq_maquina',array('size'=>25,'maxlength'=>25, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'eq_maquina'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'eq_marca'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'eq_marca',array('size'=>25,'maxlength'=>25, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'eq_marca'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'eq_modelo'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'eq_modelo',array('size'=>25,'maxlength'=>25, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'eq_modelo'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'eq_tipo'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'eq_tipo',array('size'=>25,'maxlength'=>25, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'eq_tipo'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'eq_ano'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'eq_ano',array('class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'eq_ano'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'eess_rut'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'eess_rut',array('size'=>50,'maxlength'=>50, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'eess_rut'); ?>
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
