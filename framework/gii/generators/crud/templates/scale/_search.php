<section class="panel panel-default">
	<header class="panel-heading font-bold">Buscar</header>
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
			
			<div class="wide form">
			
			<?php echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
				'action'=>Yii::app()->createUrl(\$this->route),
				'method'=>'get',
			)); ?>\n"; ?>
			
			<?php foreach($this->tableSchema->columns as $column): ?>
			<?php
				$field=$this->generateInputField($this->modelClass,$column);
				if(strpos($field,'password')!==false)
					continue;
			?>
				
				<div class="form-group">
					<div class="col-lg-2 control-label">
						<?php echo "<?php echo ".$this->generateActiveLabel($this->modelClass,$column)."; ?>\n"; ?>
					</div>
					<div class="col-lg-10">
						<?php echo "<?php echo ".$this->generateActiveField($this->modelClass,$column)."; ?>\n"; ?>
					</div>
				</div>
			
			<?php endforeach; ?>
			
				<div class="form-group">
					<div class="col-lg-offset-2 col-lg-10">
						<?php echo "<?php echo CHtml::submitButton('Buscar', array('class'=>'btn btn-sm btn-default')); ?>\n"; ?>
					</div>
				</div>
				
			<?php echo "<?php \$this->endWidget(); ?>\n"; ?>
			
			</div><!-- search-form -->

		</div>
	</div>
</section>
