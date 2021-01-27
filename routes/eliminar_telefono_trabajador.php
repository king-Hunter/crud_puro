<?php

include('../controller/TrabajadoresController.php');

$trabajadoresControler = new TrabajadoresController();
$idTelefonoTrabajador = $_POST['id_telefono_trabajador'];
$trabajadoresControler->eliminarTelefonoTrabajador($idTelefonoTrabajador);