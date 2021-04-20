<section class="panel panel-default">
	<!--header class="panel-heading font-bold">Horizontal form</header-->
	<div class="panel-body">
		<div class="bs-example form-horizontal">
						<?php
			/* @var $this UsuarioController */
			/* @var $model Usuario */
			/* @var $form CActiveForm */
			?>
			
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'usuario-form',
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
			    	<?php echo $form->labelEx($model,'usu_acceso_nombre'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'usu_acceso_nombre',array('size'=>50,'maxlength'=>50, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'usu_acceso_nombre'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'usu_acceso_contrasena'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'usu_acceso_contrasena',array('size'=>50,'maxlength'=>50, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'usu_acceso_contrasena'); ?>
			    </div>
			</div>
			
			<!--div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'usu_tipo'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'usu_tipo',array('class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'usu_tipo'); ?>
			    </div>
			</div-->
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'usu_nombre'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'usu_nombre',array('size'=>50,'maxlength'=>50, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'usu_nombre'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'usu_apellido'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'usu_apellido',array('size'=>50,'maxlength'=>50, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'usu_apellido'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'usu_email'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'usu_email',array('size'=>50,'maxlength'=>50, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'usu_email'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'usu_telefono'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'usu_telefono',array('size'=>50,'maxlength'=>50, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'usu_telefono'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'usu_direccion'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'usu_direccion',array('size'=>50,'maxlength'=>50, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'usu_direccion'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'usu_ultimo_acceso'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'usu_ultimo_acceso',array('class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'usu_ultimo_acceso'); ?>
			    </div>
			</div>
			
			<div class="col-md-12 marg" >
					<div class="col-lg-12" style="margin-top: 10px; text-align: right; padding-right: 40px;">
					<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', array('class'=>'btn btn-sm btn-default','style'=>'background-color: #f8b53d; color: white !important; padding-top: 10px; padding-bottom: 10px; padding-left: 60px; padding-right: 60px; border-radius: 5px;')); ?>
						
					</div>
				<div class="col-md-6 marg">
				</div>	
			</div>
			<?php $this->endWidget(); ?>
    	</div>
	</div>
</section>
