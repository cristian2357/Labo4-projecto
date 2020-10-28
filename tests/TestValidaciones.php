<?php

class TestValidaciones
{
    public static function testValidacion()
    {
        $db = Database::getInstance();
        $db->query("show tables");

        $nombre = "Pepe";
        $apellido = "Gonzalez%%";
        $edad = "23'5";

        $datos = array('nombre' => $nombre, 'apellido' => $apellido, 'edad' => $edad);
        $tiposDatos = array('nombre' => TipoDato::ALFANUMERICO, 'apellido' => TipoDato::ALFANUMERICO, 'edad' => TipoDato::ENTERO_POSITIVO);

        $db->validar($datos, $tiposDatos);

        echo ($datos);
    }

    public static function testValidacionAutomatica()
    {
        $db = Database::getInstance();
        $db->query("show tables");

        $nombre = "Pepe";
        $apellido = "Gonzalez%%";
        $edad = "23'5";

        $datos = array('nombre' => $nombre, 'apellido' => $apellido, 'edad' => $edad);


        $db->validarAutomatico($datos);

        echo ($datos);
    }
}
