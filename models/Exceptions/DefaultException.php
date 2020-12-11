<?php

class DefaultException extends Exception
{
    public function __constructor($msg)
    {
        echo "<h1>$msg</h1>";
    }
}
