<!-- MODAL GENERAR ORDEN -->
<div class="modal fade" id="resumen" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">RESUMEN ORDEN</h5>
            </div>
            <div class="modal-body">
                <ul class="list-group mb-3">
                <ul class="list-group mb-3" style="display: flex;">
                <div id="contenedor" class="contenedor">
                <?php
// Función mostrar productos
function mostrarProducto($product_name, $product_img, $product_price,$product_id, $product_quantity) {
    echo '<div class="product">';
    echo '<img src="img/' . $product_img . '.jpg" alt="Imagen" class="imagen-producto">';
    echo '<div class="info-producto">';
    echo '<h2>' . $product_name . '</h2>';
    echo '<p class="precio">$' . number_format($product_price, 2) . ' x'.$product_quantity.'</p>';
    echo '<form method="post" action="cart.php">';  
    echo '<input type="hidden" name="product_id" value="' . $product_id . '">';
    echo '<button type="submit" name="add_to_cart" class="boton">Añadir al carrito</button>';
    echo '</form>';
    echo '</div><br>';
    echo '</div>';
}

// Productos predeterminados
//mostrarProducto("5-STAR", "Stray Kids", 30.00, 1);
//mostrarProducto("FML", "Seventeen", 35.00, 3);

// Productos agregados al carrito
if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $key => $producto) {
        if ($producto !== null) {
            $product_name = $producto['titulo'];
            $product_img = $producto['imagen'];
            $product_quantity = $producto['cantidad'];
            $product_price = $producto['precio'];
            $product_id = $producto['product_id'];


            mostrarProducto($product_name, $product_img, $product_price,$product_id, $product_quantity);
        }
    }
}
?>

    </div>
                    
                    <?php if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) : ?>
                        <?php $total = 0; ?>
                        <?php foreach ($_SESSION['carrito'] as $key => $producto) : ?>
                            <?php if ($producto !== null) : ?>
                                <?php
                                $product_name = $producto['titulo'];
                                $product_price = $producto['precio'];
                                $product_quantity = $producto['cantidad'];
                                $product_total_price = $product_price * $product_quantity;
                                $total += $product_total_price;
                                ?>
                                
                            <?php endif; ?>

                        <?php endforeach; ?>
                        <li class="list-group-item d-flex justify-content-between">
                            <span style="text-align: left; color: #000000;">Total (USD)</span>
                            <strong style="text-align: left; color: #000000;"><?php echo isset($total) ? number_format($total, 2) : '0.00'; ?> USD</strong>
                        </li>
                    <?php else : ?>
                        <li class="list-group-item">No hay productos en el carrito.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </script>
        <div class="modal-footer">
                <!-- Botón PAGAR -->

<a type="button" class="btn btn-primary" href="pagar.php" id="openPagar">PAGAR</a>
<a type="button" class="btn btn-secondary" href="index.php">Cerrar</a>
            </div> 
        </div>
    </div>

<?php

// Verificar ir a pago
if (isset($_POST['open_pagar'])) {
    $showPagar = true;
} else {
    $showPagar = false;
}
?>
<?php 

include("pagar.php");

?>
<script>
    document.getElementById('openPagar').addEventListener('click', function (e) {
    e.preventDefault(); // Evita la recarga de la página
    // Abre la ventana modal aquí (usando JavaScript)
    $('#pagar').modal('show');
    
    });
    </script>

    
    <script>
    // Definir la función para abrir la ventana modal
    function openResumen() {
        $('#pagar').modal('show'); 
        $('#resumen').modal('hide');// Abre la ventana modal usando jQuery
    }

    document.getElementById('openPagar').addEventListener('click', function (e) {
        e.preventDefault(); // Evita la recarga de la página
        openResumen(); // Abre la ventana modal aquí (usando JavaScript)
    });
    </script>
</div>
<!-- END MODAL CARRITO -->




