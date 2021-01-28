<?php

include ('../models/TrabajadoresModel.php');
include ('../models/CatTelefonoModel.php');

class TrabajadoresController{

    private $trabajadoresModel;
    private $catTelModel;

    function __construct()
    {
        $this->trabajadoresModel = new TrabajadoresModel();
        $this->catTelModel = new CatTelefonoModel();
    }
    
    
    public function buscarTrabajador($buscar){
        $trabajadores = $this->trabajadoresModel->buscarTrabajadores($buscar);
        include('../views/trabajadores/tablero.php');
    }
    
    public function tablero(){
        $trabajadores = $this->trabajadoresModel->obtenerTrabajadores();
        include('../views/trabajadores/tablero.php');
    }

    public function formTrabajadorNuevo(){
        include('../views/trabajadores/form_trabajador_modal.php');
    }

    public function formTrabajadorEditar($idTrabajador){
        $trabajador = $this->trabajadoresModel->obtenerTrabajadorID($idTrabajador);
        $catalogo_telefono = $this->catTelModel->obtenerCatalogo();
        include('../views/trabajadores/form_trabajador_modal.php');
    }

    public function obtenerRowTelefono(){
        $catalogo_telefono = $this->catTelModel->obtenerCatalogo();
        include ('../views/trabajadores/registro_telefono.php');
    }

    public function guardar_trabajador($formulario){
        $guardar = $this->trabajadoresModel->guardar($formulario);
        $return_json = [
            'success' => true,
            'msg' => 'Se guardo el trabajador con exito'
        ];
        if(!$guardar){
            $return_json = [
                'success' => false,
                'msg' => 'Hubo un error al guardar el trabajador'
            ];
        }
        echo json_encode($return_json);
    }

    public function eliminarTelefonoTrabajador($idTelfonoTrabajador){
        $respuesta = array(
            'success' => false,
            'msg' => 'No se pudo eliminiar el telefono del trabajador'
        );
        if($this->trabajadoresModel->eliminarTelefonoEmpleado($idTelfonoTrabajador)){
            $respuesta['success'] = true;
            $respuesta['msg'] = 'Se elimino el telefono del trabajador';
        }
        echo json_encode($respuesta);
    }

    public function eliminarTrabajador($id_trabajador){
        $respuesta = array(
            'success' => false,
            'msg' => 'No se pudo eliminar el trabajador'
        );
        if($this->trabajadoresModel->eliminarTrabajador($id_trabajador)){
            $respuesta['success'] = true;
            $respuesta['msg'] = 'Se elimino el trabajador con exito';
        }
        echo json_encode($respuesta);
    }
}