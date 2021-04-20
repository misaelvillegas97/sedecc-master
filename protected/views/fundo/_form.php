<section class="panel panel-default">
	<!--header class="panel-heading font-bold">Horizontal form</header-->
	<div class="panel-body">
		<div class="bs-example form-horizontal">
						<?php
			/* @var $this FundoController */
			/* @var $model Fundo */
			/* @var $form CActiveForm */
			?>
			
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'fundo-form',
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
				    <?php echo $form->labelEx($model,'fun_eess'); ?>
				</div>
				<div class="col-lg-10">
				    <?php $disabled = false; if(Yii::app()->controller->usertype() == 1 || Yii::app()->controller->usertype() == 3) $disabled = true;?>
				    <?php echo $form->dropDownList($model,'fun_eess',CHtml::listData(Eess::model()->findAll(array('order'=>'eess_nombre_corto','condition'=>'eess_estado=1')), 'eess_rut', 'eess_nombre_corto'),array('prompt'=>' ','class'=>'form-control','disabled'=>$disabled));?>
				    <!--?php echo $form->textField($model,'fun_eess',array('class'=>'form-control')); ?-->
				    <?php echo $form->error($model,'fun_eess'); ?>
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'fun_id'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'fun_id',array('class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'fun_id'); ?>
			    </div>
			</div>
		
			<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'fun_nombre'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'fun_nombre',array('size'=>60,'maxlength'=>100, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'fun_nombre'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'fun_comuna'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'fun_comuna',array('size'=>60,'maxlength'=>100, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'fun_comuna'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'fun_sector'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'fun_sector',array('size'=>60,'maxlength'=>100, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'fun_sector'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'fun_region'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'fun_region',array('size'=>60,'maxlength'=>100, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'fun_region'); ?>
			    </div>
			</div>
			
						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'fun_activo'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<!--?php echo $form->textField($model,'fun_activo',array('class'=>'form-control')); ?-->
			    	<?php echo $form->dropDownList($model,'fun_activo',array('1'=>'Activo','0'=>'Inactivo'),array('class'=>'form-control'));?>
					<?php echo $form->error($model,'fun_activo'); ?>
			    </div>
			</div>

			<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'fun_admin'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'fun_admin',array('size'=>60,'maxlength'=>100, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'fun_admin'); ?>
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
