<?php
/* @var $this TrabajadorController */
/* @var $data Trabajador */
?>

<section class="panel panel-default">
    <header class='panel-heading bg-light no-border'>
        <div class='clearfix'>
        <div class='clear'>
            <div class='h3 m-t-xs m-b-xs'>
            <?php echo CHtml::link(CHtml::encode($data->eess_rut), array('view', 'id'=>$data->tra_id)); ?>
            </div>
            <small class='text-muted'><?php echo CHtml::link(CHtml::encode($data->tra_rut), array('view', 'id'=>$data->tra_id)); ?></small>
        </div>
        </div>
    </header>
<div class='list-group no-radius alt'>
    <a class="list-group-item">
        <b><?php echo CHtml::encode($data->getAttributeLabel('tra_creado')); ?></b><br>
        <?php echo CHtml::encode($data->tra_creado); ?>
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
        <b><?php echo CHtml::encode($data->getAttributeLabel('tra_dv')); ?></b><br>
        <?php echo CHtml::encode($data->tra_dv); ?>
        <br />
    </a>
        
    <a class="list-group-item">
        <b><?php echo CHtml::encode($data->getAttributeLabel('tra_nombres')); ?></b><br>
        <?php echo CHtml::encode($data->tra_nombres); ?>
        <br />
    </a>
        
    <a class="list-group-item">
        <b><?php echo CHtml::encode($data->getAttributeLabel('tra_apellidos')); ?></b><br>
        <?php echo CHtml::encode($data->tra_apellidos); ?>
        <br />
    </a>
	
<?php 
    /*
        <a class="list-group-item">
            <b><?php echo CHtml::encode($data->getAttributeLabel('tra_fecha_nacimiento')); ?></b><br>
            <?php echo CHtml::encode($data->tra_fecha_nacimiento); ?>
            <br />
        </a>
        
        <a class="list-group-item">
            <b><?php echo CHtml::encode($data->getAttributeLabel('tra_vencimiento_corma')); ?></b><br>
            <?php echo CHtml::encode($data->tra_vencimiento_corma); ?>
            <br />
        </a>
        
        <a class="list-group-item">
            <b><?php echo CHtml::encode($data->getAttributeLabel('tra_vencimiento_examen')); ?></b><br>
            <?php echo CHtml::encode($data->tra_vencimiento_examen); ?>
            <br />
        </a>
        
        <a class="list-group-item">
            <b><?php echo CHtml::encode($data->getAttributeLabel('tra_licencia_conducir')); ?></b><br>
            <?php echo CHtml::encode($data->tra_licencia_conducir); ?>
            <br />
        </a>
        
        
        <a class="list-group-item">
            <b><?php echo CHtml::encode($data->getAttributeLabel('tra_vencimiento_licencia_conducir')); ?></b><br>
            <?php echo CHtml::encode($data->tra_vencimiento_licencia_conducir); ?>
            <br />
        </a>
        
        
        <a class="list-group-item">
            <b><?php echo CHtml::encode($data->getAttributeLabel('car_id')); ?></b><br>
            <?php echo CHtml::encode($data->car_id); ?>
            <br />
        </a>
	*/ 
?>
</div>
</section>