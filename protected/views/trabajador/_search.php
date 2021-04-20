<section class="panel panel-default">
	<header class="panel-heading font-bold">Buscar</header>
	<div class="panel-body">
		<div class="bs-example form-horizontal">
						<?php
			/* @var $this TrabajadorController */
			/* @var $model Trabajador */
			/* @var $form CActiveForm */
			?>
			
			<div class="wide form">
			
			<?php $form=$this->beginWidget('CActiveForm', array(
				'action'=>Yii::app()->createUrl($this->route),
				'method'=>'get',
			)); ?>
			
										
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-6">
					<!--
					<div class="col-lg-12">
						<?php echo $form->labelEx($model,'tra_id'); ?>
					</div>
					<div class="col-lg-12">
						<?php echo $form->numberField($model,'tra_id',array('class'=>'form-control')); ?>
					</div>
					-->
					<?php 
			$rut_eess = Yii::app()->user->id; 
			?>

					<?php if ($rut_eess == 'admin'){?>
					<?php $style = ''; if(Yii::app()->controller->usertype() == 1) $style = 'display:none;';?>				
					<div class="col-md-12 marg" style="<?php echo $style;?>">
						<div class="col-lg-12">
							<?php echo $form->labelEx($model,'eess_rut'); ?>
						</div>
						<div class="col-lg-12">
							<!--?php echo $form->textField($model,'eess_rut',array('class'=>'form-control')); ?-->
				    		<?php $disabled = false; if(Yii::app()->controller->usertype() == 1 || Yii::app()->controller->usertype() == 3) $disabled = true;?>
				    		<?php echo $form->dropDownList($model,'eess_rut',CHtml::listData(Eess::model()->findAll(array('order'=>'eess_nombre_corto','condition'=>'eess_estado=1')), 'eess_rut', 'eess_nombre_corto'),array('prompt'=>' ','class'=>'form-control'));?>
				    	</div>
					</div>
					<?php } ?>

					<div class="col-lg-12">
						<?php echo $form->labelEx($model,'tra_rut'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->numberField($model,'tra_rut',array('class'=>'form-control')); ?>
					</div>
					<div class="col-lg-2">
						<?php echo $form->textField($model,'tra_dv',array('size'=>2,'maxlength'=>2, 'class'=>'form-control')); ?>
					</div>

					<div class="col-lg-12">
						<?php echo $form->labelEx($model,'tra_nombres'); ?>
					</div>
					<div class="col-lg-12">
						<?php echo $form->textField($model,'tra_nombres',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
					</div>
					<div class="col-lg-12">
						<?php echo $form->labelEx($model,'tra_apellidos'); ?>
					</div>
					<div class="col-lg-12">
						<?php echo $form->textField($model,'tra_apellidos',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
					</div>

					<div class="col-lg-12">
				    	<?php echo $form->labelEx($model,'tra_email'); ?>
				    </div>
				    <div class="col-lg-12">
				    	<?php echo $form->textField($model,'tra_email',array('class'=>'form-control')); ?>
				    </div>

				    <div class="col-lg-12">
						<?php echo $form->labelEx($model,'tra_evaluador'); ?>
					</div>
					<div class="col-lg-12">
						<?php echo $form->dropDownList($model,'tra_evaluador',array(''=>'[Todos]','0'=>'No','1'=>'Si'),array('class'=>'form-control'));?>
						<!--?php echo $form->textField($model,'tra_evaluador',array('class'=>'form-control')); ?-->
					</div>
				</div>
				<!--<div class="col-md-6">-->
					
					
				<div class="col-md-6 marg">
					<div class="col-lg-12">
						<?php echo $form->labelEx($model,'tra_fecha_nacimiento'); ?>
					</div>
					<div class="col-lg-12">
						<?php echo $form->dateField($model,'tra_fecha_nacimiento',array('class'=>'form-control')); ?>
					</div>
				<!--</div>-->
				<div class="col-md-6 marg">
					<div class="col-lg-12">
						<?php echo $form->labelEx($model,'tra_vencimiento_corma'); ?>
					</div>
					<div class="col-lg-12">
						<?php echo $form->dateField($model,'tra_vencimiento_corma',array('class'=>'form-control')); ?>
					</div>
				</div>
					
				<div class="col-md-6 marg">
					<div class="col-lg-12">
						<?php echo $form->labelEx($model,'tra_licencia_conducir'); ?>
					</div>
					<div class="col-lg-12">
						<?php echo $form->textField($model,'tra_licencia_conducir',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
					</div>
				</div>
				<div class="col-md-6 marg">
					<div class="col-lg-12">
						<?php echo $form->labelEx($model,'tra_vencimiento_licencia_conducir'); ?>
					</div>
					<div class="col-lg-12">
						<?php echo $form->dateField($model,'tra_vencimiento_licencia_conducir',array('class'=>'form-control')); ?>
					</div>
				</div>
				<div class="col-md-6 marg">
					<div class="col-lg-12">
						<?php echo $form->labelEx($model,'tra_vencimiento_examen'); ?>
					</div>
					<div class="col-lg-12">
						<?php echo $form->dateField($model,'tra_vencimiento_examen',array('class'=>'form-control')); ?>
					</div>
				</div>
				<div class="col-md-6 marg">
					<div class="col-lg-12">
						<?php echo $form->labelEx($model,'car_id'); ?>
					</div>
					<div class="col-lg-12">
						<?php echo $form->dropDownList($model,'car_id',CHtml::listData(Cargo::model()->findAll(), 'car_id', 'car_descripcion'),array('prompt'=>' ','class'=>'form-control'));?>
			    		<!--?php echo $form->textField($model,'car_id',array('class'=>'form-control')); ?-->
					</div>
					<div class="col-lg-12">
				    	<?php echo $form->labelEx($model,'tra_centro_trabajo'); ?>
				    </div>
				    <div class="col-lg-12">
				    	<?php echo $form->textField($model,'tra_centro_trabajo',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
				    </div>
				</div>
				<div class="col-md-6 marg">
					<div class="col-lg-12">
						<?php echo $form->labelEx($model,'are_id'); ?>
					</div>
					<div class="col-lg-12">
						<?php echo $form->dropDownList($model,'are_id',CHtml::listData(Area::model()->findAll(), 'are_id', 'are_descripcion'),array('prompt'=>' ','class'=>'form-control'));?>
			    		<!--?php echo $form->textField($model,'are_id',array('class'=>'form-control')); ?-->
					</div>
				</div>
				<!--
				<div class="col-md-6 marg">
					<div class="col-lg-12">
						<?php echo $form->labelEx($model,'tra_creado'); ?>
					</div>
					<div class="col-lg-12">
						<?php echo $form->dateField($model,'tra_creado',array('class'=>'form-control')); ?>
					</div>
				</div>
				-->

				<div class="col-md-12 marg" >
					<div class="col-lg-12" style="margin-top: 10px; text-align:right;">
						<?php echo CHtml::submitButton('Buscar', array('class'=>'btn btn-sm btn-default','style'=>'background-color: #f8b53d; color: white !important; padding-top: 10px; padding-bottom: 10px; padding-left: 60px; padding-right: 60px; border-radius: 5px;')); ?>
					</div>
				<div class="col-md-6 marg">
				</div>
										
				



					
				</div>
			</div>
						
				
				
			<?php $this->endWidget(); ?>
			
			</div><!-- search-form -->

		</div>
	</div>
</section>
