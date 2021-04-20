<section class="panel panel-default">
	<header class="panel-heading font-bold">Buscar</header>
	<div class="panel-body">
		<div class="bs-example form-horizontal">
						<?php
			/* @var $this EessController */
			/* @var $model Eess */
			/* @var $form CActiveForm */
			?>
			
			<div class="wide form">
			
			<?php $form=$this->beginWidget('CActiveForm', array(
				'action'=>Yii::app()->createUrl($this->route),
				'method'=>'get',
			)); ?>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'eess_rut'); ?>
					</div>
					<div class="col-lg-2">
						<?php echo $form->numberField($model,'eess_rut',array('style'=>'box-shadow: none; -webkit-box-shadow: none;', 'size'=>20,'maxlength'=>20, 'class'=>'form-control bord')); ?>
					</div>
					<div class="col-lg-1 control-label">
						<?php echo $form->labelEx($model,'eess_nombre_corto'); ?>
					</div>
					<div class="col-lg-7">
						<?php echo $form->textField($model,'eess_nombre_corto',array('style'=>'text-transform: uppercase; box-shadow: none; -webkit-box-shadow: none;', 'size'=>60,'maxlength'=>150, 'class'=>'form-control bord')); ?>
					</div>
				</div>
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'eess_razon_social'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'eess_razon_social',array('style'=>'text-transform: uppercase; box-shadow: none; -webkit-box-shadow: none;', 'size'=>60,'maxlength'=>250, 'class'=>'form-control bord')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'eess_ciudad'); ?>
					</div>
					<div class="col-lg-2">
						<?php echo $form->textField($model,'eess_ciudad',array('style'=>'text-transform: uppercase; box-shadow: none; -webkit-box-shadow: none;', 'size'=>60,'maxlength'=>200, 'class'=>'form-control bord')); ?>
					</div>
					<div class="col-lg-1 control-label">
						<?php echo $form->labelEx($model,'eess_telefono'); ?>
					</div>
					<div class="col-lg-3">
						<?php echo $form->numberField($model,'eess_telefono',array('style'=>'box-shadow: none; -webkit-box-shadow: none;', 'size'=>60,'maxlength'=>200, 'class'=>'form-control bord')); ?>
					</div>
					<div class="col-lg-1 control-label">
						<?php echo $form->labelEx($model,'eess_email'); ?>
					</div>
					<div class="col-lg-3">
						<?php echo $form->emailField($model,'eess_email',array('style'=>'text-transform: uppercase; box-shadow: none; -webkit-box-shadow: none;', 'size'=>60,'maxlength'=>250, 'class'=>'form-control bord')); ?>
					</div>
				</div>
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'eess_creado'); ?>
					</div>
					<div class="col-lg-2">
						<?php echo $form->dateField($model,'eess_creado',array('style'=>'uppercase; box-shadow: none; -webkit-box-shadow: none;', 'class'=>'form-control bord')); ?>
					</div>
					<div class="col-lg-1 control-label">
						<?php echo $form->labelEx($model,'eess_estado'); ?>
					</div>
					<div class="col-lg-3">
						<?php echo $form->dropDownList($model,'eess_estado',array('1'=>'Activo','0'=>'Inactivo'),array('style'=>'text-transform: uppercase; box-shadow: none; -webkit-box-shadow: none;', 'class'=>'form-control bord'));?>
						<!--?php echo $form->textField($model,'eess_estado',array('size'=>20,'maxlength'=>20, 'class'=>'form-control')); ?-->
					</div>
				</div>
			
				<h3 class="page-header">Información de representante</h3>
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'eess_representante'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'eess_representante',array('style'=>'text-transform: uppercase; box-shadow: none; -webkit-box-shadow: none;', 'size'=>60,'maxlength'=>200, 'class'=>'form-control bord')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
                        <?php # echo $form->labelEx($model,'eess_representante_telefono'); ?>
                        <label for="Eess_eess_representante_telefono">Teléfono</label>
					</div>
					<div class="col-lg-2">
						<?php echo $form->numberField($model,'eess_representante_telefono',array('style'=>'box-shadow: none; -webkit-box-shadow: none;', 'size'=>60,'maxlength'=>200, 'class'=>'form-control bord')); ?>
					</div>
					<div class="col-lg-1 control-label">
                        <?php # echo $form->labelEx($model,'eess_representante_email'); ?>
                        <label for="Eess_eess_representante_email">Email</label>
					</div>
					<div class="col-lg-7">
						<?php echo $form->emailField($model,'eess_representante_email',array('style'=>'text-transform: uppercase; box-shadow: none; -webkit-box-shadow: none;', 'size'=>60,'maxlength'=>255, 'class'=>'form-control bord')); ?>
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
