<?php

include_once('BaseDeDatos.php');

class TrabajadoresModel extends BaseDeDatos
{

    function __construct()
    {
        parent::__construct();
    }

    public function obtenerTrabajadores(){
        /*$trabajadoresModel = array(
            array('id'=> '5','nombre' => 'Enrique Corona Ricaño','correo' =>'enrique_cr1990@hotmail.com','telefono' => '246 123 58 69','cumpleanios' => '6 de abril'),
            array('id'=> '10','nombre' => 'Shaila Palafox Hernandez','correo' =>'shailaph@hotmail.com','telefono' => '246 123 96 78','cumpleanios' => '1 de enero')
        );*/
        $this->consulta("select 
               e.id_empleado id,
               concat(e.nombre,' ',e.paterno, ' ', e.materno) nombre,
               e.correo correo,
               e.nacimiento cumpleanios,
               (
                select group_concat(ct.tipo, ': ', te.telefono) from telefono_empleado te 
                  inner join catalogo_telefono ct on ct.id_catalogo_telefono = te.id_catalogo_telefono
                where te.id_empleado = e.id_empleado
               ) telefono
            from empleado e");
        $trabajadoresModel = $this->procesarResultadoArray();
        return $trabajadoresModel;
    }

    public function obtenerTrabajadorID($idTrabajador){
        /*$trabajador = array(
            'id_empleado'=> '5',
            'nombre' => 'Enrique',
            'paterno' => ' Corona',
            'materno' => 'Ricaño',
            'correo' =>'enrique_cr1990@hotmail.com',
            'nacimiento' => '1990-04-06',
        );*/
        $this->consulta("select * from empleado e where e.id_empleado = $idTrabajador");
        $trabajador = $this->procesarResultadoArray()[0];
        $trabajador['telefonos'] = $this->obtenerTelefonosTrabajador($idTrabajador);
        return $trabajador;
    }

    public function obtenerTelefonosTrabajador($idTrabajador){
        /*$telefonos = array(
            array('id_telefono_empleado' => 1,'telefono' => '246 789 45 12','id_catalogo_telefono' => 1, 'id_empleado' => 5),
            array('id_telefono_empleado' => 2,'telefono' => '789 45 12','id_catalogo_telefono' => 2, 'id_empleado' => 5),
        );*/
        $this->consulta("select * from telefono_empleado te where te.id_empleado = $idTrabajador");
        $telefonos = $this->procesarResultadoArray();
        return $telefonos;
    }

    public function guardar($formulario){
        try{
            $telefonos = $formulario['telefonos'];
            unset($formulario['telefonos']);
            if(isset($formulario['id_empleado']) && $formulario['id_empleado'] != ''){
                //actualizar
                $this->updateEmpleado($formulario['id_empleado'],$formulario);
                //numeros de telefono
                foreach ($telefonos as $tel){
                    if(isset($tel['id_telefono_empleado']) && $tel['id_telefono_empleado'] != ''){
                        //actualizar telefono
                        $this->actualizarTelefonoEmpleado($tel['id_telefono_empleado'],$tel);
                    }else{
                        //insertar telefono
                        $this->insertarTelefonoEmpleado($formulario['id_empleado'],$tel);
                    }
                }
            }else{
                //insertar
                $formulario['id_empleado'] = null;
                $idNuevoEmpleado = $this->insertarEmpleado($formulario);
                foreach ($telefonos as $tel){
                    $this->insertarTelefonoEmpleado($idNuevoEmpleado,$tel);
                }
            }
            return true;
        }catch (Exception $ex){
            return false;
        }
    }

    public function insertarTelefonoEmpleado($idEmpleado, $dataTelefono){
        if ($dataTelefono['id_telefono_empleado']=='') {
            $dataTelefono['id_telefono_empleado'] = null;
        }
        $dataTelefono['id_empleado'] = $idEmpleado;
        return $this->insertarRegistro('telefono_empleado',$dataTelefono);
    }

    public function actualizarTelefonoEmpleado($idTelefonoEmpleado,$dataTelefono){
        return $this->actualizarRegistro('telefono_empleado',$dataTelefono,array('id_telefono_empleado' => $idTelefonoEmpleado));
    }

    public function eliminarTelefonoEmpleado($idTelefonoEmpleado){
        return $this->eliminarRegistro('telefono_empleado',array('id_telefono_empleado' => $idTelefonoEmpleado));
    }

    public function eliminarTrabajador($id_trabajador){
        $this->eliminarTelefonosEmpleado($id_trabajador);
        return $this->eliminarRegistro('empleado',array('id_empleado' => $id_trabajador));
    }

    /**
     * funciones privadas
     */
    private function insertarEmpleado($dataEmpleado){
        

        $this->insertarRegistro('empleado',$dataEmpleado);
        return $this->getUltimoIdInsertado();
    }

    private function updateEmpleado($idEmpleado,$dataEmpleado){
        $this->actualizarRegistro('empleado',$dataEmpleado,array('id_empleado' => $idEmpleado));
    }

    private function eliminarTelefonosEmpleado($idEmpleado){
        return $this->eliminarRegistro('telefono_empleado',array('id_empleado' => $idEmpleado));
    }

}