<?php

require './fw/Database.php';

class TestValidaciones
{
    public static function mostrar($str)
    {
        echo "<h1> $str </h1>";
    }

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

        $nombre = "Pepe";
        $apellido = "Gonzalez%%";
        $edad = "23'5";

        $datos = array('nombre' => $nombre, 'apellido' => $apellido, 'edad' => $edad);


        $db->validarAutomatico($datos);

        echo ($datos);
    }

    public static function testValidacionSha1()
    {
        $db = Database::getInstance();

        $hash = '42105214677b4e4b039e6ac9151a0db7d9d653e5';

        $db->validar(array('hash' => $hash), array('hash' => TipoDato::SHA1));

        echo '<h1>Validacion exitosa para:<h1>';
        echo $hash;

        $hash = '42105214677b4e4b039e6ac9151a0db7d9d653';

        $db->validar(array('hash' => $hash), array('hash' => TipoDato::SHA1));
    }

    public static function testValidacionFecha()
    {
        $db = Database::getInstance();

        $fecha = "02/09/2020";
        $db->validar(array('fecha' => $fecha), array('fecha' => TipoDato::FECHA));

        self::mostrar("Validacion $fecha exitosa");

        $fecha = "30/02/2020";
        $db->validar(array('fecha' => $fecha), array('fecha' => TipoDato::FECHA));
    }

    public static function testValidacionFechaFormato()
    {
        $db = Database::getInstance();

        $fecha = "02/09-2020";
        $db->validar(array('fecha' => $fecha), array('fecha' => TipoDato::FECHA));
    }
}
