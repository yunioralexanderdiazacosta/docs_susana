<?php
include('../acceso_db.php');
$id_card=$_POST['id_card'];

$sql=$con->query("DELETE FROM cards WHERE id='$id_card'")or die(mysqli_error());
?>