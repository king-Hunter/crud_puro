<?php include('views/default/header.php'); ?>

<div id="contenedor_mensajes" class="alert alert-success" style="display: none; position: fixed;
    left: 20px;
    top: 4rem;
    z-index: 1;"></div>

<div id="contenedor_botones" class="text-center" style="display: none;">
    <button type="button" class="btn btn-outline-success" id="cargar_tablero_trabajadores">Cargar tablero</button>
</div>

<div id="contenedor_trabajadores"></div>
<div id="contenedor_form_trabajadores"></div>

<?php include('views/default/footer.php'); ?>
