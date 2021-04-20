<style type="text/css">
	
#ctm{
    padding-left: 0px !important;
}
</style>
<?php
    extract($_GET);
    if(!isset(Yii::app()->user->id)){
    header('Location: index.php?r=site/login');
    }

    $where = "";
    $filtroTipo = "";
    if(isset($_POST['filtro_tipo'])){
        if(empty($_POST['filtro_tipo'])){
            $where.= "";
            $filtroTipo = '';
        }else{
            $where.= " and reu_tipo='".$_POST['filtro_tipo']."' ";
            $filtroTipo = $_POST['filtro_tipo'];
        }	
    }else{
        $filtroTipo = '';

    }
    $eess='96960670';
    if(isset($_POST['filtro_empresa'])){
        $eess=$_POST['filtro_empresa'];

    }

    // Cuando el tipo de usuario es empresa
    if(Yii::app()->controller->usertype() == 1){
        $eess=Yii::app()->user->id;
    }
    // Cuando el tipo de usuario es evaluador
    if(Yii::app()->controller->usertype() == 3){
        $eess = Yii::app()->db->createCommand("SELECT DISTINCT(eess_rut) FROM min_trabajador WHERE tra_rut = '".Yii::app()->user->id."'")->queryScalar();
    }

    $contador = 0;
    // cuando el usuario ingresado es empresa
    if (Yii::app()->controller->usertype() == 3) {
        # code...
        $contador  = Yii::app()->db->createCommand("SELECT COUNT(*) FROM min_reunion WHERE eess_rut = ".Yii::app()->user->id)->queryScalar();
    }

    // Cuando el usuario ingresado es un evaluador
    if (Yii::app()->controller->usertype() == 1) {
        # code...
        $contador  = Yii::app()->db->createCommand("SELECT COUNT(*) FROM min_reunion WHERE eess_rut = ".$eess)->queryScalar();
    }

    // Cuando el usuario ingresado es admin
    if (Yii::app()->controller->usertype() == 2) {
        # code...
        $contador  = Yii::app()->db->createCommand("SELECT COUNT(*) FROM min_reunion as E JOIN min_eess as EE ON(E.eess_rut = EE.eess_rut) WHERE EE.eess_estado = 1")->queryScalar();
    }

?>

<div style="height:25px"></div>
<span style="float:right;">
    <a  href="index.php?r=site/page&view=reunion"><img src="img/list.png" width="35px;"></a>
<!--class="btn btn-rounded btn-sm btn-icon btn-default"-->
</span>
<span class="h1" style="margin-top: 20px;">Resumen tabla capacitación/inspección/reunión</span> <span class="text-muted">(<?php echo $contador; ?> en total)</span>

<div class="span-19">
 	<div id="content">
		<form method="post">
			
			<div class="col-sm-3"  id="ctm">
				<small>Actividad</small>
				<select  name="filtro_tipo" onchange="this.form.submit();" class="form-control input-sm" >
					<option value="">Todas</option>
					<?php  
				
					$rows = Yii::app()->db->createCommand("select DISTINCT reu_tipo from min_reunion")->query()->readAll();
					for($i=0;$i<count($rows);$i++){
						if($rows[$i]['reu_tipo'] == $filtroTipo){
							$selected = "selected";
						}else{
							$selected = "";
						}
						
						echo '<option '.$selected.' value="'.$rows[$i]['reu_tipo'].'">'.$rows[$i]['reu_tipo'].'</option>';
					}
				
				    ?>				             					
				</select>
				<br>
			</div>
		</form>
		
		<div class="grid-view">
			  
			
			<table class="items table table-striped table-bordered table-hover" style="margin-top: 10px;background-color: white;">
				<thead style="background-color: #365fa0;color: white;">
					<tr align="center">
						<th style="text-align: center" class="th-sortable" data-toggle="class">Actividad</th>
						<th style="text-align: center" class="th-sortable" data-toggle="class">Ejecutor</th>
						<th style="text-align: center" class="th-sortable" data-toggle="class">Asesor (APR)</th>
						<th style="text-align: center" class="th-sortable" data-toggle="class">Lugar</th>
						<th style="text-align: center" class="th-sortable" data-toggle="class">Fecha</th>
						<th style="text-align: center" class="th-sortable" data-toggle="class">Georeferencia</th>
						<th style="text-align: center" class="th-sortable" data-toggle="class">Seguimiento</th>
						<th style="text-align: center;" class="th-sortable" data-toggle="class">Acciones</th>
					</tr>
				</thead>
				<tbody id="datos" style="font-size:12px;">
				</tbody>
			</table>
		</div>
		
		<footer >
			<div class="row">
				<div class="col-md-12 text-center">
					<ul class="pagination" id="paginador" name="paginador"></ul>
				</div>
			</div>
		</footer>
	</div>
</div>






          <!-- Button trigger modal -->



