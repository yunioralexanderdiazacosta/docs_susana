<?php
session_set_cookie_params(60 * 60 * 24 * 365);
ini_set('session.cookie_lifetime', 60 * 60 * 24 * 365);
ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 365);
session_name('cards');
session_start();

@$nick = $_POST['nick'];
@$password = md5($_POST['password']);

include("acceso_db.php");
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
    header('Location:home.php');
    exit();
}
else
{
    $errores=array();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        if (trim($nick=="" || $password==""))
        {
            $errores[] = "Debes llenar todos los campos"; 
        }
        else
        {

            $sq= $con->query("SELECT id,nick,password,status,role_id,sesion FROM users WHERE nick='$nick' AND password='$password'")or die(mysqli_error());
            $row= mysqli_fetch_assoc($sq);
            if(mysqli_num_rows($sq)>0)
            {
                $id = $row['id'];
                $estatus=$row['status'];
                $role=$row['role_id'];
                $nick=$row['nick'];
                $sesion=$row['sesion'];

                if($role == 1)
                {
                    if($sesion == 0){
                        $ip = $_SERVER['REMOTE_ADDR'];
                        $sql2 = $con->query("UPDATE users SET sesion=1,ip='$ip' WHERE id='$id'")or die(mysqli_error());
                        if($sql2 > 0)
                        {
                            $_SESSION['id'] = $id;
                            $_SESSION['nick'] = $nick;
                            $_SESSION['role'] = $role;
                            header('Location:home.php');
                            exit();
                        }
                        else{
                            $errores[] = "Ocurrio un error";
                        }
                    }
                    else{
                        $errores[] = "Ya tiene una sesion activa";
                        $ip = $_SERVER['REMOTE_ADDR'];

                        $con->query("INSERT INTO logs (id_user, ip) VALUES ('$id','$ip') ")or die(mysqli_error());
                    }
                }
                else
                {
                    if($sesion == 0){


                        if($estatus == 0)
                        {
                            $errores[] = "Su cuenta ha sido bloqueada";
                        }
                        else
                        {  
                            $ip = $_SERVER['REMOTE_ADDR'];
                            $sql2 = $con->query("UPDATE users SET sesion=1,ip='$ip' WHERE id='$id'")or die(mysqli_error());
                            if($sql2 > 0)
                            {

                                $_SESSION['id'] = $id;
                                $_SESSION['nick'] = $nick;
                                $_SESSION['role'] = $role;
                                header('Location:home.php');
                            }
                            else{
                                $errores[] = "Ocurrio un error";
                            }
                        }
                    }
                    else
                    {
                       
                        $ip = $_SERVER['REMOTE_ADDR'];
                        $sql3 = $con->query("INSERT INTO logs (id_user, ip) VALUES ('$id','$ip') ")or die(mysqli_error());
                        $errores[] = "Ya tiene una sesion activa";

                    }
          
                }
            }
            else
            {   
                $errores[] = "usuario y/o contraseña incorrectos";
            }
        }
        mysqli_close($con);
    }
}
?> 
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="application/json; charset=UTF-8">
    <meta charset="utf-8">
    <div class="title">
        <title>Login</title>
    </div>
    <meta name="description">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4 offset-md-4">
            <?php if (@$errores): ?>
                <?php foreach ($errores as $error): ?>
                    <div class="alert alert-danger"> <?php echo $error ?> </div>
                <?php endforeach; ?>
            <?php endif; ?>
              <div class="card">
                  <div class="card-header bg-primary" style="border-bottom-right-radius: 50%; border-bottom-left-radius: 50%">
                      <h4 class="card-title text-white text-center">Iniciar Sesión</h4>
                  </div>
                  <div class="card-body">
                       <form id="formulario" name="formulario" action="login.php" method="post" auto-complete="false">
                           <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" name="nick" placeholder="Usuario" aria-label="Username" aria-describedby="basic-addon1" value="<?php if(isset($_POST['nick'])) echo $_POST['nick'];  ?>">
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" class="form-control" name="password" placeholder="contraseña" aria-label="Password" aria-describedby="basic-addon1">
                            </div>

                            <div class="mt-3 text-right">
                                <button id="entrar" class="btn btn-primary">
                                    Entrar <i class="fas fa-sign-in-alt"></i>
                                </button>
                            </div>
                        </form>
                  </div>
              </div>
            </div>
        </div>
    </div>
</body>
</script>
</html>