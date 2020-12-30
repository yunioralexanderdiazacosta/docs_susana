<?php 
session_set_cookie_params(60 * 60 * 24 * 365);
session_name('cards');
session_start(); 
include('acceso_db.php'); 
$ip=$_SERVER['REMOTE_ADDR'];
$query=$con->query("SELECT id,nick,role_id FROM users WHERE ip='$ip' AND sesion=1")or die(mysqli_error());
if(mysqli_num_rows($query) > 0)
{
    $fila=mysqli_fetch_assoc($query);
    $_SESSION['id'] = $fila['id'];
    $_SESSION['nick'] = $fila['nick'];
    $_SESSION['role'] = $fila['role_id'];
    header('Location:home.php');
    exit();
}
if(isset($_SESSION['id'])) 
{
    $pagina="home"; 
if($_SESSION['role'] == 1)
{
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="application/json; charset=UTF-8">
    <meta charset="utf-8">
    <div class="title">
        <title>Reports</title>
    </div>
    <meta name="description">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                
                <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                    <a class="navbar-brand" href="home.php">CARDS</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                     </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link">
                                    <i class="fas fa-user"></i> <?= $_SESSION['nick'] ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                 <a class="nav-link" href="logout.php" >
                                    <i class="fas fa-sign-out-alt"></i>Logout
                                 </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
             
            <div class="col-md-12 mt-5">
                <div class="mb-3">
                    <a href="home.php" class="btn btn-dark">
                        <i class="fas fa-home"></i> Inicio
                    </a>
                </div>
                <div class="table-responsive">
                <table id="example" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">fecha</th>
                            <th class="text-center">ID tarjeta</th>
                            <th class="text-center">numero tarjeta</th>
                            <th class="text-center">usuario</th>
                            <th class="text-center">descripción </th>
                        </tr>
                    </thead>
                  <tbody>

                       
                   <?php
                 
                   $sql=$con->query("SELECT users.nick,reports.fecha,reports.descripcion,cards.tarjeta, reports.id_card FROM reports,cards,users WHERE reports.id_user=users.id AND cards.id=reports.id_card ORDER BY reports.fecha DESC")or die(mysqli_error());
                   $sql2=$con->query("UPDATE reports SET status=1 WHERE status=0")or die(mysqli_error());
                   while($row=mysqli_fetch_assoc($sql))
                   {
                    $id_card =$row['id_card'];
                    $tarjeta=$row['tarjeta'];
                    $fecha=$row['fecha'];
                    $fecha=date("d-m-Y h:ia",strtotime($fecha)); 
                    $nick=$row['nick'];
                    $descripcion=$row['descripcion'];  
                    if($id_user != null){
                        $tarjeta_view = substr($tarjeta,-16, -12)." ".substr($tarjeta,-12, -8)." ".substr($tarjeta,-8, -4)." ".substr($tarjeta,-4);
                    }
                    else
                    {
                        $tarjeta_view = substr($tarjeta,-16, -12)." ".substr($tarjeta,-12, -8)." ".substr($tarjeta,-8, -4)." ****";
                    }  
                    ?>

                    <tr>
                        <td class="text-center"><?=$fecha?></td>
                        <td class="text-center"><?=$id_card?></td>
                        <td class="text-center"><?=$tarjeta_view?></td>
                        <td class="text-center"><?=$nick?></td>
                        <td class="text-center"><?=$descripcion?> </td>
                    </tr>
                <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

</html>
<?php
}
else
{
    header("Location:home.php");
    exit();
}

}
else
{
    header("Location:login.php");
    exit();
}