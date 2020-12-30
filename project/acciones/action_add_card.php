<?php
include('../acceso_db.php');

$tarjeta=$_POST['tarjeta'];
$fecha=$_POST['fecha'];
$cvv=$_POST['cvv'];
$nota=$_POST['nota'];

if(trim($tarjeta) == ""){
	echo "<div class='alert alert-danger'>Ingresa el numero de tarjeta</div>";
}
elseif(strlen($tarjeta) < 16){
	echo "<div class='alert alert-danger'>El número de tarjeta debe contener 16 dígitos</div>";
}
elseif(trim($fecha) == ""){
	echo "<div class='alert alert-danger'>La fecha de vencimiento es requerida</div>";
}
elseif(trim($cvv) == ""){
	echo "<div class='alert alert-danger'>El cvv es requerido</div>";
}
elseif(strlen($cvv) < 3){
	echo "<div class='alert alert-danger'>El cvv debe contener 3 dígitos</div>";
}
else{
	
	$sql=$con->query("INSERT INTO cards (tarjeta,fecha,cvv,nota) VALUES ('$tarjeta','$fecha','$cvv','$nota')")or die(mysqli_error());
	echo 'response_200';
}
?>