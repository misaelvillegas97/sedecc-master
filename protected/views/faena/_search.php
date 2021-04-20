<section class="panel panel-default">
	<header class="panel-heading font-bold">Buscar</header>
	<div class="panel-body">
		<div class="bs-example form-horizontal">
						<?php
			/* @var $this FaenaController */
			/* @var $model Faena */
			/* @var $form CActiveForm */
			?>
			
			<div class="wide form">
			
			<?php $form=$this->beginWidget('CActiveForm', array(
				'action'=>Yii::app()->createUrl($this->route),
				'method'=>'get',
			)); ?>
			
				<!--						
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'fae_id'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'fae_id',array('style'=>'text-transform: uppercase; box-shadow: none; -webkit-box-shadow: none;', 'size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
					</div>
				</div> -->
			
					<!-- 					
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'fae_creado'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'fae_creado',array('style'=>'text-transform: uppercase; box-shadow: none; -webkit-box-shadow: none;', 'class'=>'form-control')); ?>
					</div>
				</div>
			-->
				
				<div class="form-group">
				

				<?php 
			$rut_eess = Yii::app()->user->id; 
			?>
				<?php if ($rut_eess == 'admin'){?>
				<div class="col-lg-2 control-label">
				    <?php echo $form->labelEx($model,'eess_rut'); ?>
				</div>
				<div class="col-lg-10">
				    <?php $disabled = false; if(Yii::app()->controller->usertype() == 1 || Yii::app()->controller->usertype() == 3) $disabled = true;?>
				    <?php echo $form->dropDownList($model,'eess_rut',CHtml::listData(Eess::model()->findAll(array('order'=>'eess_nombre_corto','condition'=>'eess_estado=1')), 'eess_rut', 'eess_nombre_corto'),array('style'=>'text-transform: uppercase; box-shadow: none; -webkit-box-shadow: none;', 'prompt'=>' ','class'=>'form-control','disabled'=>$disabled));?>
				    <!--?php echo $form->textField($model,'eess_rut',array('class'=>'form-control')); ?-->
				    <?php echo $form->error($model,'eess_rut'); ?>
				</div>
				<?php }else{ ?>
				<div style="display: none;">
					<div class="col-lg-2 control-label">
				    <?php echo $form->labelEx($model,'eess_rut'); ?>
					</div>
					<div class="col-lg-10">
				    <?php $disabled = false; if(Yii::app()->controller->usertype() == 1 || Yii::app()->controller->usertype() == 3) $disabled = true;?>
				    <?php echo $form->dropDownList($model,'eess_rut',CHtml::listData(Eess::model()->findAll(array('order'=>'eess_nombre_corto','condition'=>'eess_estado=1')), 'eess_rut', 'eess_nombre_corto'),array('style'=>'text-transform: uppercase; box-shadow: none; -webkit-box-shadow: none;', 'prompt'=>' ','class'=>'form-control','disabled'=>$disabled));?>
				    <!--?php echo $form->textField($model,'eess_rut',array('class'=>'form-control')); ?-->
				    <?php echo $form->error($model,'eess_rut'); ?>
					</div>
				</div>

				<?php } ?>
			</div>

				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'fae_nombre'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'fae_nombre',array('style'=>'text-transform: uppercase; box-shadow: none; -webkit-box-shadow: none;', 'size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
					</div>
				</div>
			
									
				
			
										
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'fae_activo'); ?>
					</div>
					<div class="col-lg-10">
						<?php echo $form->textField($model,'fae_activo',array('style'=>'text-transform: uppercase; box-shadow: none; -webkit-box-shadow: none;', 'class'=>'form-control')); ?>
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'tipo'); ?>
					</div>
					<div class="col-lg-10">
						
						<?php echo $form->dropDownList($model,'fae_activo',array('1'=>'Activa','0'=>'Inactiva'),array('style'=>'text-transform: uppercase; box-shadow: none; -webkit-box-shadow: none;', 'class'=>'form-control'));?>
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
