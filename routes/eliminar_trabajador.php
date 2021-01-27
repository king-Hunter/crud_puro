<?php

include ('../controller/TrabajadoresController.php');

$trabajadoresController =  new TrabajadoresController();
$id_trabajador = $_POST['id_trabajador'];
$trabajadoresController->eliminarTrabajador($id_trabajador);