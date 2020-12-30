<?php
include('../acceso_db.php');
header('Content-Type: text/javascript');

$sql=$con->query("SELECT count(id) as total FROM reports WHERE status=0")or die(mysqli_error());
$row=mysqli_fetch_assoc($sql);
$totalReportes = $row['total'];
echo json_encode($totalReportes);
?>