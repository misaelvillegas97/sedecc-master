
<?php 
	$whereEess = '';
	//obtengo rut EE.SS
	$eess='';
	if(Yii::app()->controller->usertype() == 1){
		$eess=Yii::app()->user->id;
		$whereEess = 'eess_rut = '.$eess;
	}
	if(Yii::app()->controller->usertype() == 3){
		$eess = Yii::app()->db->createCommand("SELECT eess_rut FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
		$whereEess = 'eess_rut = '.$eess;
	}
?>
<section class="panel panel-default">
	<header class="panel-heading font-bold">Buscar</header>
	<div class="panel-body">
		<div class="bs-example form-horizontal">
						<?php
			/* @var $this AccidenteController */
			/* @var $model Accidente */
			/* @var $form CActiveForm */
			?>
			
			<div class="wide form">
			
			<?php $form=$this->beginWidget('CActiveForm', array(
				'action'=>Yii::app()->createUrl($this->route),
				'method'=>'get',
			)); ?>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'id_accidente'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'id_accidente',array('size'=>15,'maxlength'=>15, 'class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<!--<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'eess_rut'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'eess_rut',array('size'=>15,'maxlength'=>15, 'class'=>'form-control')); ?>
					</div>
				</div>-->
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'rut_trabajador'); ?>
					</div>
					<div class="col-lg-10">
						<?php 
				    		echo $form->dropDownList($model,'rut_trabajador',CHtml::listData(Trabajador::model()->findAll(array("condition"=>$whereEess)), 'tra_rut', 'fullName'),array('prompt'=>'Seleccione Trabajador ','class'=>'form-control bord'))
						;?>
						<?php 
							//comentado para seleccionar trabajador mediante dropdown
							//echo $form->textField($model,'rut_trabajador',array('size'=>15,'maxlength'=>15, 'class'=>'form-control')); 
						?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'tra_cargo'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->dropDownList($model,'tra_cargo',CHtml::listData(Cargo::model()->findAll(), 'car_id', 'car_descripcion'),array('prompt'=>'Seleccione Cargo','class'=>'form-control bord'));?>
						<?php //echo $form->textField($model,'tra_cargo',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'tra_depto'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'tra_depto',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'acc_tipo_accidnte'); ?>
					</div>
					<div class="col-lg-10">
						<?php  echo $form->dropDownList($model,'acc_tipo_accidnte',array('CTP'=>'CTP','STP'=>'STP','Daño Material'=>'Daño Material','Incidente'=>'Incidente'), array('prompt'=>'Seleccione Tipo', 'class' =>'form-control')); ?>
						<?php //echo $form->textField($model,'acc_tipo_accidnte',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<div class="form-group" >
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'fecha_accidente'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->dateField($model,'fecha_accidente',array('class'=>'form-control')); ?>
						<?php //echo $form->textField($model,'fecha_accidente',array('class'=>'form-control')); ?>
					</div>
				</div>
			
										
				<!--<div class="form-group" id="divFechaAlta" style="display:none;">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'fecha_alta'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'fecha_alta',array('class'=>'form-control')); ?>
					</div>
				</div>-->
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'Descripcion'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'Descripcion',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
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


