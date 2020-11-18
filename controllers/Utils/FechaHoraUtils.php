<?php

class FechaHoraUtils
{
    const FORMAT_DEFAULT_FECHA = 'd/m/Y';

    public static function getFechaFutura($diasFuturos)
    {
        return date_format(date(strtotime("+$diasFuturos day")), 'd/m/y');
    }

    public static function getNumeroDiaSemanaByDateTime($dateTime)
    {
        $nroDia = date_format($dateTime, 'w');
        if ($nroDia == 0)
            $nroDia = 7;
        return $nroDia;
    }

    public static function parseDateTimeToStringFecha($dateTime)
    {
        return date_format($dateTime, 'd/m/y');
    }

    public static function parseStringToDateTime($strFecha)
    {
        return date('d/M/Y', strtotime($strFecha));
    }

    // Retorna lista de fechas en un intervalo, que esten dentro de los dias de la semana permitidos
    public static function getListaFechasEnDiasPermitidos($diasPermitidos, $fechaInicio, $fechaFin)
    {
        if (!isset($diasPermitidos) || !is_array($diasPermitidos))
            die("Los dias ingresados como parametro no son validos");

        $fechaInicio = Datetime::createFromFormat(SELF::FORMAT_DEFAULT_FECHA, $fechaInicio);
        $fechaFin = Datetime::createFromFormat(SELF::FORMAT_DEFAULT_FECHA, $fechaFin);

        if ($fechaInicio > $fechaFin)
            die("La fecha de inicio es mayor que la final");

        $difDias = date_diff($fechaInicio, $fechaFin);
        $difDias = $difDias->format('%d');

        $fechasRetornadas = array();

        for ($d = 0; $d <= $difDias; $d++) {
            $fechaTemp = clone $fechaInicio;
            $fechaTemp->add(new DateInterval('P' . $d . 'D'));

            $nroDiaSemana = self::getNumeroDiaSemanaByDateTime($fechaTemp);
            if (in_array($nroDiaSemana, $diasPermitidos))
                $fechasRetornadas[] = self::parseDateTimeToStringFecha($fechaTemp);
        }
        return $fechasRetornadas;
    }
}
