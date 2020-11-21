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
}
