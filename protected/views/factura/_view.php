<?php
/* @var $this FacturaController */
/* @var $data Factura */
?>

<section class="panel panel-default">
					
                        
                        
                        


						<header class='panel-heading bg-light no-border'>
                          <div class='clearfix'>
                            <div class='clear'>
                              <div class='h3 m-t-xs m-b-xs'>
                                <?php echo CHtml::link(CHtml::encode($data->fijo_uf), array('view', 'id'=>$data->id_rango)); ?>
                              </div>
                              <small class='text-muted'><?php echo CHtml::link(CHtml::encode($data->variableuf_tra), array('view', 'id'=>$data->id_rango)); ?></small>
                            </div>
                          </div>
                        </header>
<div class='list-group no-radius alt'>
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('rango_trabajador')); ?></b><br>
	<?php echo CHtml::encode($data->rango_trabajador); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('fijo_uf')); ?></b><br>
	<?php echo CHtml::encode($data->fijo_uf); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('variableuf_tra')); ?></b><br>
	<?php echo CHtml::encode($data->variableuf_tra); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('checklist')); ?></b><br>
	<?php echo CHtml::encode($data->checklist); ?>
	<br />


                          </a>
	
	
                        </div>
</section>