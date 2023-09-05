<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <!-- NAVBAR -->

    <?php
    session_start();

    // Verificar si se hizo clic en la imagen del carrito
    if (isset($_POST['open_cart_modal'])) {
        $showCartModal = true;
    } else {
        $showCartModal = false;
    }
    ?>

    <?php 

    //include("../Admin/navbar.php"); 
    //include("nav_cart.php"); 
    include("modal_cart.php");

    ?>

    </head>
    <body>


    <header>
        <div class="header-content">
            <h1 class="titulo-tienda">Album store</h1><br>
            <div class="carrito">
                <form method="post" action="">
                    <!-- Cambia el tipo de botón a submit para enviar el formulario -->
                    <input type="hidden" name="open_cart_modal" value="1">
                    <img src="img/carritocompras.png" alt="carrito" class="logo-carrito" style="cursor: pointer;" id="openCartModal">
                    <?php
                    // Mostrar el contador de productos en el carrito
                    if (isset($_SESSION['carrito'])) {
                        $total_cantidad = 0;
                        foreach ($_SESSION['carrito'] as $producto) {
                            if ($producto !== null) {
                                $total_cantidad += $producto['cantidad'];
                            }
                        }
                        // Establecer el color del contador
                        $color_contador = ($total_cantidad >= 1) ? 'purple' : 'black';
                        echo '<p class="texto-carrito" style="color: ' . $color_contador . ';">[' . $total_cantidad . ']</p>';
                    } else {
                        echo '<p class="texto-carrito">[0]</p>';
                    }
                    ?>
                </form>
            </div>
            </div>
            
    </header>


    <div id="contenedor" class="contenedor">
        <div class="product">
            <img src="img/albumkpop.jpg" alt="Imagen" class="imagen-producto">
            <div class="info-producto">
                <h2>5-STAR</h2>
                <h6>Stray Kids</h6>
                <p class="precio">$30.00</p>
                <form method="post" action="cart.php">
                    <input type="hidden" name="product_id" value="1">
                    <button type="submit" name="add_to_cart" class="boton">Añadir al carrito</button>
                </form>
            </div><br>
        </div>





        <div class="product">
            <img src="img/albumkpop2.jpg" alt="Imagen" class="imagen-producto">
            <div class="info-producto">
                <h2>MORE & MORE</h2>
                <h6>Twice</h6>
                <p class="precio">$25.00</p>
                <form method="post" action="cart.php">
                    <input type="hidden" name="product_id" value="2">
                    <button type="submit" name="add_to_cart" class="boton">Añadir al carrito</button>
                </form>

            </div>
        </div>




        <div class="product">
            <img src="img/albumkpop3.jpg" alt="Imagen" class="imagen-producto">
            <div class="info-producto">
                <h2>FML</h2>
                <h6>Seventeen</h6>
                <p class="precio">$35.00</p>
                <form method="post" action="cart.php">
                    <input type="hidden" name="product_id" value="3">
                    <button type="submit" name="add_to_cart" class="boton">Añadir al carrito</button>
                </form>
            </div>
        </div>




        <div class="product">
            <img src="img/albumkpop4.jpg" alt="Imagen" class="imagen-producto">
            <div class="info-producto">
                <h2>Taste of Love</h2>
                <h6>Twice</h6>
                <p class="precio">$25.00</p>
                <form method="post" action="cart.php">
                    <input type="hidden" name="product_id" value="4">
                    <button type="submit" name="add_to_cart" class="boton">Añadir al carrito</button>
                </form>
            </div><br>
        </div>




        <div class="product">
            <img src="img/albumkpop5.jpg" alt="Imagen" class="imagen-producto">
            <div class="info-producto">
                <h2>Proof</h2>
                <h6 class="artista">BTS</h6>
                <p class="precio">$60.00</p>
                <form method="post" action="cart.php">
                    <input type="hidden" name="product_id" class="id" value="5">
                    <button type="submit" name="add_to_cart" class="boton">Añadir al carrito</button>
                </form>
            </div>
        </div>




        <div class="product">
            <img src="img/albumkpop6.jpg" alt="Imagen" class="imagen-producto">
            <div class="info-producto">
                <h2>Formula of Love</h2>
                <h6>Twice</h6>
                <p class="precio">$30.00</p>
                <form method="post" action="cart.php">
                    <input type="hidden" name="product_id" value="6">
                    <button type="submit" name="add_to_cart" class="boton">Añadir al carrito</button>
                </form>
            </div>
        </div>
    </div>
    <br>

    <script>
    document.getElementById('openCartModal').addEventListener('click', function (e) {
    e.preventDefault(); // Evita la recarga de la página
    // Abre la ventana modal aquí (usando JavaScript)
    $('#cart-modal').modal('show');
    });
    </script>

    
    <script>
    // Definir la función para abrir la ventana modal
    function openCartModal() {
        $('#cart-modal').modal('show'); // Abre la ventana modal usando jQuery
    }

    // Asignar el evento click al botón del carrito para llamar a la función
    document.getElementById('openCartModal').addEventListener('click', function (e) {
        e.preventDefault(); // Evita la recarga de la página
        openCartModal(); // Abre la ventana modal aquí (usando JavaScript)
    });
    </script>


<script>
    function removeItem(productIndex) {
        if (confirm('¿Seguro que deseas quitar este producto del carrito?')) {
            // Elimina el producto del carrito usando su índice
            <?php
            // Esto es para generar el código JavaScript que redirige a remove_from_cart.php
            // pasando el índice del producto a eliminar
            ?>
            window.location.href = 'remove_from_cart.php?productIndex=' + productIndex;
        }
    }
</script>


<script>
document.addEventListener("DOMContentLoaded", function () {
    // Verificar si el parámetro 'producto_eliminado' está en la URL
    const urlParams = new URLSearchParams(window.location.search);
    const productoEliminado = urlParams.get("producto_eliminado");
    
    if (productoEliminado === "true") {
        // Abre la ventana modal del carrito
        $('#cart-modal').modal('show');
    }
});
</script>

</body>
</html>