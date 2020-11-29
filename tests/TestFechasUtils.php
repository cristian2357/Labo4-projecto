<?php

require Configuration::getAbsolutePath() . '/controllers/Utils/FechaHoraUtils.php';

class TestFechasUtils
{

    public static function testListaFechasSegunDiasSemanales()
    {
        $strFecha = "09/11/2020";
        $strFechaFin = "15/11/2020";

        $diasPermitidos = array('6', '7');

        var_dump(FechaHoraUtils::getListaFechasEnDiasPermitidos($diasPermitidos, $strFecha, $strFechaFin));
    }

    public static function testFechaFutura()
    {
        $diasFuturos = 15;
        $a = strtotime("+$diasFuturos day");
        $b = new DateTime();
        $b->setTimestamp($a);

        $c = date_format($b, 'd/m/y');
        var_dump($c);
    }

    public static function testStrFechaHoraToDateTime()
    {
        $strFecha = "09/11/2020";
        $strHora = "10:00";

        var_dump(FechaHoraUtils::parseStringFechaHoraToDatetime($strFecha, $strHora));
    }

    public static function testAñadirMinutos()
    {
        $strFecha = "09/11/2020";
        $strHora = "10:00";

        $datetime = FechaHoraUtils::parseStringFechaHoraToDatetime($strFecha, $strHora);

        FechaHoraUtils::addMinutesToDatetime($datetime, 10);

        var_dump($datetime);
    }
}
