<?php
/* @var $this CargoController */
/* @var $data Cargo */
?>

<section class="panel panel-default">
    <header class='panel-heading bg-light no-border'>
        <div class='clearfix'>
        <div class='clear'>
            <div class='h3 m-t-xs m-b-xs'>
            <?php echo CHtml::link(CHtml::encode($data->eess_rut), array('view', 'id'=>$data->car_id)); ?>
            </div>
            <small class='text-muted'><?php echo CHtml::link(CHtml::encode($data->car_descripcion), array('view', 'id'=>$data->car_id)); ?></small>
        </div>
        </div>
    </header>
<div class='list-group no-radius alt'>
    <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('car_creado')); ?></b><br>
        <?php echo CHtml::encode($data->car_creado); ?>
        <br />
    </a>
    <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('eess_rut')); ?></b><br>
        <?php echo CHtml::encode($data->eess_rut); ?>
        <br />
    </a>
    <a class="list-group-item">
		<b><?php echo CHtml::encode($data->getAttributeLabel('car_descripcion')); ?></b><br>
        <?php echo CHtml::encode($data->car_descripcion); ?>
        <br />
    </a>
    </div>
</section>