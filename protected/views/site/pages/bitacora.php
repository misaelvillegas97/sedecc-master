
<?php 

extract($_GET);
if(!isset(Yii::app()->user->id)){
  header('Location: index.php?r=site/login');
}

include("conexion.php");
mysqli_set_charset( $mysqli, 'utf8');



?>

	<link rel="shortcut icon" type="image/x-icon" href="http://innoapsion.cl/terreno/favicon.ico"/>
	<meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
	<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="css/animate.css" type="text/css" />
    <link rel="stylesheet" href="css/mio.css" type="text/css" />
	<link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
	<link rel="stylesheet" href="css/icon.css" type="text/css" />
	<link rel="stylesheet" href="css/font.css" type="text/css" />
	<link rel="stylesheet" href="css/app.css" type="text/css" />  

<style type="text/css">
	body {
		font: small "Trebuchet MS";
	}

	#disclaimer {
		background-color: #fafafa;
		padding: 1em;
		border: 3px double #ccc;
	}

	/*************************/
	/* Necesario para que se muestre bien los nuevos elementos agregados */

	.file {
		display: block;
	}

	span a {
		margin-left: 1em;
	}

	/*************************/
	.borInp2{
	padding: 8px;
	background-color:#12131a;
	color: #edf4f7;
	text-align: center;
	width: 100%;
	height: 30px auto;
	}

	.tittlecolor{
		color: #84898f;
	}

	.mrgn{
		margin-top: 5px !important;
	}

	.mrgnrow{
		margin-top: 5px;
	}
</style>
          
<div class="container-fluid">

	<?php 
	

	for ($i=1; $i <= 20; $i++) { 
		$myquery = "SELECT campo_".$i."_nombre as nombre, campo_".$i."_valor as valor FROM min_bitacora_dinamica WHERE bit_id = '1522977801318'";
		$resultado = $mysqli->query($myquery);
		$row = $resultado ->fetch_assoc();
		if ($row['nombre'] != NULL) {		
	?>

	<div class="col-md-4">
		<div class="row">
			<div class="col-md-12 mrgn">
				<span class="tittlecolor"><?php echo $row['nombre']; ?></span>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<input class="form-control" type="text" name="" value="<?php echo $row['valor']; ?>" disabled>
			</div>
		</div>
	</div>
	<?php
		}
	}
	?>

	

</div>




  <script src="js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="js/bootstrap.js"></script>
  <!-- App -->
  <script src="js/app.js"></script>  
  <script src="js/slimscroll/jquery.slimscroll.min.js"></script>
  <script src="js/charts/easypiechart/jquery.easy-pie-chart.js"></script>
  <script src="js/app.plugin.js"></script>
  <!--<script src="bootstrap/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>-->
  <script src="js/main.js"></script>
    
  <script src="js/alertify.js"></script>
  <script src="js/filtro.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
  <script src="js/jquery.table2excel.js"></script>

<script type="text/javascript">
var numero = 0;

// Funciones comunes
c= function (tag) { // Crea un elemento
   return document.createElement(tag);
}
d = function (id) { // Retorna un elemento en base al id
   return document.getElementById(id);
}
e = function (evt) { // Retorna el evento
   return (!evt) ? event : evt;
}
f = function (evt) { // Retorna el objeto que genera el evento
   return evt.srcElement ?  evt.srcElement : evt.target;
}

addField = function (num) {
   container = d('files'+num);
   
   span = c('SPAN');
   span.className = 'file';
   span.id = 'file' + (++numero);
   span.style = 'height: 25px;';
   

   field = c('INPUT');   
   field.name = 'archivos'+num+'[]';
   field.type = 'file';
   field.required = 'true';
   field.multiple = 'true';
   field.style = 'float:left;';
   field.onchange = function() {
    control(this);
	}
   

   a = c('A');
   a.name = span.id;
   a.href = '#';
   a.onclick = removeField;
   a.innerHTML = 'Quitar';
   

   span.appendChild(field);
   span.appendChild(a);
   container.appendChild(span);
}

removeField = function (evt) {
   lnk = f(e(evt));
   span = d(lnk.name);
   span.parentNode.removeChild(span);
}
</script>
 
<script type="text/javascript">
	function control(f){
		var ext=['gif','jpg','jpeg','png','pdf'];
		var v=f.value.split('.').pop().toLowerCase();
		for(var i=0,n;n=ext[i];i++){
		if(n.toLowerCase()==v)
		return
		}
		var t=f.cloneNode(true);
		t.value='';
		f.parentNode.replaceChild(t,f);
		alert('La extensión del archivo no es válida, subir solo en formato de imagen');
	}
</script>
<script type="text/javascript">
	function dlDataUrlBin2(b){
		var valor2 = document.getElementById("texto2"+b).value;
		download(valor2, "Descarga.jpeg", "image/");
	}
</script>
