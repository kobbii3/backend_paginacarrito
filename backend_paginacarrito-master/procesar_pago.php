<?php
//ARCHIVO PROCESAR PAGO INICIO
session_start();
// Datos bancarios simulados almacenados en una variable (debes reemplazarlos con datos reales)
$datosBancarios = array(
    'nombre' => 'Nombre del Titular',
    'tarjeta' => '1234567890123456', // Número de tarjeta (debe coincidir con el formato real)
    'fecha' => '12/23', // Fecha de expiración (debe coincidir con el formato real)
    'cvv' => '123', // CVV (debe coincidir con el formato real)
    'saldo' => 1000.00 // Saldo disponible
);

// Obtener datos enviados desde el formulario
$nombreEnTarjeta = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$numeroTarjeta = isset($_POST['tarjeta']) ? $_POST['tarjeta'] : '';
$fechaExpiracion = isset($_POST['fecha']) ? $_POST['fecha'] : '';
$cvv = isset($_POST['cvv']) ? $_POST['cvv'] : '';

// Realizar las verificaciones necesarias
if (
    $nombreEnTarjeta === $datosBancarios['nombre'] &&
    $numeroTarjeta === $datosBancarios['tarjeta'] &&
    $fechaExpiracion === $datosBancarios['fecha'] &&
    $cvv === $datosBancarios['cvv']
) {
    // Verificar si el monto a pagar es válido
    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
        $total = 0;
        foreach ($_SESSION['carrito'] as $key => $producto) {
            if ($producto !== null) {
                $product_price = $producto['precio'];
                $product_quantity = $producto['cantidad'];
                $product_total_price = $product_price * $product_quantity;
                $total += $product_total_price;
            }
        }
        
        // Usar el valor de $total como monto a pagar
        if ($total <= $datosBancarios['saldo']) {
            // Pago exitoso
            echo "Pago exitoso. El monto de $" . number_format($total, 2) . " USD ha sido debitado de tu cuenta.";
        } else {
            // Saldo insuficiente
            echo "Saldo insuficiente en tu tarjeta.";
        }
    } else {
        // No hay productos en el carrito
        echo "No hay productos en el carrito.";
    }
} else {
    // Datos erróneos
    echo "Los datos ingresados son incorrectos. Por favor, verifica la información.";
}

//ARCHIVO PROCESAR PAGO FIN
?>
