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
        objajx.open("POST", "AgregarNuevoPedido.php", true);
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
    <h1>Nueva Compra</h1>
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
            <td><input type="text" class="" value="" name="Compra" id="Compra"></td>
            </tr>
            <tr>
            <th scope="row"><label for="">Formato: </label></th>
            <td><input type="text" class="" value="" name="Formato" id="Formato"></td>
            </tr><tr>
            <th scope="row"><label for="">Cantidad: </label></th>
            <td><input type="numeric" class="" value="" name="Cantidad" id="Cantidad"></td>
            </tr><tr>
            <th scope="row"><label for="">Producto: </label></th>
            <td><input type="text" class="" value="" name="Producto" id="Producto"></td>
            </tr>
            <tr>
            <th scope="row"><label for="">Distribuidora: </label></th>
            <td><input type="text" class="" value="" name="Fecha" id="Distribuidora"></td>
            </tr>
            <tr>
            <th scope="row"><label for="">Fecha: </label></th>
            <td><input type="date" class="" value="" name="Fecha" id="Fecha"></td>
            </tr>
        </tbody>
        </table>
        <br>
        <label for=""><b>Nro de pedido - Cemento Andino</b></label>
        <br>
        <input type="numeric" class="" value="" name="NroPedido">
        <br>
        <br>
        <a type="submit" href="" name=""><button type="button" class="btn btn-success" onclick="Mostrar(event);">Guardar</button></a>
        
        <!--<a type="submit" href="" name=""><button type="button" class="btn btn-secondary">Depósito</button></a>
    --></form>
</center>
</body>
</html>
<script src="https://code.jquery.com/jquery.js"></script>
<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>