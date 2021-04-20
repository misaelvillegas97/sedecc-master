<?php
/* @var $this FormulariobitacoraController */
/* @var $data Formulariobitacora */
?>

<section class="panel panel-default">
					
                        
                        
                        


						<header class='panel-heading bg-light no-border'>
                          <div class='clearfix'>
                            <div class='clear'>
                              <div class='h3 m-t-xs m-b-xs'>
                                <?php echo CHtml::link(CHtml::encode($data->eess_rut), array('view', 'id'=>$data->id)); ?>
                              </div>
                              <small class='text-muted'><?php echo CHtml::link(CHtml::encode($data->bit_nombre), array('view', 'id'=>$data->id)); ?></small>
                            </div>
                          </div>
                        </header>
<div class='list-group no-radius alt'>
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('bit_tiempo')); ?></b><br>
	<?php echo CHtml::encode($data->bit_tiempo); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eess_rut')); ?></b><br>
	<?php echo CHtml::encode($data->eess_rut); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('bit_nombre')); ?></b><br>
	<?php echo CHtml::encode($data->bit_nombre); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('bit_n_campos')); ?></b><br>
	<?php echo CHtml::encode($data->bit_n_campos); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('bit_campos')); ?></b><br>
	<?php echo CHtml::encode($data->bit_campos); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('bit_nombre_campos')); ?></b><br>
	<?php echo CHtml::encode($data->bit_nombre_campos); ?>
	<br />


                          </a>
	
		<?php /*

                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('bit_campos_values')); ?></b><br>
	<?php echo CHtml::encode($data->bit_campos_values); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('bit_campos_requeridos')); ?></b><br>
	<?php echo CHtml::encode($data->bit_campos_requeridos); ?>
	<br />


                          </a>
	
		*/ ?>

                        </div>
</section>