<section class="panel panel-default">
	<!--header class="panel-heading font-bold">Horizontal form</header-->
	<div class="panel-body">
		<div class="bs-example form-horizontal">
						<?php
			/* @var $this AreaController */
			/* @var $model Area */
			/* @var $form CActiveForm */
			?>
			
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'area-form',
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
			    	<?php echo $form->labelEx($model,'eess_rut'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<!--?php echo $form->textField($model,'eess_rut',array('class'=>'form-control')); ?-->
			    	<?php $disabled = false; if(Yii::app()->controller->usertype() == 1 || Yii::app()->controller->usertype() == 3) $disabled = true;?>
			    	<?php echo $form->dropDownList($model,'eess_rut',CHtml::listData(Eess::model()->findAll('eess_estado=1'), 'eess_rut', 'eess_nombre_corto'),array('prompt'=>' ','class'=>'form-control','disabled'=>$disabled));?>
			    	<?php echo $form->error($model,'eess_rut'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'are_descripcion'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'are_descripcion',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'are_descripcion'); ?>
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
