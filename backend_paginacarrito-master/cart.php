<?php
session_start();


// Verificar si se ha enviado un formulario para eliminar un producto del carrito
if (isset($_POST['remove_from_cart'])) {
    $productIndex = $_POST['productIndex'];

    // Remueve el producto del carrito usando el índice
    if (isset($_SESSION['carrito'][$productIndex])) {
        unset($_SESSION['carrito'][$productIndex]);
    }

    // Redirige nuevamente al carrito o a donde desees
    header("Location: cart.php");
    exit; // Asegura que el script se detenga después de la redirección
}


// Si no existe la sesión 'carrito', la creamos vacía.
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

// Verificar si se ha enviado un formulario para agregar productos al carrito
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];

    // Obtener información del producto (esto podría provenir de una base de datos)
    $productos = array(
        1 => array("titulo" => "Stray Kids / 5-STAR", "precio" => 30.00, "imagen" => 'albumkpop' ),
        2 => array("titulo" => "Twice / MORE & MORE", "precio" => 25.00, "imagen" => 'albumkpop2'),
        3 => array("titulo" => "Seventeen / FML", "precio" => 35.00, "imagen" => 'albumkpop3'),
        4 => array("titulo" => "Twice / Taste of Love", "precio" => 25.00, "imagen" => 'albumkpop4'),
        5 => array("titulo" => "BTS / Proof", "precio" => 60.00, "imagen" => 'albumkpop5'),
        6 => array("titulo" => "Twice / Formula of Love", "precio" => 30.00, "imagen" => 'albumkpop6')
    );

    if (array_key_exists($product_id, $productos)) {
        $product_info = $productos[$product_id];

        // Comprobar si el producto ya existe en el carrito
        $existing_product_key = -1;
        for ($i = 0; $i < count($_SESSION['carrito']); $i++) {
            if ($_SESSION['carrito'][$i]['product_id'] === $product_id) {
                $existing_product_key = $i;
                break;
            }
        }

        if ($existing_product_key !== -1) {
            // Si el producto ya está en el carrito, aumenta la cantidad
            $_SESSION['carrito'][$existing_product_key]['cantidad']++;
        } else {
            // Si el producto no está en el carrito, agrégalo
            $_SESSION['carrito'][] = array(
                'product_id' => $product_id,
                'titulo' => $product_info['titulo'],
                'precio' => $product_info['precio'],
                'imagen' => $product_info['imagen'],
                'cantidad' => 1
            );
        }
    }
}

// Redirigir de nuevo a la página de inicio
header("Location: index.php");
?>

