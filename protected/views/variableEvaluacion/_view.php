<?php
/* @var $this VariableEvaluacionController */
/* @var $data VariableEvaluacion */
?>

<section class="panel panel-default">
					
                        
                        
                        


						<header class='panel-heading bg-light no-border'>
                          <div class='clearfix'>
                            <div class='clear'>
                              <div class='h3 m-t-xs m-b-xs'>
                                <?php echo CHtml::link(CHtml::encode($data->var_descripcion), array('view', 'id'=>$data->var_id)); ?>
                              </div>
                              <small class='text-muted'><?php echo CHtml::link(CHtml::encode($data->var_activa), array('view', 'id'=>$data->var_id)); ?></small>
                            </div>
                          </div>
                        </header>
<div class='list-group no-radius alt'>
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('var_nombre')); ?></b><br>
	<?php echo CHtml::encode($data->var_nombre); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('var_descripcion')); ?></b><br>
	<?php echo CHtml::encode($data->var_descripcion); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('var_activa')); ?></b><br>
	<?php echo CHtml::encode($data->var_activa); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eess_rut')); ?></b><br>
	<?php echo CHtml::encode($data->eess_rut); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('var_ponderacion')); ?></b><br>
	<?php echo CHtml::encode($data->var_ponderacion); ?>
	<br />


                          </a>
	
	
                        </div>
</section>