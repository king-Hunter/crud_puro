<?php

//incluimos y cargamos el controlador de trabajadores
include('../controller/TrabajadoresController.php');
$trabajadoresController = new TrabajadoresController();
$trabajadoresController->tablero();