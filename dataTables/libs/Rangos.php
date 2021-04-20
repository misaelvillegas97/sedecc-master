<?php
include("../../conexion.php");
    mysqli_set_charset( $mysqli, 'utf8');
    $sql = "SELECT * from grupo_rangos_alejandro";
    $result = mysqli_query($mysqli, $sql)or die (mysqli_error());  

?>

<!DOCTYPE html>

<html>

<head>

	<title>Trabajadores</title>
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

	<!-- Jquery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>

	<!-- JavaScript -->
	<script src="JSGrupo/Funciones.js"></script>

</head>

<body>

	   <nav class="navbar navbar-expand-lg navbar-light bg-inverse">

	  <a class="nav-item nav-link disabled" href="">Barra de Navegacion</a>



	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">

	    <span class="navbar-toggler-icon"></span>

	  </button>

	 

	  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">

	    <div class="navbar-nav">

	      <a class="nav-item nav-link active" href="#">Ver Listado Rangos<span class="sr-only">(current)</span></a>

	      <a class="nav-item nav-link" href="">Mantenciones</a>

	      <a class="nav-item nav-link" href="libs/man_rangos1.php">Ingresos</a>

	      <a class="nav-item nav-link " href="listarPaises.php">Ver Registros</a>      

	    </div>

	  </div>



  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Desconectarse <i class="fas fa-user"></i></button>

</nav>

	<!-- La idea es que en esta parte pongamos los rangos en los que trabajaremos -->

	<!-- TRABAJADORES -->

	<!-- La idea es que en esta parte pongamos los rangos en los que trabajaremos -->

	<!-- N° trab	1- 100	101- 200	201-300	 301-400	401-500   >500 -->

	<!-- Base	    1,0	     1,0	      0,5		0,5		 0,0	  0,0 -->

	<!-- id rango, comienzo, final, base , variable !-->

	<div class="container-fluid">

      <div class="col-md-15">

	<div class="card">

  <div class="card-header">

    Mantencion de Rangos
    <button type="button" class="btn btn-success" id="btn" data-toggle="modal" data-target="#exampleModal" style="float: right;" >Agregar</button>

  </div>

  <div class="card-body">

  	<div id="contenido"></div>

  	<!-- acá agregamos los rangos por mientras usaremos solo html sin javascript -->

  	<table class="table table-hover table-bordered">
  		<thead>
  			<tr>
  				<td>ID</td>

  				<td>Inicio del Rango</td>

  				<td>Termino del Rango</td>

  				<td>Valor Fijo<cite title="Source Title">(UF)</cite></td>

  				<td>Valor Variable<cite title="Source Title">(UF)</cite></td>

  				<td align="center">Acciones</td>
  			</tr>

  		</thead>

  		<!-- Como todavia no entiendo como funciona la conexion, dejemos esto acá por el momento -->

  			<?php 
			 while($row = $result ->fetch_assoc()){   


                      $grupo_id = $row["id_rango"];

                      $grupo_inicio =$row["comienzo"];

                      $grupo_termino =$row["final"];

                      $grupo_fijo =$row["fijo"];

                      $grupo_variable =$row["variable"];

                  echo '
                  		<tr>
                  		<td>'.$grupo_id.'</td>

  						<td>'.$grupo_inicio.'</td>

  						<td>'.$grupo_termino.'</td>

		  				<td>'.$grupo_fijo.'<cite title="Source Title">(UF)</cite></td>

		  				<td>'.$grupo_variable.'<cite title="Source Title">(UF)</cite></td>

		  				<td>

		  				<div class="btn-group" >

		  				<button type="button" class="btn btn-primary ver"  verid="'.$grupo_id.'">Ver</button>

		  				<button type="button" class="btn btn-success editar" editarid="'.$row['id_rango'].'">Editar</button>

		  				<button type="button" class="btn btn-danger eliminar" eliminarid="'.$row['id_rango'].'">Eliminar</button>


		  				</div>
		  				</td>
		  				</tr>';


                  }


            ?>	

  	</table>

    <blockquote class="blockquote mb-0">

      <p></p>

      <footer class="blockquote-footer" text-align="center">
      	<?php
      	$apiUrl = 'https://mindicador.cl/api';
//Es necesario tener habilitada la directiva allow_url_fopen para usar file_get_contents
if ( ini_get('allow_url_fopen') ) {
    $json = file_get_contents($apiUrl);
} else {
    //De otra forma utilizamos cURL
    $curl = curl_init($apiUrl);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($curl);
    curl_close($curl);
}
 
	$dailyIndicators = json_decode($json);
echo 'El valor actual de la UF es $' . $dailyIndicators->uf->valor;

	?>

      </footer>

      <!-- <cite title="Source Title">Source Title</cite> -->

    </blockquote>

  </div>

</div>

</div>

</div>



	<!-- La idea es que en esta parte pongamos los rangos en los que trabajaremos -->
	



</body>

</html>