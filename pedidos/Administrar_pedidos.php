<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Ingresar producto</title>


    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <script src="js/bootstrap.min.js"></script>
    <script src="../lib/js/jquery-2.1.4.min.js"></script>
    <script src="../lib/js/bootstrap.js"></script>
    <link rel="stylesheet" href="../lib/css/bootstrap.css">
    </link>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <script src="js/bootstrap.min.js"></script>

    <script src="../app.js"></script>
</head>

<body style="padding-bottom: 5em; position: relative; min-height: 100vh;">
    <header class="p-3 bg-dark text-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="../aplicacion/catalogo.php"
                    class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img src="../imagenes/logo.png" width="150" height="70">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                        <use xlink:href="#bootstrap" />
                    </svg>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-3 justify-content-center mb-md-0">
                    <li><a href="../aplicacion/catalogo.php" class="nav-link px-2 text-white"><i
                                class="fa-solid fa-house"></i> Inicio</a></li>

                    <li><a href="../sistema/usuario.php" class="nav-link px-2 text-white"><i
                                class="fa-solid fa-user"></i> Usuario</a></li>

                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a class="nav-link px-10 text-white" href='../sistema/logout.php'><i
                                class="fa-solid fa-power-off"></i> Cerrar Sesi&oacute;n</a></li>
                </ul>
            </div>
        </div>
    </header>
    <br>
    <div class="container">
        <h2>Lista de pedidos </h2>
        <br><br>

        <div class="col-sm-14">
            <table class="table table.responsive">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Dirección</th>
                        <th>Fecha</th>
                        <th>Total</th>

                    </tr>
                </thead>

                <?php

                include "../conexion/conexion.php";

                $sql = "SELECT * FROM pedidos WHERE estado = 'pedido'";
                $ejecutar = mysqli_query($conexion, $sql);

                while ($fila = mysqli_fetch_array($ejecutar)) {

                    $dts = $fila[0] . "||" .
                        $fila[1] . "||" .
                        $fila[2] . "||" .
                        $fila[3] . "||" .
                        $fila[4] . "||" .
                        $fila[5] . "||" .
                        $fila[6] . "||" .
                        $fila[7];

                ?>

                <tbody>
                    <td> <?php echo $fila[1] ?> </td>
                    <td> <?php echo $fila[2] ?> </td>
                    <td> <?php echo $fila[3] ?> </td>
                    <td> <?php echo $fila[4] ?> </td>
                    <td> <?php echo $fila[5] ?> </td>
                    <td> <?php echo $fila[6] ?> </td>

                    <th><button class="btn btn-sm btn-success modal-trigger" data-toggle="modal"
                            data-target="#modal_entregar" onclick="EntregaActualizar('<?php echo $dts ?>');">
                            Entregado </button></th>
                </tbody>

                <?php
                    }

                            ?>
            </table>

        </div>

        <!---------VENTANA MODAL---------->



        <div id="modal_entregar" class="modal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">¿Confirmar pedido entregado?</h4>
                    </div>


                    <div class="modal-body">
                        <!--Formulario de Actualizar aquí-->



                        <form id="frm_entregar" method="POST">


                            <label style="display:none;"> ID </label>
                            <input style="display:none;" id="e_id" name="e_id" type="text" class="form-control">
                            <div class="container-fluid h-100">
                                <div class="row w-100 align-items-center">
                                    <div class="col text-center">
                                        <button type="button" id="btnEntregar" class="btn btn-lg btn-primary">
                                            Confirmar</button>
                                    </div>
                                </div>




                        </form>


                    </div>
                </div>

            </div>
        </div>

    <script>
        $(document).ready(function(){


$('#btnEntregar').on('click', function(){

    var datos = $('#frm_entregar').serialize();

    $.ajax({
        method:'POST',
        url: '../pedidos/entregar.php',
        data: datos,
        success: function(e){
              alert("Entregado");
                $('body').load('../pedidos/Administrar_pedidos.php');
        }
    })

})

})
function EntregaActualizar(dts){

d = dts.split('||');
$('#e_id').val(d[0]);


}
    </script>
</body>

</html>