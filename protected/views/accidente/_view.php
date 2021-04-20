<?php
/* @var $this AccidenteController */
/* @var $data Accidente */
?>

<section class="panel panel-default">
					                                                                

						<header class='panel-heading bg-light no-border'>
                          <div class='clearfix'>
                            <div class='clear'>
                              <div class='h3 m-t-xs m-b-xs'>
                                <?php echo CHtml::link(CHtml::encode($data->rut_trabajador), array('view', 'id'=>$data->id_accidente)); ?>
                              </div>
                              <small class='text-muted'><?php echo CHtml::link(CHtml::encode($data->tra_cargo), array('view', 'id'=>$data->id_accidente)); ?></small>
                            </div>
                          </div>
                        </header>
<div class='list-group no-radius alt'>
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('rut_eess')); ?></b><br>
	<?php echo CHtml::encode($data->eess_rut); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('rut_trabajador')); ?></b><br>
	<?php echo CHtml::encode($data->rut_trabajador); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('tra_cargo')); ?></b><br>
	<?php 
		echo Yii::app()->db->createCommand("SELECT car_descripcion as id FROM min_cargo where car_id=".$data->tra_cargo." ")->queryScalar();
		//echo CHtml::encode($data->tra_cargo); 
	
	?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('tra_depto')); ?></b><br>
	<?php echo CHtml::encode($data->tra_depto); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('acc_tipo_accidnte')); ?></b><br>
	<?php echo CHtml::encode($data->acc_tipo_accidnte); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_accidente')); ?></b><br>
	<?php echo CHtml::encode($data->fecha_accidente); ?>
	<br />


                          </a>
	
		<?php /*

                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_alta')); ?></b><br>
	<?php echo CHtml::encode($data->fecha_alta); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('Descripcion')); ?></b><br>
	<?php echo CHtml::encode($data->Descripcion); ?>
	<br />


                          </a>
	
		*/ ?>

                        </div>
</section>
