<?php

session_start();
ob_start();
$conexion = mysqli_connect("localhost", "root", "", "teamfor");
require "../conexiondb/consultas.php";
$c = new consultas($conexion);
$vector1 = $c->mostrarRecojo();
$vectorAsignar = $_SESSION['vectorPedidosAsignados'];
//$tamaño = array_count_values($vectorAsignar);
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

    function ShowSelected(id) {
        /* Para obtener el valor*/
        var orden = $('#' + id.id).text();
        $.ajax({
            url: 'tablaPedidosAsignados.php',
            type: 'POST',
            data: {
                Id: orden
            },
        }).done(function(resp) {
            //alert(resp);
            /*if (resp.length > 0) {
                var info = JSON.parse(resp);
                for (var i = 0; i < info.length; i++) {
                    cantidad.push(info[i][1]);
                }
                crear_dona_grafico(idCanvas, titulo, cantidad);
            }*/
        });
        document.location.reload("Recojos.php");
    }

    function verificarInput(event) {
        //const producto = event.target.value;
        $.ajax({
            url: 'leerIdAsignacion.php',
            type: 'POST',
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

        //alert(tamaño);
        /*for (var i = 0; i < tamaño; i++) {
            console.log(i);

        }
       
        const fechaInferior = event.target.value;
        const fechaPosterior = event.target.value;
        const fechaPosterior = event.target.value;
        const producto = event.target.value;
        console.log(event.target.value);
        
        const parametros = "&producto=" + producto + "&FechaInferior=" + FechaInferior + "&FechaSuperior=" +
            FechaSuperior + "&NroFormato=" + NroFormato + "&NroPedido=" + NroPedido;*/
    }

    function enviasAjax(parametros) {
        let objajx = creaObjetoAjax();
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
                                <a href="formato.php" class="displayFirst__link"><i
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
                        <span class="displayFirst__area-span"><a href="../login.html"><button class="btn btn-danger ">
                                    Salir <i class="bi bi-box-arrow-right"></i>
                                </button></a></span>
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
                        <h4>Administracion De Recojos</h4>
                    </div>
                    <div class="col-12 displayFirst__formato-menu">

                        <div class="input-group mb-3">
                            <br>
                            <select class="form-select" aria-label="Default select example" style="padding: 10px 80% 10px 10px; position:absolute; border-radius: 15px;    background-color: #fff;
    border: 0;
    border: 2px solid #2ecc71;
    color: #fff;
    text-align: right; background:rgb(0,0,0, .8)">
                                <option selected>Seleccione Orden</option>
                                <?php for ($i = 0; $i < count($vector1); $i++) { ?>

                                <option value="1"><?php echo $vector1[$i][0] ?></option>

                                <li style="padding:auto auto auto 5000px; background: rgb(255,255,255, .2)"><a
                                        class="dropdown-item" onclick="ShowSelected(this)"
                                        id="<?php echo "Orden" . $i ?>"><?php echo $vector1[$i][0] ?></a>
                                </li>
                                <?php
                                } ?>
                            </select>
                        </div>
                        <!-- tabla -->
                        <div class="row displayFirst__formato-table">
                            <div class="col-10">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Pedido </th>
                                            <th scope="col">Cantidad </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        //echo '<h4>'.$vector.'</h4>';
                                        if ($vectorAsignar !== "Error" and $vectorAsignar !== null) {
                                            for ($i = 0; $i < count($vectorAsignar); $i++) {
                                        ?>
                                        <tr>
                                            <td><?php echo $vectorAsignar[$i][1]; ?></td>
                                            <td><input type="text" id="<?php echo $vectorAsignar[$i][1]; ?>"></td>
                                        </tr>
                                        <?php }
                                        }
                                        $_SESSION['vectorPedidosAsignados'] = null;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <script>
                            function Descripcion(elemento) {
                                var codigo = elemento.id;
                                $('.modal-body-1').load('ModalEditar.php?id=' + codigo, function() {
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
                                            <a type="submit" href="" name=""><button type="button"
                                                    class="btn btn-danger" data-dismiss="modal">Cancelar</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Depositar-->
                            <div class="modal fade" id="ModalDeposito" tabindex="-1"
                                aria-labelledby="ModalDepositoLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" style="width: 100%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Depósito</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body-1">

                                        </div>
                                        <div class="modal-footer">
                                            <a type="submit" href="" name=""><button type="button"
                                                    class="btn btn-success" data-dismiss="modal">Nuevo</button></a>
                                            <a type="submit" href="" name=""><button type="button"
                                                    class="btn btn-danger" data-dismiss="modal">Cancelar</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">

                                <!--<button type="button" class="btn btn-success displayFirst__formato-boton"
                                    data-toggle="modal" data-target="#exampleModal">
                                    Nuevo
                                </button>-->

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
                                                include("ModalNuevaCompra.php");
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
                                <!--Modal 1-->
                                <div id="myModal1" class="modal modal-child" data-backdrop-limit="1" tabindex="-1"
                                    role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
                                    data-modal-parent="#myModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                ...
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--<button class="btn btn-dark displayFirst__formato-boton">
                                    Imprimir
                                </button>-->
                                <a href="Recojos.php"><button class="btn btn-success displayFirst__formato-boton"
                                        onclick="verificarInput(event)">
                                        Enviar
                                    </button></a>
                                <a href="formato.php"><button class="btn btn-danger displayFirst__formato-boton">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
</script>