<?php
/* @var $this FaenaController */
/* @var $data Faena */
?>

<section class="panel panel-default">
					
                        
                        
                        


						<header class='panel-heading bg-light no-border'>
                          <div class='clearfix'>
                            <div class='clear'>
                              <div class='h3 m-t-xs m-b-xs'>
                                <?php echo CHtml::link(CHtml::encode($data->fae_nombre), array('view', 'id'=>$data->fae_id)); ?>
                              </div>
                              <small class='text-muted'><?php echo CHtml::link(CHtml::encode($data->eess_rut), array('view', 'id'=>$data->fae_id)); ?></small>
                            </div>
                          </div>
                        </header>
<div class='list-group no-radius alt'>
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('fae_creado')); ?></b><br>
	<?php echo CHtml::encode($data->fae_creado); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('fae_nombre')); ?></b><br>
	<?php echo CHtml::encode($data->fae_nombre); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eess_rut')); ?></b><br>
	<?php echo CHtml::encode($data->eess_rut); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('fae_activo')); ?></b><br>
	<?php echo CHtml::encode($data->'fae_activo'); ?>
	<br />

	                   <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('tipo')); ?></b><br>
	<?php echo CHtml::encode($data->tipo); ?>
	<br />

                          </a>
	
	
                        </div>
</section>