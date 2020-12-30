<?php
session_name('cards');
session_start();
include("../acceso_db.php");
if(isset($_SESSION['id'])){
	$id_user = $_SESSION['id'];
	$id_card = $_POST['id_card'];

	$query=$con->query("SELECT cards.id FROM cards,users WHERE cards.id_user=users.id AND cards.id='$id_card' ")or die(mysqli_error());
	if(mysqli_num_rows($query) > 0){
	   echo 'response_401';
	}
	else
	{
		$sql =$con->query("UPDATE cards SET id_user='$id_user' WHERE id='$id_card'")or die(mysqli_error());
		echo 'response_200';
	}
}
?>