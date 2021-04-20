<section class="panel panel-default">
	<!--header class="panel-heading font-bold">Horizontal form</header-->
	<div class="panel-body">
		<div class="bs-example form-horizontal">
						<?php
			/* @var $this FormulariosController */
			/* @var $model Formularios */
			/* @var $form CActiveForm */
			?>

			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'formularios-form',
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// There is a call to performAjaxValidation() commented in generated controller code.
				// See class documentation of CActiveForm for details on this.
				'enableAjaxValidation'=>false,
			)); ?>

			<p class="note">Los campos que contienen <span class="required">*</span> son obligatorios.</p>

			<!--?php echo $form->errorSummary($model); ?-->
			<div class="form-group">
				<div class="col-lg-2 control-label">
						<?php echo $form->labelEx($model,'eess_rut'); ?>
					</div>
					<div class="col-lg-10">
						<?php $disabled = false; if(Yii::app()->controller->usertype() == 1) $disabled = true;?>

						<?php echo $form->dropDownList($model,'eess_rut',CHtml::listData(Eess::model()->findAll('eess_estado=1'), 'eess_rut', 'eess_nombre_corto'),array('prompt'=>' ','class'=>'form-control bord','disabled'=>$disabled));?>
						<?php //echo $form->textField($model,'eess_rut',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
						<?php echo $form->error($model,'eess_rut'); ?>
					</div>
			</div>

			<div class="form-group">
					<div class="col-lg-2 control-label">
						  <?php echo $form->labelEx($model,'tipo_checklist'); ?>
					</div>
					<div class="col-lg-10">
							<!--?php echo $form->dropDownList($model,'tipo_checklist',CHtml::listData(Pregunta::model()->findAll("eess_rut = '".$model->eess_rut."'"), 'tipo_checklist', 'tipo_checklist'),array('prompt'=>' ','class'=>'form-control bord'));?-->
						  <?php echo $form->textField($model,'tipo_checklist',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
							<?php echo $form->error($model,'tipo_checklist'); ?>
					</div>
			</div>
			<?php
			if(!$model->isNewRecord){
				echo '
				<div class="form-group">
					<div class="col-lg-2 control-label">'.$form->labelEx($model,'checklist').'</div>
				    <div class="col-lg-10">'.$form->dropDownList($model,'checklist',CHtml::listData(Yii::app()->db->createCommand("SELECT * FROM min_pregunta")->query()->readAll(), 'car_id', 'car_id'),array('class'=>'form-control bord')).
						'</div>
				</div>';
			}else{
				echo '<div class="form-group">
					<div class="col-lg-2 control-label">'.$form->labelEx($model,'checklist').'</div>
				    <div class="col-lg-10">'.$form->dropDownList($model,'checklist',CHtml::listData(Yii::app()->db->createCommand("SELECT * FROM min_pregunta")->query()->readAll(), 'car_id', 'car_id'),array('class'=>'form-control bord')).
						'</div>
				</div>';
			}
			?>
<!--<div class="form-group">
		<div class="col-lg-2 control-label">'.$form->labelEx($model,'checklist').'
			</div>
			<div class="col-lg-10">
				'.$form->textField($model,'checklist',array('size'=>50,'maxlength'=>50, 'class'=>'form-control')).'
				'.$form->error($model,'checklist').'
			</div>
	</div>';
-->

		<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'correlativo_chk_eess'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'correlativo_chk_eess',array('size'=>50,'maxlength'=>50, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'correlativo_chk_eess'); ?>
			    </div>
			</div>






						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'n_campos'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'n_campos',array('class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'n_campos'); ?>
			    </div>
			</div>

						<!--div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'campo'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textArea($model,'campo',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'campo'); ?>
			    </div>
			</div>

						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'nombre_campos'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textArea($model,'nombre_campos',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'nombre_campos'); ?>
			    </div>
			</div>

						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'campos_values'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textArea($model,'campos_values',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'campos_values'); ?>
			    </div>
			</div>

						<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'campos_requeridos'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textArea($model,'campos_requeridos',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
			    	<?php echo $form->error($model,'campos_requeridos'); ?>
			    </div>
			</div-->
			
			<hr>
			
			<?php
			$campos_index = explode(',', $model->campo);
			$campos_nombr = explode(',', $model->nombre_campos);
			$campos_valor = explode(',', $model->campos_values);
			$campos_reque = explode(',', $model->campos_requeridos);
			echo '<table id="tablee" class="table table-condensed">
			<thead>
				<th>Nombre interno(sin espacios)</th>
				<th>Nombre para mostrar</th>
				<th>Valor por defecto</th>
				<th>Requerido (0,1)</th>
				<th></th>
			</thead>
			';
			for($i=0;$i<count($campos_index);$i++){
				
				if(!isset($campos_index[$i])) $campos_index[$i] = '';
				if(!isset($campos_nombr[$i])) $campos_nombr[$i] = '';
				if(!isset($campos_valor[$i])) $campos_valor[$i] = '';
				if(!isset($campos_reque[$i])) $campos_reque[$i] = '';
				
				echo '
				<tr id="row_'.$i.'">
					<td><input name="campos_index_'.$i.'" class="form-control" type="text" value="'.$campos_index[$i].'"></td>
					<td><input name="campos_nombr_'.$i.'" class="form-control" type="text" value="'.$campos_nombr[$i].'"></td>
					<td><input name="campos_valor_'.$i.'" class="form-control" type="text" value="'.$campos_valor[$i].'"></td>
					<td><input name="campos_reque_'.$i.'" class="form-control" type="text" value="'.$campos_reque[$i].'"></td>
					<td><a class="btn btn-xs btn-danger" onclick="delrow('.$i.')">x</a></td>
				</tr>
				';
			}
			echo '</table>
			<div class="col-lg-12" style="margin-top: 10px; text-align: right; padding-right: 40px;">
			<a class="btn btn-sm btn-default" style=" background-color: #f8b53d; color: white !important; padding-top: 10px; padding-bottom: 10px; padding-left: 60px; padding-right: 60px; border-radius: 5px;" onclick="addrow();">AGREGAR CAMPO</a>
			</div>
			
			';
			?>
			<script>
				maxindex = <?php echo count($campos_index);?>;
				function addrow(){
					table = document.getElementById('tablee');
					
					var row = table.insertRow(table.rows.length);
					row.setAttribute("id", "row_"+maxindex);

					// Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
					var cell1 = row.insertCell(0);
					var cell2 = row.insertCell(1);
					var cell3 = row.insertCell(2);
					var cell4 = row.insertCell(3);
					var cell5 = row.insertCell(4);
					
					// Add some text to the new cells:
					cell1.innerHTML = '<input name="campos_index_'+maxindex+'" required class="form-control" type="text">';
					cell2.innerHTML = '<input name="campos_nombr_'+maxindex+'" required class="form-control" type="text">';
					cell3.innerHTML = '<input name="campos_valor_'+maxindex+'" class="form-control" type="text">';
					cell4.innerHTML = '<input name="campos_reque_'+maxindex+'" required class="form-control" type="text" value="0">';
					cell5.innerHTML = '<a class="btn btn-xs btn-danger" onclick="delrow('+maxindex+')">x</a>';
					
					maxindex++;
				}
				function delrow(ind){
					/*
					table = document.getElementById('tablee');
					var row = table.deleteRow(ind+1);
					*/
					
					var row = document.getElementById("row_"+ind);
    				row.parentNode.removeChild(row);
				}
			</script>
			<hr>
					
					<!--<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', array('class'=>'btn btn-block btn-lg btn-primary')); ?>-->
						<div class="col-lg-12" style="margin-top: 10px; text-align: right; padding-right: 40px;">
					<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', array('class'=>'btn btn-sm btn-default','style'=>'background-color: #f8b53d; color: white !important; padding-top: 10px; padding-bottom: 10px; padding-left: 60px; padding-right: 60px; border-radius: 5px;')); ?>

			<?php $this->endWidget(); ?>
    	</div>
	</div>
</section>
