<?php
session_start();

if (isset($_GET['productIndex'])) {
    $productIndex = $_GET['productIndex'];

    // Verificar si el producto existe en el carrito
    if (isset($_SESSION['carrito'][$productIndex])) {
        // Reducir la cantidad en 1
        $_SESSION['carrito'][$productIndex]['cantidad']--;

        // Si la cantidad es menor o igual a 0, eliminar el producto
        if ($_SESSION['carrito'][$productIndex]['cantidad'] <= 0) {
            unset($_SESSION['carrito'][$productIndex]);
        }
    }
}

// Redirige nuevamente al carrito o a donde desees
header("Location: index.php?producto_eliminado=true");
?>