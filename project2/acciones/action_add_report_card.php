<?php
session_name('cards');
session_start();
include('../acceso_db.php');

$descripcion=$_POST['descripcion'];
$id_card=$_POST['id_card'];
$id_user=$_SESSION['id'];

if(trim($descripcion) == ""){
	echo "<div class='alert alert-danger'>Ingresa la descripcion</div>";
}
else{
	
	$sql=$con->query("INSERT INTO reports (id_card,id_user,descripcion,status) VALUES ('$id_card','$id_user','$descripcion',0)")or die(mysqli_error());
	echo 'response_200';
}