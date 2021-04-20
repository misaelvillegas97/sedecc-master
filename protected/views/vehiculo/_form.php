<section class="panel panel-default">
	<!--header class="panel-heading font-bold">Horizontal form</header-->
	<div class="panel-body">
		<div class="bs-example form-horizontal">
						<?php
			/* @var $this VehiculoController */
			/* @var $model Vehiculo */
			/* @var $form CActiveForm */
			?>
			
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'vehiculo-form',
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// There is a call to performAjaxValidation() commented in generated controller code.
				// See class documentation of CActiveForm for details on this.
				'enableAjaxValidation'=>false,
			)); ?>
		
			<p class="note">Los campos que contienen <span class="required">*</span> son obligatorios.</p>
			
			<!--?php echo $form->errorSummary($model); ?-->
		
			<?php if(Yii::app()->user->id == 'admin'){?>
			<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'eess_rut'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->dropDownList($model,'eess_rut',CHtml::listData(Eess::model()->findAll(array('order'=>'eess_nombre_corto','condition'=>'eess_estado=1')), 'eess_rut', 'eess_nombre_corto'),array('prompt'=>' ','class'=>'form-control'));?>
				    <?php echo $form->error($model,'eess_rut'); ?>
			    </div>
			</div>
			<?php }?>
			
			<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'veh_patente'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'veh_patente',array('size'=>8,'maxlength'=>8, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'veh_patente'); ?>
			    </div>
			</div>
			
			<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'veh_marca'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'veh_marca',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'veh_marca'); ?>
			    </div>
			</div>
			
			<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'veh_ano'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'veh_ano',array('class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'veh_ano'); ?>
			    </div>
			</div>
			
			<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'veh_modelo'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'veh_modelo',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'veh_modelo'); ?>
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
