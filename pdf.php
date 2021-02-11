<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        global $title;
        global $codValor;
        global $fechaEmision;
        global $documento;
        // Arial bold 15
        $this->SetFont('Arial', 'B', 13);
        $this->Image('https://ciaologo.com/timthumb.php?src=upload/379/654/0_orig_20131029041040_1a328d9dd5.png&h=250&w=400&zc=2&b=15', 10, 5, 40, 0, 'PNG');
        // Título Orden Pedido
        // Calculamos ancho y posición del título.
        $w = $this->GetStringWidth($title) + 6;
        $this->SetX((300 - $w) / 2);
        // Colores de los bordes, fondo y texto
        $this->SetFillColor(255, 255, 255);
        $this->Cell($w, 9, $title, 0, 1, 'C', false);
        $this->SetFont('Arial', '', 11);
        // Numero
        $numero = 'Numero:';
        $widthNumero = $this->GetStringWidth($numero) + 6;
        $this->SetX((300 - ($widthNumero * 4)) / 2);
        $this->Cell($widthNumero, 5, $numero, 0, 0, 'L', false);
        //Numero valor
        $widthValorNumero = $this->GetStringWidth($codValor) + 6;
        $this->SetX((300 - ($widthNumero * 4)) / 2 + $widthNumero);
        $this->Cell($widthValorNumero, 5, $codValor, 0, 0, 'C', false);
        //Fecha 
        $fecha = 'Fecha:';
        $widthFecha = $this->GetStringWidth($fecha) + 6;
        $this->SetX((300 - ($widthNumero * 4)) / 2 + $widthNumero + $widthValorNumero);
        $this->Cell($widthFecha, 5, $fecha, 0, 0, 'L', false);
        //Valor Fecha
        $widthValorFecha = $this->GetStringWidth($fechaEmision) + 6;
        $this->SetX((300 - ($widthNumero * 4)) / 2 + $widthNumero + $widthValorNumero + $widthFecha);
        $this->Cell($widthValorFecha, 5, $fechaEmision, 0, 1, 'L', false);
        //Documento
        $nomDocumento = 'Documento:';
        $widthDocumento = $this->GetStringWidth($nomDocumento) + 6;
        $this->SetX((300 - ($widthNumero * 4)) / 2 + $widthNumero);
        $this->Cell($widthDocumento, 5, $nomDocumento, 0, 0, false);
        //Valor Documento
        $widthValorDocumento = $this->GetStringWidth($documento) + 6;
        $this->SetX((300 - ($widthNumero * 4)) / 2 + $widthNumero + $widthDocumento);
        $this->Cell($widthValorDocumento, 5, $documento, 0, 1, 'L', false);
        // Salto de línea
        $this->Ln(5);
    }


    function datosOrden($canOrdenado, $numOrdenado, $numChofer, $nomChofer, $codChofer, $numTrans, $nomTrans, $codTrans)
    {
        // Arial 
        $this->SetFont('Arial', 'B', 8);
        // Producto
        $producto = 'Producto';
        $this->SetX(10);
        $this->Cell(150, 5, $producto, 0, 1, 'L', false);
        //Valor Producto
        $this->SetFont('Arial', '', 8);
        $valorProducto = $canOrdenado . '             ' . $numOrdenado;
        $this->Cell(150, 5, $valorProducto, 0, 1, 'C', false);
        // Chofer
        $this->SetFont('Arial', 'B', 8);
        $chofer = 'Datos del Chofer';
        $this->Cell(150, 5, $chofer, 0, 1, 'L', false);
        //Valor Chofer
        $this->SetFont('Arial', '', 8);
        $valorChofer = $numChofer . '             ' . $nomChofer . '              ' . $codChofer;
        $this->Cell(150, 5, $valorChofer, 0, 1, 'C', false);
        // Transportista
        $this->SetFont('Arial', 'B', 8);
        $transportista = 'Datos del Transportista';
        $this->Cell(150, 5, $transportista, 0, 1, 'L', false);
        //Valor Transportista
        $this->SetFont('Arial', '', 8);
        $valorTransportista = $numTrans . '               ' . $nomTrans . '               ' . $codTrans;
        $this->Cell(150, 5, $valorTransportista, 0, 1, 'C', false);
        $this->Ln(4);
    }

    function datosTabla($data)
    {
        // Times 12
        $this->SetFont('Times', 'B', 10);
        //Header Principal 
        $headerUno = 'DETALLES DE RECOJO';
        $this->SetX(10);
        $this->SetFillColor(0, 0, 0);
        $this->Cell(81, 8, $headerUno, 1, 0, 'C', false);
        $headerDos = 'DETALLES DE COMPRAS';
        $this->SetX(91);
        $this->Cell(108, 8, $headerDos, 1, 1, 'C', false);
        //Headers 
        $headers = array('Fecha', 'Cantidad', 'Vendidos', 'F. Apertura', 'Fecha', 'N. Pedido', 'Cantidad');
        foreach ($headers as $col) {
            $this->Cell(27, 8, $col, 1, 0, 'C', false);
        }
        $this->Ln();
        $this->SetFont('Times', '', 9);
        //Datos
        foreach ($data as $row) {
            foreach ($row as $col) {
                $this->Cell(27, 8, $col, 0, 0, 'C', false);
            }
            $this->Ln();
        }
        // Salto de línea
        $this->Ln();
    }
    function total($totalOrdenados, $totalRecojidos)
    {
        // Arial 12
        $this->SetFont('Arial', 'B', 10);
        //Total Ordenados
        $this->SetX(57);
        $this->Cell(50, 8, 'Total Ordenados: ', 1, 0, 'C', false);
        $this->SetX(107);
        $this->Cell(50, 8, $totalOrdenados, 1, 1, 'C', false);
        //Total Recojidos
        $this->SetX(57);
        $this->Cell(50, 8, 'Total Recojidos: ', 1, 0, 'C', false);
        $this->SetX(107);
        $this->Cell(50, 8, $totalRecojidos, 1, 1, 'C', false);
    }
    function imprimirPDF($data, $canOrdenado, $nomOrdenado, $numChofer, $nombChofer, $codChofer, $numTrans, $nomTrans, $codTrans, $totalOrdenados, $totalRecojidos)
    {
        $this->AddPage();
        $this->datosOrden($canOrdenado, $nomOrdenado, $numChofer, $nombChofer, $codChofer, $numTrans, $nomTrans, $codTrans);
        $this->datosTabla($data);
        $this->total($totalOrdenados, $totalRecojidos);
    }
}
$pdf = new PDF('l', 'mm', 'A5');
$title = 'Orden de Recojo';
$pdf->SetTitle($title);
//Inicio de Entrada de datos
//////////////////////////////////////////
//Datos header
$codValor = '0977QUE';
$fechaEmision = '29-12-2021';
$documento = 'Pendiente';
//Datos del recojo
//Producto
$canOrdenado = '765.00';
$nomOrdenado = 'Cemento TIpo 1 P ---- Andino';
//Chofer
$numChofer = 'N-123456789';
$nomChofer = 'Porras Santillas Luis';
$codChofer = 'BH-2628C4L-1';
//Transportista
$numTrans = '124567891020';
$nomTrans = 'Empresa de Transporte Pasco EIR.';
$codTrans = '3580';
//Datos de la tabla 
$data = array(['21-03-2021', '54', '0.00', '14886', '26-03-2015', 'COM: 10002644', '3000'], ['22-08-2015', '545.00', '0.00', '15889', '28-02-2012', 'COM: 10002644', '2100'], ['21-03-2021', '54', '0.00', '14886', '26-03-2015', 'COM: 10002644', '3000'], ['22-08-2015', '545.00', '0.00', '15889', '28-02-2012', 'COM: 10002644', '2100'], ['21-03-2021', '54', '0.00', '14886', '26-03-2015', 'COM: 10002644', '3000'], ['22-08-2015', '545.00', '0.00', '15889', '28-02-2012', 'COM: 10002644', '2100'], ['21-03-2021', '54', '0.00', '14886', '26-03-2015', 'COM: 10002644', '3000'], ['22-08-2015', '545.00', '0.00', '15889', '28-02-2012', 'COM: 10002644', '2100'], ['21-03-2021', '54', '0.00', '14886', '26-03-2015', 'COM: 10002644', '3000'], ['22-08-2015', '545.00', '0.00', '15889', '28-02-2012', 'COM: 10002644', '2100'], ['21-03-2021', '54', '0.00', '14886', '26-03-2015', 'COM: 10002644', '3000'], ['22-08-2015', '545.00', '0.00', '15889', '28-02-2012', 'COM: 10002644', '2100']);
//Total
$totalOrdenados = '765.00';
$totalRecojidos =  '145.00';
//Fin de Entrada de datos
//////////////////////////////////////////
$pdf->imprimirPDF($data, $canOrdenado, $nomOrdenado, $numChofer, $nomChofer, $codChofer, $numTrans, $nomTrans, $codTrans, $totalOrdenados, $totalRecojidos);
$pdf->Output();