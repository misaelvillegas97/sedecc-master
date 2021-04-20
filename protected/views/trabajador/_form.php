<section class="panel panel-default">
	<!--header class="panel-heading font-bold">Horizontal form</header-->
	<div class="panel-body">
		<div class="bs-example form-horizontal">
						<?php
			/* @var $this TrabajadorController */
			/* @var $model Trabajador */
			/* @var $form CActiveForm */
			?>
			
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'trabajador-form',
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// There is a call to performAjaxValidation() commented in generated controller code.
				// See class documentation of CActiveForm for details on this.
				'enableAjaxValidation'=>false,
			)); ?>
		
			<p class="note">Los campos que contienen * son obligatorios.</p>
			
			<!--?php echo $form->errorSummary($model); ?-->

		<div class="row">
			<div class="col-md-12">
				<div class="col-md-5">
					<?php 
			$rut_eess = Yii::app()->user->id; 
			?>
				<?php if ($rut_eess == 'admin'){?>
						<div class="col-lg-12">
				    		<?php echo $form->labelEx($model,'eess_rut'); ?>
				    	</div>
				    	<div class="col-lg-12">
				    		<?php $disabled = false; if(Yii::app()->controller->usertype() == 1 || Yii::app()->controller->usertype() == 3) $disabled = true;?>
				    		<?php echo $form->dropDownList($model,'eess_rut',CHtml::listData(Eess::model()->findAll(array('order'=>'eess_nombre_corto','condition'=>'eess_estado=1')), 'eess_rut', 'eess_nombre_corto'),array('style'=>'text-transform: uppercase; box-shadow: none; -webkit-box-shadow: none;', 'prompt'=>' ','class'=>'form-control'));?>
				    		<!--?php echo $form->textField($model,'eess_rut',array('class'=>'form-control')); ?-->
				    		<?php echo $form->error($model,'eess_rut'); ?>
				    	</div>
			    	
				<?php }else{ ?>
					<div style="display: none;">
						<div class="col-lg-12">
				    		<?php echo $form->labelEx($model,'eess_rut'); ?>
				    	</div>
				    	<div class="col-lg-12">
				    		<?php $disabled = false; if(Yii::app()->controller->usertype() == 1 || Yii::app()->controller->usertype() == 3) $disabled = true;?>
				    		<?php echo $form->dropDownList($model,'eess_rut',CHtml::listData(Eess::model()->findAll('eess_estado=1'), 'eess_rut', 'eess_nombre_corto'),array('style'=>'text-transform: uppercase; box-shadow: none; -webkit-box-shadow: none;', 'prompt'=>' ','class'=>'form-control','disabled'=>$disabled));?>
				    		<!--?php echo $form->textField($model,'eess_rut',array('class'=>'form-control')); ?-->
				    		<?php echo $form->error($model,'eess_rut'); ?>
				    	</div>
			    	</div>
				<?php } ?>
				
					<div class="col-lg-12">
				    	<?php echo $form->labelEx($model,'tra_rut'); ?>
				    </div>
				    <div class="col-lg-10">
				    	<?php echo $form->numberField($model,'tra_rut',array('style'=>'box-shadow: none; -webkit-box-shadow: none;', 'class'=>'form-control')); ?>
				    	<?php echo $form->error($model,'tra_rut'); ?>
				    </div>

				    <div class="col-lg-2" style="padding-left: 0px; ">
				    	<?php echo $form->textField($model,'tra_dv',array('style'=>'text-transform: uppercase; box-shadow: none; -webkit-box-shadow: none;', 'size'=>2,'maxlength'=>2, 'class'=>'form-control')); ?>
				    	<?php echo $form->error($model,'tra_dv'); ?>
				    </div>
				  
					<div class="col-lg-12">
				    	<?php echo $form->labelEx($model,'tra_nombres'); ?>
				    </div>
				    <div class="col-lg-12">
				    	<?php echo $form->textField($model,'tra_nombres',array('style'=>'text-transform: uppercase; box-shadow: none; -webkit-box-shadow: none;', 'size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
				    	<?php echo $form->error($model,'tra_nombres'); ?>
				    </div>
					<div class="col-lg-12">
				    	<?php echo $form->labelEx($model,'tra_apellidos'); ?>
				    </div>
				    <div class="col-lg-12">
				    	<?php echo $form->textField($model,'tra_apellidos',array('style'=>'text-transform: uppercase; box-shadow: none; -webkit-box-shadow: none;', 'size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
				    	<?php echo $form->error($model,'tra_apellidos'); ?>
				    </div>
				    <div class="col-lg-12">
						<?php echo $form->labelEx($model,'car_id'); ?>
					</div>
					<div class="col-lg-12">
					    <?php echo $form->dropDownList($model,'car_id',CHtml::listData(Cargo::model()->findAll(), 'car_id', 'car_descripcion'),array('style'=>'text-transform: uppercase; box-shadow: none; -webkit-box-shadow: none;', 'prompt'=>' ','class'=>'form-control'));?>
					    <!--?php echo $form->textField($model,'car_id',array('class'=>'form-control')); ?-->
					    <?php echo $form->error($model,'car_id'); ?>
					</div>
				  	<div class="col-lg-12">
				    	<?php echo $form->labelEx($model,'tra_centro_trabajo'); ?>
				    </div>
				    <div class="col-lg-12">
				    	<?php echo $form->textField($model,'tra_centro_trabajo',array('style'=>'text-transform: uppercase; box-shadow: none; -webkit-box-shadow: none;', 'size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
				    	<?php echo $form->error($model,'tra_centro_trabajo'); ?>
				    </div>
				    <div class="col-lg-12">
				    	<?php echo $form->labelEx($model,'tra_evaluador'); ?>
				    </div>
				    <div class="col-lg-12">
				    	<?php echo $form->dropDownList($model,'tra_evaluador',array('0'=>'No','1'=>'Si'),array('style'=>'text-transform: uppercase; box-shadow: none; -webkit-box-shadow: none;', 'class'=>'form-control'));?>
						<?php echo $form->error($model,'tra_evaluador'); ?>
				    </div>
				    
				    <div class="col-lg-12" style="<?php if($model->tra_evaluador == 0) echo 'display:none;';?>">
				    	<?php echo $form->labelEx($model,'tra_responder_todo'); ?>
				    </div>
				    <div class="col-lg-12" style="<?php if($model->tra_evaluador == 0) echo 'display:none;';?>">
				    	<?php echo $form->dropDownList($model,'tra_responder_todo',array('0'=>'No','1'=>'Si'),array('style'=>'text-transform: uppercase; box-shadow: none; -webkit-box-shadow: none;', 'class'=>'form-control'));?>
				    	<div style="font-size:7pt; line-height:15px;">Este evaluador puede responder evaluaciones realizadas por otros evaluadores.</div>
						<?php echo $form->error($model,'tra_responder_todo'); ?>
				    </div>
				    
				    <div class="col-lg-12" style="<?php if($model->tra_evaluador == 0) echo 'display:none;';?>">
				    	<?php echo $form->labelEx($model,'tra_recibir_todo'); ?>
				    </div>
				    <div class="col-lg-12" style="<?php if($model->tra_evaluador == 0) echo 'display:none;';?>">
				    	<?php echo $form->dropDownList($model,'tra_recibir_todo',array('0'=>'No','1'=>'Si'),array('style'=>'text-transform: uppercase; box-shadow: none; -webkit-box-shadow: none;', 'class'=>'form-control'));?>
				    	<div style="font-size:7pt; line-height:15px;">Este evaluador recibirá evaluaciones realizadas por otros evaluadores.</div>
						<?php echo $form->error($model,'tra_recibir_todo'); ?>
				    </div>
				</div>

				<div class="col-md-7">
					<div class="col-md-6 marg">
						<div class="col-lg-12">
					    	<?php echo $form->labelEx($model,'tra_fecha_nacimiento'); ?>
					    </div>
					    <div class="col-lg-12">
					    	<?php echo $form->dateField($model,'tra_fecha_nacimiento',array('style'=>'box-shadow: none; -webkit-box-shadow: none;', 'class'=>'form-control')); ?>
					    	<?php echo $form->error($model,'tra_fecha_nacimiento'); ?>
					    </div>
					</div>
					<div class="col-md-6 marg">
						<div class="col-lg-12">
					    	<?php echo $form->labelEx($model,'tra_vencimiento_corma'); ?>
					    </div>
					    <div class="col-lg-12">
					    	<?php echo $form->dateField($model,'tra_vencimiento_corma',array('style'=>'text-transform: uppercase; box-shadow: none; -webkit-box-shadow: none;', 'class'=>'form-control')); ?>
					    	<?php echo $form->error($model,'tra_vencimiento_corma'); ?>
					    </div>
					</div>
					<div class="col-md-6 marg">
						<div class="col-lg-12">
					    	<?php echo $form->labelEx($model,'tra_licencia_conducir'); ?>
					    </div>
					    <div class="col-lg-12">
					    	<?php echo $form->textField($model,'tra_licencia_conducir',array('style'=>'box-shadow: none; -webkit-box-shadow: none;', 'size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
					    	<?php echo $form->error($model,'tra_licencia_conducir'); ?>
					    </div>
					</div>
					<div class="col-md-6 marg">
						<div class="col-lg-12">
					    	<?php echo $form->labelEx($model,'tra_vencimiento_licencia_conducir'); ?>
					    </div>
					    <div class="col-lg-12">
					    	<?php echo $form->dateField($model,'tra_vencimiento_licencia_conducir',array('style'=>'box-shadow: none; -webkit-box-shadow: none;', 'class'=>'form-control')); ?>
					    	<?php echo $form->error($model,'tra_vencimiento_licencia_conducir'); ?>
					    </div>
					</div>
					<div class="col-md-6 marg">
						<div class="col-lg-12">
					    	<?php echo $form->labelEx($model,'tra_vencimiento_examen'); ?>
					    </div>
					    <div class="col-lg-12">
					    	<?php echo $form->dateField($model,'tra_vencimiento_examen',array('style'=>'box-shadow: none; -webkit-box-shadow: none;', 'class'=>'form-control')); ?>
					    	<?php echo $form->error($model,'tra_vencimiento_examen'); ?>
					    </div>
					    
					    
					    
					</div>
					<div class="col-md-6 marg">
					<div class="col-lg-12">
				    	<?php echo $form->labelEx($model,'tra_email'); ?>
				    </div>
				    <div class="col-lg-12">
				    	<?php echo $form->textField($model,'tra_email',array('style'=>'text-transform: uppercase; box-shadow: none; -webkit-box-shadow: none;', 'class'=>'form-control')); ?>
				    	<?php echo $form->error($model,'tra_email'); ?>
				    </div>

						
					</div>
					<div class="col-md-6 marg" style="<?php if($model->tra_evaluador == 0) echo 'display:none;';?>">
						<div class="col-lg-12">
				    	<?php echo $form->labelEx($model,'tra_color'); ?>
				    	
				    	

				    	<?php echo $form->textField($model,'tra_color',array('style'=>'text-transform: uppercase; box-shadow: none; -webkit-box-shadow: none;', 'class'=>'form-control')); ?>
				    	<?php echo $form->error($model,'tra_color'); ?>
				    	<div style="font-size:7pt; line-height:15px;">Las evaluaciones realizadas por este evaluador aparecen del color seleccionado en el mapa.</div>
				    	</div>

				    </div>
				    <div class="col-md-6 marg" style="<?php if($model->tra_evaluador == 0) echo 'display:none;';?>">
				    	<div class="col-lg-12">
				    	<div class="col-lg-6" style="padding: 0px;">
				    	<?php
				    	$colors = array('FFD34C','FCD0C7','DEB194','74D6E1','73B341','FF5426','2D88A5','517245','004B8E','F42B79');
						for($i=0;$i<count($colors);$i++){
							if(($i)%5 == 0) echo '<br>';
							$opacity = '0.5';
							if($colors[$i] == $model->tra_color) $opacity = '1';
							echo '<img id="marker'.$colors[$i].'" style="cursor:pointer;opacity:'.$opacity.'" onclick="asignarcolor(\''.$colors[$i].'\');" src="http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|'.$colors[$i].'">';
						}

				    	?>
				    	</div>
				    	<div class="col-lg-6" style="font-size:7pt; line-height:15px; margin-top: 20px;">Seleccione un marcador o ingrese el código de color en la caja de texto
				    	</div>
				    	<script>
				    		function asignarcolor(color){
				    			<?php
				    			for($i=0;$i<count($colors);$i++){
				    				echo "document.getElementById('marker".$colors[$i]."').style.opacity = '0.5';";
				    			}
				    			?>
				    			document.getElementById('marker'+color).style.opacity = '1';
				    			document.getElementById('Trabajador_tra_color').value = color;
				    		}
				    	</script>
				    </div>
					</div>
					<div class="col-md-6">
					</div>
					

					
					

					
					

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
