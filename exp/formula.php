<?php

if($_GET['a'] < 60){
	$a = (1+($_GET['a']/20));
}
else{
	$a = (-0.5+($_GET['a']/13.32));
}

if($_GET['a'] <= 100 && $_GET['a'] >= 0) echo number_format ($a,2);
else echo 'Fuera de rango';
?>