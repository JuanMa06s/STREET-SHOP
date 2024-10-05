<?php 
// Activamos almacenamiento en el buffer
ob_start();
if (strlen(session_id()) < 1) 
    session_start();

if (!isset($_SESSION['nombre'])) {
    echo "Debe ingresar al sistema correctamente para visualizar el reporte";
} else {
    if ($_SESSION['ventas'] == 1) {

        // Incluimos el archivo factura
        require('Factura.php');

        // Establecemos los datos de la empresa
        $logo = "LOGOR.png";
        $ext_logo = "png";
        $empresa = "LA RESACA STREET SHOP";
        $documento = "NIT: 7777777";
        $direccion = "4ta avenida San Juan  3-33, 
                Santo Tomas Chichicastenango";
        $telefono = "+502 4092 2319";
        
        // Obtenemos los datos de la cabecera de la venta actual
        require_once "../modelos/Venta.php";
        $venta = new Venta();
        $rsptav = $venta->ventacabecera($_GET["id"]);
        
        // Recorremos todos los valores que obtengamos
        $regv = $rsptav->fetch_object();

        // Verificamos si el objeto de respuesta contiene la información del cliente
        $email = isset($regv->email) ? $regv->email : 'No disponible'; // Aseguramos que email esté definido

        // Configuración de la factura
        $pdf = new PDF_Invoice('p', 'mm', 'A4');
        $pdf->AddPage();

        // Enviamos datos de la empresa al método addSociete de la clase factura
        $pdf->addSociete(utf8_decode($empresa),
                         $documento . "\n" .
                         utf8_decode("Dirección: ") . utf8_decode($direccion) . "\n" .
                         utf8_decode("Telefono: ") . $telefono . "\n" .
                         "Email: " . $email, $logo, $ext_logo);

        $pdf->fact_dev("$regv->tipo_comprobante ", "$regv->serie_comprobante- $regv->num_comprobante");
        $pdf->temporaire("");
        $pdf->addDate($regv->fecha);

        // Enviamos los datos del cliente al método addClientAddresse de la clase factura
        $pdf->addClientAdresse(utf8_decode($regv->cliente),
                               "Domicilio: " . utf8_decode($regv->direccion), 
                               $regv->tipo_documento . ": " . $regv->num_documento, 
                               "Email: " . $email, // Usamos el email ya definido
                               "Telefono: " . $regv->telefono);

        // Establecemos las columnas que va a tener la sección donde mostramos los detalles de la venta
        $cols = array("CODIGO" => 23,
                      "DESCRIPCION" => 78,
                      "CANTIDAD" => 22,
                      "P.U." => 25,
                      "DSCTO" => 20,
                      "SUBTOTAL" => 22);
        $pdf->addCols($cols);
        $cols = array("CODIGO" => "L",
                      "DESCRIPCION" => "L",
                      "CANTIDAD" => "C",
                      "P.U." => "R",
                      "DSCTO" => "R",
                      "SUBTOTAL" => "C");
        $pdf->addLineFormat($cols);
        $pdf->addLineFormat($cols);

        // Actualizamos el valor de la coordenada "y" que será la ubicación desde donde empecemos a mostrar los datos 
        $y = 85;

        // Obtenemos todos los detalles de la venta actual
        $rsptad = $venta->ventadetalles($_GET["id"]);

        while ($regd = $rsptad->fetch_object()) {
            $line = array("CODIGO" => "$regd->codigo",
                          "DESCRIPCION" => utf8_decode("$regd->articulo"),
                          "CANTIDAD" => "$regd->cantidad",
                          "P.U." => "$regd->precio_venta",
                          "DSCTO" => "$regd->descuento",
                          "SUBTOTAL" => "$regd->subtotal");
            $size = $pdf->addLine($y, $line);
            $y += $size + 2;
        }

        /* Aquí falta código de letras */
        require_once "Letras.php";
        $V = new EnLetras();
        $total = $regv->total_venta; 
        $V = new EnLetras(); 
        $V->substituir_un_mil_por_mil = true;

        $con_letra = strtoupper($V->ValorEnLetras($total, " QUETZALES")); 
        $pdf->addCadreTVAs("---" . $con_letra);

        // Mostramos el impuesto
        $pdf->addTVAs($regv->impuesto, $regv->total_venta, "Q. ");
        $pdf->addCadreEurosFrancs("IVA" . " $regv->impuesto %");
        $pdf->Output('Reporte de Venta', 'I');
    } else {
        echo "No tiene permiso para visualizar el reporte";
    }
}

ob_end_flush();
?>