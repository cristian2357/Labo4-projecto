<?php

abstract class View
{
    public function render()
    {
        return "../html/" . get_class($this) . ".php";
    }
}
