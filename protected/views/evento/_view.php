<?php
/* @var $this EventoController */
/* @var $data Evento */
?>

<section class="panel panel-default">
					
                        
                        
                        


						<header class='panel-heading bg-light no-border'>
                          <div class='clearfix'>
                            <div class='clear'>
                              <div class='h3 m-t-xs m-b-xs'>
                                <?php echo CHtml::link(CHtml::encode($data->tra_rut), array('view', 'id'=>$data->eve_id)); ?>
                              </div>
                              <small class='text-muted'><?php echo CHtml::link(CHtml::encode($data->eess_rut), array('view', 'id'=>$data->eve_id)); ?></small>
                            </div>
                          </div>
                        </header>
<div class='list-group no-radius alt'>
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eve_tiempo')); ?></b><br>
	<?php echo CHtml::encode($data->eve_tiempo); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('tra_rut')); ?></b><br>
	<?php echo CHtml::encode($data->tra_rut); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eess_rut')); ?></b><br>
	<?php echo CHtml::encode($data->eess_rut); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eve_tipo')); ?></b><br>
	<?php echo CHtml::encode($data->eve_tipo); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eve_descripcion')); ?></b><br>
	<?php echo CHtml::encode($data->eve_descripcion); ?>
	<br />


                          </a>
	
	
                        </div>
</section>