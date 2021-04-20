<section class="panel panel-default">
	<!--header class="panel-heading font-bold">Horizontal form</header-->
	<div class="panel-body">
		<div class="bs-example form-horizontal">
						<?php
			/* @var $this EventoController */
			/* @var $model Evento */
			/* @var $form CActiveForm */
			?>
			
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'evento-form',
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
			    	<?php echo $form->labelEx($model,'eve_tiempo'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->dateField($model,'eve_tiempo',array('class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'eve_tiempo'); ?>
			    </div>
			</div>
			
			<div class="form-group">
				<div class="col-lg-2 control-label">
				    <?php echo $form->labelEx($model,'tra_rut'); ?>
				</div>
				<div class="col-lg-10">
				    <?php $disabled = false; if(Yii::app()->controller->usertype() == 1 || Yii::app()->controller->usertype() == 3) $disabled = true;?>
				    <?php echo $form->dropDownList($model,'tra_rut',CHtml::listData(Trabajador::model()->findAll(), 'tra_rut', 'tra_nombres'),array('prompt'=>' ','class'=>'form-control'));?>
				    <?php echo $form->error($model,'tra_rut'); ?>
				</div>
			</div>
			
			<?php $disabled = ''; if(Yii::app()->controller->usertype() == 1 || Yii::app()->controller->usertype() == 3) $disabled = 'display:none;';?>
			<div class="form-group" style="<?php echo $disabled;?>">
				<div class="col-lg-2 control-label">
				    <?php echo $form->labelEx($model,'eess_rut'); ?>
				</div>
				<div class="col-lg-10">
				    <?php echo $form->dropDownList($model,'eess_rut',CHtml::listData(Eess::model()->findAll(array('order'=>'eess_nombre_corto','condition'=>'eess_estado=1')), 'eess_rut', 'eess_nombre_corto'),array('prompt'=>' ','class'=>'form-control'));?>
				    <!--?php echo $form->textField($model,'eess_rut',array('class'=>'form-control')); ?-->
				    <?php echo $form->error($model,'eess_rut'); ?>
				</div>
			</div>
			<?php ?>
			
			<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'eve_tipo'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->dropDownList($model,'eve_tipo',array('Accidente'=>'Accidente','Incidente'=>'Incidente'),array('class'=>'form-control'));?>
				    <?php echo $form->error($model,'eve_tipo'); ?>
			    </div>
			</div>
			
			<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'eve_descripcion'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textArea($model,'eve_descripcion',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'eve_descripcion'); ?>
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
