<?php
/* @var $this MensajeController */
/* @var $data Mensaje */
?>

<section class="panel panel-default">
					
                        
                        
                        


						<header class='panel-heading bg-light no-border'>
                          <div class='clearfix'>
                            <div class='clear'>
                              <div class='h3 m-t-xs m-b-xs'>
                                <?php echo CHtml::link(CHtml::encode($data->men_emisor), array('view', 'id'=>$data->men_id)); ?>
                              </div>
                              <small class='text-muted'><?php echo CHtml::link(CHtml::encode($data->mes_mensaje), array('view', 'id'=>$data->men_id)); ?></small>
                            </div>
                          </div>
                        </header>
<div class='list-group no-radius alt'>
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('men_creado')); ?></b><br>
	<?php echo CHtml::encode($data->men_creado); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('men_emisor')); ?></b><br>
	<?php echo CHtml::encode($data->men_emisor); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('mes_mensaje')); ?></b><br>
	<?php echo CHtml::encode($data->mes_mensaje); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('men_imagen_1')); ?></b><br>
	<?php echo CHtml::encode($data->men_imagen_1); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('men_imagen_2')); ?></b><br>
	<?php echo CHtml::encode($data->men_imagen_2); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('men_imagen_3')); ?></b><br>
	<?php echo CHtml::encode($data->men_imagen_3); ?>
	<br />


                          </a>
	
		<?php /*

                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('men_imagen_4')); ?></b><br>
	<?php echo CHtml::encode($data->men_imagen_4); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('men_imagen_5')); ?></b><br>
	<?php echo CHtml::encode($data->men_imagen_5); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('men_imagen_6')); ?></b><br>
	<?php echo CHtml::encode($data->men_imagen_6); ?>
	<br />


                          </a>
	
		*/ ?>

                        </div>
</section>