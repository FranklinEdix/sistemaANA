<?php

session_start();
ob_start();
$_SESSION['idPedido'] = $_GET['id'];
$conexion = mysqli_connect("localhost", "root", "", "teamfor");
require "../conexiondb/consultas.php";
$c = new consultas($conexion);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Sistema Informacion</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous" />
    <script type="application/javascript">
    function Comparacion(event) {
        let FechaMenor = document.getElementById('FechaInferior').value;
        let FechaMayor = document.getElementById('FechaSuperior').value;
        if (FechaMayor < FechaMenor && FechaMayor !== "" && FechaMenor !== "") {
            alert("Fechas incorrectas la fecha inferior tiene que ser menor a la fecha superior");
            $("#FechaSuperior").val(FechaMenor);
        }
    }

    function creaObjetoAjax() {
        var obj;
        if (window.XMLHttpRequest) {
            obj = new XMLHttpRequest();
        } else { //para IE 5 y IE 6
            obj = new ActiveXObject(Microsoft.XMLHTTP);
        }
        return obj;
    }

    function handleinput(event) {
        //const producto = event.target.value;
        let producto = document.getElementById('producto').value;
        let FechaInferior = document.getElementById('FechaInferior').value;
        let FechaSuperior = document.getElementById('FechaSuperior').value;
        let NroFormato = document.getElementById('NroFormato').value;
        let NroPedido = document.getElementById('NroPedido').value;
        /*
        const fechaInferior = event.target.value;
        const fechaPosterior = event.target.value;
        const fechaPosterior = event.target.value;
        const producto = event.target.value;
        console.log(event.target.value);
        */
        let objajx = creaObjetoAjax();
        const parametros = "&producto=" + producto + "&FechaInferior=" + FechaInferior + "&FechaSuperior=" +
            FechaSuperior + "&NroFormato=" + NroFormato + "&NroPedido=" + NroPedido;
        objajx.open("POST", "Controlador.php", true);
        objajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        objajx.send(parametros);
        objajx.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(objajx.responseText);
                const result = JSON.parse(objajx.responseText);
                console.log(result);
            }
        }
    }
    </script>
    <style>
    .displayFirst {
        min-height: 100vh;
    }

    .displayFirst__menu {
        background-color: #122f3b;
        height: 100%;
    }

    .displayFirst__logo {
        width: 100%;
        border-radius: 58px;
        margin-top: 1em;
    }

    .displayFirst__link {
        color: white;
        text-decoration: none;
        text-align: center;
        width: 100%;
        padding: 1em;
    }

    .displayFirst__link:hover {
        color: white;
        text-decoration: none;
        background-color: #0bacdf;
        border-radius: 1em;
    }

    .displayFirst__area {
        background-color: #f2f2f2;
    }

    .displayFirst__area-header {
        padding: 0.5em;
        box-shadow: 5px 5px 5px gray;
    }

    .displayFirst__area-usuario {
        width: 50px;
    }

    .displayFirst__area-span {
        line-height: 50px;
    }

    .display_First__icon {
        width: 100%;
    }

    /*Estilo Formato*/
    .displayFirst__formato-titulo {
        margin-top: 2em;
        background-color: white;
        border-radius: 1em;
        padding: 0.5em;
        color: gray;
        text-align: center;
    }

    .displayFirst__formato-menu {
        margin-top: 2em;
        border-radius: 1em;
        background-color: white;
        padding: 1em 0.5em;
    }

    .displayFirst__formato-items {
        font-size: 0.8em;
    }

    .displayFirst__formato-items input {
        width: 80%;
        color: gray;
    }

    .displayFirst__formato-table {
        margin-top: 2em;
    }

    .displayFirst__formato-boton {
        width: 70%;
        margin: 0.5em 15%;
    }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row displayFirst">
            <div class="col-2">
                <div class="row displayFirst__menu">
                    <div class="col-12">
                        <img class="displayFirst__logo"
                            src="https://ciaologo.com/timthumb.php?src=upload/379/654/0_orig_20131029041040_1a328d9dd5.png&h=250&w=400&zc=2&b=15"
                            alt="" />
                        <div class="displayFirst__navbar">
                            <nav class="navbar">
                                <a class="displayFirst__link" href="formato.php"><i
                                        class="fas fa-clipboard display_First__icon"></i>Formatos de Apertura</a>
                                <a href="OrdeneDeRecojo.php" class="displayFirst__link display_First__icon"><i
                                        class="fas fa-box-open display_First__icon"></i>Ordenes
                                    de Recojo</a>
                                <a class="displayFirst__link" href=""><i
                                        class="fas fa-calendar-alt display_First__icon"></i>Programación</a>
                                <a class="displayFirst__link" href=""><i
                                        class="fas fa-pencil-alt display_First__icon"></i>Pendientes</a>
                                <a class="displayFirst__link" href=""><i
                                        class="fas fa-project-diagram display_First__icon"></i>Procesos</a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-10 displayFirst__area">
                <div class="row displayFirst__area-header">
                    <div class="col-12"></div>
                    <div class="col-4">
                        <span class="displayFirst__area-span">Dashboard</span>
                    </div>
                    <div class="col-auto ml-auto">
                        <span class="displayFirst__area-span"><?php ob_start();
                                                                echo $c->nombreEmpleado($_SESSION['user']); ?></span>
                    </div>
                    <div class="col-auto">
                        <img class="displayFirst__area-usuario"
                            src="https://rciminternet.com/wp-content/uploads/2019/04/usuario.png" alt="" />
                    </div>
                </div>
                <!-- Desde aqui empiezan los frames -->
                <div class="row displayFirst__formato">
                    <div class="col-10 ml-auto mr-auto displayFirst__formato-titulo">
                        <h4>Administracion de Depositos</h4>
                    </div>
                    <div class="col-12 displayFirst__formato-menu">
                        <table>
                            <thead>
                                <tr>
                                    <th>Filtrar Producto</th>
                                    <th>Desde:</th>
                                    <th>Hasta:</th>
                                    <th>Nro.Formato</th>
                                    <th>Nro.Pedido</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" id="producto" /></td>
                                    <td><input type="date" placeholder="" name="FechaInferior" id="FechaInferior"
                                            onchange="Comparacion(event)" /></td>
                                    <td><input type="date" placeholder="" name="FechaSuperior" id="FechaSuperior"
                                            onchange="Comparacion(event)" /></td>
                                    <td><input type="text" name="NroFormato" id="NroFormato" /></td>
                                    <td><input type="text" name="NroPedido" id="NroPedido" /></td>
                                    <td><a href="formato.php"><button class="btn btn-secondary" name="buscar"
                                                onclick="handleinput(event);">Buscar Oper.</button></a></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row displayFirst__formato-table">
                            <div class="col-10">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Nro</th>
                                            <th scope="col">Fecha</th>
                                            <th scope="col">Banco</th>
                                            <th scope="col">Monto</th>
                                            <th scope="col">Responsable</th>
                                            <th scope="col">Ventanilla</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $vector = $c->consultaDeposito($_GET['id']);
                                        if ($vector !== "Error" && $vector !== null) {
                                            //echo '<h4>'.$vector.'</h4>';
                                            for ($i = 0; $i < count($vector); $i++) {
                                        ?>
                                        <tr>
                                            <td><?php echo $vector[$i][0]; ?></td>
                                            <td><?php echo $vector[$i][5]; ?></td>
                                            <td><?php echo $vector[$i][3]; ?></td>
                                            <td><?php echo $vector[$i][2]; ?></td>
                                            <td><?php echo $vector[$i][6]; ?></td>
                                            <td><?php echo $vector[$i][4]; ?></td>
                                            <td><a data-target="#myModal1" type="button" class="btn btn-primary"
                                                    data-toggle="modal" id="<?php echo $vector[$i][0]; ?>"
                                                    onclick="Descripcion(this)"><i class="bi bi-pencil-square"></i></a>
                                            </td>
                                            <td><canvas id="<?php echo $vector[$i][0] . $vector[$i][1] ?>" width="80"
                                                    height="80" style="margin-top: 20px;" onload="prueba()"></canvas>
                                            </td>
                                        </tr>
                                        <?php }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>

                            <script>
                            function Descripcion(elemento) {
                                var codigo = elemento.id;
                                $('.modal-body-1').load('ModalEditarDeposito.php?id=' + codigo, function() {
                                    $('#ModalEditar').modal({
                                        show: true
                                    });
                                });
                            }
                            </script>
                            <!-- Modal Editar -->
                            <div class="modal fade" id="ModalEditar" tabindex="-1" aria-labelledby="ModalEditarLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body-1">

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <span>Compras</span>
                                <button type="button" class="btn btn-success displayFirst__formato-boton"
                                    data-toggle="modal" data-target="#exampleModal">
                                    Nuevo
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <?php
                                                include("ModalAgregarDeposito.php");
                                                ?>
                                            </div>
                                            <div class="modal-footer">
                                                <a type="submit" href="" name=""><button type="button"
                                                        class="btn btn-danger"
                                                        data-dismiss="modal">Cancelar</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-dark displayFirst__formato-boton">
                                    Imprimir
                                </button>
                                <a href="formato.php"><button style="position: absolute; bottom: 0px; right: 0px"
                                        class="btn btn-danger displayFirst__formato-boton">
                                        Atras
                                    </button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script src="https://code.jquery.com/jquery.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.min.js"></script>
<script>
function prueba() {
    console.log("Hola imgen");
}
window.onload = prueba;

function CargarDatosGraficoBar(id) {
    var titulo = ['Deuda', 'Cancelado'];
    var idCanvas = id.id;
    var cantidad = [];
    $.ajax({
        url: 'controladorGrafico.php',
        type: 'POST',
        data: {
            Id: idCanvas
        },
    }).done(function(resp) {
        alert(resp);
        /*if (resp.length > 0) {
            var info = JSON.parse(resp);
            for (var i = 0; i < info.length; i++) {
                cantidad.push(info[i][1]);
            }
            crear_dona_grafico(idCanvas, titulo, cantidad);
        }*/
    });

}

function crear_dona_grafico(id, titulo, cantidad) {
    document.getElementById(id).style.backgroundColor = "rgb(0,0,0)";
    var data = {
        labels: titulo,
        datasets: [{
            data: cantidad,
            backgroundColor: ['rgba(55, 171, 55)', 'rgba(191, 77, 69)'],

        }]
    };

    var ctx = document.getElementById(id);
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: data,

        options: {

        }
    });
}
//-------------------------------------------------------------------------------------
function color(cant, difusion) {
    var exa = [];
    var R = 3;
    var G = 0;
    var B = 1;
    var auxR = Math.trunc(236 / cant);
    var auxB = Math.trunc(49 / cant);
    for (var i = 0; i < cant; i++) {
        exa.push('rgba(' + R + ',' + G + ',' + B + ',' + difusion + ')');
        var R = R + auxR;
        var B = B + auxB;

    }
    return exa;
}
</script>