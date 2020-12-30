<?php
require('connect_db.php');
$id = $_POST['id'];

$servername = $host;
$database = $db; 
$username = $user;
$password = $pass;


$con = mysqli_connect($servername, $username, $password,$database) or die("Could not connect database");
$consulta = $con->query("SELECT * FROM employee_details WHERE id_employee='$id'")or die(mysqli_error());

$data = array();

while($fila=mysqli_fetch_assoc($consulta)){
    $data[] = $fila;
}

echo json_encode($data);

?>