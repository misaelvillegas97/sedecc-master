<?php
/* @var $this FundoController */
/* @var $data Fundo */
?>

<section class="panel panel-default">
					
                        
                        
                        


						<header class='panel-heading bg-light no-border'>
                          <div class='clearfix'>
                            <div class='clear'>
                              <div class='h3 m-t-xs m-b-xs'>
                                <?php echo CHtml::link(CHtml::encode($data->fun_nombre), array('view', 'id'=>$data->fun_id)); ?>
                              </div>
                              <small class='text-muted'><?php echo CHtml::link(CHtml::encode($data->fun_comuna), array('view', 'id'=>$data->fun_id)); ?></small>
                            </div>
                          </div>
                        </header>
<div class='list-group no-radius alt'>
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('fun_creado')); ?></b><br>
	<?php echo CHtml::encode($data->fun_creado); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('fun_nombre')); ?></b><br>
	<?php echo CHtml::encode($data->fun_nombre); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('fun_comuna')); ?></b><br>
	<?php echo CHtml::encode($data->fun_comuna); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('fun_sector')); ?></b><br>
	<?php echo CHtml::encode($data->fun_sector); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('fun_region')); ?></b><br>
	<?php echo CHtml::encode($data->fun_region); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('fun_activo')); ?></b><br>
	<?php echo CHtml::encode($data->fun_activo); ?>
	<br />

	<a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('fun_admin')); ?></b><br>
	<?php echo CHtml::encode($data->fun_admin); ?>
	<br />
                          </a>
	
	
                        </div>
</section>