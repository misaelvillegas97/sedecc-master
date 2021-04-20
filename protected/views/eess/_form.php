<section class="panel panel-default">
	<!--header class="panel-heading font-bold">Horizontal form</header-->
	<div class="panel-body">
		<div class="bs-example form-horizontal">
						<?php
			/* @var $this EessController */
			/* @var $model Eess */
			/* @var $form CActiveForm */
			?>
			
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'eess-form',
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
			    <div class="col-lg-2">
			    	<?php echo $form->numberField($model,'eess_rut',array('style'=>'box-shadow: none; -webkit-box-shadow: none;', 'size'=>20,'maxlength'=>20, 'class'=>'form-control bord')); ?>
			    	<?php echo $form->error($model,'eess_rut'); ?>
			    </div>
				<div class="col-lg-1 control-label">
			    	<?php echo $form->labelEx($model,'eess_nombre_corto'); ?>
			    </div>
			    <div class="col-lg-7">
			    	<?php echo $form->textField($model,'eess_nombre_corto',array('style'=>'text-transform: uppercase; box-shadow: none; -webkit-box-shadow: none;', 'size'=>60,'maxlength'=>150, 'class'=>'form-control bord')); ?>
			    	<?php echo $form->error($model,'eess_nombre_corto'); ?>
			    </div>
			</div>
			
			<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'eess_razon_social'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'eess_razon_social',array('style'=>'text-transform: uppercase; box-shadow: none; -webkit-box-shadow: none;', 'size'=>60,'maxlength'=>250, 'class'=>'form-control bord')); ?>
			    	<?php echo $form->error($model,'eess_razon_social'); ?>
			    </div>
			</div>
			<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'eess_ciudad'); ?>
			    </div>
			    <div class="col-lg-2">
			    	<?php echo $form->textField($model,'eess_ciudad',array('style'=>'text-transform: uppercase; box-shadow: none; -webkit-box-shadow: none;', 'size'=>60,'maxlength'=>200, 'class'=>'form-control bord')); ?>
			    	<?php echo $form->error($model,'eess_ciudad'); ?>
			    </div>
				<div class="col-lg-1 control-label">
			    	<?php echo $form->labelEx($model,'eess_telefono'); ?>
			    </div>
			    <div class="col-lg-3">
			    	<?php echo $form->numberField($model,'eess_telefono',array('style'=>'box-shadow: none; -webkit-box-shadow: none;', 'size'=>60,'maxlength'=>200, 'class'=>'form-control bord')); ?>
			    	<?php echo $form->error($model,'eess_telefono'); ?>
			    </div>
				<div class="col-lg-1 control-label">
			    	<?php echo $form->labelEx($model,'eess_email'); ?>
			    </div>
			    <div class="col-lg-3">
			    	<?php echo $form->emailField($model,'eess_email',array('style'=>'text-transform: uppercase; box-shadow: none; -webkit-box-shadow: none;', 'size'=>60,'maxlength'=>250, 'class'=>'form-control bord','multiple' => true)); ?>
			    	<?php echo $form->error($model,'eess_email'); ?>
			    </div>
			</div>
			
			<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'eess_clave'); ?>
			    </div>
			    <div class="col-lg-2">
			    	<?php echo $form->textField($model,'eess_clave',array('style'=>'box-shadow: none; -webkit-box-shadow: none;', 'size'=>60,'maxlength'=>200, 'class'=>'form-control bord')); ?>
			    	<?php echo $form->error($model,'eess_clave'); ?>
			    </div>
				<!--div class="col-lg-1 control-label">
			    	<?php echo $form->labelEx($model,'eess_logo'); ?>
			    </div>
			    <div class="col-lg-3">
			    	<?php echo $form->fileField($model,'eess_logo',array('rows'=>6, 'cols'=>50, 'class'=>'form-control bord')); ?>
			    	<?php echo $form->error($model,'eess_logo'); ?>
			    </div-->
			    
				<div class="col-lg-1 control-label" style="<?php if(Yii::app()->user->id != 'admin') echo 'display:none;';?>">
			    	<?php echo $form->labelEx($model,'eess_estado'); ?>
			    </div>
			    <div class="col-lg-3" style="<?php if(Yii::app()->user->id != 'admin') echo 'display:none;';?>">
			    	<!--?php echo $form->textField($model,'eess_estado',array('size'=>20,'maxlength'=>20, 'class'=>'form-control')); ?-->
			    	<?php echo $form->dropDownList($model,'eess_estado',array('1'=>'Activo','0'=>'Inactivo'),array('style'=>'text-transform: uppercase; box-shadow: none; -webkit-box-shadow: none;', 'class'=>'form-control bord'));?>
					<?php echo $form->error($model,'eess_estado'); ?>
			    </div>
			</div>
			
			<h3 class="page-header">Información de representante</h3>
			
			<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php echo $form->labelEx($model,'eess_representante'); ?>
			    </div>
			    <div class="col-lg-10">
			    	<?php echo $form->textField($model,'eess_representante',array('style'=>'text-transform: uppercase; box-shadow: none; -webkit-box-shadow: none;', 'size'=>60,'maxlength'=>200, 'class'=>'form-control bord')); ?>
			    	<?php echo $form->error($model,'eess_representante'); ?>
			    </div>
			</div>
			
			<div class="form-group">
				<div class="col-lg-2 control-label">
			    	<?php # echo $form->labelEx($model,'eess_representante_telefono'); ?>
                    <label for="Eess_eess_representante_telefono">Teléfono</label>
			    </div>
			    <div class="col-lg-2">
			    	<?php echo $form->numberField($model,'eess_representante_telefono',array('style'=>'box-shadow: none; -webkit-box-shadow: none;', 'size'=>60,'maxlength'=>200, 'class'=>'form-control bord')); ?>
			    	<?php echo $form->error($model,'eess_representante_telefono'); ?>
			    </div>
				<div class="col-lg-1 control-label">
			    	<?php # echo $form->labelEx($model,'eess_representante_email'); ?>
                    <label for="Eess_eess_representante_email">Email</label>
			    </div>
			    <div class="col-lg-7">
			    	<?php echo $form->emailField($model,'eess_representante_email',array('style'=>'text-transform: uppercase; box-shadow: none; -webkit-box-shadow: none;', 'size'=>60,'maxlength'=>255, 'class'=>'form-control bord','required' => false)); ?>
			    	<?php echo $form->error($model,'eess_representante_email'); ?>
			    </div>
			</div>
			
			<div class="col-md-12 marg" >
					<div class="col-lg-12" style="margin-top: 10px; text-align: right; padding-right: 40px;">
					<?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', array('class'=>'btn btn-sm btn-default','style'=>'background-color: #f8b53d; color: white !important; padding-top: 10px; padding-bottom: 10px; padding-left: 60px; padding-right: 60px; border-radius: 5px;')); ?>
						
					</div>
				<div class="col-md-6 marg">
				</div>	
			</div>
			<?php $this->endWidget(); ?>
			
			<?php if(!$model->isNewRecord){?>
			<h3 class="page-header">Agregar logo</h3>
			<?php
			$dir = 'images/eess/';
			$url = 'index.php?r=eess/update&id='.$_GET['id'];
			if(!file_exists($dir)) mkdir($dir, 0777, true);
			?>
			<form enctype="multipart/form-data" method="post">
				<input name="file" type="file" onchange="this.form.submit()">
				<div class="alert alert-warning">La imagen a subir reemplazará la anterior.</div>
			</form>
			<?php
			// Subir
			if(isset($_FILES['file'])){
				//$uploadfile = $dir.substr(md5(microtime()),1,8).basename($_FILES['file']['name']);
				$uploadfile = $dir.$_GET['id'].'.jpg';
			
				echo '<div class="alert alert-info">';
				if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
			    	echo "Archivo subido correctamente";
				} else {
			    	echo "Error al subir archivo";
				}
				echo "</div>";
			}
			
			// Eliminar
			if(isset($_GET['del'])){
				unlink($dir.$_GET['del']);
				header('Location: '.$url);
			}
			
			// Mostrar
			echo '<div class="row margin-top">';
			$directorio=opendir($dir);
			while ($archivo = readdir($directorio))
			  if($archivo != '.' && $archivo != '..' && strpos($archivo , $_GET['id'].'.jpg') !== false) echo '
			  	<div class="col-sm-12">
			  	<div class="thumbnail">
					<!--input value="'.$dir.$archivo.'" style="width:200px;" onclick="this.select();"-->
					<!--a style="float:right;" href="'.$url.'&del='.$archivo.'" onclick="return confirm(\'¿Realmente desea eliminar este archivo?\')">Eliminar</a-->
			  		<center><a href="'.$dir.$archivo.'" target="_blank"><img src="'.$dir.$archivo.'" style="max-width:100%;"></a></center>
			  	</div>
			  	</div>
			  '; 
			closedir($directorio); 
			echo '</div>';
			}
			?>
    	</div>
	</div>
</section>
