<section class="panel panel-default">
	<!--header class="panel-heading font-bold">Horizontal form</header-->
	<div class="panel-body">
		<div class="bs-example form-horizontal">
			<?php
			/**
			 * The following variables are available in this template:
			 * - $this: the CrudCode object
			 */
			?>
			<?php echo "<?php\n"; ?>
			/* @var $this <?php echo $this->getControllerClass(); ?> */
			/* @var $model <?php echo $this->getModelClass(); ?> */
			/* @var $form CActiveForm */
			?>
			
			<?php echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
				'id'=>'".$this->class2id($this->modelClass)."-form',
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// There is a call to performAjaxValidation() commented in generated controller code.
				// See class documentation of CActiveForm for details on this.
				'enableAjaxValidation'=>false,
			)); ?>\n"; ?>
		
			<p class="note">Los campos que contienen <span class="required">*</span> son obligatorios.</p>
			
			<?php echo "<!--?php echo \$form->errorSummary(\$model); ?-->\n"; ?>
		
			<?php
			foreach($this->tableSchema->columns as $column)
			{
				if($column->autoIncrement)
					continue;
			?>
			<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo "<?php echo ".$this->generateActiveLabel($this->modelClass,$column)."; ?>\n"; ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo "<?php echo ".$this->generateActiveField($this->modelClass,$column)."; ?>\n"; ?>
			    	<?php echo "<?php echo \$form->error(\$model,'{$column->name}'); ?>\n"; ?>
			    </div>
			</div>
			
			<?php
			}
			?>
			<div class="form-group">
				<div class="col-lg-offset-2 col-lg-10">
					<?php echo "<?php echo CHtml::submitButton(\$model->isNewRecord ? 'Guardar' : 'Guardar', array('class'=>'btn btn-sm btn-default')); ?>\n"; ?>
				</div>
			</div>
			<?php echo "<?php \$this->endWidget(); ?>\n"; ?>
    	</div>
	</div>
</section>
