<?php

require Configuration::getAbsolutePath().'/fw/SingletonContainer.php';
require Configuration::getAbsolutePath().'/fw/TipoDato.php';

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
            throw new DefaultException(mysqli_error($this->cn) . " " - $query);
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
        if (!$this->cn)                         // para que algunas dependencias no fallen en los test
            $this->connect();

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
                case TipoDato::SHA1:
                    $this->validarSha1($datos[$clave]);
                    break;
                case TipoDato::FECHA:
                    $this->validarFecha($datos[$clave]);
                    break;
                case TipoDato::HORA:
                    $this->validarHora($datos[$clave]);
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
            throw new DefaultException("No se han recibido datos para validar");

        $tiposDatos = array();
        foreach ($datos as $clave => $valor)
            $tiposDatos[$clave] = TipoDato::getTipoDato($datos[$clave]);

        return $tiposDatos;
    }

    private function validarInformacionParametros($datos, $tiposDatos)
    {
        if (!isset($datos) || count($datos) == 0)
            throw new DefaultException("No se han recibido datos para validar");

        if (!isset($tiposDatos) || count($tiposDatos) == 0)
            throw new DefaultException("No se han recibido tipos de datos para validar");

        // faltaria validacion de tipo array?

        if (count($datos) != count($tiposDatos))
            throw new DefaultException("No coincide el tamaño de los datos a validar con los tipos de datos informados");

        foreach ($datos as $claveDato => $valor)
            if (!isset($tiposDatos[$claveDato]))
                throw new DefaultException("No existe tipo de dato para el dato: \"" . $claveDato . "\"");

        foreach ($tiposDatos as $claveTipo => $valor)
            if (!isset($datos[$claveTipo]))
                throw new DefaultException("No existe dato para el tipo de dato \"" . $claveDato . "\"");
    }

    private function validarEnteroPositivo($dato)
    {
        if (!ctype_digit($dato))
            throw new DefaultException($dato . " no es un entero positivo");
        if ($dato<1) throw new DefaultException($dato . " no es un entero positivo");
    }


    private function validarNumerico($dato)
    {
        if (!is_numeric($dato))
            throw new DefaultException($dato . " no deberia contener caracteres alfanumericos");
        if ($dato<1) throw new DefaultException($dato . " no es un entero positivo");
    }

    private function validarString($dato)
    {
        if (strlen($dato)<1) throw new DefaultException($dato . " no es valido");
        $dato = substr($dato, 0 , 20);

        $dato = mysqli_escape_string($this->cn, $dato);
        return $dato;
    }

    private function validarStringParaLike($dato)
    {
        if (strlen($dato)<1) throw new DefaultException($dato . " no es valido");
        $dato = substr($dato, 0 , 20);
        
        $dato = mysqli_escape_string($this->cn, $dato);
        $dato = str_replace("%", "\%", $dato);
        $dato = str_replace("_", "\_", $dato);
        return $dato;
    }

    private function validarSha1($str)
    {
        if (!preg_match('/^[0-9a-f]{40}$/i', $str))
            throw new DefaultException($str . " no es un hash valido");
    }

    private function validarFecha($strFecha)
    {
        if (!preg_match('/' . '\d{2}(\/)\d{2}(\/)\d{4}' . '/', $strFecha))
            throw new DefaultException($strFecha . " tiene un formato de fecha valido");
        list($dia, $mes, $anio) = explode('/', $strFecha);
        if (!checkdate($mes, $dia, $anio))
            throw new DefaultException($strFecha . " no es una fecha valida");
    }

    private function validarHora($strHora)
    {
        if (!preg_match('/' . '(2[0-3]|[01][0-9]):[0-5][0-9]' . '/', $strHora))
            throw new DefaultException("La hora ingresada es invalida");
    }
}

class DefaultException extends Exception {}
