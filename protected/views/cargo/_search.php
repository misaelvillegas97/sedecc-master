<section class="panel panel-default">
	<header class="panel-heading font-bold">Buscar</header>
	<div class="panel-body">
		<div class="bs-example form-horizontal">
						<?php
			/* @var $this CargoController */
			/* @var $model Cargo */
			/* @var $form CActiveForm */
			?>
			
			<div class="wide form">
			
			<?php $form=$this->beginWidget('CActiveForm', array(
				'action'=>Yii::app()->createUrl($this->route),
				'method'=>'get',
			)); ?>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'car_id'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->numberField($model,'car_id',array('class'=>'form-control bord')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'car_creado'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->dateField($model,'car_creado',array('class'=>'form-control bord')); ?>
					</div>
				</div>
			
										
				<?php $style = ''; if(Yii::app()->controller->usertype() == 1) $style = 'display:none;';?>				
				<!--div class="form-group" style="<?php echo $style;?>">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'eess_rut'); ?>
					</div>
					<div class="col-lg-10">
						<?php $disabled = false; if(Yii::app()->controller->usertype() == 1 || Yii::app()->controller->usertype() == 3) $disabled = true;?>
			    		<?php echo $form->dropDownList($model,'eess_rut',CHtml::listData(Eess::model()->findAll('eess_estado=1'), 'eess_rut', 'eess_nombre_corto'),array('prompt'=>' ','class'=>'form-control bord'));?>
			    	</div>
				</div-->
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'car_descripcion'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'car_descripcion',array('size'=>60,'maxlength'=>255, 'class'=>'form-control bord')); ?>
					</div>
				</div>
			
						
				<div class="form-group">
				<!--	<div class="col-lg-offset-2 col-lg-10">
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
