<?php
include('../acceso_db.php');
$id_card=$_POST['id_card'];
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
	
	$sql=$con->query("UPDATE cards SET tarjeta='$tarjeta',fecha='$fecha',cvv='$cvv',nota='$nota' WHERE id='$id_card'")or die(mysqli_error());
	
	if($sql> 0){
		echo 'response_200';
	}
}
?>