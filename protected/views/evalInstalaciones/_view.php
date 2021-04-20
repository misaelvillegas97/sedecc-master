<?php
/* @var $this EvalInstalacionesController */
/* @var $data EvalInstalaciones */
?>

<section class="panel panel-default">
					
                        
                        
                        


						<header class='panel-heading bg-light no-border'>
                          <div class='clearfix'>
                            <div class='clear'>
                              <div class='h3 m-t-xs m-b-xs'>
                                <?php echo CHtml::link(CHtml::encode($data->eva_tipo), array('view', 'id'=>$data->eva_id)); ?>
                              </div>
                              <small class='text-muted'><?php echo CHtml::link(CHtml::encode($data->eess_rut), array('view', 'id'=>$data->eva_id)); ?></small>
                            </div>
                          </div>
                        </header>
<div class='list-group no-radius alt'>
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_creado')); ?></b><br>
	<?php echo CHtml::encode($data->eva_creado); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_tipo')); ?></b><br>
	<?php echo CHtml::encode($data->eva_tipo); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eess_rut')); ?></b><br>
	<?php echo CHtml::encode($data->eess_rut); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_gerente_general')); ?></b><br>
	<?php echo CHtml::encode($data->eva_gerente_general); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_num_trabajadores')); ?></b><br>
	<?php echo CHtml::encode($data->eva_num_trabajadores); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_gerente_operacion')); ?></b><br>
	<?php echo CHtml::encode($data->eva_gerente_operacion); ?>
	<br />


                          </a>
	
		<?php /*

                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_administrador')); ?></b><br>
	<?php echo CHtml::encode($data->eva_administrador); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_num_personas')); ?></b><br>
	<?php echo CHtml::encode($data->eva_num_personas); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_fecha_evaluacion')); ?></b><br>
	<?php echo CHtml::encode($data->eva_fecha_evaluacion); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_fundo')); ?></b><br>
	<?php echo CHtml::encode($data->eva_fundo); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_faena')); ?></b><br>
	<?php echo CHtml::encode($data->eva_faena); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_jefe_faena')); ?></b><br>
	<?php echo CHtml::encode($data->eva_jefe_faena); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_supervisor')); ?></b><br>
	<?php echo CHtml::encode($data->eva_supervisor); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_apr')); ?></b><br>
	<?php echo CHtml::encode($data->eva_apr); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_geo_x')); ?></b><br>
	<?php echo CHtml::encode($data->eva_geo_x); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_geo_y')); ?></b><br>
	<?php echo CHtml::encode($data->eva_geo_y); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_general_observacion')); ?></b><br>
	<?php echo CHtml::encode($data->eva_general_observacion); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_general_foto')); ?></b><br>
	<?php echo CHtml::encode($data->eva_general_foto); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_general_fecha')); ?></b><br>
	<?php echo CHtml::encode($data->eva_general_fecha); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_evaluador')); ?></b><br>
	<?php echo CHtml::encode($data->eva_evaluador); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_cache_porcentaje')); ?></b><br>
	<?php echo CHtml::encode($data->eva_cache_porcentaje); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_evaluador_correlativo')); ?></b><br>
	<?php echo CHtml::encode($data->eva_evaluador_correlativo); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_fecha')); ?></b><br>
	<?php echo CHtml::encode($data->eva_fecha); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_hora')); ?></b><br>
	<?php echo CHtml::encode($data->eva_hora); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_lugar')); ?></b><br>
	<?php echo CHtml::encode($data->eva_lugar); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_semaforo')); ?></b><br>
	<?php echo CHtml::encode($data->eva_semaforo); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_item_nombre_0')); ?></b><br>
	<?php echo CHtml::encode($data->eva_item_nombre_0); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_item_nota_0')); ?></b><br>
	<?php echo CHtml::encode($data->eva_item_nota_0); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_item_nombre_1')); ?></b><br>
	<?php echo CHtml::encode($data->eva_item_nombre_1); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_item_nota_1')); ?></b><br>
	<?php echo CHtml::encode($data->eva_item_nota_1); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_item_nombre_2')); ?></b><br>
	<?php echo CHtml::encode($data->eva_item_nombre_2); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_item_nota_2')); ?></b><br>
	<?php echo CHtml::encode($data->eva_item_nota_2); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_item_nombre_3')); ?></b><br>
	<?php echo CHtml::encode($data->eva_item_nombre_3); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_item_nota_3')); ?></b><br>
	<?php echo CHtml::encode($data->eva_item_nota_3); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_item_nombre_4')); ?></b><br>
	<?php echo CHtml::encode($data->eva_item_nombre_4); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_item_nota_4')); ?></b><br>
	<?php echo CHtml::encode($data->eva_item_nota_4); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_item_nombre_5')); ?></b><br>
	<?php echo CHtml::encode($data->eva_item_nombre_5); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_item_nota_5')); ?></b><br>
	<?php echo CHtml::encode($data->eva_item_nota_5); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_item_nombre_6')); ?></b><br>
	<?php echo CHtml::encode($data->eva_item_nombre_6); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_item_nota_6')); ?></b><br>
	<?php echo CHtml::encode($data->eva_item_nota_6); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_item_nombre_7')); ?></b><br>
	<?php echo CHtml::encode($data->eva_item_nombre_7); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_item_nota_7')); ?></b><br>
	<?php echo CHtml::encode($data->eva_item_nota_7); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_item_nombre_8')); ?></b><br>
	<?php echo CHtml::encode($data->eva_item_nombre_8); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_item_nota_8')); ?></b><br>
	<?php echo CHtml::encode($data->eva_item_nota_8); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_item_nombre_9')); ?></b><br>
	<?php echo CHtml::encode($data->eva_item_nombre_9); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_item_nota_9')); ?></b><br>
	<?php echo CHtml::encode($data->eva_item_nota_9); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_item_nombre_10')); ?></b><br>
	<?php echo CHtml::encode($data->eva_item_nombre_10); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_item_nota_10')); ?></b><br>
	<?php echo CHtml::encode($data->eva_item_nota_10); ?>
	<br />


                          </a>
	
		*/ ?>

                        </div>
</section>