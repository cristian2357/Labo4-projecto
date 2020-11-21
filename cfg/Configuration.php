<?php
class Configuration
{
    const DB_HOST = "us-cdbr-east-02.cleardb.com";
    const DB_USER = "b1fba2bae6cecb";
    const DB_PASSWORD = "6a3e69e6";
    const DB_NAME = "heroku_49ccb216faf4052";
    const NOMBRE_PROYECTO = "Labo4 projecto";

    public static function getAbsolutePath()
    {
        return 'C:/xampp/htdocs/Labo4 projecto';

    }

    public static function getAbsolutePathSinDirectorioLocal()
    {
        $path = self::getAbsolutePath();
        $dirs = explode('/', $path);
        $output = "";
        $encontrado = false;
        foreach ($dirs as $d) {
            if ($encontrado)
                $output .= $d;
            if ($d == self::NOMBRE_PROYECTO)
                $encontrado = true;
        }
        return $output;
    }
}
