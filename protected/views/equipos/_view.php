<?php
/* @var $this EquiposController */
/* @var $data Equipos */
?>

<section class="panel panel-default">
					
                        
                        
                        


						<header class='panel-heading bg-light no-border'>
                          <div class='clearfix'>
                            <div class='clear'>
                              <div class='h3 m-t-xs m-b-xs'>
                                <?php echo CHtml::link(CHtml::encode($data->eq_marca), array('view', 'id'=>$data->eq_codigo)); ?>
                              </div>
                              <small class='text-muted'><?php echo CHtml::link(CHtml::encode($data->eq_modelo), array('view', 'id'=>$data->eq_codigo)); ?></small>
                            </div>
                          </div>
                        </header>
<div class='list-group no-radius alt'>
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eq_maquina')); ?></b><br>
	<?php echo CHtml::encode($data->eq_maquina); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eq_marca')); ?></b><br>
	<?php echo CHtml::encode($data->eq_marca); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eq_modelo')); ?></b><br>
	<?php echo CHtml::encode($data->eq_modelo); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eq_tipo')); ?></b><br>
	<?php echo CHtml::encode($data->eq_tipo); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eq_ano')); ?></b><br>
	<?php echo CHtml::encode($data->eq_ano); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eess_rut')); ?></b><br>
	<?php echo CHtml::encode($data->eess_rut); ?>
	<br />


                          </a>
	
	
                        </div>
</section>