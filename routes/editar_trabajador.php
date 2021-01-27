<?php

include('../controller/TrabajadoresController.php');
$trabajadoresController = new TrabajadoresController();
$idTrabajador = $_POST['id_trabajador'];
$trabajadoresController->formTrabajadorEditar($idTrabajador);