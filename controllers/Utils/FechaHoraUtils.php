<?php

class FechaHoraUtils
{
    const FORMAT_DEFAULT_FECHA = 'd/m/Y';

    public static function getFechaFutura($diasFuturos)
    {
        $timeStamp = strtotime("+$diasFuturos day");
        $dateTime = new DateTime();
        $dateTime->setTimestamp($timeStamp);
        return date_format($dateTime, self::FORMAT_DEFAULT_FECHA);
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
        return date_format($dateTime, self::FORMAT_DEFAULT_FECHA);
    }

    public static function parseStringToDateTime($strFecha)
    {
        return date('d/M/Y', strtotime($strFecha));
    }

    // Retorna lista de fechas en un intervalo, que esten dentro de los dias de la semana permitidos
    public static function getListaFechasEnDiasPermitidos($diasPermitidos, $fechaInicio, $fechaFin)
    {
        if (!isset($diasPermitidos) || !is_array($diasPermitidos))
            throw new Exception("Los dias ingresados como parametro no son validos");

        $fechaInicio = Datetime::createFromFormat(SELF::FORMAT_DEFAULT_FECHA, $fechaInicio);
        $fechaFin = Datetime::createFromFormat(SELF::FORMAT_DEFAULT_FECHA, $fechaFin);

        if ($fechaInicio > $fechaFin)
            throw new Exception("La fecha de inicio es mayor que la final");

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

    public static function getFechaHoy()
    {
        return self::parseDateTimeToStringFecha(new DateTime());
    }

    public static function parseStringFechaHoraToDatetime($strFecha, $strHora)
    {
        return date_create_from_format('d/m/Y H:i', $strFecha . ' ' . $strHora);
    }

    public static function addMinutesToDatetime($datetime, $minutosAgregados)
    {
        $dateInterval = new DateInterval("PT" . $minutosAgregados . 'M');
        $datetime->add($dateInterval);
    }

    public static function getHoraByDateTime($datetime)
    {
        return date_format($datetime, 'H:i');
    }
}