<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Exportar a Correo</h4>
			</div>




			<script>
				function FLTRAR(){
				a = document.getElementById('area3').value;
				e = document.getElementById('buscar3').value;
				 document.getElementById("areaF").value = a;
				 document.getElementById("buscF").value = e;
				}
				</script>


			<!--<form id="filtrar" action="email.php" method="post" data-form-title="Formulario de contacto">
				<div class="modal-body">
					<input type="hidden" value="Bhc8uKnbVUBWpKTvtsHaVV68Y+YN7KjO9wDbFqVv7Nu7yyBzKfrZT5yMsieX+F1f7UWGezCFUno1ehKOrk4Q4nipEPxiuJdBKP/JLgY7x7x+aVZK5wOZ4OvwF4DspvRM" data-form-email="true">

					<div class="form-group">
						<input type="hidden" class="form-control" name="email1" required="" value='<?php //echo $_SESSION['correo_admin'];?>'  data-form-field="Email">
					</div>

					<!-- INICIO DATOS FILTRO -->
					<!-- <div class="form-group">
						<input class="form-control" type="hidden" name="areaF" id="areaF">
					</div>
					<div class="form-group">
						<input class="form-control" type="hidden" name="buscF" id="buscF">
					</div>
					<!-- FIN DATOS FILTRO -->

					<!-- <div class="form-group">
						<input type="hidden" class="form-control" name="cod" required="" value='1'>
					</div>
					<div class="form-group">
						<input type="email" class="form-control" name="email"   required="" placeholder="Ingrese su correo electrónico" data-form-field="Email">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="asunto" required="" placeholder="Ingrese el asunto" data-form-field="tex">
					</div>
					<div class="form-group">
						<textarea class="form-control" id="message"  name="message" rows="7" placeholder="Ingrese el mensaje" data-form-field="Message"></textarea>
					</div>
						<h3>Archivos Adjuntos</h3>
						<input style="width: 20px;	height: 20px;" type="checkbox" name="pdf" value="1" checked ><img src="../images/pdf.jpg" width="30" height="30">

						<input style="width: 20px;	height: 20px;" type="checkbox" name="excel" value="1" checked><img src="../images/excel.jpg" width="30" height="30">
						<br>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
					<button  type="submit" class="btn btn-primary" ><i class="i i-mail" ></i> Enviar correo</button>

				</div>
			</form>-->
		</div>
	</div>
</div>


              



  <!-- Bootstrap -->

  <!-- App -->
  <script src="js/app.js"></script>
  <script src="js/slimscroll/jquery.slimscroll.min.js"></script>
  <script src="js/charts/easypiechart/jquery.easy-pie-chart.js"></script>
  <script src="js/app.plugin.js"></script>
  <!--<script src="bootstrap/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>-->
  <script src="js/main.js"></script>
  <script src="js/filtro.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
  <script src="js/jquery.table2excel.js"></script>
  <script LANGUAGE="JavaScript">
function abreSitio(){
var URL = "http://";
var web = document.form5.sitio.options[document.form5.sitio.selectedIndex].value;
window.open(URL+web, '_blank', '');
}
</script>
  <script type="text/javascript">

    var paginador;
    var totalPaginas
    var itemsPorPagina = 10;
    var numerosPorPagina = 5;

    function creaPaginador(totalItems)
    {
      paginador = $(".pagination");

      totalPaginas = Math.ceil(totalItems/itemsPorPagina);

      $('<li><a href="#" class="first_link"><</a></li>').appendTo(paginador);
      $('<li><a href="#" class="prev_link">«</a></li>').appendTo(paginador);

      var pag = 0;
      while(totalPaginas > pag)
      {
        $('<li><a href="#" class="page_link">'+(pag+1)+'</a></li>').appendTo(paginador);
        pag++;
      }


      if(numerosPorPagina > 1)
      {
        $(".page_link").hide();
        $(".page_link").slice(0,numerosPorPagina).show();
      }

      $('<li><a href="#" class="next_link">»</a></li>').appendTo(paginador);
      $('<li><a href="#" class="last_link">></a></li>').appendTo(paginador);

      paginador.find(".page_link:first").addClass("active");
      paginador.find(".page_link:first").parents("li").addClass("active");

      paginador.find(".prev_link").hide();

      paginador.find("li .page_link").click(function()
      {
        var irpagina =$(this).html().valueOf()-1;
        cargaPagina(irpagina);
        return false;
      });

      paginador.find("li .first_link").click(function()
      {
        var irpagina =0;
        cargaPagina(irpagina);
        return false;
      });

      paginador.find("li .prev_link").click(function()
      {
        var irpagina =parseInt(paginador.data("pag")) -1;
        cargaPagina(irpagina);
        return false;
      });

      paginador.find("li .next_link").click(function()
      {
        var irpagina =parseInt(paginador.data("pag")) +1;
        cargaPagina(irpagina);
        return false;
      });

      paginador.find("li .last_link").click(function()
      {
        var irpagina =totalPaginas -1;
        cargaPagina(irpagina);
        return false;
      });

      cargaPagina(0);




    }
