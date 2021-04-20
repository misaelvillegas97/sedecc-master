<?php
/* @var $this FormulariosController */
/* @var $data Formularios */
?>

<section class="panel panel-default">
					
                        
                        
                        


						<header class='panel-heading bg-light no-border'>
                          <div class='clearfix'>
                            <div class='clear'>
                              <div class='h3 m-t-xs m-b-xs'>
                                <?php echo CHtml::link(CHtml::encode($data->tipo_checklist), array('view', 'id'=>$data->correlativo_chk_eess)); ?>
                              </div>
                              <small class='text-muted'><?php echo CHtml::link(CHtml::encode($data->eess_rut), array('view', 'id'=>$data->correlativo_chk_eess)); ?></small>
                            </div>
                          </div>
                        </header>
<div class='list-group no-radius alt'>
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('checklist')); ?></b><br>
	<?php echo CHtml::encode($data->checklist); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_checklist')); ?></b><br>
	<?php echo CHtml::encode($data->tipo_checklist); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eess_rut')); ?></b><br>
	<?php echo CHtml::encode($data->eess_rut); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('n_campos')); ?></b><br>
	<?php echo CHtml::encode($data->n_campos); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('campo')); ?></b><br>
	<?php echo CHtml::encode($data->campo); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_campos')); ?></b><br>
	<?php echo CHtml::encode($data->nombre_campos); ?>
	<br />


                          </a>
	
		<?php /*

                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('campos_values')); ?></b><br>
	<?php echo CHtml::encode($data->campos_values); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('campos_requeridos')); ?></b><br>
	<?php echo CHtml::encode($data->campos_requeridos); ?>
	<br />


                          </a>
	
		*/ ?>

                        </div>
</section>