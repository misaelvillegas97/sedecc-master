<section class="panel panel-default">
	<header class="panel-heading font-bold">Buscar</header>
	<div class="panel-body">
		<div class="bs-example form-horizontal">
						<?php
			/* @var $this EvaluacionEquiposController */
			/* @var $model EvaluacionEquipos */
			/* @var $form CActiveForm */
			?>

			<div class="wide form">

			<?php $form=$this->beginWidget('CActiveForm', array(
				'action'=>Yii::app()->createUrl($this->route),
				'method'=>'get',
			)); ?>

			<style type="text/css">
				.marg{
					padding-left: 0px !important;
					padding-right: 0px !important;
				}
			</style>
			<div class="col-lg-12">
				<div class="col-lg-6 marg">
					<div class="col-lg-6 marg">
						<div class="col-lg-12">
							<?php echo $form->labelEx($model,'eva_id'); ?>
						</div>
						<div class="col-lg-12">
							<?php echo $form->textField($model,'eva_id',array('class'=>'form-control')); ?>
						</div>
					</div>
					<div class="col-lg-6 marg">
						<div class="col-lg-12">
								<?php echo $form->labelEx($model,'eva_creado'); ?>
						</div>
						<div class="col-lg-12">
								<?php echo $form->textField($model,'eva_creado',array('class'=>'form-control')); ?>
						</div>
					</div>
					<div class="col-lg-6 marg">
						<div class="col-lg-12">
							<?php echo $form->labelEx($model,'eva_tipo'); ?>
						</div>
						<div class="col-lg-12">
							<?php echo $form->dropDownList($model,'eva_tipo',CHtml::listData(Yii::app()->db->createCommand("SELECT * FROM min_pregunta WHERE tipo_checklist='equipos'")->query()->readAll(), 'car_id', 'car_id'),array('prompt'=>' ','class'=>'form-control'));?>
					    		<!--?php echo $form->textField($model,'eva_tipo',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?-->
						</div>
					</div>
					<div class="col-md-6 marg">
						<div class="col-lg-12">
							<?php echo $form->labelEx($model,'eq_tipo'); ?>
						</div>
						<div class="col-lg-12">
							<?php echo $form->numberField($model,'eq_tipo',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
						</div>
					</div>
                    <div class="col-md-12 marg">
                        <div class="col-lg-12">
                            <!-- <?php echo $form->labelEx($model,'eess_rut'); ?> -->
                            <label for="Eess_eess_rut">Empresa</label>
                        </div>
                        <div class="col-lg-12">
                            <?php $disabled = false; if(Yii::app()->controller->usertype() == 1 || Yii::app()->controller->usertype() == 3) $disabled = true;?>
                            <?php echo $form->dropDownList($model,'eess_rut',CHtml::listData(Eess::model()->findAll(array('order'=>'eess_nombre_corto','condition'=>'eess_estado=1')), 'eess_rut', 'eess_nombre_corto'),array('prompt'=>' ','class'=>'form-control'));?>
                        </div>
					</div>
					<div class="col-md-6 marg">
						<div class="col-lg-12">
							<?php echo $form->labelEx($model,'eq_codigo'); ?>
						</div>
						<div class="col-lg-12">
							<?php echo $form->textField($model,'eq_codigo',array('size'=>25,'maxlength'=>25, 'class'=>'form-control')); ?>
						</div>
					</div>
					<div class="col-md-6 marg">
						<div class="col-lg-12">
                            <?php echo $form->labelEx($model,'eq_marca'); ?>
                        </div>
                        <div class="col-lg-12">
                            <?php echo $form->textField($model,'eq_marca',array('size'=>25,'maxlength'=>25, 'class'=>'form-control')); ?>
                        </div>
					</div>
					<div class="col-md-6 marg">
                        <div class="col-lg-12">
                            <?php echo $form->labelEx($model,'eq_modelo'); ?>
                        </div>
                        <div class="col-lg-12">
                            <?php echo $form->textField($model,'eq_modelo',array('size'=>25,'maxlength'=>25, 'class'=>'form-control')); ?>
                        </div>
					</div>

					<div class="col-md-6 marg">
                        <div class="col-lg-12">
                            <?php echo $form->labelEx($model,'eva_operador'); ?>
                        </div>
                        <div class="col-lg-12">
                            <?php echo $form->textField($model,'eva_operador',array('size'=>30,'maxlength'=>30, 'class'=>'form-control')); ?>
                        </div>
					</div>
					
					
					

					<div class="col-md-6 marg">
						<div class="col-lg-12">
							<?php echo $form->labelEx($model,'eva_apr'); ?>
						</div>
						<div class="col-lg-12">
							<?php echo $form->textField($model,'eva_apr',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
						</div>
					</div>
					<div class="col-md-6 marg">
						<div class="col-lg-12">
							<?php echo $form->labelEx($model,'eva_supervisor'); ?>
						</div>
						<div class="col-lg-12">
							<?php echo $form->textField($model,'eva_supervisor',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
						</div>
					</div>
				</div>
			<!-- </div>
			<div class="col-lg-12"> -->
				<div class="col-lg-6">
					<div class="col-md-6 marg">
						<div class="col-lg-12">
							<?php echo $form->labelEx($model,'eva_jefe_faena'); ?>
						</div>
						<div class="col-lg-10">
							<?php echo $form->textField($model,'eva_jefe_faena',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
						</div>
					</div>
					<div class="col-md-6 marg">
						<div class="col-lg-12">
							<?php echo $form->labelEx($model,'eva_horometro'); ?>
						</div>
						<div class="col-lg-10">
							<?php echo $form->textField($model,'eva_horometro',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
						</div>
					</div>
					<div class="col-md-6 marg">
						<div class="col-lg-12">
							<?php echo $form->labelEx($model,'eva_ot'); ?>
						</div>
						<div class="col-lg-10">
							<?php echo $form->textField($model,'eva_ot',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
						</div>
					</div>
					<div class="col-md-6 marg">
						<div class="col-lg-12">
							<?php echo $form->labelEx($model,'eva_fecha_evaluacion'); ?>
						</div>
						<div class="col-lg-10">
							<?php echo $form->textField($model,'eva_fecha_evaluacion',array('class'=>'form-control')); ?>
						</div>
					</div>
					<div class="col-md-6 marg">
						<div class="col-lg-12">
							<?php echo $form->labelEx($model,'eva_evaluador'); ?>
						</div>
						<div class="col-lg-10">
							<?php echo $form->textField($model,'eva_evaluador',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
						</div>
					</div>
					<div class="col-md-6 marg">
						<div class="col-lg-12">
							<?php echo $form->labelEx($model,'eva_cache_porcentaje'); ?>
						</div>
						<div class="col-lg-10">
							<?php echo $form->textField($model,'eva_cache_porcentaje',array('class'=>'form-control')); ?>
						</div>
					</div>
				</div>
			</div>
			<div style="float:right;">
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