function abrirModal(){
	$('#myModal1').modal('show');
}
var rut='<?php echo $eess; ?>';
var where="<?php echo $where; ?>";

function cargaPagina(pagina){

	var desde = pagina * itemsPorPagina;
	var area = $('#area3').val() == undefined ? '' : $('#area3').val();
	console.log(itemsPorPagina);
	console.log(desde);
	console.log(area);
	console.log(rut);
	console.log(where);

	$.ajax({
		data:{"param1":"dame","limit":itemsPorPagina,"offset":desde,"area":area,"rut":rut,"where":where},
        type:"GET",
        dataType:"json",
        cache:false,
        url:"conexionReunion.php"
	}).done(function(data,textStatus,jqXHR){

		var lista = data.lista;
		console.log(data);

        $("#datos").html("");

        $.each(lista, function(ind, elem){
			var roves1;
			var roves2;
			var roves3;
			var roves4;
			var roves5;
			var roves6;
			var roves7;
			var roves8;
			var semaforo;

			if (elem.sema == 3) {
					semaforo = "<img style='height:25px;' src='images/semaforo_rojo.png'>";
				}else if (elem.sema == 2) {
					semaforo = "<img style='height:25px;' src='images/semaforo_amarillo.png'>";
				}else if (elem.sema == 1) {
					semaforo = "<img style='height:25px;' src='images/semaforo_verde.png'>";
				}else if (elem.sema == 0) {
					semaforo = "S/A";
				}

				roves1="<b>"+elem.reu_tipo+" </b>";
				roves4="<b>"+elem.evaluador+"</b>";
				roves5="<b>"+elem.eess_apr+"</b>";
				roves6="<b>"+elem.reu_lugar+"</b>";
				roves7="<b>"+elem.reu_tiempo+"</b>";
				roves8="<b>"+elem.geo+"</b>";
				roves9="<b>"+semaforo+"</b>";

			$("<tr>"+
			"<td style='text-align: center'>"+roves1+"</td>"+
			"<td style='text-align: center'>"+roves4+"</td>"+
			"<td style='text-align: center'>"+roves5+"</td>"+
			"<td style='text-align: center'>"+roves6+"</td>"+
			"<td style='text-align: center'>"+roves7+"</td>"+
      		"<td style='text-align: center'>"+roves8+"</td>"+
      		"<td style='text-align: center'>"+roves9+"</td>"+
      		"<td class='button-column' style='60px !important;'><a title='Modificar' href='index.php?r=site/page&view=reunionD&id="+elem.reu_id+"'><img src='/sedecc/assets/94f94605/gridview/update.png' alt='Update'></a>"+
      		"<a title='Eliminar' style='margin-right: 0' href='index.php?r=site/page&view=reunionDel&id="+elem.reu_id+"' onClick='return confirm(&quot; ¿Estás seguro que desea eliminar esta bitácora? &quot;)'><img src='/sedecc/assets/94f94605/gridview/delete.png' alt='Delete'></a></td>"+			
            "</tr>").appendTo($("#datos"));
        });
	}).fail(function(jqXHR,textStatus,textError){
		alert("Error al realizar la peticion dame".textError);

	});
/*
	if(pagina >= 1){
		paginador.find(".prev_link").show();
	}
	else{
		paginador.find(".prev_link").hide();
	}
	if(pagina <(totalPaginas- numerosPorPagina)){
		paginador.find(".next_link").show();
	}else
      {
        paginador.find(".next_link").hide();
      }

      paginador.data("pag",pagina);

      if(numerosPorPagina>1)
      {
        $(".page_link").hide();
        if(pagina < (totalPaginas- numerosPorPagina))
        {
          $(".page_link").slice(pagina,numerosPorPagina + pagina).show();
        }
        else{
          if(totalPaginas > numerosPorPagina)
            $(".page_link").slice(totalPaginas- numerosPorPagina).show();
          else
            $(".page_link").slice(0).show();

        }
      }

      paginador.children().removeClass("active");
      paginador.children().eq(pagina+2).addClass("active");*/


    }


$(function(){
	cargarTabla();
});

function cargarTabla(){
	$("#mitabla").empty();
	$("#paginador").empty();
	$.ajax({
		data:{"param1":"cuantos"},
        type:"GET",
        dataType:"json",
        cache:false,
        url:"conexionReunion.php"
	}).done(function(data,textStatus,jqXHR){
		var total = data.total;
        creaPaginador(total);

	}).fail(function(jqXHR,textStatus,textError){
        alert("Error al realizar la peticion cuantos".textError);
	});
}

function excel() {
	window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#tabla').html()));
	e.preventDefault();
}

$('#area3').on('change', function(){
   cargarTabla();
});

$('#buscar3').on('keydown', function(){
   cargarTabla();
});

    </script>
    <style>
    	.pagination{
    		display:none;
    	}
    </style>

