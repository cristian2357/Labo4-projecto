<?php

class DefaultException extends Exception
{
    public function __construct($msg)
    {
        echo ("<h1>$msg</h1>");
        die();
    }
}
