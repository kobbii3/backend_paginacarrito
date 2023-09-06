<!-- PAGAR.PHP -->
<div class="modal fade" id="pagar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Formulario de Pago</h5>
            </div>
            <div class="modal-body">
                <!-- FORMULARIO DE PAGO -->
                <h2>Datos Bancarios</h2>
                <form id="formulario-pago">
                    <label for="nombre">Nombre en la Tarjeta:</label>
                    <input type="text" id="nombre" name="nombre" required><br><br>

                    <label for="tarjeta">Número de Tarjeta:</label>
                    <input type="text" id="tarjeta" name="tarjeta" required><br><br>

                    <label for="fecha">Fecha de Expiración:</label>
                    <input type="text" id="fecha" name="fecha" placeholder="MM/YY" required><br><br>

                    <label for="cvv">CVV:</label>
                    <input type="text" id="cvv" name="cvv" required><br><br>

                    <input type="button" class="btn btn-primary" value="Realizar Pago" onclick="realizarPago()">
                </form>
                <div class="mensaje" id="mensaje">
                    <!-- Mensaje procesar pago -->
                </div>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-secondary" href="index.php">Cerrar</a>
            </div>
        </div>
    </div>
</div>
<!-- END PAGAR.PHP -->

<!-- Funcion para mostrar mensaje -->
<script>
function realizarPago() {
    // Obtener los datos del formulario
    var nombre = document.getElementById("nombre").value;
    var tarjeta = document.getElementById("tarjeta").value;
    var fecha = document.getElementById("fecha").value;
    var cvv = document.getElementById("cvv").value;

    // Realizar una solicitud AJAX para procesar el pago
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "procesar_pago.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Actualizar el mensaje en el modal
            document.getElementById("mensaje").innerHTML = xhr.responseText;
        }
    };

    // Enviar los datos del formulario al servidor
    xhr.send("nombre=" + nombre + "&tarjeta=" + tarjeta + "&fecha=" + fecha + "&cvv=" + cvv);
}
</script>