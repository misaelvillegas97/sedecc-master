<section class="panel panel-default">
	<header class="panel-heading font-bold">Buscar</header>
	<div class="panel-body">
		<div class="bs-example form-horizontal">
						<?php
			/* @var $this UsuarioController */
			/* @var $model Usuario */
			/* @var $form CActiveForm */
			?>
			
			<div class="wide form">
			
			<?php $form=$this->beginWidget('CActiveForm', array(
				'action'=>Yii::app()->createUrl($this->route),
				'method'=>'get',
			)); ?>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'usu_id'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'usu_id',array('class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'usu_creado'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'usu_creado',array('class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'usu_acceso_nombre'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'usu_acceso_nombre',array('size'=>50,'maxlength'=>50, 'class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'usu_acceso_contrasena'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'usu_acceso_contrasena',array('size'=>50,'maxlength'=>50, 'class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<!--div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'usu_tipo'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'usu_tipo',array('class'=>'form-control')); ?>
					</div>
				</div-->
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'usu_nombre'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'usu_nombre',array('size'=>50,'maxlength'=>50, 'class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'usu_apellido'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'usu_apellido',array('size'=>50,'maxlength'=>50, 'class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'usu_email'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'usu_email',array('size'=>50,'maxlength'=>50, 'class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'usu_telefono'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'usu_telefono',array('size'=>50,'maxlength'=>50, 'class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'usu_direccion'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'usu_direccion',array('size'=>50,'maxlength'=>50, 'class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'usu_ultimo_acceso'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'usu_ultimo_acceso',array('class'=>'form-control')); ?>
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
