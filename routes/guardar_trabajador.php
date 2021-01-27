<?php

include('../controller/TrabajadoresController.php');

$trabajadoreController = new TrabajadoresController();
$formulario = $_POST;
$trabajadoreController->guardar_trabajador($formulario);