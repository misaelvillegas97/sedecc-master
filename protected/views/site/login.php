<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
  'Login',
);
extract($_GET);
if (isset($returnurl)) {
  Yii::app()->user->returnUrl = $returnurl . '&id=' . $id;
}

?>

<style type="text/css">
      body{
        background-image: url(img/1.jpg);
          background-size: 100% 100%; 
    }
    span{
      color: white;
      font-size: 10px;
    }
.errorMessage{
  color: red;

}
</style>
<!DOCTYPE html>
<html lang="en" class="app">
<head>  
  <meta charset="utf-8" />
  <title>SEDECC</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
  <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="css/animate.css" type="text/css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="css/icon.css" type="text/css" />
  <link rel="stylesheet" href="css/font.css" type="text/css" />
  <link rel="stylesheet" href="css/app.css" type="text/css" />  
    <!--[if lt IE 9]>
    <script src="js/ie/html5shiv.js"></script>
    <script src="js/ie/respond.min.js"></script>
    <script src="js/ie/excanvas.js"></script>
  <![endif]-->
</head>
<body class="">
  <section id="content" class="m-t-lg wrapper-md animated fadeInUp" >    
    <div  class="col-md-4"></div>
    <div class="container col-md-4 text-center img-responsive" >
      <img src="img/logo.png">
      <section class="m-b-lg">
        

        <?php $form = $this->beginWidget('CActiveForm', array(
          'id' => 'login-form',
          'enableClientValidation' => true,
          'clientOptions' => array(
            'validateOnSubmit' => true,
          ),
        )); ?>
    
        <div class="col-md-1"></div>
        <div class="col-md-10" style="border-radius: 10px 10px 10px 10px; background-color: #217fbd; padding:30px; -webkit-box-shadow: 10px 10px 5px -6px rgba(0,0,0,0.75); -moz-box-shadow: 10px 10px 5px -6px rgba(0,0,0,0.75); box-shadow: 10px 10px 5px -6px rgba(0,0,0,0.75); margin-bottom: 10px;">
              <span style="margin-left:10px;">Nombre de usuario</span>
			   <?php echo $form->textField($model, 'username', array('placeholder' => 'Nombre de usuario (o RUT evaluador)', 'class' => 'form-control', 'style' => 'border-radius: 5px;', 'autofocus' => 'true')); ?>
               <?php echo $form->error($model, 'username'); ?>
            <br>
            <span style="margin-left:10px;">Contraseña</span>
	          <?php echo $form->passwordField($model, 'password', array('placeholder' => 'Contraseña (o RUT EESS)', 'class' => 'form-control', 'style' => 'border-radius: 5px; margin-bottom: 20px;')); ?>
              <?php echo $form->error($model, 'password'); ?>
            
            
          
          <?php echo CHtml::submitButton('Login', array('class' => 'btn btn-lg btn-primary btn-block', 'style' => 'background-color: #ffad01; border-radius: 15px; -webkit-box-shadow: 0px 10px 5px -6px rgba(0,0,0,0.75); -moz-box-shadow: 0px 10px 5px -6px rgba(0,0,0,0.75); box-shadow: 0px 10px 5px -6px rgba(0,0,0,0.75);')); ?>
          <!--button type="submit" class="btn btn-lg btn-primary btn-block">Sign in</button-->
          <!--div class="text-center m-t m-b"><a href="#"><small>Forgot password?</small></a></div-->
          <!--div class="line line-dashed"></div>
          <p class="text-muted text-center"><small>Do not have an account?</small></p>
          <a href="signup.html" class="btn btn-lg btn-default btn-block">Create an account</a-->
        
		</div>
<div class="col-md-1"></div>
<?php $this->endWidget(); ?>

          	
  
  <!-- footer -->
  <footer id="footer">
    <div class="text-center padder">
      <p><br>
        <span style="font-size: 15px;">SISTEMA DE EVALUACIÓN DE DESEMPEÑO<br>PARA CARGOS CRITICOS<br><br>&copy; <?php echo date("Y"); ?></span>
      </p>
    </div>
  </footer>
      </section>
    </div>
  </section>
  <!-- / footer -->
  <script src="js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="js/bootstrap.js"></script>
  <!-- App -->
  <script src="js/app.js"></script>  
  <script src="js/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="js/app.plugin.js"></script>

</body>
</html>

