<?php

class TestVarios
{
    public static function testDirectorios()
    {        
        echo Configuration::getAbsolutePath();
        echo '<br>';
        echo Configuration::getAbsolutePathSinDirectorioLocal();        
    }
}
