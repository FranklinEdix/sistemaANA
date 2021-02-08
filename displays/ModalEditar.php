<?php 

$conexion = mysqli_connect("localhost","root","","teamfor");
require "../conexiondb/consultas.php";
$c = new consultas($conexion);
$b = false;
if(isset($_GET['id'])){
    session_start();
    ob_start();
    $_SESSION['idProducto'] = $_GET['id'];
    $cantidadDeposito = $c -> contarPedido('deposito',$_GET['id']);
    $cantidadEmtregado = $c -> contarPedido('pedidoentregado',$_GET['id']);
    if($cantidadDeposito > 0 || $cantidadEmtregado > 0){
        $b=true;
    }
    $vector = $c -> consultaPedido($_GET['id']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<script>
    function creaObjetoAjax() {
        var obj;
        if (window.XMLHttpRequest) {
          obj = new XMLHttpRequest();
        } else { //para IE 5 y IE 6
          obj = new ActiveXObject(Microsoft.XMLHTTP);
        }
        return obj;
      }
      function Mostrar(event){
        //const producto = event.target.value;
        let producto = document.getElementById('Producto').value; 
        let compra = document.getElementById('Compra').value; 
        let cantidad = document.getElementById('Cantidad').value; 
        let formato = document.getElementById('Formato').value; 
        let fecha = document.getElementById('Fecha').value;
        let distribuidora = document.getElementById('Distribuidora').value;   
        let objajx = creaObjetoAjax();
        const parametros = "&producto="+producto+"&compra="+compra+"&cantidad="+cantidad+"&formato="+formato+"&fecha="+fecha+"&distribuidora="+distribuidora;
        objajx.open("POST", "modificarPedido.php", true);
        objajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        objajx.send(parametros);    
        objajx.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          console.log(objajx.responseText);
          const result = JSON.parse(objajx.responseText);
          console.log(result);  
        }
        
        document.location.reload("formato.php");
      }
      }
</script>
<body>
<center>
    <h1>Editar Compra</h1>
    <form action="">
        <table class="  ">
        <thead>
            <tr>
            <th scope="col"></th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <th scope="row"><label for="">Compra: </label></th>
            <td><input type="text" class="" value="<?php echo $vector[0];?>" name="Compra" <?php if($b){echo 'disabled';} ?> id="Compra"></td>
            </tr>
            <tr>
            <th scope="row"><label for="">Formato: </label></th>
            <td><input type="text" class="" value="<?php echo $vector[9];?>" name="Formato" <?php if($b){echo 'disabled';} ?> id="Formato"></td>
            </tr><tr>
            <th scope="row"><label for="">Cantidad: </label></th>
            <td><input type="numeric" class="" value="<?php echo $vector[4];?>" name="Cantidad" <?php if($b){echo 'disabled';} ?> id="Cantidad"></td>
            </tr><tr>
            <th scope="row"><label for="">Producto: </label></th>
            <td><input type="text" class="" value="<?php echo $vector[1];?>" name="Producto" <?php if($b){echo 'disabled';} ?> id="Producto"></td>
            </tr>
            <tr>
            <th scope="row"><label for="">Distribuidora: </label></th>
            <td><input type="text" class="" value="<?php echo $vector[2];?>" name="Fecha" <?php if($b){echo 'disabled';} ?> id="Distribuidora"></td>
            </tr>
            <tr>
            <th scope="row"><label for="">Fecha: </label></th>
            <td><input type="date" class="" value="<?php echo $vector[6];?>" name="Fecha" <?php if($b){echo 'disabled';} ?> id="Fecha"></td>
            </tr>
        </tbody>
        </table>
        <br>
        <label for=""><b>Nro de pedido - Cemento Andino</b></label>
        <br>
        <input type="numeric" class="" value="<?php echo $vector[0];?>" name="NroPedido" disabled>
        <br>
        <br>
        <a type="submit" href="" name=""><button type="button" class="btn btn-success" onclick="Mostrar(event);">Guardar</button></a>
        <a type="submit" href="" name=""><button type="button" class="btn btn-secondary">Deposito</button></a>
    </form>
</center>
</body>
</html>
<script src="https://code.jquery.com/jquery.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
