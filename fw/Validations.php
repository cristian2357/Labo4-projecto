<?php
class TipoDato
{
    const ALFANUMERICO = 0;
    const ENTERO_POSITIVO = 1;
    const FLOTANTE = 2;
}


function validar($datos, $tiposDatos)
{
    validarInformacionParametros($datos, $tiposDatos);
}

function validarInformacionParametros($datos, $tiposDatos)
{
    if (!isset($datos) || count($datos) == 0)
        die("No se han recibido datos para validar");

    if (!isset($tiposDatos) || count($tiposDatos) == 0)
        die("No se han recibido tipos de datos para validar");

    if (count($datos) != count($tiposDatos))
        die("No coincide el tamaño de los datos a validar con los tipos de datos informados");

    foreach ($datos as $claveDato => $valor)
        if (!isset($tiposDatos[$claveDato]))
            die("No existe tipo de dato para el dato: \"" . $claveDato . "\"");

    foreach ($tiposDatos as $claveTipo => $valor)
        if (!isset($datos[$claveTipo]))
            die("No existe dato para el tipo de dato \"" . $claveDato . "\"");
}


