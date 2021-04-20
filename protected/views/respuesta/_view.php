<?php
/* @var $this RespuestaController */
/* @var $data Respuesta */
?>

<section class="panel panel-default">
					
                        
                        
                        


						<header class='panel-heading bg-light no-border'>
                          <div class='clearfix'>
                            <div class='clear'>
                              <div class='h3 m-t-xs m-b-xs'>
                                <?php echo CHtml::link(CHtml::encode($data->res_enunciado), array('view', 'id'=>$data->res_id)); ?>
                              </div>
                              <small class='text-muted'><?php echo CHtml::link(CHtml::encode($data->res_respuesta), array('view', 'id'=>$data->res_id)); ?></small>
                            </div>
                          </div>
                        </header>
<div class='list-group no-radius alt'>
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('res_tiempo')); ?></b><br>
	<?php echo CHtml::encode($data->res_tiempo); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('res_enunciado')); ?></b><br>
	<?php echo CHtml::encode($data->res_enunciado); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('res_respuesta')); ?></b><br>
	<?php echo CHtml::encode($data->res_respuesta); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('res_ponderacion')); ?></b><br>
	<?php echo CHtml::encode($data->res_ponderacion); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('pre_id')); ?></b><br>
	<?php echo CHtml::encode($data->pre_id); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('car_id')); ?></b><br>
	<?php echo CHtml::encode($data->car_id); ?>
	<br />


                          </a>
	
		<?php /*

                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('tem_id')); ?></b><br>
	<?php echo CHtml::encode($data->tem_id); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('res_observacion')); ?></b><br>
	<?php echo CHtml::encode($data->res_observacion); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('res_foto')); ?></b><br>
	<?php echo CHtml::encode($data->res_foto); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_id')); ?></b><br>
	<?php echo CHtml::encode($data->eva_id); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('res_seguimiento')); ?></b><br>
	<?php echo CHtml::encode($data->res_seguimiento); ?>
	<br />


                          </a>
	
		*/ ?>

                        </div>
</section>