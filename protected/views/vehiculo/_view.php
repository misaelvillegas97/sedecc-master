<?php
/* @var $this VehiculoController */
/* @var $data Vehiculo */
?>

<section class="panel panel-default">
					
                        
                        
                        


						<header class='panel-heading bg-light no-border'>
                          <div class='clearfix'>
                            <div class='clear'>
                              <div class='h3 m-t-xs m-b-xs'>
                                <?php echo CHtml::link(CHtml::encode($data->veh_ano), array('view', 'id'=>$data->veh_patente)); ?>
                              </div>
                              <small class='text-muted'><?php echo CHtml::link(CHtml::encode($data->veh_modelo), array('view', 'id'=>$data->veh_patente)); ?></small>
                            </div>
                          </div>
                        </header>
<div class='list-group no-radius alt'>
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('veh_marca')); ?></b><br>
	<?php echo CHtml::encode($data->veh_marca); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('veh_ano')); ?></b><br>
	<?php echo CHtml::encode($data->veh_ano); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('veh_modelo')); ?></b><br>
	<?php echo CHtml::encode($data->veh_modelo); ?>
	<br />


                          </a>
	
	
                        </div>
</section>