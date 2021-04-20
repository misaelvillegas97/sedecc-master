<?php
/* @var $this UsuarioController */
/* @var $data Usuario */
?>

<section class="panel panel-default">
					
                        
                        
                        


						<header class='panel-heading bg-light no-border'>
                          <div class='clearfix'>
                            <div class='clear'>
                              <div class='h3 m-t-xs m-b-xs'>
                                <?php echo CHtml::link(CHtml::encode($data->usu_acceso_nombre), array('view', 'id'=>$data->usu_id)); ?>
                              </div>
                              <small class='text-muted'><?php echo CHtml::link(CHtml::encode($data->usu_acceso_contrasena), array('view', 'id'=>$data->usu_id)); ?></small>
                            </div>
                          </div>
                        </header>
<div class='list-group no-radius alt'>
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('usu_creado')); ?></b><br>
	<?php echo CHtml::encode($data->usu_creado); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('usu_acceso_nombre')); ?></b><br>
	<?php echo CHtml::encode($data->usu_acceso_nombre); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('usu_acceso_contrasena')); ?></b><br>
	<?php echo CHtml::encode($data->usu_acceso_contrasena); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('usu_tipo')); ?></b><br>
	<?php echo CHtml::encode($data->usu_tipo); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('usu_nombre')); ?></b><br>
	<?php echo CHtml::encode($data->usu_nombre); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('usu_apellido')); ?></b><br>
	<?php echo CHtml::encode($data->usu_apellido); ?>
	<br />


                          </a>
	
		<?php /*

                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('usu_email')); ?></b><br>
	<?php echo CHtml::encode($data->usu_email); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('usu_telefono')); ?></b><br>
	<?php echo CHtml::encode($data->usu_telefono); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('usu_direccion')); ?></b><br>
	<?php echo CHtml::encode($data->usu_direccion); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('usu_ultimo_acceso')); ?></b><br>
	<?php echo CHtml::encode($data->usu_ultimo_acceso); ?>
	<br />


                          </a>
	
		*/ ?>

                        </div>
</section>