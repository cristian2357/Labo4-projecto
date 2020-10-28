<?php

require 'cfg/Configuration.php';
require 'fw/SingletonContainer.php';
require 'fw/TipoDato.php';

class Database extends SingletonContainer
{
    private $cn;
    private $res;

    private function connect()
    {
        $this->cn = mysqli_connect(Configuration::DB_HOST, Configuration::DB_USER, Configuration::DB_PASSWORD, Configuration::DB_NAME);
    }

    public function query($query)
    {
        if (!$this->cn)
            $this->connect();
        $this->res = mysqli_query($this->cn, $query);
        if (!$this->res)
            die(mysqli_error($this->cn) . " " - $query);
    }

    public function fetch()
    {
        return mysqli_fetch_assoc($this->res);
    }

    public function fetchAll()
    {
        $vecAux = array();
        while ($fila = $this->fetch())
            $vecAux[] =  $fila;
        return $vecAux;
    }

    public function numRows()
    {
        return mysqli_num_rows($this->res);
    }

    public function validar($datos, $tiposDatos)
    {
        $this->validarInformacionParametros($datos, $tiposDatos);
        foreach ($datos as $clave => $valor) {
            switch ($tiposDatos[$clave]) {
                case TipoDato::ALFANUMERICO:
                    $datos[$clave] = $this->validarString($datos[$clave]);
                    break;
                case TipoDato::ENTERO_POSITIVO:
                    $this->validarEnteroPositivo($datos[$clave]);
                    break;
                case TipoDato::NUMERICO:
                    $this->validarNumerico($datos[$clave]);
                    break;
            }
        }
    }

    public function validarAutomatico($datos)
    {
        $vecTiposDatos = $this->crearArrayConTiposDeDato($datos);

        $this->validar($datos, $vecTiposDatos);
    }

    private function crearArrayConTiposDeDato($datos)
    {
        if (!isset($datos) || count($datos) == 0)
            die("No se han recibido datos para validar");

        $tiposDatos = array();
        foreach ($datos as $clave => $valor)
            $tiposDatos[$clave] = TipoDato::getTipoDato($datos[$clave]);
            
        return $tiposDatos;
    }

    private function validarInformacionParametros($datos, $tiposDatos)
    {
        if (!isset($datos) || count($datos) == 0)
            die("No se han recibido datos para validar");

        if (!isset($tiposDatos) || count($tiposDatos) == 0)
            die("No se han recibido tipos de datos para validar");

        // faltaria validacion de tipo array?

        if (count($datos) != count($tiposDatos))
            die("No coincide el tamaño de los datos a validar con los tipos de datos informados");

        foreach ($datos as $claveDato => $valor)
            if (!isset($tiposDatos[$claveDato]))
                die("No existe tipo de dato para el dato: \"" . $claveDato . "\"");

        foreach ($tiposDatos as $claveTipo => $valor)
            if (!isset($datos[$claveTipo]))
                die("No existe dato para el tipo de dato \"" . $claveDato . "\"");
    }

    private function validarEnteroPositivo($dato)
    {
        if (!ctype_digit($dato))
            die($dato . " no es un entero positivo");
    }


    private function validarNumerico($dato)
    {
        if (!is_numeric($dato))
            die($dato . " no deberia contener caracteres alfanumericos");
    }

    private function validarString($dato)
    {
        $dato = mysqli_escape_string($this->cn, $dato);
        $dato = str_replace("%", "\%", $dato);
        $dato = str_replace("_", "\_", $dato);
        return $dato;
    }
}
