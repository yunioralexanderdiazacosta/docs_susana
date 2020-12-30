<?php 
session_set_cookie_params(60 * 60 * 24 * 365);
session_name('cards');
session_start(); 
include('acceso_db.php'); 
$ip=$_SERVER['REMOTE_ADDR'];
$query=$con->query("SELECT id,nick,role_id FROM users WHERE ip='$ip' AND sesion=1")or die(mysqli_error($con));
if(mysqli_num_rows($query) > 0)
{
    $fila=mysqli_fetch_assoc($query);
    $_SESSION['id'] = $fila['id'];
    $_SESSION['nick'] = $fila['nick'];
    $_SESSION['role'] = $fila['role_id'];
    $pagina="home"; 
}
if(isset($_SESSION['id'])) 
{
    $pagina="home"; 
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="application/json; charset=UTF-8">
    <meta charset="utf-8">
    <div class="title">
        <title>Home</title>
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
             <?php
               include('card_add.php');
               include('card_edit.php');
               include('card_add_report.php');
             ?>
            <div class="col-md-12 mt-5">
                <?php
                if($_SESSION['role'] == 1){
                ?>
                <div class="mb-3">
                    <button class="btn btn-dark" data-toggle="modal" data-target="#addCard"><i class="fa fa-plus"></i> Agregar</button>
                    <a href="reports.php" class="btn btn-dark">
                        Reportes <span class="badge badge-light" id="countReports"></span>
                    </a>
                </div>
                <?php
                }
                ?>
                <div class="table-responsive">
                <table id="example" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">tarjeta</th>
                        <th class="text-center">fecha</th>
                        <th class="text-center"> cvv </th>
                        <?php if($_SESSION['role'] == 1) { ?><th class="tex-center"> nota </th> <?php } ?>
                        <th class="text-center">acciones</th>
                        <th></th>
                    </tr>
                  </thead>
                  <tbody id="content"></tbody>
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
<script>
   


    window.setInterval(function () {
        getCards();
        getNotificationNewReport();
    }, 1000);

    $(document).ready(function() {
        $('[data-toggle=tooltip]').tooltip();
    }); 

    $( "#fecha" ).keypress(function() {
      if(this.value.length ==2){
        this.value = this.value+'/';
      }
    })

    $( "#fechaView" ).keypress(function() {
      if(this.value.length ==2){
        this.value = this.value+'/';
      }
    })
    
    function getCards(){
        $.ajax({
            type: "GET",
            url: "acciones/action_list_card.php",
            dataType: 'json',
            success: function(response){
                 var id = <?=$_SESSION['id']?>;
                 var role = <?=$_SESSION['role']?>;
                var views = '';
                var data = [];
                data = response;
                data.filter(element => {
                views += `
                        <tr>
                        <td class="text-center">${element.id}</td>
                        <td class="text-center mx-auto"> 
                        <div id="card">${element.tarjeta_view}</div>`;

                            if(element.id_user != null && element.id_user == id)
                            {

                                views += `<div class="float-right align-top">
                                    <button class="btn btn-outline-dark ml-auto" data-toggle="tooltip" title="copiar" onclick="copyToClipboard(${element.tarjeta})">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>`;
                            }
                views += `
                        </td>
                        <td class="text-center"> ${element.fecha}</td>
                        <td class="text-center">${element.cvv} </td>`;

                        if(role == 1) {  
                        element.nota == null ? element.nota='' : element.nota=element.nota;  

                views += `<td class="tex-center"> ${element.nota} </td>`;  }
                views += `<td class="text-center"><div class="btn-group">`;
                           
                            if(role == 1)
                            {
                        
                views+=      `<button onclick="editCard(${element.id},'${element.tarjeta}','${element.fecha}',${element.cvv},${element.nota})" class="btn btn-warning">
                                <i class="fas fa-edit"></i>
                            </button>

                            <button type="button" class="btn btn-danger" onClick="eliminarCard(${element.id})">
                                <i class="fas fa-trash"></i>
                            </button>`;
                            }
                            if(element.id_user == null)
                            {
                views+= `<button type="button" class="btn btn-outline-primary" onClick="verCard(${element.id})">
                                <i class="fa fa-eye"></i> Ver 
                            </button>`;
 
                            }
                            else
                            {
                        
                views+= `<button type="button" class="btn btn-outline-dark" disabled="">
                                <i class="fa fa-eye-slash"></i> Visto 
                            </button>`
                            }
                           
                            if(role==2)
                            {
                                if(element.reportada == true)
                                {
                    
                views+= `<button type="button" class="btn btn-outline-dark" disabled="">
                                    <i class="fa fa-exclamation-triangle"></i> Reportada
                                </button>`;
                                }
                                else
                                {
                views+= `<button type="button" class="btn btn-danger" onclick="reportarCard(${element.id}+","+${element.tarjeta_view})">
                                    Reportar
                                </button>`;
                     
                                }
                            }
                views+= `</div></td>
                      <td class="text-center">`;

                         if(element.id_user != null)
                         {
                views+= `<span class="badge badge-dark">${element.nick}</span>`;
                         }
                views+=`
                        </td>
                    </tr>`;
                }) 
                $('#content').html(views);
            
            }
        });
    }

    function getNotificationNewReport(){
        $.ajax({
            type: "GET",
            url: "acciones/action_count_new_reports.php",
            dataType: 'json',
            success: function(response){
                $('#countReports').text(response);
            }
        });
    }

    function editCard(id, tarjeta, fecha, cvv, nota){
        $('#id_card').val(id);
        $('#tarjetaView').val(tarjeta);
        $('#fechaView').val(fecha);
        $('#cvvView').val(cvv);
        $("#notaView").val(nota);
        $("#editCard").modal("show");
    }


    function eliminarCard(id){
        console.log(id)
        if(confirm('¿Esta seguro de que desea eliminar la tarjeta?')){
            $.ajax({
                type: "POST",
                url: "acciones/action_delete_card.php",
                data: { id_card: id },
                success: function(){
                    location.reload()
                }
            });
        }
    }
    
    function copyToClipboard(element) {
        console.log(element)
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val(element).select();
        document.execCommand("copy");
        $temp.remove();

    }

    function reportarCard(id, tarjeta){
        console.log(id)
        $('#id_cardReport').val(id);
        $('#tarjetaReport').val(tarjeta);
        $("#reportCard").modal("show");
    }

    function verCard(id){
        $.ajax({
            url: 'acciones/ver.php',
            data: { id_card: id },
            type: 'POST',
            success: function(datos){
            console.log(datos)
            if(datos == "response_200")
            {

               location.reload();
            }
            else{
                alert('La tarjeta ya ha sido vista')
            }
           }
        })
    }

    $( "#guardarCard" ).click(function() {
    var tarjeta = $('#tarjeta').val();
    var fecha = $("#fecha").val();
    var cvv = $("#cvv").val();
    var nota = $("#nota").val();
        $.ajax({
            type: "POST",
            url: "acciones/action_add_card.php",
            data: { tarjeta: tarjeta, fecha: fecha, cvv: cvv, nota: nota },
            beforeSend: function(objeto){
                $("#datos_ajax_register").html("Mensaje: Cargando...");
            },
            success: function(datos){
                if(datos == "response_200"){
                    location.reload()
                }
                else
                {
                    $("#datos_ajax_register").html(datos);
                }
            }
        });
    }); 

    $( "#enviarReportCard" ).click(function() {
    var id_card = $('#id_cardReport').val();
    var descripcion = $("#descripcion").val();
        $.ajax({
            type: "POST",
            url: "acciones/action_add_report_card.php",
            data: { id_card: id_card, descripcion: descripcion },
            beforeSend: function(objeto){
                $("#datos_ajax_report").html("Mensaje: Cargando...");
            },
            success: function(datos){
                if(datos == "response_200"){
                    location.reload()
                }
                else
                {
                    $("#datos_ajax_report").html(datos);
                }
            }
        });
    }); 

    $( "#actualizarCard" ).click(function() {
    var tarjeta = $('#tarjetaView').val();
    var fecha = $("#fechaView").val();
    var cvv = $("#cvvView").val();
    var nota = $("#notaView").val();
        var id_card = $("#id_card").val();
        $.ajax({
            type: "POST",
            url: "acciones/action_edit_card.php",
            data: { id_card: id_card, tarjeta: tarjeta, fecha: fecha, cvv: cvv, nota: nota },
            beforeSend: function(objeto){
                $("#datos_ajax_register").html("Mensaje: Cargando...");
            },
            success: function(datos){
                if(datos == "response_200"){
                    location.reload()
                }
                else
                {
                    $("#datos_ajax_register").html(datos);
                }
            }
        });
    }); 
    
</script>
</html>
<?php
}
else
{
    header("Location:login.php");
    exit();
}
?>