<?php
/* @var $this EvaluacionController */
/* @var $data Evaluacion */
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
		<b><?php echo CHtml::encode($data->getAttributeLabel('tra_rut')); ?></b><br>
        <?php echo CHtml::encode($data->tra_rut); ?>
        <br />
    </a>
	
    <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_apellidos')); ?></b><br>
        <?php echo CHtml::encode($data->eva_apellidos); ?>
        <br />
    </a>
	
    <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_nombres')); ?></b><br>
        <?php echo CHtml::encode($data->eva_nombres); ?>
        <br />
    </a>
	
		<?php /*

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
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_comuna')); ?></b><br>
	<?php echo CHtml::encode($data->eva_comuna); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_jefe_faena')); ?></b><br>
	<?php echo CHtml::encode($data->eva_jefe_faena); ?>
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
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_linea')); ?></b><br>
	<?php echo CHtml::encode($data->eva_linea); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_vencimiento_corma')); ?></b><br>
	<?php echo CHtml::encode($data->eva_vencimiento_corma); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_tipo_cosecha')); ?></b><br>
	<?php echo CHtml::encode($data->eva_tipo_cosecha); ?>
	<br />


                          </a>
	
	
                          <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eva_cache_porcentaje')); ?></b><br>
	<?php echo CHtml::encode($data->eva_cache_porcentaje); ?>
	<br />


                          </a>
	
		*/ ?>

    </div>
</section>