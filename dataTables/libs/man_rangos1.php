<!doctype html>
<html>
<head>

	<!--    ESTILO GENERAL   -->
        <link type="text/css" href="css/style.css" rel="stylesheet" />
        
        <!--    ESTILO GENERAL    -->
        <!--    JQUERY   -->
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" language="javascript" src="js/funciones.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        <!--    JQUERY    -->
        <!--    FORMATO DE TABLAS    -->
        <link type="text/css" href="css/demo_table.css" rel="stylesheet" />
        <script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
        <!--    FORMATO DE TABLAS    -->
	<style type="text/css">
		body {
	background: rgb(125,185,232); /* Old browsers */
	background: -moz-linear-gradient(top,  rgba(125,185,232,1) 71%, rgba(125,185,232,1) 99%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(71%,rgba(125,185,232,1)), color-stop(99%,rgba(125,185,232,1))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  rgba(125,185,232,1) 71%,rgba(125,185,232,1) 99%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  rgba(125,185,232,1) 71%,rgba(125,185,232,1) 99%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  rgba(125,185,232,1) 71%,rgba(125,185,232,1) 99%); /* IE10+ */
	background: linear-gradient(to bottom,  rgba(125,185,232,1) 71%,rgba(125,185,232,1) 99%); /* W3C */


filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#E6B548', endColorstr='#E6B548',GradientType=0 ); /* IE6-9 */
	color: #000;
	font-family: "Century Gothic";
	font-size: 16px;
	line-height: 1.6;
}
h2 {
	color: #000
    font-family: Verdana, Geneva, sans-serif;
	font-size: 22px;
	margin: 15px;
	text-align: center;
	
}
.group {
	border: 3px solid #999999;
	padding: 20px;
	width: 400px;
	color: #006;
border-radius: 8px;
border-color:#036;
	
	background: rgb(255,255,255); /* Old browsers */
	background: -moz-linear-gradient(top,  rgba(255,255,255,1) 0%, rgba(209,238,255,1) 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,1)), color-stop(100%,rgba(209,238,255,1))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  rgba(255,255,255,1) 0%,rgba(209,238,255,1) 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  rgba(255,255,255,1) 0%,rgba(209,238,255,1) 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  rgba(255,255,255,1) 0%,rgba(209,238,255,1) 100%); /* IE10+ */
	background: linear-gradient(to bottom,  rgba(255,255,255,1) 0%,rgba(209,238,255,1) 100%); /* W3C */

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#d1eeff',GradientType=0 ); /* IE6-9 */
	margin-top: 0;
	margin-right: auto;
	margin-bottom: 0;
	margin-left: auto;
}
.contact-form {
	width: 400px;
	text-align: left;

}

/* Form input box style */
.form-input {
	display: block;
	width: 200px;
	height: 15px;
	margin-bottom: 15px;
	color: #000;
	background-color: #FF9;
	border: 1px solid #999;
	box-shadow: inset 0 0 1px rgba(0, 0, 0, 0.7), 0 1px 0 rgba(255, 255, 255, 0.1);
	-moz-transition: all 0.4s ease-in-out;
	-webkit-transition: all 0.4s ease-in-out;
	-o-transition: all 0.4s ease-in-out;
	-ms-transition: all 0.4s ease-in-out;
	transition: all 0.4s ease-in-out;
	behavior: url(PIE.htc);
	font-family: "Century Gothic";
	font-size: 14px;
	padding-top: 5px;
	padding-right: 10px;
	padding-bottom: 5px;
	padding-left: 10px;
}

/* Focus style */
.form-input:focus {
	border: 1px solid #7fbbf9;
	-moz-box-shadow:    inset 0 0 1px rgba(0, 0, 0, 0.7), 0 0 1px #7fbbf9;
	-webkit-box-shadow: inset 0 0 1px rgba(0, 0, 0, 0.7), 0 0 1px #7fbbf9;
	box-shadow:         inset 0 0 1px rgba(0, 0, 0, 0.7), 0 0 1px #7fbbf9;
}

/* Error style */
.form-input:-moz-ui-invalid {
	border: 1px solid #e00;
	-moz-box-shadow:    inset 0 0 1px rgba(0, 0, 0, 0.7), 0 0 1px #e00;
	-webkit-box-shadow: inset 0 0 1px rgba(0, 0, 0, 0.7), 0 0 1px #e00;
	box-shadow:         inset 0 0 1px rgba(0, 0, 0, 0.7), 0 0 1px #e00;
}

.form-input.invalid {
	border: 1px solid #e00;
	-moz-box-shadow:    inset 0 0 1px rgba(0, 0, 0, 0.7), 0 0 1px #e00;
	-webkit-box-shadow: inset 0 0 1px rgba(0, 0, 0, 0.7), 0 0 1px #e00;
	box-shadow:         inset 0 0 1px rgba(0, 0, 0, 0.7), 0 0 1px #e00;
}

