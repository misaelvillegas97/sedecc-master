<?php
/* @var $this AreaController */
/* @var $data Area */
?>

<section class="panel panel-default">
					
                        
                        
                        


						<header class='panel-heading bg-light no-border'>
                          <div class='clearfix'>
                            <div class='clear'>
                              <div class='h3 m-t-xs m-b-xs'>
                                <?php echo CHtml::link(CHtml::encode($data->eess_rut), array('view', 'id'=>$data->are_id)); ?>
                              </div>
                              <small class='text-muted'><?php echo CHtml::link(CHtml::encode($data->are_descripcion), array('view', 'id'=>$data->are_id)); ?></small>
                            </div>
                          </div>
                        </header>
<div class='list-group no-radius alt'>
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('are_creado')); ?></b><br>
	<?php echo CHtml::encode($data->are_creado); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eess_rut')); ?></b><br>
	<?php echo CHtml::encode($data->eess_rut); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('are_descripcion')); ?></b><br>
	<?php echo CHtml::encode($data->are_descripcion); ?>
	<br />


                          </a>
	
	
                        </div>
</section>