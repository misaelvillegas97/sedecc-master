<section class="panel panel-default">
	<header class="panel-heading font-bold">Buscar</header>
	<div class="panel-body">
		<div class="bs-example form-horizontal">
						<?php
			/* @var $this EventoController */
			/* @var $model Evento */
			/* @var $form CActiveForm */
			?>
			
			<div class="wide form">
			
			<?php $form=$this->beginWidget('CActiveForm', array(
				'action'=>Yii::app()->createUrl($this->route),
				'method'=>'get',
			)); ?>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'eve_id'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'eve_id',array('class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'eve_tiempo'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->dateField($model,'eve_tiempo',array('class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'tra_rut'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'tra_rut',array('class'=>'form-control')); ?>
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
						<?php echo $form->textField($model,'eve_tipo',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'eve_descripcion'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textArea($model,'eve_descripcion',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
					</div>
				</div>
			
						
				<div class="form-group">
					<div class="col-lg-offset-2 col-lg-10">
						<?php echo CHtml::submitButton('Buscar', array('class'=>'btn btn-sm btn-default')); ?>
					</div>
				</div>
				
			<?php $this->endWidget(); ?>
			
			</div><!-- search-form -->

		</div>
	</div>
</section>
