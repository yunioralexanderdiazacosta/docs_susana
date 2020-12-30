<?php
session_name('cards');
session_start(); 
include("../acceso_db.php");
header('Content-Type: text/javascript');
$id=$_SESSION['id'];

$sql=$con->query("SELECT id,tarjeta,fecha,cvv,id_user,nota FROM cards")or die(mysqli_error());

$data=array();
while($row=mysqli_fetch_assoc($sql)){
    $id_card=$row['id'];
	$id_user=$row['id_user'];
	$tarjeta=$row['tarjeta'];
	if($id_user != null){
        $sql2=$con->query("SELECT nick FROM users WHERE id='$id_user'")or die(mysqli_error());
        $row2=mysqli_fetch_assoc($sql2);
        $nick=$row2['nick'];
        $row['nick']=$nick;
        $row['tarjeta_view'] = substr($tarjeta,-16, -12)." ".substr($tarjeta,-12, -8)." ".substr($tarjeta,-8, -4)." ".substr($tarjeta,-4);
    }
    else
    {
    	$row['nick']='';
        $row['tarjeta_view'] = substr($tarjeta,-16, -12)." ".substr($tarjeta,-12, -8)." ".substr($tarjeta,-8, -4)." ****";
    }
    $sql3=$con->query("SELECT id FROM reports WHERE id_card='$id_card' AND id_user='$id'")or die(mysqli_error());
    if(mysqli_num_rows($sql3) > 0){
    	$row['reportada']=true;
    }
    else{
    	$row['reportada']=false;
    }
	array_push($data, $row);
}

echo json_encode($data);
   
?>