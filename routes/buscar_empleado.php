<?php

include('../controller/TrabajadoresController.php');
$trabajadoresController = new TrabajadoresController();
$buscar = $_POST['buscar'];
$trabajadoresController->buscarTrabajador($buscar);