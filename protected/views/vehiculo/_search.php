<section class="panel panel-default">
	<header class="panel-heading font-bold">Buscar</header>
	<div class="panel-body">
		<div class="bs-example form-horizontal">
						<?php
			/* @var $this VehiculoController */
			/* @var $model Vehiculo */
			/* @var $form CActiveForm */
			?>
			
			<div class="wide form">
			
			<?php $form=$this->beginWidget('CActiveForm', array(
				'action'=>Yii::app()->createUrl($this->route),
				'method'=>'get',
			)); ?>
			
				<?php if(Yii::app()->user->id == 'admin'){?>					
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'eess_rut'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->dropDownList($model,'eess_rut',CHtml::listData(Eess::model()->findAll(array('order'=>'eess_nombre_corto','condition'=>'eess_estado=1')), 'eess_rut', 'eess_nombre_corto'),array('prompt'=>' ','class'=>'form-control'));?>
				    </div>
				</div>
				<?php }?>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'veh_patente'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'veh_patente',array('size'=>8,'maxlength'=>8, 'class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'veh_marca'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'veh_marca',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'veh_ano'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'veh_ano',array('class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'veh_modelo'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'veh_modelo',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
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
