<section class="panel panel-default">
	<header class="panel-heading font-bold">Buscar</header>
	<div class="panel-body">
		<div class="bs-example form-horizontal">
						<?php
			/* @var $this PreguntaController */
			/* @var $model Pregunta */
			/* @var $form CActiveForm */
			?>

			<div class="wide form">

			<?php $form=$this->beginWidget('CActiveForm', array(
				'action'=>Yii::app()->createUrl($this->route),
				'method'=>'get',
			)); ?>


				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'pre_id'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->numberField($model,'pre_id',array('class'=>'form-control')); ?>
					</div>
				</div>


				<!--div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'eess_rut'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->dropDownList($model,'eess_rut',CHtml::listData(Eess::model()->findAll('eess_estado=1'), 'eess_rut', 'eess_nombre_corto'),array('prompt'=>' ','class'=>'form-control'));?>
			    	</div>
				</div-->


				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'pre_enunciado'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'pre_enunciado',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
					</div>
				</div>


				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'pre_ponderacion'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->numberField($model,'pre_ponderacion',array('class'=>'form-control')); ?>
					</div>
				</div>


				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'tem_id'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->dropDownList($model,'tem_id',CHtml::listData(Tematica::model()->findAll(), 'tem_descripcion', 'tem_descripcion'),array('prompt'=>' ','class'=>'form-control'));?>
			    		<!--?php echo $form->textField($model,'tem_id',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?-->
					</div>
				</div>


				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'car_id'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->dropDownList($model,'car_id',CHtml::listData(Cargo::model()->findAll(), 'car_descripcion', 'car_descripcion'),array('prompt'=>' ','class'=>'form-control'));?>
			    		<!--?php echo $form->textField($model,'car_id',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?-->
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'tipo_checklist'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'tipo_checklist',array('class'=>'form-control')); ?>
					</div>
				</div>


				<div class="form-group">
					<!--<div class="col-lg-offset-2 col-lg-10">
						<?php echo CHtml::submitButton('Buscar', array('class'=>'btn btn-sm btn-default')); ?>
					</div>-->
					<div class="col-lg-12" style="margin-top: 10px; text-align:right;">
						<?php echo CHtml::submitButton('Buscar', array('class'=>'btn btn-sm btn-default','style'=>'background-color: #f8b53d; color: white !important; padding-top: 10px; padding-bottom: 10px; padding-left: 60px; padding-right: 60px; border-radius: 5px;')); ?>
					</div>
				</div>

			<?php $this->endWidget(); ?>

			</div><!-- search-form -->

		</div>
	</div>
</section>
