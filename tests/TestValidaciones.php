<?php

require './fw/Database.php';

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

    public static function testValidacionSha1()
    {
        $db = Database::getInstance();
        $db->query("show tables");

        $hash = '42105214677b4e4b039e6ac9151a0db7d9d653e5';

        $db->validar(array('hash' => $hash), array('hash' => TipoDato::SHA1));

        echo '<h1>Validacion exitosa para:<h1>';
        echo $hash;

        $hash = '42105214677b4e4b039e6ac9151a0db7d9d653';

        $db->validar(array('hash' => $hash), array('hash' => TipoDato::SHA1));
    }
}
