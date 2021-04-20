<?php
/* @var $this EessController */
/* @var $data Eess */
?>

<section class="panel panel-default">
					
                        
                        
                        


						<header class='panel-heading bg-light no-border'>
                          <div class='clearfix'>
                            <div class='clear'>
                              <div class='h3 m-t-xs m-b-xs'>
                                <?php echo CHtml::link(CHtml::encode($data->eess_nombre_corto), array('view', 'id'=>$data->eess_rut)); ?>
                              </div>
                              <small class='text-muted'><?php echo CHtml::link(CHtml::encode($data->eess_razon_social), array('view', 'id'=>$data->eess_rut)); ?></small>
                            </div>
                          </div>
                        </header>
<div class='list-group no-radius alt'>
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eess_creado')); ?></b><br>
	<?php echo CHtml::encode($data->eess_creado); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eess_nombre_corto')); ?></b><br>
	<?php echo CHtml::encode($data->eess_nombre_corto); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eess_razon_social')); ?></b><br>
	<?php echo CHtml::encode($data->eess_razon_social); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eess_ciudad')); ?></b><br>
	<?php echo CHtml::encode($data->eess_ciudad); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eess_telefono')); ?></b><br>
	<?php echo CHtml::encode($data->eess_telefono); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eess_email')); ?></b><br>
	<?php echo CHtml::encode($data->eess_email); ?>
	<br />


                          </a>
	
		<?php /*

                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eess_representante')); ?></b><br>
	<?php echo CHtml::encode($data->eess_representante); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eess_representante_telefono')); ?></b><br>
	<?php echo CHtml::encode($data->eess_representante_telefono); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eess_representante_email')); ?></b><br>
	<?php echo CHtml::encode($data->eess_representante_email); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eess_clave')); ?></b><br>
	<?php echo CHtml::encode($data->eess_clave); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eess_logo')); ?></b><br>
	<?php echo CHtml::encode($data->eess_logo); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eess_estado')); ?></b><br>
	<?php echo CHtml::encode($data->eess_estado); ?>
	<br />


                          </a>
	
		*/ ?>

                        </div>
</section>