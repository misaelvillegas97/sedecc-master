<section class="panel panel-default">
	<!--header class="panel-heading font-bold">Horizontal form</header-->
	<div class="panel-body">
		<div class="bs-example form-horizontal">
						<?php
			/* @var $this MensajeController */
			/* @var $model Mensaje */
			/* @var $form CActiveForm */
			?>
			
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'mensaje-form',
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
			    	<?php echo $form->labelEx($model,'men_creado'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'men_creado',array('class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'men_creado'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'men_emisor'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'men_emisor',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'men_emisor'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'mes_mensaje'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textArea($model,'mes_mensaje',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'mes_mensaje'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'men_imagen_1'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textArea($model,'men_imagen_1',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'men_imagen_1'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'men_imagen_2'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textArea($model,'men_imagen_2',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'men_imagen_2'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'men_imagen_3'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textArea($model,'men_imagen_3',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'men_imagen_3'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'men_imagen_4'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textArea($model,'men_imagen_4',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'men_imagen_4'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'men_imagen_5'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textArea($model,'men_imagen_5',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'men_imagen_5'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'men_imagen_6'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textArea($model,'men_imagen_6',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'men_imagen_6'); ?>
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
