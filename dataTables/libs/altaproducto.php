<?php

	 include("../../conexion.php");

	if(!isset($_POST['id_rango']) && !isset($_POST['rango_trabajador']) && !isset($_POST['fijo_uf']) &&  !isset($_POST['variableuf_tra']) && !isset($_POST['cheklist'])){

		header("Location:man_rangos1.php");

	}else{

			$allowedExts = array("gif", "jpeg", "jpg", "png");

			$temp = explode(".", $_FILES["file"]["name"]);

			$extension = end($temp);

			$imagen="";

			$random=rand(1,999999);

			if ((($_FILES["file"]["type"] == "image/gif")

				|| ($_FILES["file"]["type"] == "image/jpeg")

				|| ($_FILES["file"]["type"] == "image/jpg")

				|| ($_FILES["file"]["type"] == "image/pjpeg")

				|| ($_FILES["file"]["type"] == "image/x-png")

				|| ($_FILES["file"]["type"] == "image/png"))){

				//Verificamos que sea una imagen

		  	if ($_FILES["file"]["error"] > 0){

		  		//verificamos que venga algo en el input file

		    	echo "Error numero: " . $_FILES["file"]["error"] . "<br>";

		    }else{

		    	//subimos la imagen



		    	$imagen= $random.'_'.$_FILES["file"]["name"];

		    	if(file_exists("../productos/".$random.'_'.$_FILES["file"]["name"])){

		      		echo $_FILES["file"]["name"] . " Ya existe. ";

		      	}else{

		      		move_uploaded_file($_FILES["file"]["tmp_name"],

		      		"../productos/" .$random.'_'.$_FILES["file"]["name"]);

		      		echo "Archivo guardado en " . "../productos/" .$random.'_'. $_FILES["file"]["name"];

					$id_rango=$_POST['id_rango'];

					$rango_trabajador=$_POST['rango_trabajador'];

		      		$fijo_uf=$_POST['fijo_uf'];

					$variableuf_tra=$_POST['variableuf_tra'];

					$cheklist=$_POST['checklist'];

					$Sql="insert into factura (id_rango,rango_trabajador,fijo_uf,variableuf_tra,cheklist,) values(

					        '".$id_rango."',

							'".$rango_trabajador."',

							'".$fijo_uf."',

							'".$variableuf_tra."',

							'".$cheklist."')";

							

					mysql_query($Sql);

					header ("Location: man_rangos1.php");

		      }

		    }

		  }else{

		  echo "ingrese imagen";

		  }



		

	}

?>

