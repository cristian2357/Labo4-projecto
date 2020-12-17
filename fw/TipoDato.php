<?php
class TipoDato
{
    const ALFANUMERICO = 0;
    const ENTERO_POSITIVO = 1;
    const NUMERICO = 2;
    const SHA1 = 3;
    const FECHA = 4;
    const HORA = 5;

    public static function getTipoDato($dato)
    {
        if (!isset($dato))
            throw new tipException("El siguiente dato ingresado por parametro no existe o es nulo: " . $dato);

        $tipo = gettype($dato);

        switch ($tipo) {
            case "string":
                return TipoDato::ALFANUMERICO;
            case "integer":
                return TipoDato::ENTERO_POSITIVO;
            case "double":
                return TipoDato::NUMERICO;
            default:
                throw new tipException("No se pudo reconocer el siguiente tipo de dato: " . $dato);
        }
    }
}

class tipException extends Exception {}
