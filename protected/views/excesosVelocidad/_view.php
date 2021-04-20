<?php
/* @var $this ExcesosVelocidadController */
/* @var $data ExcesosVelocidad */
?>

<section class="panel panel-default">
					
                        
                        
                        


						<header class='panel-heading bg-light no-border'>
                          <div class='clearfix'>
                            <div class='clear'>
                              <div class='h3 m-t-xs m-b-xs'>
                                <?php echo CHtml::link(CHtml::encode($data->exc_fecha), array('view', 'id'=>$data->exc_id)); ?>
                              </div>
                              <small class='text-muted'><?php echo CHtml::link(CHtml::encode($data->exc_zona), array('view', 'id'=>$data->exc_id)); ?></small>
                            </div>
                          </div>
                        </header>
<div class='list-group no-radius alt'>
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('tra_rut')); ?></b><br>
	<?php echo CHtml::encode($data->tra_rut); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('exc_fecha')); ?></b><br>
	<?php echo CHtml::encode($data->exc_fecha); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('exc_zona')); ?></b><br>
	<?php echo CHtml::encode($data->exc_zona); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('veh_patente')); ?></b><br>
	<?php echo CHtml::encode($data->veh_patente); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('exc_velocidad')); ?></b><br>
	<?php echo CHtml::encode($data->exc_velocidad); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('exc_limite')); ?></b><br>
	<?php echo CHtml::encode($data->exc_limite); ?>
	<br />


                          </a>
	
		<?php /*

                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('veh_codigoCamion')); ?></b><br>
	<?php echo CHtml::encode($data->veh_codigoCamion); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('exc_turno')); ?></b><br>
	<?php echo CHtml::encode($data->exc_turno); ?>
	<br />


                          </a>
	
		*/ ?>

                        </div>
</section>