<?php
/**
 * Class ConfigDB que contendra la configuracion
 * de la BD para su conexion
 */

class ConfigDB
{

    public static function getConfig(){
        $dbConfig = array();

        /**
         * switch del server name para saber que configuracion cargar
         * se usa principalmente si hay distintos alojamientos en el server
         * ya sea para local, pruebas o produccion
         */
        switch ($_SERVER['SERVER_NAME']){
            default:
                $dbConfig['host'] = '127.0.0.1';
                $dbConfig['port'] = '3306';
                $dbConfig['user'] = 'root';
                $dbConfig['password'] = '';
                $dbConfig['database'] = 'capacitacion_soft';
                break;
        }
        return $dbConfig;
    }

}