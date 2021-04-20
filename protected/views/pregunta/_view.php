<?php
/* @var $this PreguntaController */
/* @var $data Pregunta */
?>

<section class="panel panel-default">
					
                        
                        
                        


						<header class='panel-heading bg-light no-border'>
                          <div class='clearfix'>
                            <div class='clear'>
                              <div class='h3 m-t-xs m-b-xs'>
                                <?php echo CHtml::link(CHtml::encode($data->pre_enunciado), array('view', 'id'=>$data->pre_id)); ?>
                              </div>
                              <small class='text-muted'><?php echo CHtml::link(CHtml::encode($data->pre_ponderacion), array('view', 'id'=>$data->pre_id)); ?></small>
                            </div>
                          </div>
                        </header>
<div class='list-group no-radius alt'>
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eess_rut')); ?></b><br>
	<?php echo CHtml::encode($data->eess_rut); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('pre_enunciado')); ?></b><br>
	<?php echo CHtml::encode($data->pre_enunciado); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('pre_ponderacion')); ?></b><br>
	<?php echo CHtml::encode($data->pre_ponderacion); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('tem_id')); ?></b><br>
	<?php echo CHtml::encode($data->tem_id); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('car_id')); ?></b><br>
	<?php echo CHtml::encode($data->car_id); ?>
	<br />


                          </a>
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('critico')); ?></b><br>
	<?php echo CHtml::encode($data->critico); ?>
	<br />


                          </a>
	
	
                        </div>
                        
</section>