<?php
require('../fpdf/fpdf.php');

class PDF extends FPDF
{
function Header()
{
    global $title;
    global $fechaEmision;
    // Arial bold 15
    $this->SetFont('Arial','B',13);
    $this->Image('https://ciaologo.com/timthumb.php?src=upload/379/654/0_orig_20131029041040_1a328d9dd5.png&h=250&w=400&zc=2&b=15',10,5,40,0,'PNG');
    // Título Orden Pedido
    // Calculamos ancho y posición del título.
    $w = $this->GetStringWidth($title)+6;
    $this->SetX(60);
    // Colores de los bordes, fondo y texto
    $this->SetFillColor(255,255,255);
    $this->Cell($w,9,$title,0,1,'C',false);
    $this->SetFont('Arial','',11);
    //Fecha 
    $fecha='Fecha:';
    $widthFecha = $this-> GetStringWidth($fecha) + 6;
    $this->SetX(65);
    $this->Cell($widthFecha,5,$fecha,0,0,'L',false);
    //Valor Fecha
    $widthValorFecha = $this-> GetStringWidth($fechaEmision) + 6;
    $this->SetX($widthFecha+65);
    $this->Cell($widthValorFecha,5,$fechaEmision,0,1,'L',false);
    //Documento
    // Salto de línea
    $this->Ln(5);
}


function datosOrden($nomDistribuidor,$numRuc,$numPedido,$valorBolsas,$valorCemento,$valorDeposito)
{
    // Arial 
    $this->SetFont('Arial','B',8);
    // Distribuidor
    $distribuidor = 'Nombre del Distribuidor';
    $this->SetX(10);
    $this-> Cell(150,5,$distribuidor,0,1,'L',false);
    //Valor Distribuidor
    $this->SetFont('Arial','',8);
    $this-> Cell(150,5,$nomDistribuidor,0,1,'C',false);
   // Numero RUC
    $this->SetFont('Arial','B',8);
    $ruc = 'Nro. RUC';
    $this-> Cell(150,5,$ruc,0,1,'L',false);
    //Valor RUC
    $this->SetFont('Arial','',8);
    $this-> Cell(150,5,$numRuc,0,1,'C',false);
   // Numero de Pedido
    $this->SetFont('Arial','B',8);
    $pedido = 'Nro. de Pedido';
    $this-> Cell(150,5,$pedido,0,1,'L',false);
    //Valor Numero de Pedido
    $this->SetFont('Arial','',8);
    $this-> Cell(150,5,$numPedido,0,1,'C',false);
    //Fila Dos
    $this->Ln(3);
    $this->SetFont('Times','B',10);
    $this->SetX(10);
    $bolsas = 'Cantidad de bolsas';
    $this->Cell(60,8,$bolsas,1,0,'C',false);
    $this->SetX(70);
    $cemento = 'Tipo de Cemento Nro Pliegos';
    $this->Cell(60,8,$cemento,1,0,'C',false);
    $this->SetX(130);
    $fDeposito = 'Fecha del Deposito';
    $this->Cell(60,8,$fDeposito,1,1,'C',false);
        //Valores
    $altoTabla = 0 ;
    foreach($valorDeposito as $row) {
    $this->SetX(130);
    $this->Cell(60,8,$row,1,1,'C',false);
    $altoTabla +=8;
    }
    $getY = $this->GetY();
    $this->SetY($getY - $altoTabla);
    $this->SetX(10);
    $this->Cell(60,$altoTabla,$valorBolsas,1,0,'C',false);
    $this->SetX(70);
    $this->Cell(60,$altoTabla,$valorCemento,1,1,'C',false);
   $this->Ln(10);
}

function datosTabla($data)
{
    // Times 10
    $this->SetFont('Times','B',10);
    //Headers 
    $headers = array('Nombre del Banco','No. de Operacion Bancaria','Importe S/.');
    foreach ($headers as $col) { $this->Cell(60,8,$col,1,0,'C',false); }
    $this->Ln();
    $this->SetFont('Times','',9);
    //Datos
    foreach($data as $row) {
        foreach($row as $col) {
            $this->Cell(60,8,$col,1,0,'C',false);
        }
            $this->Ln();
    }
    // Salto de línea
    $this->Ln();
}
function total ($total) {
    $this->SetFont('Times','B',10);
    $this->Cell(180,8,'BOLETA DE DEPOSITO               '.$total,0,1,'R',false);
}
function imprimirPDF($data,$nomDistribuidor,$numRuc,$numPedido,$valorBolsas,$valorCemento,$valorDeposito,$total)
{
    $this->AddPage();
    $this->datosOrden($nomDistribuidor,$numRuc,$numPedido,$valorBolsas,$valorCemento,$valorDeposito);
    $this->datosTabla($data);
    $this->total($total);
}
}
$pdf = new PDF('l','mm','A5');
$title = 'Formato de Apertura de Pedido y Cancelacion';
$pdf->SetTitle($title);
//Inicio de Entrada de datos
//////////////////////////////////////////
    //Datos header
    $fechaEmision = '29-12-2021';
    //Datos 
    //Distribuidor
    $nomDistribuidor = 'Grupo San Cristobal S.C.R.L';
    //Numero RUC
    $numRuc = '2644766945';
    //Numero Pedido
    $numPedido = '3580';
    //Bolsas
    $valorBolsas = '2250.00';
    //Cemento
    $valorCemento = 'Cemento Tipo V Andino';
    //Deposito
    $valorDeposito = array('21.15.2021','21.22.2020','21.22.2032','21.22.2012');
    //Datos de la tabla 
    $data = array(['BCP','54','14.00'],['Banco Continental','545','55.00']);
    //Total
    $total = 1688;
//Fin de Entrada de datos
//////////////////////////////////////////
$pdf->imprimirPDF($data,$nomDistribuidor,$numRuc,$numPedido,$valorBolsas,$valorCemento,$valorDeposito,$total);
$pdf->Output();