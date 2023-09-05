<!-- MODAL CARRITO -->
<div class="modal fade" id="cart-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mi carrito</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
            </div>
            <div class="modal-body">
                <ul class="list-group mb-3">
                <ul class="list-group mb-3">
                    <?php if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) : ?>
                        <?php $total = 0; ?>
                        <?php foreach ($_SESSION['carrito'] as $key => $producto) : ?>
                            <?php if ($producto !== null) : ?>
                                <?php
                                $product_name = $producto['titulo'];
                                $product_price = $producto['precio'];
                                $product_img = $producto['imagen'];
                                $product_quantity = $producto['cantidad'];
                                $product_id = $producto['product_id'];
                                $product_total_price = $product_price * $product_quantity;
                                $total += $product_total_price;
                                ?>
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div class="row col-12">
                                        <div class="col-6 p-0" style="text-align: left; color: #000000;">
                                            <h6 class="my-0">Cantidad: <?php echo $product_quantity; ?>. <?php echo '<br>'.$product_name; ?></h6>
                                        </div>
                                        <div class="col-3 p-0" style="text-align: right; color: #000000;">
                                            <span class="text-muted" style="text-align: right; color: #000000;"><?php echo number_format($product_total_price, 2); ?> USD</span>
                                        </div>
                                        <div class="col-3 p-0" style="text-align: right;">
                                            <button class="btn btn-danger btn-sm" onclick="removeItem(<?php echo $key; ?>)">Quitar</button>
                                        </div>
                                    </div>
                                </li>
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
            <div class="modal-footer">
                <a type="button" class="btn btn-danger" href="borrarcarro.php">Vaciar carrito</a>
                <a type="button" class="btn btn-primary" href="generar_orden.php" id="openResumen">Generar orden</a>
                <a type="button" class="btn btn-secondary" href="index.php">Cerrar</a>
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button> -->
            </div>
        </div>
    </div>
<!-- MODIFICACIÓN PARA QUITAR PRODUCTOS -->


<?php

    // Verificar si se hizo clic en la imagen del carrito
    if (isset($_POST['open_resumen'])) {
        $showResumen = true;
    } else {
        $showResumen = false;
    }
    ?>

    <?php 

    //include("../Admin/navbar.php"); 
    //include("nav_cart.php"); 
    include("generar_orden.php");

    ?>

    <script>
        function removeItem(productIndex) {
            if (confirm('¿Seguro que deseas quitar este producto del carrito?')) {
                // Elimina el producto del carrito usando su índice
                $.ajax({
                    url: 'remove_from_cart.php',
                    type: 'POST',
                    data: { productIndex: productIndex },
                    success: function(response) {
                        // Actualiza el modal después de quitar el producto
                        $('#cart-modal .modal-body').html(response);
                    }
                });
            }
        }
    </script>
    <!-- FIN DE MODIFICACIÓN PARA QUITAR PRODUCTOS -->

    <script>
    document.getElementById('openResumen').addEventListener('click', function (e) {
    e.preventDefault(); // Evita la recarga de la página
    // Abre la ventana modal aquí (usando JavaScript)
    $('#resumen').modal('show');
    });
    </script>

    
    <script>
    // Definir la función para abrir la ventana modal
    function openResumen() {
        // Abre la ventana modal usando jQuery
        $('#resumen').modal('show'); 
    }

    // Asignar el evento click al botón del carrito para llamar a la función
    document.getElementById('openResumen').addEventListener('click', function (e) {
        e.preventDefault(); // Evita la recarga de la página
        openResumen(); // Abre la ventana modal aquí (usando JavaScript)
    });
    </script>

</div>
<!-- END MODAL CARRITO -->