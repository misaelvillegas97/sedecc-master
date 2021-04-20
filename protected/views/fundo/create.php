<?php
/* @var $this FundoController */
/* @var $model Fundo */

$this->breadcrumbs=array(
	'Fundos'=>array('index'),
	'Nuevo',
);
?>


<span style='float:right;'>
<?php echo CHtml::link('<img src="img/list.png" width="40px;">',array('index'),array('title'=>'Volver al listado')); ?>
<!--?php echo CHtml::link('<i class="i i-list2"></i>',array('admin'),array('class'=>'btn btn-rounded btn-sm btn-icon btn-default')); ?-->
</span>
<h1>Nuevo fundo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>