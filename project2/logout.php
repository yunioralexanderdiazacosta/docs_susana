<?php 
    session_name('cards');
    session_start(); 
    include('acceso_db.php'); // incluímos los datos de acceso a la BD 
    // comprobamos que se haya iniciado la sesión 
    if(isset($_SESSION['id'])) 
    { 
        $id=$_SESSION['id'];
        $sql = $con->query("UPDATE users SET sesion=0,ip='' WHERE id='$id'")or die(mysqli_error());
        if($sql > 0)
        {
            session_destroy(); 
            header("Location:login.php");  
        }
    }
    else { 
       header("Location:login.php"); 
    } 
?>