/* Form submit button */
.form-btn {
	padding: 0 15px;
	height: 30px;
	font: bold 12px 'Helvetica Neue', Helvetica, Arial, sans-serif;
	text-align: center;
	color: #fff;
	text-shadow: 0 1px 0 rgba(0, 0, 0, 0.7);
	cursor: pointer;
	border: 1px solid #0d3d6a;
	outline: none;
	position: relative;
	background-color: #1d83e2;
	background-image: -webkit-gradient(linear, left top, left bottom, from(#1d83e2), to(#0d3d6a)); /* Saf4+, Chrome */
	background-image: -webkit-linear-gradient(top, #1d83e2, #0d3d6a); /* Chrome 10+, Saf5.1+, iOS 5+ */
	background-image:    -moz-linear-gradient(top, #1d83e2, #0d3d6a); /* FF3.6 */
	background-image:     -ms-linear-gradient(top, #1d83e2, #0d3d6a); /* IE10 */
	background-image:      -o-linear-gradient(top, #1d83e2, #0d3d6a); /* Opera 11.10+ */
	background-image:         linear-gradient(top, #1d83e2, #0d3d6a);
	-pie-background:          linear-gradient(top, #1d83e2, #0d3d6a); /* IE6-IE9 */
	-moz-box-shadow:    inset 0 1px 0 rgba(255, 255, 255, 0.3), 0 1px 2px rgba(0, 0, 0, 0.7);
	-webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.3), 0 1px 2px rgba(0, 0, 0, 0.7);
	box-shadow:         inset 0 1px 0 rgba(255, 255, 255, 0.3), 0 1px 2px rgba(0, 0, 0, 0.7);
	-moz-background-clip:    padding;
	-webkit-background-clip: padding-box;
	background-clip:         padding-box;
	behavior: url(PIE.htc);
}

.form-btn:active {
	border: 1px solid #1d83e2;
	background-color: #0d3d6a;
	background-image: -webkit-gradient(linear, left top, left bottom, from(#0d3d6a), to(#1d83e2)); /* Saf4+, Chrome */
	background-image: -webkit-linear-gradient(top, #0d3d6a, #1d83e2); /* Chrome 10+, Saf5.1+, iOS 5+ */
	background-image:    -moz-linear-gradient(top, #0d3d6a, #1d83e2); /* FF3.6 */
	background-image:     -ms-linear-gradient(top, #0d3d6a, #1d83e2); /* IE10 */
	background-image:      -o-linear-gradient(top, #0d3d6a, #1d83e2); /* Opera 11.10+ */
	background-image:         linear-gradient(top, #0d3d6a, #1d83e2);
	-pie-background:          linear-gradient(top, #0d3d6a, #1d83e2); /* IE6-IE9 */
	-moz-box-shadow:    inset 0 0 2px rgba(0, 0, 0, 0.7), 0 1px 0 rgba(255, 255, 255, 0.1);
	-webkit-box-shadow: inset 0 0 2px rgba(0, 0, 0, 0.7), 0 1px 0 rgba(255, 255, 255, 0.1);

	box-shadow:         inset 0 0 2px rgba(0, 0, 0, 0.7), 0 1px 0 rgba(255, 255, 255, 0.1);
	behavior: url(PIE.htc);
}

label {
	margin-bottom: 8px;
	display: block;
	width: 300px;
	color: #003;
	font-size: 14px;
	font-weight: bold;
}

label span {
	font-size: 12px;
	color:#333;
	font-weight: normal;
}

.contact-form.frame {
    background-color: #444444;
    border: 1px solid #CCCCCC;
    padding: 20px;
}

	</style>

	<script type="text/javascript">
		function validaNumericos(event) {
    if(event.charCode >= 48 && event.charCode <= 57){
      return true;
     }
     return false;        
}
	</script>
		
	

<meta charset="utf-8">
<title>rangos</title>
</head>
<body>
	<div class="group">
  <form action="registro.php" method="POST">

  <h2><em>Mantenedor de rangos</em></h2>
  
     
      <label for="id_rango">id_rango <span><em>(*)</em></span></label>
      <input type="number" name="id_rango" placeholder="rango sin guion" class="form-input" required onkeypress='return validaNumericos(event)'/> 
        <label for="rango"> Rango de Tabajadores <span><em>(*)</em></span></label>
      <input  type="number" name="rango_trabajador"  class="form-input" required />
        <label for="Fijo">Fijo UF <span><em>(*)</em></span></label>
      <input type="number"  name="fijo_uf" class="form-input" required /> 
     <label for="variable">variable UF/trabajador <span><em>(*)</em></span></label>
      <input type="number" name="variableuf_tra" class="form-input" required/>             
      
      <label for="check">check list por numero de trabajador eess <span><em>(*)</em></span></label>
      <input name="checklist" class="form-input"  onkeypress='return validaNumericos(event)'/>
     <center> <input class="form-btn" name="submit" type="submit" value="Guardar"  /></center>
    </p>
  </form>
 
</body>
</html>

